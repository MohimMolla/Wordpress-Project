<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


// Exit if accessed directly.
defined('ABSPATH') || exit;

class CoverNews_Notice
{
    public $name;
    public $type;
    public $dismiss_url;
    public $temporary_dismiss_url;
    public $pricing_url;
    public $current_user_id;

    /**
     * The constructor.
     *
     * @param string $name Notice Name.
     * @param string $type Notice type.
     * @param string $dismiss_url Notice permanent dismiss URL.
     * @param string $temporary_dismiss_url Notice temporary dismiss URL.
     *
     * @since 1.4.7
     *
     */
    public function __construct($name, $type, $dismiss_url, $temporary_dismiss_url)
    {
        $this->name = $name;
        $this->type = $type;
        $this->dismiss_url = $dismiss_url;
        $this->temporary_dismiss_url = $temporary_dismiss_url;
        $this->pricing_url = 'https://afthemes.com/products/covernews-pro/';
        $this->current_user_id = get_current_user_id();

        // Notice markup.
        add_action('admin_notices', array($this, 'notice'));

        $this->dismiss_notice();
        $this->dismiss_notice_temporary();
    }

    public function notice()
    {
        if (!$this->is_dismiss_notice()) {
            $this->notice_markup();
        }
    }

    private function is_dismiss_notice()
    {
        return apply_filters('covernews_' . $this->name . '_notice_dismiss', true);
    }

    public function notice_markup()
    {
        echo '';
    }

    /**
     * Hide a notice if the GET variable is set.
     */
    public function dismiss_notice()
    {
        if (isset($_GET['covernews_notice_dismiss']) && isset($_GET['_covernews_upgrade_notice_dismiss_nonce'])) { // WPCS: input var ok.
            if (!wp_verify_nonce(wp_unslash($_GET['_covernews_upgrade_notice_dismiss_nonce']), 'covernews_upgrade_notice_dismiss_nonce')) { // phpcs:ignore WordPress.VIP.ValidatedSanitizedInput.InputNotSanitized
                wp_die(__('Action failed. Please refresh the page and retry.', 'covernews')); // WPCS: xss ok.
            }

            if (!current_user_can('publish_posts')) {
                wp_die(__('Cheatin&#8217; huh?', 'covernews')); // WPCS: xss ok.
            }

            $dismiss_notice = sanitize_text_field(wp_unslash($_GET['covernews_notice_dismiss']));

            // Hide.
            if ($dismiss_notice === $_GET['covernews_notice_dismiss']) {
                add_user_meta(get_current_user_id(), 'covernews_' . $dismiss_notice . '_notice_dismiss', 'yes', true);
            }
        }
    }

    public function dismiss_notice_temporary()
    {
        if (isset($_GET['covernews_notice_dismiss_temporary']) && isset($_GET['_covernews_upgrade_notice_dismiss_temporary_nonce'])) { // WPCS: input var ok.
            if (!wp_verify_nonce(wp_unslash($_GET['_covernews_upgrade_notice_dismiss_temporary_nonce']), 'covernews_upgrade_notice_dismiss_temporary_nonce')) { // phpcs:ignore WordPress.VIP.ValidatedSanitizedInput.InputNotSanitized
                wp_die(__('Action failed. Please refresh the page and retry.', 'covernews')); // WPCS: xss ok.
            }

            if (!current_user_can('publish_posts')) {
                wp_die(__('Cheatin&#8217; huh?', 'covernews')); // WPCS: xss ok.
            }

            $dismiss_notice = sanitize_text_field(wp_unslash($_GET['covernews_notice_dismiss_temporary']));

            // Hide.
            if ($dismiss_notice === $_GET['covernews_notice_dismiss_temporary']) {
                add_user_meta(get_current_user_id(), 'covernews_' . $dismiss_notice . '_notice_dismiss_temporary', 'yes', true);
            }
        }
    }
}


class CoverNews_Upgrade_Notice extends CoverNews_Notice {

    public function __construct() {
        if ( ! current_user_can( 'publish_posts' ) ) {
            return;
        }

        $dismiss_url = wp_nonce_url(
            add_query_arg( 'covernews_notice_dismiss', 'upgrade', admin_url() ),
            'covernews_upgrade_notice_dismiss_nonce',
            '_covernews_upgrade_notice_dismiss_nonce'
        );

        $temporary_dismiss_url = wp_nonce_url(
            add_query_arg( 'covernews_notice_dismiss_temporary', 'upgrade', admin_url() ),
            'covernews_upgrade_notice_dismiss_temporary_nonce',
            '_covernews_upgrade_notice_dismiss_temporary_nonce'
        );

        parent::__construct( 'upgrade', 'info', $dismiss_url, $temporary_dismiss_url );

        $this->set_notice_time();

        $this->set_temporary_dismiss_notice_time();

        $this->set_dismiss_notice();
    }

    private function set_notice_time() {
        if ( ! get_option( 'covernews_upgrade_notice_start_time' ) ) {
            update_option( 'covernews_upgrade_notice_start_time', time() );
        }
    }

    private function set_temporary_dismiss_notice_time() {
        if ( isset( $_GET['covernews_notice_dismiss_temporary'] ) && 'upgrade' === $_GET['covernews_notice_dismiss_temporary'] ) {
            update_user_meta( $this->current_user_id, 'covernews_upgrade_notice_dismiss_temporary_start_time', time() );
        }
    }

    public function set_dismiss_notice() {

        /**
         * Do not show notice if:
         *
         * 1. It has not been 5 days since the theme is activated.
         * 2. If the user has ignored the message partially for 2 days.
         * 3. Dismiss always if clicked on 'Dismiss' button.
         */
        if ( get_option( 'covernews_upgrade_notice_start_time' ) > strtotime( '-5 day' )
            || get_user_meta( get_current_user_id(), 'covernews_upgrade_notice_dismiss', true )
            || get_user_meta( get_current_user_id(), 'covernews_upgrade_notice_dismiss_temporary_start_time', true ) > strtotime( '-2 day' )
        ) {
            add_filter( 'covernews_upgrade_notice_dismiss', '__return_true' );
        } else {
            add_filter( 'covernews_upgrade_notice_dismiss', '__return_false' );
        }
    }

    public function notice_markup() {
        ?>
        <div class="notice notice-success covernews-notice" >
            <a class="covernews-notice-dismiss notice-dismiss" href="<?php echo esc_url( $this->dismiss_url ); ?>"></a>

            <p class="notice-text">
                <?php
                $current_user = wp_get_current_user();

                printf(
                /* Translators: %1$s current user display name., %2$s this theme name., %3$s discount coupon code., %4$s discount percentage. */
                   esc_html__(
                        'Hello %1$s! We hope you\'re enjoying the %2$s theme now that you\'ve been using it for a while. You may always upgrade to pro to gain access to more premium features. You can also get a %4$s discount (limited time offer) by using the promo code %3$s when making your purchase. Enjoy! ',
                        'covernews'
                    ),
                    '<strong>' . esc_html( $current_user->display_name ) . '</strong>',
                    'CoverNews',
                    '<code class="coupon-code">AFT20</code>',
                    '<strong>20%</strong>'
                );
                ?>
            </p>

            <div class="links">
                <a href="<?php echo esc_url( $this->pricing_url ); ?>" class="button button-primary" target="_blank">

                    <span><?php esc_html_e( 'Upgrade to pro', 'covernews' ); ?></span>
                </a>

                <a href="<?php echo esc_url( $this->temporary_dismiss_url ); ?>" class="button button-secondary">

                    <span><?php esc_html_e( 'Maybe later', 'covernews' ); ?></span>
                </a>

                <a href="https://afthemes.com/supports/" class="button button-secondary" target="_blank">

                    <span><?php esc_html_e( 'Got pre sales queries?', 'covernews' ); ?></span>
                </a>
            </div>
        </div> <!-- /covernews-notice -->
        <?php
    }
}

new CoverNews_Upgrade_Notice();
