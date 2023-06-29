<?php
/*
  Template Name: News
*/
get_header();
?>
<main class="p-news">
    <?php custom_breadcrumbs(); ?>
    <div class="c-headpage">
        <h1 class="c-title"><?php echo get_the_title(); ?></h1>
    </div>
    <div class="p-news__content">
       <div class="l-container">
            <ul class="c-tabs">
                <li data-content="cat_all" data-color="#0078d2" class="active">すべて</li>
                <?php
                $cats = get_categories(array(
                    'orderby' => 'ID'
                ));
                if ($cats) {
                    foreach ($cats as $cat) {
                        $color = get_field('color', $cat);
                        $cat_key = get_field('cat_key', $cat);
                        echo '<li data-content="' . $cat_key . '" data-color="' . $color . '"><a class="c-tabs__cat" href="' . get_category_link($cat->term_id) . '">' . $cat->cat_name . '</a></li>';
                    }
                }
                ?>
            </ul>
            <div class="c-tabs__content">
                <!-- All Posts - Display 5 Posts-->
                <div class="c-listpost active" id="cat_all" data-content="すべて">
                    <ul>
                        <?php
                        $the_query = new WP_Query(array('order' => 'DESC', 'post_type' => 'post', 'posts_per_page' => 10, 'orderby' => 'date'));
                        if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                                $post = get_post();
                                $cat = get_the_category($post); ?>
                                <li class="c-listpost__item">
                                    <div class="c-listpost__info">
                                        <span class="datepost"><?php echo get_the_date('Y年m月d日'); ?></span>
                                        <div class="c-listpost__cat">
                                            <?php if (count($cat) > 1) {
                                                foreach ($cat as $cd) {
                                            ?>
                                                    <span class="cat">
                                                        <i class="c-dotcat" style="background-color: <?php echo task14_cat($cd->cat_name); ?>"></i>
                                                        <a href="<?php echo get_category_link($cd->term_id); ?>"><?php echo $cd->cat_name; ?></a>
                                                    </span>
                                                <?php
                                                }
                                            } else {
                                                foreach ($cat as $cd) { ?>
                                                    <span class="cat">
                                                        <i class="c-dotcat" style="background-color: <?php echo task14_cat($cd->cat_name); ?>"></i>
                                                        <a href="<?php echo get_category_link($cd->term_id); ?>"><?php echo $cd->cat_name; ?></a>
                                                    </span>
                                            <?php
                                                }
                                            } ?>
                                        </div>
                                    </div>
                                    <h3 class="titlepost"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h3>
                                </li>
                        <?php
                            endwhile;
                        endif; ?>
                    </ul>
                    <div class="c-pagination c-ajax">
                    	<?php
                    	echo pagination_tdc($the_query, 1, 'news');
                    	wp_reset_postdata();  ?>
                	</div>
                </div>
                <?php
                foreach ($cats as $cat) {
                    $color = get_field('color', $cat);
                    $cat_key = get_field('cat_key', $cat); ?>
                    <ul class="c-listpost" id="<?php echo $cat_key; ?>">
                        <?php
                        $the_query = new WP_Query(array('nopaging' => false, 'order' => 'DESC', 'post_type' => 'post', 'orderby' => 'date', 'category_name' => $cat->cat_name, 'posts_per_page' => 5));
                        if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                                $post = get_post(); ?>
                                <li class="c-listpost__item">
                                    <div class="c-listpost__info">
                                        <span class="datepost"><?php echo get_the_date('Y年m月d日'); ?></span>
                                        <div class="c-listpost__cat">
                                            <span class="cat">
                                                <i class="c-dotcat" style="background-color: <?php echo $color; ?>"></i>
                                                <a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo $cat->cat_name; ?></a>
                                            </span>
                                        </div>
                                    </div>
                                    <h3 class="titlepost"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h3>
                                </li>
                        <?php
                            endwhile;
                        endif;
                        ?>
                    </ul>
                <?php }
                ?>
               <div class="c-pagination c-ajax">
                    <?php
                    echo pagination_tdc($the_query, 1, 'news');
                    wp_reset_postdata();  ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>