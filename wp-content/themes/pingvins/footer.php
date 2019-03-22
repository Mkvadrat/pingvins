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
	
	<div class="container-fluid map">
		<?php if(get_option('pn_maps')){ ?>
		<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
		
		<div id="map"></div>
		
		<script type="text/javascript">
			// /start maps
			ymaps.ready(init);

			function init () {
				var myMap = new ymaps.Map("map", {
					center: [<?php echo get_option('pn_maps'); ?>],
					zoom: 18,
					<!--Скрыть элементы управления: controls: []	 -->
					controls: []
				}, {
				searchControlProvider: 'yandex#search'
				});

				if (window.matchMedia("(max-width: 1500px)").matches) {
					myMap.setCenter([<?php echo get_option('pn_maps'); ?>])
				};
				if (window.matchMedia("(max-width: 992px)").matches) {
					myMap.setCenter([<?php echo get_option('pn_maps'); ?>])
				};
				if (window.matchMedia("(max-width: 767px)").matches) {
					myMap.setCenter([<?php echo get_option('pn_maps'); ?>])
				};

				myGeoObject = new ymaps.GeoObject({

				properties: {

					iconContent: 'Lorem',
					hintContent: 'Компания "Lorem"'
				}
				}, {

					preset: 'islands#blackStretchyIcon',

					draggable: false,

				});

				myMap.behaviors

				.disable('scrollZoom')

				myMap.geoObjects
				.add(myGeoObject)
				.add(new ymaps.Placemark([<?php echo get_option('pn_maps'); ?>], {
					iconCaption: 'красноармейская улица 40 ялта'
				}, {
					preset: 'islands#greenDotIconWithCaption'
				}))

			}
		</script>
		<?php } ?>
	</div>
	<footer>
	<div class="container">
		<div class="row footer-wrapper">
			<div class="col-xs-12 col-md-6 footer-info">
				<?php echo get_option('pn_offer'); ?>
			</div>
			<div class="col-xs-12 col-md-3 footer-social">
				<?php echo get_option('pn_footer_social'); ?>
			</div>
			<div class="col-xs-12 col-md-3 footer-company">
				<?php echo get_option('pn_footer_company'); ?>
				<div class="copy">
					<?php echo get_option('pn_wrapper'); ?>
				</div>
			</div>
		</div>
	</div>
	</footer>
    
    <?php wp_footer(); ?>
     
  </body>
</html>