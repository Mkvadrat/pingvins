<?php
/*
Theme Name: Pingvins
Theme URI: https://mkvadrat.com/
Author: mkvadrat
Author URI: https://mkvadrat.com/
Description: Тема Pingvins
Version: 1.0
*/

get_header(); 
?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-3 col-sm-6 col-sm-push-3">
                    <div class="page-404">
                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/image/banner-1.jpg" alt="">
                        <p class="title">Ошибка 404</p>
                        <p>Данная страница не найдена</p>
                        <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="light-button">На главную</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>