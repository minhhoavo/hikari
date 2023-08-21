<?php
/* pagination - load page*/
function pagination($custom_query = null, $paged = 1)
{
    global $wp_query, $wp_rewrite;
    if ($custom_query) $main_query = $custom_query;
    else $main_query = $wp_query;
    $big = 999999999;
    $total = isset($main_query->max_num_pages) ? $main_query->max_num_pages : '';
    if ($total > 1) echo '<div class="c-pagination">';
    echo paginate_links(array(
        'base' => trailingslashit(esc_url(get_pagenum_link())) . "{$wp_rewrite->pagination_base}/%#%/",
        'format'   => '?paged=%#%',
        'current'  => max(1, get_query_var('paged')),
        'total'    => $total,
        'mid_size' => '5',
        'prev_text'    => __('', 'task14'),
        'next_text'    => __('', 'task14'),
    ));
    if ($total > 1) echo '</div>';
}
/* pagination ajax */
function pagination_tdc($wp_query, $paged, $type)
{
    if ($wp_query->max_num_pages <= 1)
        return;
    $paged = $paged;
    $max = intval($wp_query->max_num_pages);

    if ($paged >= 1) {
        $links[] = $paged;
    }
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if (($paged + 2) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
    $html = '';
    if ($paged - 1 > 0) {
        $prev = $paged - 1;
        $html .= '<a rel="nofollow" class="prev page-numbers" href="' . build_url($prev, $type) . '" ></a>';
    }

    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="current"' : '';
        if (!$class) {
            $html .= '<a rel="nofollow" class="page-numbers" href="' . build_url(1, $type) . '" >1</a>';
        } else {
            $html .= '<span ' . $class . '>1</span>';
        }
        if (!in_array(2, $links))
            $html .= '<span>…</span>';
    }

    sort($links);
    foreach ((array) $links as $link) {
        $class = $paged == $link ? ' class="current"' : '';
        if (!$class) {
            $html .= '<a rel="nofollow" class="page-numbers" href="' . build_url($link, $type) . '">' . $link . '</a>' . "\n";
        } else {
            $html .= '<span ' . $class . '>' . $link . '</span>';
        }
    }

    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links)) $html .= '<li>…</li>' . "\n";
        $class = $paged == $max ? 'current ' : '';
        $html .= '<a rel="nofollow" class="' . $class . 'page-numbers" href="' . build_url($max, $type) . '">' . $max . '</a>';
    }

    if ($paged + 1 <= $max) {
        $next = $paged + 1;
        $html .= '<a rel="nofollow" class="next page-numbers" href="' . build_url($next, $type) . '" ></a>';
    }
    return $html;
}

function build_url($paged, $type)
{
    $url = home_url("/$type/page/" . $paged);
    return $url;
}

//ajax page news
function ajax_load_page()
{
    $result['type'] = 'error';
    $result['message'] = "Error";

    $paged = $_POST['paged'];
    $cat = $_POST['cat'];
    $id = $_POST['id'];
    $type = $_POST['slug'];
    if ($cat == "すべて") {
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 10,
            'paged' => $paged,
            'order' => 'DESC'
        );
    } else {
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 10,
            'category_name' => $cat,
            'paged' => $paged,
            'order' => 'DESC'
        );
    }
    $the_query = new WP_Query($args);
    ob_start();
    if (is_wp_error($the_query)) {
        $result = json_encode($result);
    } else { ?>
        <ul>
            <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                    $post = get_post();
                    $cat = get_the_category(); ?>
                    <li class="c-listpost__item">
                        <div class="c-listpost__info">
                            <span class="datepost"><?php echo get_the_date('Y年m月d日'); ?></span>
                            <div class="c-listpost__cat">
                                <?php if (count($cat) > 1) {
                                    foreach ($cat as $cd) {
                                        if ($cd->cat_ID != 1) {
                                ?>
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
            endif;
            ?>
        </ul>
        <div class="c-pagination c-ajax">
            <?php
            echo pagination_tdc($the_query, $paged, $type);
            wp_reset_postdata(); ?>
        </div>
    <?php
    }
    $content = ob_get_contents();
    ob_end_clean();
    $result['type'] = "success";
    $result['message'] = "Success!";
    $result['content'] = $content;
    $result = json_encode($result);
    echo $result;
    die();
}
    add_action('wp_ajax_nopriv_ajax_load_page', 'ajax_load_page');
    add_action('wp_ajax_ajax_load_page', 'ajax_load_page');

/*
@ Hàm hiển thị nội dung của post type
@ Hàm này sẽ hiển thị đoạn rút gọn của post ngoài trang chủ (the_excerpt)
@ Nhưng nó sẽ hiển thị toàn bộ nội dung của post ở trang single (the_content)
**/
if (!function_exists('task14_entry_content')) {
    function task14_entry_content()
    {
        if (!is_single()) :
            the_excerpt();
        elseif (is_single()) :
            the_content();
/*
* Code hiển thị phân trang trong post type
*/
            $link_pages = array(
                'before' => __('<p>Page:', 'task14'),
                'after' => '</p>',
                'nextpagelink' => __('Next page', 'task14'),
                'previouspagelink' => __('Previous page', 'task14')
            );
            wp_link_pages($link_pages);
        endif;
    }
}
//Classic Editor
add_filter('use_block_editor_for_post', '__return_false');
//Edit search form
function custom_search_form($form)
{
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url() . '" >
<div class="custom-form"><label class="screen-reader-text" for="s">' . __('Search:') . '</label>
<input type="text" value="' . get_search_query() . '" name="s" id="s" />
<input class="c-search__submit" type="submit" id="searchsubmit" value="' . esc_attr__('近日公開') . '" />
</div>
</form>';

    return $form;
}
add_filter('get_search_form', 'custom_search_form', 40);
    
    /* Filter and add color for category */
    if (!function_exists('dot_cat')) {
        function dot_cat($cat)
        {
            if ($cat == 'お知らせ') {
                return '#1bb7c5';
            } elseif ($cat == '税の最新情報') {
                return '#d6772a';
            } elseif ($cat == '税制改正') {
                return '#c4a021';
            } elseif ($cat == '掲載情報') {
                return '#416ad3';
            } elseif ($cat == 'バックナンバー') {
                return '#cccccc';
            }
        }
    }
    function custom_post_type()
    {
        register_post_type(
            'publish',
            array(
                'labels'      => array(
                    'name'          => __('Publish', 'task14'),
                    'singular_name' => __('Publish', 'task14'),
					'taxonomies'    => __('Publish Categories','task14')
                ),
                'public'      => true,
                'has_archive' => true,
				'supports' => array( 'title', 'editor', 'custom-fields','thumbnail' ),
                'rewrite'     => array(
                    'slug' => 'publish',
                    'with_front' => false
                ), // my custom slug
            )
        );
    }
    add_action('init', 'custom_post_type');
    function add_service()
    {
        register_post_type(
            'service',
            array(
                'labels'      => array(
                    'name'          => __('Services', 'task14'),
                    'singular_name' => __('Service', 'task14')
                ),
                'public'      => true,
                'has_archive' => true,
				'supports' => array( 'title', 'editor', 'custom-fields','thumbnail' ),
                'rewrite'     => array(
                    'slug' => 'services',
                    'with_front' => false
                ), // my custom slug
            )
        );
    }
    add_action('init', 'add_service');

    /**
     * Add custom taxonomies
    */
    function add_custom_taxonomies()
    {
        // Add new "Locations" taxonomy to Posts
        register_taxonomy('product-category', 'product', array(
            // Hierarchical taxonomy (like categories)
            'hierarchical' => true,
            // This array of options controls the labels displayed in the WordPress Admin UI
            'labels' => array(
                'name' => __('Publish Categories', 'task14'),
                'singular_name' => __('Publish Category', 'task14')
            ),
            // Control the slugs used for this taxonomy
            'rewrite' => array(
                'slug' => '', // This controls the base slug that will display before each term
                'with_front' => false, // Don't display the category base before "/locations/"
                'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
            ),
        ));
    }
    add_action('init', 'add_custom_taxonomies', 0);
    function add_custom_service()
    {
        // Add new "Locations" taxonomy to Posts
        register_taxonomy('service-category', 'service', array(
            // Hierarchical taxonomy (like categories)
            'hierarchical' => true,
            // This array of options controls the labels displayed in the WordPress Admin UI
            'labels' => array(
                'name' => __('Type of Service','task14'),
                'singular_name' => __('Type of Service','task14')
            ),
            // Control the slugs used for this taxonomy
            'rewrite' => array(
                'slug' => '', // This controls the base slug that will display before each term
                'with_front' => false, // Don't display the category base before "/locations/"
                'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
            ),
        ));
    }
    add_action('init', 'add_custom_service', 0);
    function add_custom_service2()
    {
        // Add new "Locations" taxonomy to Posts
        register_taxonomy('service-category2', 'service', array(
            // Hierarchical taxonomy (like categories)
            'hierarchical' => true,
            // This array of options controls the labels displayed in the WordPress Admin UI
            'labels' => array(
                'name' => __('Content of Service','task14'),
                'singular_name' => __('Content of Service', 'task14')
            ),
            // Control the slugs used for this taxonomy
            'rewrite' => array(
                'slug' => '', // This controls the base slug that will display before each term
                'with_front' => false, // Don't display the category base before "/locations/"
                'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
            ),
        ));
    }
    add_action('init', 'add_custom_service2', 2);
    // Breadcrumbs
    function custom_breadcrumbs()
    {

        // Settings
        $breadcrums_class   = 'c-breadcrumb';
        $home_title         = 'Home';

        // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
        $custom_taxonomy    = 'product_cat';

        // Get the query & post information
        global $post, $wp_query;

        // Do not display on the homepage
        if (!is_front_page()) {
            // Build the breadcrums
            echo '<div class="' . $breadcrums_class . '">
        <div class="l-container">';

            // Home page
            echo '<a href="' . get_home_url() . '">' . $home_title . '</a>';

            if (is_archive() && !is_tax() && !is_category() && !is_tag()) {
            $post_type = get_post_type();
            if ($post_type == 'post') {
                $post_type_object = get_post_type_object($post_type);
                echo '<span>' . $post_type_object->labels->name . '</span>';
            }
            if ($post_type == 'publish') {
                $post_type_object = get_post_type_object($post_type);
                echo '<span>出版物</span>';
            }
            if ($post_type == 'service') {
                $post_type_object = get_post_type_object($post_type);
                echo '<span>ご提供サービス</span>';
            }
        } else if (is_single()) {

            // If post is a custom post type
            $post_type = get_post_type();
            // If it is a custom post type display name and link
            if ($post_type == 'publish') {
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                echo '<a href="' . $post_type_archive . '">出版物</a>';
            }
            if ($post_type == 'post') {
                echo '<a href="' . get_site_url() . '/news">ニュース・お知らせ</a>';
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
            }
            if ($post_type == 'service') {
                echo '<a href="' . get_site_url() . '/services">ご提供サービス</a>';
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
            }
                // If it's a custom post type within a custom taxonomy
                $taxonomy_exists = taxonomy_exists($custom_taxonomy);
                if (empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {

                    $taxonomy_terms = get_the_terms($post->ID, $custom_taxonomy);
                    $cat_id         = $taxonomy_terms[0]->term_id;
                    $cat_nicename   = $taxonomy_terms[0]->slug;
                    $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                    $cat_name       = $taxonomy_terms[0]->name;
                }

                // Check if the post is in a category
                if (!empty($last_category)) {
                    // echo $cat_display;
                    echo '<a href="' . get_site_url() . '/news">ニュース・お知らせ</a>';
                    echo '<span>' . get_the_title() . '</span>';

                    // Else if post is in a custom taxonomy
                } else if (!empty($cat_id)) {

                    echo '<a href="' . $cat_link . '">' . $cat_name . '</a>';
                    echo '<span>' . get_the_title() . '</span>';
                } else {
                    echo '<span>' . get_the_title() . '</span>';
                }
            } else if (is_category()) {
                echo '<a href="' . get_site_url() . '/news">ニュース・お知らせ</a>';
                // Category page
                echo '<span>ニュース' . single_cat_title('', false) . '</span>';
            } else if (is_page()) {
				// If child page, get parents 
            $anc = get_post_ancestors( $post->ID );
                   
            // Get parents in the right order
            $anc = array_reverse($anc);
               
            // Parent page loop
            if ( !isset( $parents ) ) $parents = null;
            foreach ( $anc as $ancestor ) {
                $parents .= '<a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a>';
            }               
            // Display parent pages
            echo $parents;
               
            // Current pageF
                echo '<span>' . get_the_title() . '</span>';
            } else if (get_query_var('paged')) {

                // Paginated archives
                echo '<span>' . __('Page') . ' ' . get_query_var('paged') . '</span>';
            } else if (is_search()) {

                // Search results page
                echo '<span>Search results for: ' . get_search_query() . '</span>';
            }
            echo '</div></div>';
        }
    }
    function filter_service_category()
    {
        $result['type'] = 'error';
        $result['message'] = "Error";

        $b = $_POST['checked'];
        $b2 = $_POST['checked2'];

        $args = array(
            'post_type' => 'service', 'posts_per_page' => -1
        );

        if (!empty($b) || !empty($b2)) {
            $args['tax_query'] = [
                'relation' => 'OR',
                array(
                    'taxonomy' => 'service-category',
                    'field' => 'term_id',
                    'terms' => $b,
                ),
                array(
                    'taxonomy' => 'service-category2',
                    'field' => 'term_id',
                    'terms' => $b2,
                )
            ];
        }

        $the_query = new WP_Query($args);

        if (is_wp_error($the_query)) {
            $result = json_encode($result);
        } elseif (!is_wp_error($the_query) && $the_query->post_count == 0) {
            $result['type'] = 'empty';
            $result['message'] = "Null";
            $result = json_encode($result);
        } else {

            $posts = $the_query->posts;
            ob_start(); ?>
            <?php if ($the_query->have_posts()) : 
            ?>
            <?php while ($the_query->have_posts()) : $the_query->the_post();?>
                <li class="c-column__item">
                    <a href="<?php echo get_permalink($post->ID); ?>">
                    <?php if( get_field('icon') ): ?>
                        <img src="<?php echo get_field('icon')['url']; ?>" alt="<?php echo get_the_title($post->ID); ?>">
                        <?php else : ?> 
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/no-imgpublish.png" alt="no image available">
						<?php endif; ?>
                        <p><?php echo get_field('title');  ?></p>
                    </a>
                </li>
            <?php endwhile; endif;

            wp_reset_postdata();
            $content = ob_get_contents();
            ob_end_clean();
            $result['type'] = "success";
            $result['message'] = "Success!";
            $result['content'] = $content;
            $result['count'] = $the_query->post_count;
            $result = json_encode($result);
        }

        echo $result;
        die();
    }
    add_action('wp_ajax_nopriv_filter_service_category', 'filter_service_category');
    add_action('wp_ajax_filter_service_category', 'filter_service_category');

/*
/* Set title is required when publishing post
*/
add_action('edit_form_advanced', 'force_post_title');
function force_post_title($post)
{
    // List of post types that we want to require post titles for.
    $post_types = array(
        'post',
        'report',
        'interview'
        // 'event', 
        // 'project' 
    );

    // If the current post is not one of the chosen post types, exit this function.
    if (!in_array($post->post_type, $post_types)) {
        return;
    }

?>
    <script type='text/javascript'>
        (function($) {
            $(document).ready(function() {
                //Require post title when adding/editing Project Summaries
                $('body').on('submit.edit-post', '#post', function() {
                    // If the title isn't set
                    if ($("#title").val().replace(/ /g, '').length === 0) {
                        // Show the alert
                        if (!$("#title-required-msj").length) {
                            $("#titlewrap")
                                .append('<div id="title-required-msj"><em>タイトルが必要です。</em></div>')
                                .css({
                                    "padding": "5px",
                                    "margin": "5px 0",
                                    "background": "#ffebe8",
                                    "border": "1px solid #c00"
                                });
                        }
                        // Hide the spinner
                        $('#major-publishing-actions .spinner').hide();
                        // The buttons get "disabled" added to them on submit. Remove that class.
                        $('#major-publishing-actions').find(':button, :submit, a.submitdelete, #post-preview').removeClass('disabled');
                        // Focus on the title field.
                        $("#title").focus();
                        return false;
                    }
                });
            });
        }(jQuery));
    </script>
<?php
}