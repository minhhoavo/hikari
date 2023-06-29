<?php get_header();?>
<main class="p-news">
    <?php custom_breadcrumbs(); ?>
    <div class="c-headpage">
        <h2 class="c-title">ニュース・<?php single_term_title() ?></h2>
    </div>

    <div class="l-container">
        <ul class="c-listpost" id="<?php echo $item['id'] ?>">
            <?php
            if (have_posts()) : while (have_posts()) : the_post();
                    $post = get_post();
                    $cat = get_the_category(); ?>
                    <li class="c-listpost__item">
                        <div class="c-listpost__info">
                            <span class="datepost"><?php echo get_the_date('Y年m月d日'); ?></span>
                            <div class="c-listpost__cat">
                                <?php
                                if ($cat) {
                                    foreach ($cat as $cd) {
										if ($cd->cat_name == single_cat_title('', false)){
                                ?>
                                        <span class="cat">
                                            <i class="c-dotcat" style="background-color: <?php echo dot_cat($cd->cat_name); ?>"></i>
                                            <a href="<?php echo get_category_link($cd->term_id); ?>"><?php echo $cd->cat_name; ?></a>
                                        </span>
                                <?php }}
                                } ?>
                            </div>
                        </div>
                        <h3 class="titlepost"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h3>
                    </li>
            <?php
                endwhile;
            endif;
            ?>
        </ul>
        <?php pagination(); ?>
    </div>
</main>
<?php get_footer(); ?>