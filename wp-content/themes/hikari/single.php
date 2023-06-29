<?php get_header();?>
<main class="p-news">
    <?php custom_breadcrumbs(); ?>
    <div class="p-news__content">
        <div class="l-container">
            <?php if( get_field('image') ): ?>
                <div class="feature_img">
                    <img src="<?php echo get_field('image')['url']; ?>" alt="<?php the_title(); ?>">
                </div>
            <?php endif; ?>	
            <div class="c-ttlpostpage">
                <h2><?php the_title(); ?></h2>
                <span><?php echo get_the_date('Y年m月d日'); ?></span>
                <?php
                $cat = get_the_category(); ?>
                <div class="c-listpost__catlist">
                    <?php
                    if ($cat) {
                        foreach ($cat as $cd) {
                    ?>
                            <span class="c-listpost__cat">
                                <i class="c-dotcat" style="background-color: <?php echo dot_cat($cd->cat_name); ?>"></i>
                                <a href="<?php echo get_category_link($cd->term_id); ?>"><?php echo $cd->cat_name; ?></a>
                            </span>
                    <?php }
                    } ?>
                </div>
            </div>

            <div class="single__content">
                <p><?php echo get_field('text1'); ?></p>

                <p class="u-center">▽▽詳細はこちら▽▽</p>

                <p class="u-center u-bborder"><?php echo get_field('text2'); ?></p>
            </div>

            <div class="l-btn">
                <div class="c-btn c-btn--small2">
                    <a class="c-btnlink" href="<?php echo get_site_url(); ?>/news">ニュース一覧を見る</a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>