<?php ob_start();
/** Template Name: Log Ind
**/
get_header();
?>
<style>
 .form-msg{
    text-align: center;
    padding: 21px;
    background: #ededed;
}
.rerror{ color: #ff0000; }
.rsucess{ color: #0F7A10; }
</style>
<?php
 
    if(isset($_POST['loginsub'])){	
    $useremail = $_POST['uemail'];
    $password = trim($_POST['upassword']);
    $data = array();
    if(username_exists( $useremail ))
    {
        $userid = username_exists( $useremail );
    }
    else if(email_exists( $useremail ))
    {
        $userid = email_exists( $useremail );
    }
    else{
        $userid = '';
    }
      if($userid) {

			$user = get_user_by( 'id', $userid );
			//echo "<pre>";print_r($user);
	
			//echo $lastlogin = get_user_meta($uid, '_lastlogin', true);
			$ustatus = get_user_meta( $userid, "_ustatus", true);
			
			if($ustatus==1){
				
            if( $user && wp_check_password( $password, $user->data->user_pass, $user->ID) )
              {

                $creds = array();
                $creds['user_login'] = $user->data->user_login;
                $creds['user_password'] = $password;
               /* if($userrem){
                    $creds['remember'] = true;
                }
                else{
                    $creds['remember'] = false;
                }*/
                $user_ = wp_signon( $creds, false );
                if ( is_wp_error($user_) ){
					
                    $data['msg'] = $user_->get_error_message();
                    $data['userid'] = 0;
					$cls = "rerror";
                }
                else{
					$lastloginnew = date('YmdHis');
					update_user_meta($userid, '_lastlogin_prev', $lastlogin);
					update_user_meta($userid, '_lastlogin', $lastloginnew);
					
					
                    $data['msg'] =  "Successfully loged in";
                    $data['userid'] = $userid;
					$cls = "rsucess";
					$udash = get_page_link(197);
                    wp_redirect($udash);
                    exit;
                }
              }
              else
              {
				  
                  $data['msg'] = 'Password do not match';
                  $data['userid'] = 0;
				  $cls = "rerror";
              }
			}else{
				
			      $data['msg'] = 'Your account is not active. Please contact admin';
                  $data['userid'] = 0;
				  $cls = "rerror";	
				
			}


      }
      else
      {
          $data['msg'] = 'Username or Email do not exist.';
          $data['userid'] = 0;
		  $cls = "rerror";
      }
	}

?>

<div class="content-wrap">
	<div class="container">
		<div class="row">
			<article class="col-md-9 left-panel">
			 <section class="about-Massage clearfix">
			 <div class="bread_cnt"> 
			  <?php 
			  
			  if(function_exists('bcn_display'))
				{
					bcn_display();
				}
				
				?>
			 </div>
		  <h1>Log ind</h1>
		  <?php if(!empty($data)){ ?>
		  <div class="form-msg <?php echo $cls; ?>"> 
		  <?php echo $data['msg'];  ?>
		  </div>
		  <?php }//end if ?>
         <div class="contact-wrap clearfix">
          <div class="registeration-form clearfix">
			  <form method="post" action="" class="form-inline">
				<div class="form-group">
				  <label>E-mail</label>
				  <input type="text" name="uemail" class="form-control" placeholder="Din e-mail">
				</div>
				<div class="form-group">
				  <label>Adgangskode</label>
				  <input type="password" name="upassword" class="form-control" placeholder="Adgangskode">
				</div>
				<p><a href="<?php echo get_page_link(238); ?>">Glemt Adgangskode?</a></p>
				<button type="submit" name="loginsub" class="btn btn-default profile-btn"><i class="fa fa-lock" aria-hidden="true"></i> Login</button>
				<button  class="btn btn-default profile-btn"><a href="<?php echo get_page_link(43); ?>"><i class="fa fa-user" aria-hidden="true"></i> Register</a></button>
			</form>
          </div>
         </div><!-- Contact Wrapper -->
		    </section>
    </article><!-- Left Panel -->
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
     </div><!-- Row -->
    </div><!-- Container -->
</div><!-- Content Wrapper -->
<?php ob_flush(); ?>
<?php get_footer(); ?>