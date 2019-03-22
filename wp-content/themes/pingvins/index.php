<?php
/*
Theme Name: Pingvins
Theme URI: https://mkvadrat.com/
Author: mkvadrat
Author URI: https://mkvadrat.com/
Description: Тема Pingvins
Version: 1.0
*/

get_header(); ?>

	<?php if (have_posts()): while (have_posts()): the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; endif; ?>

<?php get_footer(); ?>
