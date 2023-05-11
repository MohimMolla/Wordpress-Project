<mark>i am sidebar</mark>
<h3>Pages Link</h3>
<ul>
<?php wp_list_pages( 'title_li=' ); ?>
</ul>
<hr>
<?php wp_page_menu( 'show_home=1&menu_class=my-menu&sort_column=menu_order'
); ?>
<h3>Categories Link</h3>
<?php wp_list_categories() ?>
<hr>
<ul>
<?php wp_list_categories(
'title_li=&depth=4&orderby=name&exclude=16,34' ); ?>
</ul>
<?php wp_tag_cloud() ?>

<hr>
<?php get_template_part("socialmenu"); ?>

<hr>
<h3>author meta</h3>
The email address for user id 1 is <?php the_author_meta( 'user_email', 1
); ?>