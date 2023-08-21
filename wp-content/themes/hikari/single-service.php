<?php get_header(); ?>
<main class="p-service">
    <?php custom_breadcrumbs();
    $p = get_post(); ?>
        <div class="c-headpage">
            <div class="l-container2">
                <h2 class="c-title"><?php echo get_field('title'); ?></h2>
            </div>
            <p><?php echo get_field('description'); ?></p>
        </div>
        <?php if( get_field('image') ): ?>
            <div class="feature_img">
                <img src="<?php echo get_field('image')['url']; ?>" alt="<?php the_title(); ?>">
            </div>
        <?php endif; ?>	
        <?php if( have_rows('target-list') ): ?>
            <div class="p-service__consultation">
                <dl class="l-container2">
                    <dt>このような方はご相談ください</dt>
                    <?php while( have_rows('target-list') ): the_row(); ?>
                        <dd class="c-checkMark"><?php echo the_sub_field('target'); ?></dd>
                    <?php endwhile; ?>
                </dl>
            </div>
        <?php endif; ?>

        <?php if( have_rows('advantage') ): ?>
        <div class="p-service__merit">
            <div class="l-container2">
                <h3 class="p-service__title">ひかり税理士法人を選ぶメリット</h3>
                <dl>
				    <?php while( have_rows('advantage') ): the_row(); ?>
                        <dt class="c-checkMark"><?php echo the_sub_field('advantage-title'); ?></dt>
                        <dd><?php echo the_sub_field('advantage-description'); ?></dd>
                    <?php endwhile; ?>
                </dl>
            </div>
        </div>
        <?php endif; ?>
       
        <?php if( have_rows('steps') ): ?>
            <div class="p-service__flow">
                <div class="l-container2">
                    <h3 class="p-service__title">サービスの流れ</h3>
                        <?php $count = 0; ?>
                        <?php while( have_rows('steps') ): the_row(); ?>
                        <?php $count +=1;?>
                            <table>
                                <tbody>
                                    <tr>
                                        <th>STEP<?php echo $count ?></th>
                                        <td>
                                            <h4 class="flow-title"><?php echo the_sub_field('step-title'); ?></h4>
                                            <?php if( have_rows('step-subtitle-rpt') ): ?>
                                                <?php while( have_rows('step-subtitle-rpt') ): the_row(); ?>
                                                    <h5 class="flow-subtitle"><?php echo the_sub_field('step-subtitle'); ?></h5>
                                                    <?php if( have_rows('step-description-rpt') ): ?>
                                                        <?php while( have_rows('step-description-rpt') ): the_row(); ?>
                                                            <p class="c-checkMark"><?php echo the_sub_field('step-description'); ?></p>
                                                        <?php endwhile; ?>
                                                    <?php endif; ?>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php endwhile; ?> 
                </div>
            </div>
        <?php endif; ?> 

        <div class="p-service__division">
            <?php if( have_rows('related-service-rpt') ): ?>
                <div class="l-container">
                    <h3 class="p-service__subtitle">関連サービス</h3>
                    <ul class="division-list c-flex">
                        <?php while( have_rows('related-service-rpt') ): the_row(); ?>
                            <li class="small-12 medium-4">
                                <a href="<?php echo get_permalink($post->ID); ?>">
                                    <p class="img">
                                        <?php if( get_field('icon') ): ?>
                                            <img src="<?php echo get_field('icon')['url']; ?>" alt="<?php echo get_field('title'); ?>">
                                        <?php else : ?> 
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/no-imgpublish.png" alt="no image available">
                                        <?php endif; ?>	
                                    </p>
                                    <p class="text"><span class="arrow"><?php echo get_field('title'); ?></span></p>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            <?php endif; ?>
    
            <div class="l-btn">
                <div class="c-btn c-btn--small">
                    <a class="c-btnlink" href="<?php echo get_site_url();?>/services">ご提供サービス一覧へ</a>
                </div>
            </div>
        </div>
        
</main>
<?php get_footer(); ?>