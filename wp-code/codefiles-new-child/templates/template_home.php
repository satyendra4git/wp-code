<?php

/**
Template Name: Home Page
 **/
get_header();
?>

<section class="banner">
    <div class="main-banner">
        <div class="row">
            <?php if (have_rows('find__property_sections')) : ?>
                <?php while (have_rows('find__property_sections')) : the_row(); ?>
                    <?php if ("find_property" == get_row_layout()) : ?>
                        <div class="banner-img-txt-nw">
                            <div class="col-lg-7 col-md-7">
                                <div class="banner-text">
                                    <div class="title">
                                        <span><?php echo get_sub_field('background_title'); ?></span>
                                        <h2><?php echo get_sub_field('title'); ?></h2>
                                    </div>
                                    <p><?php echo get_sub_field('description'); ?></p>
                                    <div class="location-bar">
                                        <div class="banner-title">
                                            <h5><?php echo get_sub_field('search_form_title'); ?></h5>
                                        </div>
                                        <ul class="list-inline-location">
                                            <form method="post" action="" class="cf_find-property">
                                                <li class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                    <input type="text" id="emails" name="pr_keyword" value="<?php if (!empty($_POST['pr_keyword'])) {
                                                                                                                echo trim($_POST['pr_keyword']);
                                                                                                            } ?>" placeholder="Search by property name..." class="inpad form-control">
                                                </li>
                                                <li class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                    <div class="search-item search-select rtin-location">
                                                        <?php
                                                        $args_loc = array(
                                                            'taxonomy'     => 'property_locations',
                                                            'orderby'      => 'name',
                                                            'pad_counts'   => '',
                                                            'hierarchical' => 1,
                                                            'hide_empty'   => 0
                                                        );
                                                        $all_locations = get_categories($args_loc);
                                                        //echo "<pre>";print_r($all_locations);
                                                        ?>
                                                        <select name="pr_location" class="select-accessible property_locations">
                                                            <option value="" selected="selected" data-select2-id="2">Select Location</option>
                                                            <?php if (!empty($all_locations)) {
                                                                foreach ($all_locations as $term) {
                                                            ?>
                                                                    <option class="level-0" value="<?php echo $term->slug; ?>" data-select2-id="<?php echo $term->term_id; ?>" <?php if (!empty($_POST['pr_location'])) {
                                                                                                                                                                                    if ($term->slug == $_POST['pr_location']) {
                                                                                                                                                                                        echo "selected";
                                                                                                                                                                                    }
                                                                                                                                                                                } ?>><?php echo $term->name; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </li>
                                                <li class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                                    <i class="fa fa-sliders"></i>
                                                </li>
                                                <li class="col-lg-3 col-md-3 col-sm-3 col-xs-3 sub-btn-cl-sjb"><input type="submit" name="findprsub" value="Search" class="sub" id="contact33-submit">
                                                    <i class="fa fa-search"></i>
                                                </li>
                                            </form>
                                        </ul>

                                        <div class="clearfix"></div>
                                        <p><?php echo get_sub_field('description_below_search_form'); ?>​</p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-5 col-md-5">
                                <figure>
                                    <?php
                                    $size = "large";
                                    $imgarr = wp_get_attachment_image_src(get_sub_field('image'), $size, true);
                                    $imgurl_pr = $imgarr[0];
                                    //echo "<pre>"; print_r($imgarr);
                                    ?>
                                    <?php if (get_sub_field('image')) : ?>
                                        <img src="<?php echo $imgurl_pr; ?>">
                                    <?php endif; ?>
                                </figure>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif;  ?>
        </div>
    </div>
</section>
<div class="clearfix"></div>


<section class="property-area">
    <div class="container">
        <?php if (have_rows('our_properties_section')) : ?>
            <?php while (have_rows('our_properties_section')) : the_row(); ?>
                <?php if ("our_properties" == get_row_layout()) : ?>
                    <div class="text-center title">
                        <h6><?php echo get_sub_field('subtitle'); ?></h6>
                        <span class="watermark center-watermark"><?php echo get_sub_field('background_title'); ?></span>
                        <h2><?php echo get_sub_field('title'); ?></h2>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
        <?php
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
        ?>
        <div class="property-list">
            <?php
            //Query the properties post_type			  
            $propertyObj = query_posts($pr_args);
            //echo "<pre>"; print_r($propertyObj);
            ?>
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) :  the_post();
                    $size = "medium";
                    $imgarr = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, true);
                    $imgurl = $imgarr[0];
                    $pr_terms = wp_get_post_terms(get_the_ID(), array('property_categories'));
                    $loc_terms = wp_get_post_terms(get_the_ID(), array('property_locations'));
                    //echo "<pre>";
                    //print_r($pr_terms);
                ?>
                    <div class="col-lg-4 col-md-4">
                        <div class="property-box">
                            <div class="property-img">
                                <a href="<?php the_permalink(); ?>"><img src="<?php echo $imgurl; ?>"></a>
                                <div class="property-overlay"></div>
                                <span class="listing-type-badge"> <?php if (!empty(get_field('type'))) {
                                                                        echo "For " . get_field('type');
                                                                    } ?></span>
                                <div class="product-price">
                                    <bdi><span class="price-currency"><?php if (!empty(get_field('price'))) {
                                                                            echo "$" . get_field('price'); ?></span>/<?php echo get_field('price_frequency');
                                                                                                                    } ?></bdi>
                                </div>
                            </div>

                            <div class="property-category">
                                <?php if (!empty($pr_terms) && !is_wp_error($pr_terms)) {
                                    foreach ($pr_terms as $term) {
                                ?>
                                        <a href="<?php echo get_term_link($term->slug, $term->taxonomy); ?>"><?php echo $term->name; ?></a>
                                <?php }
                                } ?>
                                <h3 class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                                <ul class="entry-meta">
                                    <li>
                                        <?php if (!empty($loc_terms) && !is_wp_error($loc_terms)) {
                                            foreach ($loc_terms as $term) {
                                        ?>
                                                <i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $term->name; ?></a>
                                    </li>
                            <?php }
                                        } ?>
                            </li>
                                </ul>

                                <ul class="product-features">
                                    <li><i class="fa fa-bed"></i><span class="icon"></span>Beds <?php if (!empty(get_field('beds'))) {
                                                                                                    echo get_field('beds');
                                                                                                } else {
                                                                                                    echo "0";
                                                                                                } ?></li>
                                    <li><i class="fa fa-bath"></i><span class="icon"></span>Baths <?php if (!empty(get_field('baths'))) {
                                                                                                        echo get_field('baths');
                                                                                                    } else {
                                                                                                        echo "0";
                                                                                                    } ?></li>
                                    <li><i class="fa fa-area-chart"></i><span class="icon"></span><?php if (!empty(get_field('area'))) {
                                                                                                        echo get_field('area'); ?> sqft <?php } else {
                                                                                                                                        echo "0";
                                                                                                                                    } ?></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <h1 class="text-center">Property not found.</h1>
            <?php endif; ?>

            <div class="clearfix"></div>
            <?php wp_reset_query();
            if (count($propertyObj) > 0) : ?>
                <?php if (have_rows('our_properties_section')) : ?>
                    <?php while (have_rows('our_properties_section')) : the_row(); ?>
                        <?php if ("our_properties" == get_row_layout()) : ?>
                            <?php $link_arr = get_sub_field('link');
                            if (!empty($link_arr)) :
                                //echo "<pre>"; print_r($link_arr);
                            ?>
                                <div class="text-center main-btn">
                                    <a href="<?php echo $link_arr['url'] ?>" class="hvr-shutter-in-horizontal" target="<?php echo $link_arr['target'] ?>"><?php echo $link_arr['title'] ?></a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif;  ?>
            <?php endif;  ?>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<?php wp_reset_query();
if (have_rows('who_we_are_section')) : ?>
    <?php while (have_rows('who_we_are_section')) : the_row(); ?>
        <?php if ("who_we_are" == get_row_layout()) : ?>
            <section class="who-we-are-area">
                <div class="who-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="who-img">
                                    <?php
                                    $size = "large";
                                    $imgarr = wp_get_attachment_image_src(get_sub_field('image'), $size, true);
                                    $imgurl_pr = $imgarr[0];
                                    //echo "<pre>"; print_r($imgarr);
                                    ?>
                                    <?php if (get_sub_field('image')) : ?>
                                        <img src="<?php echo $imgurl_pr; ?>">
                                    <?php endif; ?>

                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="who-area-content">
                                    <div class="title">
                                        <h6><?php echo get_sub_field('subtitle'); ?></h6>
                                        <span class="watermark"> <?php echo get_sub_field('background_title'); ?></span>
                                        <h2> <?php echo get_sub_field('title'); ?></h2>
                                    </div>
                                    <?php echo get_sub_field('content'); ?>
                                    <?php $link_arr = get_sub_field('contact_link');
                                    if (!empty($link_arr)) :
                                        //echo "<pre>"; print_r($link_arr);
                                    ?>
                                        <div class="main-btn mt-30">
                                            <a href="<?php echo $link_arr['url'] ?>" class="hvr-shutter-in-horizontal" target="<?php echo $link_arr['target'] ?>"><?php echo $link_arr['title'] ?></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="clearfix"></div>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif;  ?>

<section class="property-type-area">
    <div class="pro-ty-inner-cls">
        <div class="container">
            <?php if (have_rows('property_type_section_')) : ?>
                <?php while (have_rows('property_type_section_')) : the_row(); ?>
                    <?php if ("property_type" == get_row_layout()) : ?>
                        <div class="title">
                            <h6 class="white-text"><?php echo get_sub_field('title'); ?></h6>
                            <span class="watermark opacity-one-cls">categories</span>
                            <h2 class="white-text"> <?php echo get_sub_field('subtitle'); ?></h2>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif;  ?>

            <?php
            $args_prcat = array(
                'taxonomy'     => 'property_categories',
                'orderby'      => 'name',
                'hierarchical' => 1,
                'hide_empty'   => 0
            );
            $all_prcats = get_categories($args_prcat);
            //echo "<pre>";print_r($all_prcats);
            ?>
            <?php if (!empty($all_prcats)) : ?>
                <div id="owl-demo14" class="owl-carousel owl-theme">
                    <?php
                    foreach ($all_prcats as $term) {
                        $cat_image = get_field('image', $term->taxonomy . '_' . $term->term_id);
                    ?>
                        <div class="item">
                            <div class="pro-content-cls">
                                <?php if ($cat_image) : ?>
                                    <figure> <img src="<?php echo $cat_image;; ?>"> </figure>
                                <?php else : ?>
                                    <figure> <img src="<?php echo get_stylesheet_directory_uri(); ?>/codefile-assets/images/p-cat-1.png"> </figure>
                                <?php endif; ?>
                                <a href="<?php echo get_term_link($term->slug, $term->taxonomy); ?>"><?php echo $term->name; ?></a>
                                <span><?php echo $term->category_count; ?> listngs </span>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<div class="clearfix"></div>

<?php if (have_rows('our_team_section')) : ?>
    <?php while (have_rows('our_team_section')) : the_row(); ?>
        <?php if ("meet_oure_team" == get_row_layout()) : ?>
            <section class="team-area">
                <div class="container">
                    <div class="team-inner">
                        <div class="text-center title">
                            <h6><?php echo get_sub_field('subtitle'); ?></h6>
                            <span class="watermark center-watermark"> <?php echo get_sub_field('background_title'); ?></span>
                            <h2> <?php echo get_sub_field('title'); ?></h2>
                        </div>


                        <div class="team-new-cls">
                            <?php if (have_rows('team_members')) : ?>
                                <?php while (have_rows('team_members')) : the_row(); ?>
                                    <?php
                                    $size = "thumbnail";
                                    $imgarr = wp_get_attachment_image_src(get_sub_field('image'), $size, true);
                                    $imgurl_team = $imgarr[0];
                                    //echo "<pre>"; print_r($imgarr);
                                    ?>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="team-name">
                                            <div class="team-img col-md-5">
                                                <?php if (get_sub_field('image')) : ?>
                                                    <img src="<?php echo $imgurl_team; ?>">
                                                <?php else : ?>
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/codefile-assets/images/rosy_janner.jpg">
                                                <?php endif; ?>

                                            </div>
                                            <div class="team-detail col-md-7">
                                                <h4><a href=""><?php echo get_sub_field('name') ?></a></h4>
                                                <span class="item-subtitle"><?php echo get_sub_field('company') ?></span>
                                                <span class="listing-count"><?php echo get_sub_field('listing_count') ?></span>
                                                <div class="item-contact">
                                                    <div class="item-phn-no">
                                                        <i class="fa fa-phone" aria-hidden="true"></i>Call:<a href="tel:<?php echo trim(get_sub_field('contact_no')); ?>"><?php echo get_sub_field('contact_no') ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </section>
            <div class="clearfix"></div>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif;  ?>

<?php if (have_rows('property_for_all_section')) : ?>
    <?php while (have_rows('property_for_all_section')) : the_row(); ?>
        <?php if ("property_for_all" == get_row_layout()) : ?>
            <?php $size = "full";
            $imgarr = wp_get_attachment_image_src(get_sub_field('background_image'), $size, true);
            $imgurl_prforall = $imgarr[0];
            //echo "<pre>"; print_r($imgarr);     
            ?>
            <section class="tour-area" style="background:url(<?php if (get_sub_field('background_image')) {
                                                                    echo $imgurl_prforall;
                                                                } else {
                                                                    echo get_stylesheet_directory_uri(); ?>/codefile-assets/images/promo-bg-1.jpg <?php } ?>); background-position:center;background-repeat:no-repeat;background-size: cover;">
                <div class="tour-overlay"></div>

                <div class="tour-inner">
                    <div class="col-lg-5 col-md-5">
                        <div class="tour-video">
                            <div class="title">
                                <h6> <?php echo get_sub_field('subtitle'); ?></h6>
                                <h2> <?php echo get_sub_field('description'); ?></h2>
                            </div>
                            <div class="video-icon-area-sg">
                                <a id="play-video" class="video-play-button" href="#">
                                    <span></span>
                                </a>
                                <span class="video-txt-cls-shd">play video</span>
                                <div id="video-overlay" class="video-overlay">
                                    <a class="video-overlay-close">&times;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <div class="tour-txt">
                            <div class="text-center title">
                                <span class="watermark center-watermark"> <?php echo get_sub_field('title'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="clearfix">
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif;  ?>
            </div>
            <?php if (have_rows('testimonial_section')) : ?>
                <section class="testimonial-area">
                    <div class="testi-inner">
                        <div class="container">
                            <div id="owl-demo15" class="owl-carousel owl-theme">
                                <?php while (have_rows('testimonial_section')) : the_row(); ?>
                                    <?php if ("testimonial" == get_row_layout()) :
                                        $size = "thumbnail";
                                        $imgarr = wp_get_attachment_image_src(get_sub_field('image'), $size, true);
                                        $imgurl_testimonial = $imgarr[0];
                                        //echo "<pre>"; print_r($imgarr);
                                    ?>
                                        <div class="item">
                                            <div class="testimonial-content-cls">
                                                <?php if (get_sub_field('image')) : ?>
                                                    <img src="<?php echo $imgurl_testimonial; ?>">
                                                <?php else : ?>
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/codefile-assets/images/home5-team-3.png">
                                                <?php endif; ?>

                                                <h5><?php echo get_sub_field('name'); ?></h5>
                                                <span><?php echo get_sub_field('designation'); ?></span>
                                                <?php echo get_sub_field('content'); ?>
                                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="clearfix"></div>
            <?php endif; ?>

            <?php if (have_rows('real_state_service_section')) : ?>
                <?php while (have_rows('real_state_service_section')) : the_row(); ?>
                    <?php if ("real_state_service" == get_row_layout()) : ?>
                        <section class="real-services">
                            <div class="real-services-inner">
                                <div class="col-lg-7 col-md-7">
                                    <div class="service-lft-txt">
                                        <div class="title">
                                            <h2 class="white-text"><?php echo get_sub_field('title'); ?></h2>
                                        </div>
                                        <?php echo get_sub_field('description'); ?>

                                        <?php $link_arr = get_sub_field('contact_link');
                                        if (!empty($link_arr)) :
                                            //echo "<pre>"; print_r($link_arr);
                                        ?>
                                            <div class="contact-white-btn main-btn white-btn mt-30">
                                                <a href="<?php echo $link_arr['url'] ?>" class="hvr-shutter-in-horizontal2" target="<?php echo $link_arr['target'] ?>"><?php echo $link_arr['title'] ?></a>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5">
                                    <div class="service-img">
                                        <div class="dot-img">
                                            <?php
                                            $size = "medium";
                                            $imgarr = wp_get_attachment_image_src(get_sub_field('image'), $size, true);
                                            $imgurl_prservicert = $imgarr[0];
                                            //echo "<pre>"; print_r($imgarr);

                                            ?>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/codefile-assets/images/home-5-about-shape-2.svg">
                                        </div>
                                        <?php if (get_sub_field('image')) : ?>
                                            <img src="<?php echo $imgurl_prservicert; ?>">
                                        <?php else : ?>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/codefile-assets/images/home-5-service-2.png">
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="clearfix"></div>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif;  ?>
            <?php if (have_rows('dream_home_section')) : ?>
                <?php while (have_rows('dream_home_section')) : the_row(); ?>
                    <?php if ("find_your_dream_home" == get_row_layout()) : ?>
                        <section class="dream-home-cls">
                            <div class="text-center title dream-cls-new">
                                <span class="watermark center-watermark"><?php echo get_sub_field('background_title'); ?></span>
                                <h2> <?php echo get_sub_field('title'); ?></h2>
                                <?php $link_arr = get_sub_field('contact_link');
                                if (!empty($link_arr)) :
                                    //echo "<pre>"; print_r($link_arr);
                                ?>
                                    <div class="main-btn mt-30">
                                        <a href="<?php echo $link_arr['url'] ?>" class="hvr-shutter-in-horizontal" target="<?php echo $link_arr['target'] ?>"><?php echo $link_arr['title'] ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php
                            $size = "full";
                            $imgarr = wp_get_attachment_image_src(get_sub_field('image'), $size, true);
                            $imgurl_dreamhome = $imgarr[0];
                            //echo "<pre>"; print_r($imgarr);

                            ?>
                            <div class="dream-inner" style="background:url(<?php if (get_sub_field('image')) {
                                                                                echo $imgurl_dreamhome;
                                                                            } else {
                                                                                echo get_stylesheet_directory_uri(); ?>/codefile-assets/images/home-5-footer-promo-2.jpg<?php } ?>); background-position:center;background-repeat:no-repeat;">
                            </div>
                        </section>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif;  ?>
            <?php get_footer(); ?>