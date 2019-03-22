<?php
/*
Theme Name: Pingvins
Theme URI: https://mkvadrat.com/
Author: mkvadrat
Author URI: https://mkvadrat.com/
Description: Тема Pingvins
Version: 1.0
*/
?>

<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->

<html <?php language_attributes(); ?>>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo pn_wp_title('','|', true, 'right'); ?></title>
    
    <?php wp_head(); ?>
  </head>
  <body>
    <header>
        <div class="container">
            <div class="row social">
                <div class="col-md-6 social-vk">
                    <?php echo get_option('pn_social_links'); ?>
                </div>
                <div class="col-md-6 social-phone">
                    <?php echo get_option('pn_phone'); ?>
                </div>
            </div>
            <div class="city">
                <?php echo get_option('pn_city'); ?>
            </div>
            <div class="navigation-top">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <nav class="nav navbar-nav">
					<?php
						if (has_nav_menu('header_menu')){
							wp_nav_menu( array(
								'theme_location'  => 'header_menu',
								'menu'            => '',
								'container'       => false,
								'container_class' => '',
								'container_id'    => '',
								'menu_class'      => '',
								'menu_id'         => '',
								'echo'            => true,
								'fallback_cb'     => 'wp_page_menu',
								'before'          => '',
								'after'           => '',
								'link_before'     => '',
								'link_after'      => '',
								'items_wrap'      => '%3$s',
								'walker'          => new header_menu(),
							) );
						}
					?>
                </nav>
            </div>
            </div>
        </div>
    </header>