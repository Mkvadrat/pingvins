<?php
/*
Theme Name: Pingvins
Theme URI: https://mkvadrat.com/
Author: mkvadrat
Author URI: https://mkvadrat.com/
Description: Тема Pingvins
Version: 1.0
*/

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
****************************************************************************НАСТРОЙКИ ТЕМЫ*****************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
function pn_scripts(){
	
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/js/libs/bootstrap/css/bootstrap.min.css');
    wp_enqueue_style( 'bootstrap' );
	
	wp_register_style( 'carousel', get_template_directory_uri() . '/js/libs/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css');
    wp_enqueue_style( 'carousel' );
	
	wp_register_style( 'owl-default', get_template_directory_uri() . '/js/libs/OwlCarousel2-2.3.4/dist/assets/owl.carousel.css'); 
    wp_enqueue_style( 'owl-default' );
	
	wp_register_style( 'slick', get_template_directory_uri() . '/js/libs/slick/slick.css'); 
    wp_enqueue_style( 'slick' );
	
	wp_register_style( 'style', get_template_directory_uri() . '/style/style.css');
    wp_enqueue_style( 'style' );

	
	if (!is_admin()) {
		wp_enqueue_script( 'jquery-min', get_template_directory_uri() . '/js/libs/jquery/jquery.min.js', '', '3.3.1', true );
		wp_enqueue_script( 'bootstrap-min', get_template_directory_uri() . '/js/libs/bootstrap/js/bootstrap.js', '', '3.3.1', true );
		wp_enqueue_script( 'carousel-min', get_template_directory_uri() . '/js/libs/OwlCarousel2-2.3.4/dist/owl.carousel.js', '', '', true );
		wp_enqueue_script( 'parallax-min', get_template_directory_uri() . '/js/parallax.min.js', '', '', true );
		wp_enqueue_script( 'slick-min', get_template_directory_uri() . '/js/libs/slick/slick.min.js', '', '', true );
		//wp_enqueue_script( 'yandex', 'https://api-maps.yandex.ru/2.1/?lang=ru_RU', '', '', true );
		wp_enqueue_script( 'javascript-min', get_template_directory_uri() . '/js/javascript.js', '', '', true );
	}

}
add_action( 'wp_enqueue_scripts', 'pn_scripts' );

//Регистрируем название сайта
function pn_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	$title .= get_bloginfo( 'name', 'display' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'ug' ), max( $paged, $page ) );
	}

	if ( is_404() ) {
        $title = '404';
    }

	return $title;
}
add_filter( 'wp_title', 'psy_wp_title', 10, 2 );

//Изображение в шапке сайта
$args = array(
	'default-image' => get_template_directory_uri() . '/images/page-logo.png',
	'uploads'       => true,
);
add_theme_support( 'custom-header', $args );

//Добавление в тему миниатюры записи и страницы
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
}

//Регистрируем меню
if(function_exists('register_nav_menus')){
	register_nav_menus(
		array(
		  'header_menu'  => 'Меню в шапке',
		  'other_menu'   => 'Меню в шапке (Страницы)',
		)
	);
}

//Отключить редактор
//add_filter('use_block_editor_for_post', '__return_false');

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
****************************************************************************МЕНЮ САЙТА*********************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
// Добавляем свой класс для пунктов меню:
class header_menu extends Walker_Nav_Menu {
	// Добавляем классы к вложенным ul
	function start_lvl( &$output, $depth = 0, $args = Array() ) {
		// Глубина вложенных ul
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'',
			( $display_depth % 2  ? '' : '' ),
			( $display_depth >=2 ? '' : '' ),
			''
			);
		$class_names = implode( ' ', $classes );
		// build html
		if($depth == 0){
			$output .= "\n" . $indent . '<ul class="submenu">' . "\n";
		}else if($depth == 1){
			$output .= "\n" . $indent . '<ul class="subsubmenu">' . "\n";
		}else if($depth >= 2){
			$output .= "\n" . $indent . '<ul class="subsubsubmenu">' . "\n";
		}
	}

	// Добавляем классы к вложенным li
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wpdb;
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'has-sub' : '' ),
			( $depth >=2 ? '' : '' ),
			( $depth % 2 ? '' : '' ),
			'menu-item-depth-' . $depth
		);

		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$mycurrent = ( $item->current == 1 ) ? ' active' : '';

		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		$output .= $indent . '';

		// Добавляем атрибуты и классы к элементу a (ссылки)
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : ''; 
		$attributes .= ' class="menu-link ' . ( $depth == 0 ? 'parent' : '' ) . ( $depth == 1 ? 'child' : '' ) . ( $depth >= 2 ? 'sub-child' : '' ) . '"';

		if($depth == 0){
			$has_children = $wpdb->get_results( $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = %s AND meta_key = '_menu_item_menu_item_parent'", $item->ID), ARRAY_A);

			$link  =  $item->url;

			$title = apply_filters( 'the_title', $item->title, $item->ID );

			if(!empty($has_children)){
				$item_output = '<a href="'. $link .'">' . $title .' </a>';
			}else{
				$item_output = '<a href="'. $link .'">' . $title .'</a>';
			}
		}else if($depth == 1){
			$has_children = $wpdb->get_results( $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = %s AND meta_key = '_menu_item_menu_item_parent'", $item->ID), ARRAY_A);

			$link  =  $item->url;

			$title = apply_filters( 'the_title', $item->title, $item->ID );

			if(!empty($has_children)){
				$item_output = '<a href="'. $link .'">' . $title .' </a>';
			}else{
				$item_output = '<a href="'. $link .'">' . $title .'</a>';
			}
		}else if($depth >= 2){
			$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$args->link_after,
				$args->after
			);
		}
		// build html

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

//Меню страницы
// Добавляем свой класс для пунктов меню:
class other_menu extends Walker_Nav_Menu {
	// Добавляем классы к вложенным ul
	function start_lvl( &$output, $depth = 0, $args = Array() ) {
		// Глубина вложенных ul
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'',
			( $display_depth % 2  ? '' : '' ),
			( $display_depth >=2 ? '' : '' ),
			''
			);
		$class_names = implode( ' ', $classes );
		// build html
		if($depth == 0){
			$output .= "\n" . $indent . '' . "\n";
		}else if($depth == 1){
			$output .= "\n" . $indent . '' . "\n";
		}else if($depth >= 2){
			$output .= "\n" . $indent . '' . "\n";
		}
	}

	// Добавляем классы к вложенным li
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wpdb;
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'has-sub' : '' ),
			( $depth >=2 ? '' : '' ),
			( $depth % 2 ? '' : '' ),
			'menu-item-depth-' . $depth
		);

		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$mycurrent = ( $item->current == 1 ) ? ' active' : '';

		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		$output .= $indent . '';

		// Добавляем атрибуты и классы к элементу a (ссылки)
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : ''; 
		$attributes .= ' class="menu-link ' . ( $depth == 0 ? 'parent' : '' ) . ( $depth == 1 ? 'child' : '' ) . ( $depth >= 2 ? 'sub-child' : '' ) . '"';

		if($depth == 0){
			$has_children = $wpdb->get_results( $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = %s AND meta_key = '_menu_item_menu_item_parent'", $item->ID), ARRAY_A);

			$link  =  $item->url;

			$title = apply_filters( 'the_title', $item->title, $item->ID );

			if(!empty($has_children)){
				$item_output = '<a href="'. $link .'">' . $title .' </a>';
			}else{
				$item_output = '<a href="'. $link .'">' . $title .'</a>';
			}
		}else if($depth == 1){
			$has_children = $wpdb->get_results( $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = %s AND meta_key = '_menu_item_menu_item_parent'", $item->ID), ARRAY_A);

			$link  =  $item->url;

			$title = apply_filters( 'the_title', $item->title, $item->ID );

			if(!empty($has_children)){
				$item_output = '<a href="'. $link .'">' . $title .' </a>';
			}else{
				$item_output = '<a href="'. $link .'">' . $title .'</a>';
			}
		}else if($depth >= 2){
			$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$args->link_after,
				$args->after
			);
		}
		// build html

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
*********************************************************************РАБОТА С METAПОЛЯМИ*******************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
//Вывод изображения для плагина nextgen-gallery
function getNextGallery($post_id, $meta_key){
	global $wpdb;
	
	$value = $wpdb->get_var( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta AS pm JOIN $wpdb->posts AS p ON (pm.post_id = p.ID) AND (pm.post_id = %s) AND meta_key = %s ORDER BY pm.post_id DESC LIMIT 1", $post_id, $meta_key) );
	
	$unserialize_value = unserialize($value);
	
	return $unserialize_value;	
}

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
*************************************************************************НАСТРОЙКИ*************************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
// create custom plugin settings menu
add_action('admin_menu', 'baw_create_menu');

function baw_create_menu() {

	//create new top-level menu
	add_menu_page('Pingvins настройки темы', 'Pingvins настройки темы', 'administrator', __FILE__, 'baw_settings_page','dashicons-id-alt');

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}

function register_mysettings() {
	//register our settings
	register_setting( 'baw-settings-group', 'pn_social_links' );
	register_setting( 'baw-settings-group', 'pn_phone' );
	register_setting( 'baw-settings-group', 'pn_messenger' );
	register_setting( 'baw-settings-group', 'pn_city' );
	register_setting( 'baw-settings-group', 'pn_city_pages' );
	register_setting( 'baw-settings-group', 'pn_maps' );
	register_setting( 'baw-settings-group', 'pn_offer' );
	register_setting( 'baw-settings-group', 'pn_footer_social' );
	register_setting( 'baw-settings-group', 'pn_footer_company' );
	register_setting( 'baw-settings-group', 'pn_wrapper' );
}

function baw_settings_page() {
?>
<div class="wrap">
<h2>Настройки темы Pingvins</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'baw-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
		<td colspan="2"><h3>Настройки шапки сайта</h3></td>
		</tr>
		<tr valign="top">
        <th scope="row">Социальные сети</th>
        <td><textarea name="pn_social_links" rows="3" cols="150"><?php echo get_option('pn_social_links'); ?></textarea></td>
        </tr>
        <tr valign="top">
        <th scope="row">Телефон</th>
        <td><textarea name="pn_phone" rows="3" cols="150"><?php echo get_option('pn_phone'); ?></textarea></td>
        </tr>
		<tr valign="top">
        <th scope="row">Месенжер</th>
        <td><textarea name="pn_messenger" rows="3" cols="150"><?php echo get_option('pn_messenger'); ?></textarea></td>
        </tr>
        <tr valign="top">
        <th scope="row">Город</th>
        <td><textarea name="pn_city" rows="3" cols="150"><?php echo get_option('pn_city'); ?></textarea></td>
        </tr>
		<tr valign="top">
        <th scope="row">Город (Страницы)</th>
        <td><textarea name="pn_city_pages" rows="3" cols="150"><?php echo get_option('pn_city_pages'); ?></textarea></td>
        </tr>
		<tr valign="top">
		<td colspan="2"><h3>Настройки подвала сайта</h3></td>
		</tr>
		<tr valign="top">
        <th scope="row">Координаты карты</th>
        <td><input type="text" name="pn_maps" value="<?php echo get_option('pn_maps'); ?>" size="152" /></td>
        </tr>
		<tr valign="top">
        <th scope="row">Оферта</th>
        <td><textarea name="pn_offer" rows="3" cols="150"><?php echo get_option('pn_offer'); ?></textarea></td>
        </tr>
		<tr valign="top">
        <th scope="row">Социальные сети</th>
        <td><textarea name="pn_footer_social" rows="3" cols="150"><?php echo get_option('pn_footer_social'); ?></textarea></td>
        </tr>
		<tr valign="top">
        <th scope="row">Информация о компании</th>
        <td><textarea name="pn_footer_company" rows="3" cols="150"><?php echo get_option('pn_footer_company'); ?></textarea></td>
        </tr>
		<tr valign="top">
        <th scope="row">Wrapper</th>
        <td><textarea name="pn_wrapper" rows="3" cols="150"><?php echo get_option('pn_wrapper'); ?></textarea></td>
        </tr>
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>
<?php } ?>