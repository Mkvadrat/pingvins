<?php 
/**
Template Page for the gallery overview

Follow variables are useable :

	$gallery     : Contain all about the gallery
	$images      : Contain all images, path, title
	$pagination  : Contain the pagination content

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
**/
?>
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($gallery)) : ?>
	
	<section class="banner__carousel">
		<div class="slider slider-for">
		<?php foreach ( $images as $image ){ ?>
			<div class="slick__item" style="background-image: url('<?php echo nextgen_esc_url($image->imageURL) ?>')"></div>
		<?php } ?>
		</div>
		<div class="slider slider-nav" role="toolbar">
		<?php foreach ( $images as $image ){ ?>
			<div class="slick__dot" style="background-image: url('<?php echo nextgen_esc_url($image->imageURL) ?>')"></div>
		<?php } ?>
		</div>
	</section>
	
<?php endif; ?>
