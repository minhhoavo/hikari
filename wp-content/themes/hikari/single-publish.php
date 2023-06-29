<?php get_header(); ?>
<main class="p-publish">
    <div class="l-container">
        <div class="p-publish__single">
            <div class="feature_img">
                <img src="<?php echo get_field('image')['url']; ?>" alt="<?php the_title(); ?>">
            </div>   
            <div class="p-publish__info">
                <h2><?php echo get_the_title(); ?></h2>
                <p class="datepost"><?php echo get_field('publication-date'); ?></p>
                <p class="author">
                    著者  : <?php echo get_field('author'); ?><br>
                    出版社 : <?php echo get_field('publisher'); ?>
                </p>
                <p class="price"><?php echo get_field('price'); ?></p>
                <div class="desc">
                    <p><?php echo get_field('description'); ?></p>
                    <h4>目次</h4>
                    <p><?php echo get_field('contents'); ?></p>
                </div>
            </div>         
        </div>
        <div class="l-btn">
            <div class="c-btn c-btn--small2">
                <a class="c-btnlink" href="<?php echo get_site_url(); ?>/publish">出版物一覧へ</a>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>