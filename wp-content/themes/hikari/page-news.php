<?php get_header();
$args = array(
    'posts_per_page' => 10
);
// The Query
$the_query = new WP_Query($args); ?>
<main class="p-news">

    <?php custom_breadcrumbs(); ?>
    <div class="c-headpage">
        <h2 class="c-title">ニュース・お知らせ</h2>
    </div>
    <div class="p-news__content">
        <div class="l-container">
            <ul class="c-tabs">
                <li data-content="all" data-color="#0078d2" class="active">すべて</li>
                <?php
                $cats = get_categories(array(
                    'orderby' => 'ID'
                ));
                if ($cats) {
                    foreach ($cats as $cd) {
                ?>
                <li><a href="<?php echo get_category_link($cd->term_id); ?>"><?php echo $cd->cat_name; ?></a></li>
                <?php }
            } ?>
            </ul>
            <div class="c-tabs__content">
            <!-- All Posts - Display 5 Posts-->
            <ul class="c-listpost active" id="all">
                <?php
                $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                    $the_query = new WP_Query(array(
                        'order' => 'DESC', 
                        'post_type' => 'post', 
                        'posts_per_page' => 10, 
                        'orderby' => 'date',
                        'paged' => $paged
                    ));
                
                    if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                    $post = get_post();
                    $cat = get_the_category($post); 
                ?>
                <li class="c-listpost__item">
                    <div class="c-listpost__info">
                        <span class="datepost"><?php echo get_the_date('Y年m月d日'); ?></span>
                        <div class="c-listpost__cat">
                            <?php if (count($cat) > 1) {
                                foreach ($cat as $cd) {
                                    if ($cd->cat_ID != 1) {?>
                                        <span class="cat">
                                            <i class="c-dotcat" style="background-color: <?php echo dot_cat($cd->cat_name); ?>"></i>
                                            <a href="<?php echo get_category_link($cd->term_id); ?>"><?php echo $cd->cat_name; ?></a>
                                        </span>
                                    <?php }
                                }
                            } else {
                                foreach ($cat as $cd) { ?>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: <?php echo dot_cat($cd->cat_name); ?>"></i>
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
                pagination($the_query);
                endif; ?>
               
            </ul>
            <?php
                foreach ($cats as $cat) {
                    $color = get_field('color',$cat);
                    $cat_key = get_field('cat_key',$cat); ?>
                    <ul class="c-listpost" id="<?php echo $cat_key; ?>">
                        <?php
                        $the_query = new WP_Query(array(
                            'nopaging' => false, 
                            'order' => 'DESC', 
                            'post_type' => 'post', 
                            'orderby' => 'date',
                            'cat' => $cat->cat_ID, 
                            'posts_per_page' => 5
                        ));
                        if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                                $post = get_post();?>
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
            </ul>
        </div>
    </div>
</main>
<?php get_footer(); ?>