<?php get_header(); ?>
<div class="c-mainvisual">
<?php if( have_rows('slides') ): ?>
    <div class="js-slider">
    <?php while( have_rows('slides') ): the_row(); ?>
        <div class="c-mainvisual__slides"><img src="<?php echo get_sub_field('image')['url'] ?>" alt="<?php echo get_sub_field('image')['alt']; ?>"></div>
    <?php endwhile; ?>
    </div>
<?php endif; ?>
</div>
<main class="p-home">
    <section class="service">
        <div class="l-container">
            <h2 class="c-title"><span>幅広い案件に対応できるひかりのワンストップサービス</span>目的に応じて、最適な方法をご提案できます</h2>
            <div class="service__inner">
                <div class="service__item">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/img_service01.png" alt="目的に応じて、最適な方法をご提案できます">
                </div>
                <div class="service__item">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/img_service02.png" alt="目的に応じて、最適な方法をご提案できます">
                </div>
                <div class="service__item">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/img_service03.png" alt="目的に応じて、最適な方法をご提案できます">
                </div>
                <div class="service__item">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/img_service04.png" alt="目的に応じて、最適な方法をご提案できます">
                </div>
            </div>
            <div class="l-btn l-btn--2btn">
                <div class="c-btn">
                    <a class="c-btnlink" href="<?php bloginfo('url'); ?>/service">ひかり税理士法人のサービス一覧を見る</a>
                </div>
                <div class="c-btn">
                    <a class="c-btnlink" href="<?php bloginfo('url'); ?>/cases">ひかり税理士法人の成功事例を見る</a>
                </div>
            </div>
        </div>
    </section>
    <?php
        $the_query = new WP_Query(array(
            'order' => 'DESC', 
            'post_type' => 'post', 
            'posts_per_page' => 5, 
            'orderby' => 'date'
        ));
    ?>
    <?php if ( $the_query->have_posts() ) : ?>
    <section class="news">
        <div class="l-container">
            <h2 class="c-title1">
                <span class="ja">ニュース</span>
                <span class="en">News</span>
            </h2>
            <div class="news__inner">
            <ul class="c-tabs">
                    <li data-content="all" data-color="#0078d2" class="active">すべて</li>
                    <?php
                    $cats = get_categories(array(
                        'orderby' => 'ID'
                    ));
                    if ($cats) {
                        foreach ($cats as $cat) {
                            $color = get_field('color', $cat);
                            $cat_key = get_field('cat_key', $cat);
                            echo '<li data-content="' . $cat_key . '" data-color="' . $color . '">' . $cat->cat_name . '</li>';
                        }
                    }
                    ?>
                </ul>
                <div class="c-tabs__content">
                <!-- All Posts - Display 5 Posts-->
                <ul class="c-listpost active" id="all">
                    <?php
                        while ($the_query->have_posts()) : $the_query->the_post();
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
                        <h3 class="titlepost"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title($post->ID); ?></a></h3>
                    </li>
                    <?php
                    endwhile;
                    ?>
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
            </div>
                <div class="l-btn">
                    <div class="c-btn c-btn--small">
                        <a class="c-btnlink" href="<?php echo get_site_url(); ?>/news">ニュース一覧を見る</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        endif; 
    ?>
    <?php
        $the_query = new WP_Query(array(
            'post_type' => 'publish', 
            'posts_per_page' => 4, 
            'orderby' => 'rand'
        ));
    ?>
    <?php if ( $the_query->have_posts() ) : ?>
        <section class="publish">
            <div class="l-container">
                <h2 class="c-title1">
                    <span class="ja">出版物</span>
                    <span class="en">Publish</span>
                </h2>
                <div class="publish__inner">
                    <ul class="c-gridpost">
                    <?php
                        while ($the_query->have_posts()) : $the_query->the_post();
                            $post = get_post();
                        ?>
                            <li class="c-gridpost__item">
                                <a href="<?php echo get_permalink($post->ID); ?>">
                                    <div class="c-gridpost__thumb">
                                        <?php if( get_field('image') ): ?>
                                            <img src="<?php echo get_field('image')['url']; ?>" alt="<?php echo get_the_title($post->ID);?>">
                                        <?php else : ?> 
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/no-imgpublish.png" alt="no image available">
                                        <?php endif; ?>	
                                    </div>
                                    <p class="datepost"><?php  echo get_field('publication-date'); ?></p>
                                    <h3><?php echo get_the_title($post->ID); ?></h3>
                                </a>
                            </li>
                        <?php
                            endwhile;
                        ?>
                    </ul>
                </div>
                <div class="l-btn">
                    <div class="c-btn c-btn--small">
                        <a class="c-btnlink" href="<?php echo get_site_url(); ?>/publish">出版物一覧を見る</a>
                    </div>
                </div>
            </div>
        </section>
    <?php
        endif;
    ?>
</main>
<?php get_footer(); ?>