<?php
/*
Template Name: Create Product
*/

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php 
        // Новый запрос для получения всех продуктов
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1  // -1 значит "все продукты"
        );

        $products = new WP_Query($args);

        if ($products->have_posts()) : 
            while ($products->have_posts()) : $products->the_post();

                // Выводим название продукта и его ссылку
                echo '<h2><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>';

                // Выводим изображение продукта
                if (has_post_thumbnail()) {
                    echo get_the_post_thumbnail(get_the_ID(), 'medium');
                }

                // Выводим краткое описание
                the_excerpt();

            endwhile;

            // Возвращаем первоначальные данные поста (очень важно!)
            wp_reset_postdata();

        else :
            echo '<p>No products found</p>';
        endif;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
