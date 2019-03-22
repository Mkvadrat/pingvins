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

	<section class="slider-top">
      <div class="owl-carousel slider-ball">
		<?php foreach ( $images as $image ){ ?>
		<?php //var_dump($gallery); ?>
        <div class="slider-item">
          <img src="<?php echo nextgen_esc_url($image->imageURL) ?>" alt="<?php echo esc_attr($image->alttext) ?>">
          <div class="slider-info">
				<?php echo html_entity_decode($image->description, ENT_QUOTES, 'UTF-8'); ?>
          </div>
        </div>
       <?php } ?>
      </div>
    </section>

<?php endif; ?>
