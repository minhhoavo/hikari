<?php /* Template Name: Publish */ ?>
<?php get_header();
$post_type = get_post_type();
$post_type_object = get_post_type_object($post_type);?>
<main class="p-product">
    <?php custom_breadcrumbs(); ?>
	<div class="c-headpage">
		<h2 class="c-title">出版物</h2>
        <p>ひかり税理士法人では、税務・会計・経営・相続などに関する書籍の執筆を行っています。</p>
    </div>
    <div class="l-container">
        <div class="p-publish__content">
            <ul class="c-gridpost">
                <?php
                    $page = get_query_var('paged', 1);
                    $the_query = new WP_Query(array(
                        'order' => 'DESC', 
                        'post_type' => 'publish', 
                        'posts_per_page' => 12, 
                        'orderby' => 'date', 
                        'paged' => $page
                    ));
                    if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                ?>
                    <li class="c-gridpost__item">
                        <div class="c-gridpost__thumb">
                            <?php if( get_field('image') ): ?>
                                <img src="<?php echo get_field('image')['url']; ?>" alt="<?php echo get_the_title($post->ID); ?>">
                            <?php else : ?> 
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/no-imgpublish.png" alt="no image available">
                            <?php endif; ?>	
                            </div>
                        <div class="c-gridpost__info">
                            <p class="datepost"><?php echo get_field('publication-date'); ?></p>
                            <h3><?php echo get_the_title($post->ID); ?></h3>
                            <p class="price"><?php echo get_field('price'); ?></p>
                            <a href="<?php echo get_permalink($post->ID); ?>" class="c-btnview">詳しく見る</a>
                        </div>
                    </li>
                <?php
                endwhile;
                    endif; 
                ?>
            </ul>
            <div class="c-pagination c-ajaxpublish">
                <?php
                echo pagination($the_query, 1, 'publish');
                wp_reset_postdata();  ?>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>