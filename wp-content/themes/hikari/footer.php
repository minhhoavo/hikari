<footer class="c-footer">
        <div class="c-footer__logo">
            <div class="l-container">
                <a href="<?php bloginfo('url'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="ひかりアドバイザーグループ ひかり税理士法人"></a>
            </div>
        </div>
        <div class="c-footer__main">
            <div class="l-container">
                <div class="c-footer__link">
                    <h3><a href="<?php echo get_site_url(); ?>/news">ニュース</a></h3>
                    <ul class="c-boxlink">
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
                </div>

                <div class="c-footer__link">
                    <h3><a href="cases.html">成功事例</a></h3>
                    <ul class="c-boxlink">
                        <li><a href="<?php echo get_site_url(); ?>/404">法人のお客様</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/404">個人のお客様</a></li>
                    </ul>
                </div>

                <div class="c-footer__link">
                    <ul class="c-boxlink">
                        <li><a href="staff.html">スタッフ</a></li>
                        <li><a href="recruit.html">採用情報</a></li>
                        <li><a href="privacy.html">プライバシーポリシー</a></li>
                        <li><a href="sitemap.html">サイトマップ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <?php wp_footer(); ?>
    <script>
	var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/themes.js"></script>
</body>

</html>