<?php
get_header();
?>
    <!--table>
        <tr>
            <th>Name</th>
            <td>details</td>
            <td>Output</td>
        </tr>
        <tr>
            <th>bloginfo(string $show = '');</th>
            <td>Displays information about the current site.

‘name‘ – Displays the “Site Title” set in Settings > General. This data is retrieved from the “blogname” record in the wp_options table.
‘description‘ – Displays the “Tagline” set in Settings > General. This data is retrieved from the “blogdescription” record in the wp_options table.
‘wpurl‘ – Displays the “WordPress address (URL)” set in Settings > General. This data is retrieved from the “siteurl” record in the wp_options table. Consider echoing site_url() instead, especially for multi-site configurations using paths instead of subdomains (it will return the root site not the current sub-site).
‘url‘ – Displays the “Site address (URL)” set in Settings > General. This data is retrieved from the “home” record in the wp_options table. Consider echoing home_url() instead.
‘admin_email‘ – Displays the “E-mail address” set in Settings > General. This data is retrieved from the “admin_email” record in the wp_options table.
‘charset‘ – Displays the “Encoding for pages and feeds” set in Settings > Reading. This data is retrieved from the “blog_charset” record in the wp_options table. Note: this parameter always echoes “UTF-8”, which is the default encoding of WordPress.
‘version‘ – Displays the WordPress Version you use. This data is retrieved from the $wp_version variable set in wp-includes/version.php.
‘html_type‘ – Displays the Content-Type of WordPress HTML pages (default: “text/html”). This data is retrieved from the “html_type” record in the wp_options table. Themes and plugins can override the default value using the pre_option_html_type filter.
‘text_direction‘ – Displays the Text Direction of WordPress HTML pages. Consider using is_rtl() instead.
‘language‘ – Displays the language of WordPress.
‘stylesheet_url‘ – Displays the primary CSS (usually style.css) file URL of the active theme. Consider echoing get_stylesheet_uri() instead.
‘stylesheet_directory‘ – Displays the stylesheet directory URL of the active theme. (Was a local path in earlier WordPress versions.) Consider echoing get_stylesheet_directory_uri() instead.
‘template_url‘ / ‘template_directory‘ – URL of the active theme’s directory. Within child themes, both get_bloginfo(‘template_url’) and get_template() will return the parent theme directory. Consider echoing get_template_directory_uri() instead (for the parent template directory) or get_stylesheet_directory_uri() (for the child template directory).
‘pingback_url‘ – Displays the Pingback XML-RPC file URL (xmlrpc.php).
‘atom_url‘ – Displays the Atom feed URL (/feed/atom).
‘rdf_url‘ – Displays the RDF/RSS 1.0 feed URL (/feed/rfd).
‘rss_url‘ – Displays the RSS 0.92 feed URL (/feed/rss).
‘rss2_url‘ – Displays the RSS 2.0 feed URL (/feed).
‘comments_atom_url‘ – Displays the comments Atom feed URL (/comments/feed).
‘comments_rss2_url‘ – Displays the comments RSS 2.0 feed URL (/comments/feed).
‘siteurl‘ – Deprecated since version 2.2. Echo home_url(), or use bloginfo(‘url’).
‘home‘ – Deprecated since version 2.2. Echo home_url(), or use bloginfo(‘url’).

            </td>
            <td></td>
        </tr>
        <tr>
            <th>bloginfo('charset');</th>
            <td></td>
            <td><?php bloginfo('charset'); ?></td>
        </tr>
        <tr>
            <th>bloginfo('name');</th>
            <td></td>
            <td><?php bloginfo('name'); ?></td>
        </tr>
        <tr>
            <th>bloginfo('description');</th>
            <td></td>
            <td><?php bloginfo('description'); ?></td>
        </tr>
        <tr>
            <th>bloginfo('stylesheet_url');</th>
            <td></td>
            <td><?php bloginfo('stylesheet_url'); ?></td>
        </tr>
        <tr>
            <th>bloginfo('stylesheet_directory');</th>
            <td></td>
            <td><?php bloginfo('stylesheet_directory'); ?></td>
        </tr>
        <tr>
            <th>bloginfo('url');</th>
            <td></td>
            <td><?php bloginfo('url'); ?></td>
        </tr>
        <tr>
            <th> get_stylesheet_uri</th>
            <td>Retrieves stylesheet URI for current theme.</td>
            <td><?php echo get_stylesheet_uri(); ?></td>
        </tr>
        <tr>
            <th> wp_head()</th>
            <td></td>
            <td><?php  ?></td>
        </tr>
        <tr>
            <th> wp_footer()</th>
            <td></td>
            <td><?php ?></td>
        </tr>
        <tr>
            <th> body_class( )()</th>
            <td></td>
            <td><?php body_class( ) ?></td>
        </tr>
        <tr>
            <th> wp_nav_menu(array )</th>
            <td></td>
            <td><?php wp_nav_menu(['menu'=>'topmenu']) ?></td>
        </tr>
    </table -->
    <hr>
    <h3>index.php</h3>
    <?php get_template_part('parts/slider'); ?>
    <div class="row">
    <div class="col-9">
    <?php get_template_part( 'loop' );?>
    </div>
    <div class="col-3">    
    <?php get_template_part( 'sidebar' );?>
    </div>
    </div>



    <?php get_footer();?>