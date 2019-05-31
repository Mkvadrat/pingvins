<?php
/*
Theme Name: Pingvins
Theme URI: https://mkvadrat.com/
Author: mkvadrat
Author URI: https://mkvadrat.com/
Description: Тема Psychologue
Version: 1.0
*/

get_header(); 
?>

    <?php $category = get_queried_object(); ?>
    <section class="contacts-block">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-lg-10 col-lg-offset-1 text-center">
            <h1><?php echo $category->name; ?></h1>
            <?php echo wpautop(get_term_meta(get_queried_object()->term_id, 'description_category_page', true)); ?>
          </div>
        </div>
      </div>
    </section>
    
    <?php
        $current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'terms' => get_queried_object()->term_id
                )
            ),
            'post_type'   => 'post',
            'orderby'     => 'date',
            'order'       => 'DESC',
            'posts_per_page' => $GLOBALS['wp_query']->query_vars['posts_per_page'],
            'paged'          => $current_page,
        );

        $post_lists = get_posts( $args );
    ?>
    
    <section class="catalog__section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                <?php if($post_lists){ ?>
                <?php foreach($post_lists as $list){ ?>
                <?php
                    $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($list->ID), 'full');
                ?>
                    <div class="catalog__item">
                        <div class="catalog__img bg__img" style="background-image: url('<?php echo $image_url[0] ? $image_url[0] : esc_url( get_template_directory_uri() ) . '/image/contacts.jpg'; ?> ?>')"></div>
                        <div class="catalog__description">
                            <div class="catalog__title"><?php echo $list->post_title; ?></div>
                            <div class="catalog__text"><p><?php echo $list->post_excerpt; ?></p></div>
                            <a href="<?php echo get_permalink($list->ID); ?>" class="more__btn">Подробнее</a>
                        </div>
                    </div>
                <?php wp_reset_postdata(); ?>
                <?php } ?>  
                <?php }else{ ?>
                <div class="catalog__item">В данной категории новостей не найдено!</div>
                <?php } ?>
                </div>
                <?php
                    $defaults = array(
                        'type' => 'array',
                        'prev_next'    => True,
                        'prev_text'    => __(''),
                        'next_text'    => __(''),
                    );

                    $pagination = paginate_links($defaults);
                    
                if($pagination){
                ?>
                <div class="col-sm-12">
                    <ul class="pagination">
                        <?php foreach ($pagination as $pag){ ?>
                            <li><?php echo $pag; ?></li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <section class="text__section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?php echo wpautop(get_term_meta(get_queried_object()->term_id, 'seo_category_page', true)); ?>
                </div>
            </div>
        </div>
    </section>
      
<?php get_footer(); ?>