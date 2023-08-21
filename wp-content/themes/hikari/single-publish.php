<?php get_header(); ?>
<main class="p-publish">
<?php custom_breadcrumbs();?>
    <div class="l-container">
        <div class="p-publish__single">
            <div class="feature_img">
                <?php if( get_field('image') ): ?>
                    <img src="<?php echo get_field('image')['url']; ?>" alt="<?php the_title(); ?>">
                <?php else : ?> 
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/no-imgpublish.png" alt="no image available">
                <?php endif; ?>	
            </div>   
            <div class="p-publish__info">
                <h2><?php echo get_field('title'); ?></h2>
                <?php if( get_field('author') ): ?>
                <p class="datepost"><?php echo get_field('publication-date'); ?> 発行</p>
                <?php endif; ?>	
                <p class="author">
                    <?php if( get_field('author') ): ?>
                        著者  : <?php echo get_field('author'); ?><br>
                    <?php endif; ?>	
                    <?php if( get_field('publisher') ): ?>
                        出版社 : <?php echo get_field('publisher'); ?>
                    <?php endif; ?>	
                </p>
                <p class="price"><?php echo get_field('price'); ?></p>
                <div class="desc">
                    <p><?php echo get_field('description'); ?></p>
                    <?php if( get_field('contents') ): ?>
                        <h4>目次</h4>
                        <p><?php echo get_field('contents'); ?></p>
                    <?php endif; ?>	
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