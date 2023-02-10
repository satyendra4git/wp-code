<?php
/** Template Name: Profile detail
**/
get_header(); 

?>
<style>
.ugallery li{ float: left; padding: 1%; }
</style>
<div class="content-wrap">
  <div class="container">
    <div class="register-wrap clearfix">
		<div class="row">
		<?php 
		
			  $userid = $_GET['uid'];
			  $user = get_user_by( 'id', $userid );
			    //echo "<pre>";print_r($user);
			   
			    $profilename = $user->display_name;
				$username = $user->user_login;
				$uemail = $user->user_email;

				$ucity = get_user_meta($userid, '_ucity', true);
				$uaddr = get_user_meta($userid, '_uaddr', true);
				$uworkspaces = get_user_meta($userid, '_uworkspaces', true);
				$uservices = get_user_meta($userid, '_uservices', true);
				$usex = get_user_meta($userid, '_usex', true);
				$uprofiltext = get_user_meta($userid, '_uprofiltext', true);
				$utelephone = get_user_meta($userid, '_utelephone', true);
				

				$uimages = get_user_meta($userid, '_uimages', true);

				$uimagesarr = explode(",",$uimages);
		
			
			   //echo $lastlogin = get_user_meta($userid, '_lastlogin', true);


		?>
			<article class="col-md-9">
	          <h2><?php echo $profilename; ?> <span><?php echo $ucity; ?></span></h2>
				<p><?php echo htmlspecialchars_decode($uprofiltext); ?></p>
				<div class="user-contact-detail">
				<h3>Kontakt</h3>
				<?php if($utelephone){ ?>
				<p><strong>Tlf: </strong><span> <?php echo $utelephone;  ?></span></p>
				<?php } ?>
				
				<?php if($uemail){ ?>
				<p><strong>Email: </strong><span> <?php echo $uemail;  ?></span></p>
				<?php } ?>
				
				<?php if($uaddr){ ?>
				<p><strong>Addresse: <strong><span> <?php echo $uaddr;  ?></span></p>
				<?php } ?>
				</div>
				<div class="ugallery">
				 <h3><?php echo $profilename; ?>'s Galleri</h3>
				<?php if(!empty($uimagesarr)){ ?>
				<ul class="galimg">
				<?php foreach($uimagesarr as $img){ ?>
						  
				 <li><a href="<?php bloginfo('template_url'); ?>/useruploads/<?php echo $img; ?>"><img src="<?php bloginfo('template_url'); ?>/useruploads/<?php echo $img; ?>" title="" alt=""/> </a> </li> 
						  
				<?php }  ?>
				
				</ul>
				<?php }//end if ?>
				
				</div>

      </article>
	  <aside class="col-md-3 right-panel leftSidebar">
    	<div class="theiaStickySidebar">
    	 <?php if(have_rows('ad_boxes',5)){ ?>
		<?php while(have_rows('ad_boxes',5)){ the_row(); ?>
    	<div class="ad-box">
    		<a href="<?php the_sub_field('link',5); ?>"><img src="<?php the_sub_field('ad_image',5); ?>" alt="Massage24-7"></a>
    	</div><!-- Ad Box -->
		<?php }//end while ?>
    	
		<?php }//end if ?>
    	</div>
    </aside><!-- Right Panel -->
	  </div>
	</div>
   </div>
</div>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
