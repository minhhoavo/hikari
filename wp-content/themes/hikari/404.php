<?php get_header(); ?>
<main class="p-404">
    <div class="c-headpage">
        <h2 class="c-title"><?php echo __('近日公開', 'task14'); ?></h2>
    </div>
    <div class="l-container">
        <div class="c-search">
            <div class="c-search__content">
                <h3 class="p-service__title" style="font-size: 90px"><?php echo __('404', 'task14'); ?></h3>
                <p class="notice"><?php echo __('こちらのページは現在制作中です。<br>
								公開までしばらくお待ちください。', 'task14'); ?></p>
                <a href="<?php echo home_url(); ?>" class="c-backhome"><?php echo __('ホームページに戻る', 'task14'); ?></a>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>
<!-- これはちょっと恥ずかしいですね。 -->