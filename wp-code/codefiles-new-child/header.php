<?php

/**
 * Header file for the Code Files WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Code Files Child
 * @since Code Files New 1.0
 */

?>
<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/codefile-assets/images/favicon.png" type="image/x-icon">
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> id="home">
	<a href="#" id="scroll" style="display: none;"><span></span></a>
	<div class="clearfix"></div>

	<header class="main-home-header">
		<div class="header-custom-container">
			<div class="row header-inner-cls">

				<?php wp_reset_query();
				$size = "medium";
				//echo get_field('website_logo', 5);
				$imgarr = wp_get_attachment_image_src(get_field('website_logo', 5), $size, true);
				$imgurl_weblogo = $imgarr[0];
				//echo "<pre>";
				//print_r($imgarr);

				?>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
					<div class="logo-area">
						<a href="<?php bloginfo('url'); ?>">
							<img src="<?php if (get_field('website_logo')) {
											echo $imgurl_weblogo;
										} else {
											echo get_stylesheet_directory_uri(); ?>/codefile-assets/images/logo.png <?php } ?>">
						</a>
					</div>

				</div>
				<div class="col-lg-9 col-md-9 col-sm-6 col-xs-6">
					<div class="main-nav">
						<?php $nav_args = array(
							"theme-location" => "",
							"menu" => "top-menu",
							"menu_class" => "",
							"container" => "",

						);
						wp_nav_menu($nav_args);
						?>

					</div>
					<div class="header-contact-btn">
						<a href="<?php echo get_page_link(181); ?>" class="hvr-shutter-in-horizontal"><?php echo get_the_title(181); ?></a>
					</div>

				</div>

			</div>
		</div>

		<div id="menu-container" class="responsive-toggle">
			<div id="menu-wrapper">
				<div id="hamburger-menu"><span></span><span></span><span></span></div>
			</div>
			<?php $nav_args = array(
				"theme-location" => "",
				"menu" => "top-menu",
				"menu_class" => "menu-list accordion",
				"container" => "",

			);
			wp_nav_menu($nav_args);
			?>

		</div>
	</header>
	<div class="clearfix"></div>
	<main>