<?php
/*
Template name: Main page
Theme Name: Pingvins
Theme URI: http://mkvadrat.com/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта Pingvins
Version: 1.0
*/

get_header(); 
?>

	<?php if (have_posts()): while (have_posts()): the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; endif; ?>
    
<?php get_footer(); ?>