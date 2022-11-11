<?php //die('jdgfhj');
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 */

?>
</main>
<div class="clearfix"></div>
<footer>
  <div class="main-footer" style="background:url(<?php echo get_stylesheet_directory_uri(); ?>/codefile-assets/images/footer-2-bg.jpg); background-position:center;background-repeat:no-repeat;">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4">
          <div class="footer-inn">
            <?php wp_reset_query();
            $size = "medium";
            //echo get_field('footer_logo_image', 5);
            $imgarr = wp_get_attachment_image_src(get_field('footer_logo_image', 5), $size, true);
            $imgurl_footerlogo = $imgarr[0];
            //echo "<pre>";
            //print_r($imgarr);

            ?>
            <a href="<?php bloginfo('url'); ?>">
              <img src="<?php if (get_field('footer_logo_image', 5)) {
                          echo $imgurl_footerlogo;
                        } else {
                          echo get_stylesheet_directory_uri(); ?>/codefile-assets/images/footer-logo.png <?php } ?>" class="footer-logo">
            </a>
            <?php echo get_field('footer_description', 5); ?>
            <?php if (have_rows('social_links', 5)) : ?>
              <ul class="footer-social-icon">
                <?php while (have_rows('social_links', 5)) : the_row();
                  $link_arrft = get_sub_field('link', 5);
                  //echo "<pre>";print_r($link_arrft);
                ?>
                  <li><a href="<?php echo $link_arrft['url']; ?>" target="_blank"><?php echo $link_arrft['title']; ?></a></li>
                <?php endwhile; ?>
              </ul>
            <?php endif; ?>
          </div>
        </div>


        <div class="col-lg-4 col-md-4">
          <div class="footer-inn">
            <h3 class="footer-title"><?php echo get_field('quick_links_title', 5); ?></h3>
            <?php $nav_args = array(
              "theme-location" => "",
              "menu" => "top-menu",
              "menu_class" => "footer-links",
              "container" => "",

            );
            wp_nav_menu($nav_args);
            ?>

          </div>
        </div>

        <div class="col-lg-4 col-md-4">
          <div class="footer-inn">
            <h3 class="footer-title"><?php echo get_field('contact_title', 5); ?></h3>
            <?php if (have_rows('contact_items', 5)) : ?>
              <ul class="footer-list-info">
                <?php $j = 1;
                while (have_rows('contact_items', 5)) : the_row(); ?>
                  <?php if ($j == 1) { ?>
                    <li><?php echo get_sub_field('icon'); ?>
                      <p class="spa-side"><?php echo get_sub_field('title'); ?> </p>
                    </li>
                  <?php } elseif ($j == 2) { ?>
                    <li><?php echo get_sub_field('icon'); ?>
                      <p class="spa-side"><a href="mailto:<?php echo trim(get_sub_field('title')); ?>">
                          <?php echo get_sub_field('title'); ?></a></p>
                    </li>
                  <?php } else { ?>
                    <li><?php echo get_sub_field('icon'); ?>
                      <p class="spa-side"><a href="tel:<?php echo trim(get_sub_field('title')); ?>"><?php echo trim(get_sub_field('title')); ?> </a></p>
                    </li>
                  <?php } ?>
                <?php $j++;
                endwhile; ?>
                <div class="social-icons">
                </div>
              </ul>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="footer-copyright">

    <p>Copyright 2022© . Base Real Estate Pvt ltd. All right reserved reated in sitebeat</p>
  </div>
</footer>
<div class="get-quote-popup-cls">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body" style="background:url(<?php echo get_stylesheet_directory_uri(); ?>/codefile-assets/images/bg-color.png); background-position:center;

 background-repeat:no-repeat;background-size: cover;">
          <div class="col-md-12"> <span class="sml-title white-text">GET IN TOUCH </span>
            <div class="head-title mt-20 mb-30 about-lft-dgd-border">
              <h3 class="mt-0">Send Your Message To Us </h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php wp_footer(); ?>
<?php
if (isset($_POST['findprsub'])) {
?>
  <script>
    jQuery(function() {
      var scrl = $('.property-area').offset().top;

      scrl = scrl + 10;
      //console.log(scrl);
      //alert(scrl);
      $('html,body').animate({
        scrollTop: scrl
      }, 800, function() {});
    });
  </script>
<?php }  ?>
</body>

</html>