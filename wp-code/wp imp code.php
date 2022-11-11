<?php 
//add script and style
$parent_style = 'parent-style';
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-bootstrap-min', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css', '', null);
    wp_enqueue_style('child-fonts-googleapis', 'https://fonts.googleapis.com', '', null);
    wp_enqueue_style('child-fonts-gstatic', 'https://fonts.gstatic.com', '', null);
    wp_enqueue_style('child-fonts-googleapis-family', 'https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap', '');
    wp_enqueue_style('child-stylesheet', get_stylesheet_directory_uri() . '/codefile-assets/css/stylesheet.css', array($parent_style), '', null);
    wp_enqueue_style('child-slick', get_stylesheet_directory_uri() . '/codefile-assets/css/slick.css', array($parent_style), '');
    wp_enqueue_style('child-slick-theme', get_stylesheet_directory_uri() . '/codefile-assets/css/slick-theme.css', array($parent_style), '', null);
    wp_enqueue_style('child-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', '', null);
    //Add js files
    wp_enqueue_script('sk-child-jquery-min', get_stylesheet_directory_uri() . '/codefile-assets/js/jquery.min.js', array(), null, true);
    wp_enqueue_script('sk-child-jquery-slick', get_stylesheet_directory_uri() . '/codefile-assets/js/slick.js', array('sk-child-jquery-min'), null, true);
    wp_enqueue_script('sk-child-jquery-main', get_stylesheet_directory_uri() . '/codefile-assets/js/main.js', array('sk-child-jquery-min'), null, true);
    wp_enqueue_script('sk-child-jquery-custom', get_stylesheet_directory_uri() . '/codefile-assets/js/codefile-custom.js', array('sk-child-jquery-min'), null, true);
}
add_action('wp_enqueue_scripts', 'sk_child_theme_enqueue_scripts', 99);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Register Custom post types properties
add_action('init', 'register_cpt_properties');

function register_cpt_properties()
{

    $labels = array(
        'name' => __('Properties', 'codefiles'),
        'singular_name' => __('Property', 'codefiles'),
        'add_new' => __('Add New', 'codefiles'),
        'add_new_item' => __('Add New Property', 'codefiles'),
        'edit_item' => __('Edit Property', 'codefiles'),
        'new_item' => __('New Property', 'codefiles'),
        'view_item' => __('View Property', 'codefiles'),
        'search_items' => __('Search Property', 'codefiles'),
        'not_found' => __('Property not found', 'codefiles'),
        'not_found_in_trash' => __('No properties found in Trash', 'codefiles'),
        'parent_item_colon' => __('Parent Property:', 'codefiles'),
        'menu_name' => __('Properties', 'codefiles'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'comments'),
        'taxonomies' => array('property_categories'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-building',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type('properties', $args);
}

/**** ----------------------------------------------------------------------------------------------  **/
// Register Custom Taxonomy property_categories
function custom_taxonomy_property_categories()
{

    $labels = array(
        'name'                       => _x('Categories', 'Taxonomy General Name', 'codefiles'),
        'singular_name'              => _x('Category', 'Taxonomy Singular Name', 'codefiles'),
        'menu_name'                  => __('Categories', 'codefiles'),
        'all_items'                  => __('All Categories', 'codefiles'),
        'parent_item'                => __('Parent Category', 'codefiles'),
        'parent_item_colon'          => __('Parent Category:', 'codefiles'),
        'new_item_name'              => __('New Category', 'codefiles'),
        'add_new_item'               => __('Add New Category', 'codefiles'),
        'edit_item'                  => __('Edit Category', 'codefiles'),
        'update_item'                => __('Update Category', 'codefiles'),
        'view_item'                  => __('View Category', 'codefiles'),
        'separate_items_with_commas' => __('Separate items with commas', 'codefiles'),
        'add_or_remove_items'        => __('Add or remove Categories', 'codefiles'),
        'choose_from_most_used'      => __('Choose from the most used', 'codefiles'),
        'popular_items'              => __('Popular Category', 'codefiles'),
        'search_items'               => __('Search Items', 'codefiles'),
        'not_found'                  => __('Not Found', 'codefiles'),
        'no_terms'                   => __('No category', 'codefiles'),
        'items_list'                 => __('Category list', 'codefiles'),
        'items_list_navigation'      => __('Category list navigation', 'codefiles'),
    );

    $rewrite = array(
        'slug'                       => 'category',
        'with_front'                 => true,
        'hierarchical'               => true,
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite'                    => $rewrite,
    );

    register_taxonomy('property_categories', array('properties'), $args);
}

add_action('init', 'custom_taxonomy_property_categories', 0);

/**** ----------------------------------------------------------------------------------------------  **/
// Register Custom Taxonomy property_locations
function custom_taxonomy_property_locations()
{

    $labels = array(
        'name'                       => _x('Locations', 'Taxonomy General Name', 'codefiles'),
        'singular_name'              => _x('Location', 'Taxonomy Singular Name', 'codefiles'),
        'menu_name'                  => __('Locations', 'codefiles'),
        'all_items'                  => __('All Locations', 'codefiles'),
        'parent_item'                => __('Parent Location', 'codefiles'),
        'parent_item_colon'          => __('Parent Location:', 'codefiles'),
        'new_item_name'              => __('New Location', 'codefiles'),
        'add_new_item'               => __('Add New Location', 'codefiles'),
        'edit_item'                  => __('Edit Location', 'codefiles'),
        'update_item'                => __('Update Location', 'codefiles'),
        'view_item'                  => __('View Location', 'codefiles'),
        'separate_items_with_commas' => __('Separate items with commas', 'codefiles'),
        'add_or_remove_items'        => __('Add or remove Locations', 'codefiles'),
        'choose_from_most_used'      => __('Choose from the most used', 'codefiles'),
        'popular_items'              => __('Popular Location', 'codefiles'),
        'search_items'               => __('Search Items', 'codefiles'),
        'not_found'                  => __('Not Found', 'codefiles'),
        'no_terms'                   => __('No category', 'codefiles'),
        'items_list'                 => __('Location list', 'codefiles'),
        'items_list_navigation'      => __('Location list navigation', 'codefiles'),
    );

    $rewrite = array(
        'slug'                       => 'locations',
        'with_front'                 => true,
        'hierarchical'               => true,
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite'                    => $rewrite,
    );

    register_taxonomy('property_locations', array('properties'), $args);
}

add_action('init', 'custom_taxonomy_property_locations', 0);
////////////////////////////////////////////////////////////////
//add attributes to link tag
function codefiles_add_link_tag_attributes($html, $handle)
{
    if ('child-fonts-googleapis' === $handle) {
        return str_replace(array("rel='stylesheet'", "media='all'"), array("rel='preconnect'", ""), $html);
    }
    if ('child-fonts-gstatic' === $handle) {
        return str_replace(array("rel='stylesheet'", "media='all'"), array("rel='preconnect'", "crossorigin"), $html);
    }
    return $html;
}
add_filter('style_loader_tag', 'codefiles_add_link_tag_attributes', 10, 2);
/////////////////////////////////////////////////////////////////////////////////

$args_loc = array(
					'taxonomy'     => 'property_locations',
					'orderby'      => 'name',
					'pad_counts'   => '',
					'hierarchical' => 1,
					'hide_empty'   => 0
				);
$all_locations = get_categories($args_loc);
///////////////////////////////////////////////////////////////////////////////////////
wp_reset_query();
        $pr_args = array(
            "post_type" => "properties",
            "posts_per_page" => 6,
            "post_status" => "publish"
        );
        //Set search query here	
        if (isset($_POST['findprsub'])) {
            if (!empty($_POST['pr_location'])) {
                $pr_args['tax_query'] =  array(
                    array(
                        'taxonomy' => 'property_locations',
                        'field' => 'slug',
                        'terms' => $_POST['pr_location'],
                    )
                );
            }
            if (!empty($_POST['pr_keyword'])) {
                $pr_args['s'] = trim($_POST['pr_keyword']);
            }
        }
////////////////////////////////////////////////////////////////////////////////
          //Query the properties post_type			  
            $propertyObj = query_posts($pr_args);
            //echo "<pre>"; print_r($propertyObj);

                    $size = "medium";
                    $imgarr = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, true);
                    $imgurl = $imgarr[0];
                    $pr_terms = wp_get_post_terms(get_the_ID(), array('property_categories'));
                    $loc_terms = wp_get_post_terms(get_the_ID(), array('property_locations'));
                    //echo "<pre>";
                    //print_r($pr_terms);			