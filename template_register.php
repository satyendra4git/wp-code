<?php 
/** Template Name: Register
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
label.error{ color: #ff0000; }
.registeration-form .form-inline .form-group .checkbox01 label label.error{ color: #ff0000; }
</style>
<style type="text/css">
#dropwrapper {

			max-width: 100%;

			border: 3px #CCC dashed;

			border-radius: 15px;

			cursor: pointer;



			-webkit-touch-callout: none;

			-webkit-user-select: none;

			-khtml-user-select: none;

			-moz-user-select: none;

			-ms-user-select: none;

			user-select: none;

		}



		#dropwrapper:hover {

			border-color: orange;

		}



		#dropzone {

			padding: 25px;

			text-align: center;

			font-weight: bold;

			color: #AAA;

		}



		.dropDefaultText {

			pointer-events: none;

		}



		.dropDefaultText h1 {

			font-size: 25px;

			pointer-events: none;

			color: orange;

		}



		.dropDefaultText p {

			pointer-events: none;

		}



		.dz-preview {

			font-size: 14px;

			float: left;

			max-width: 200px;

			margin: 5px;

			border: 1px #CCC solid;

			background: #EEE;

		}



		.dz-progress {

			display: none;

			width: 100%;

			background: #CCC;

			height: 15px;

			width: 100%

		}



		.dz-upload {

			background-color: red;

			height: 15px;

			width: 100%;

		}



		.dz-details {

		}



		.dz-success-mark {

			display: none;

			width: 50%;

			float: left;

		}



		.dz-error-mark {

			display: none;

			width: 50%;

			float: left;

		}



		.dz-size {

			display: none;

		}



		.dz-filename {

			display: none;

		}

</style>
<div class="content-wrap">
	<div class="container">
  <div class="register-wrap clearfix">
		<div class="row">
			<article class="col-md-7">
			 <section class="about-Massage ">
			 <div class="bread_cnt"> 
			  <?php 
			  
			  if(function_exists('bcn_display'))
				{
					bcn_display();
				}
				
				?>
			 </div>
		    	<h1><?php the_field('page_title'); ?></h1>
		    	<?php the_field('page_content'); ?>
		    </section><!-- About Massage24-7 -->
			
		<?php 
		
		  /*$msg = "";
		  $file = array();
		
		  if(isset($_POST['usubmit'])){
			
			//echo "hello working";
			extract($_POST);
			
			//echo "<pre>";print_r($_POST);
			//echo "<pre>";print_r($_FILES);
			
			//$lastlogin = time();
			$lastloginnew = date('YmdHis');
			$lastloginprev = "";
			$emailarr = explode('@', $uemail);
		    $usernm = $emailarr[0];  
			
			//echo count($uservices);
			//echo count($uworkspaces);
		    $uservices = implode(',', $uservices);
			$uworkspaces = implode(',', $uworkspaces);
			
			if(!empty($files)){
				
			$uimages = implode(',', $files);
			
			}else{
				
			$uimages = "";	
			
			}
			
			
			
			
			
			if(!email_exists($uemail)) { 
			$userdata = array(
								'first_name'  => $uname,
								'user_email'  => $uemail,
								'user_login'  => $usernm,
								'user_pass'   => $upassword,
								'display_name' => $uname,
								
								 
							);

			$user_id = wp_insert_user( $userdata ) ;
			
			if ( ! is_wp_error( $user_id ) ) {
				
				$userflag = 1;
				$accountstatus = 1;
				add_user_meta( $user_id, '_ucity', $ucity);
				add_user_meta( $user_id, '_uaddr', $uaddr);
				add_user_meta( $user_id, '_uworkspaces', $uworkspaces);
				add_user_meta( $user_id, '_uservices', $uservices);
				add_user_meta( $user_id, '_usex', $usex);
				add_user_meta( $user_id, '_uvip', $vip);
				add_user_meta( $user_id, '_uprofiltext', htmlspecialchars($uprofiltext));
				add_user_meta( $user_id, '_uprofilepic', $files[0]);
				add_user_meta( $user_id, '_uimages', $uimages);
				add_user_meta( $user_id, '_lastlogin', $lastlogin);
				add_user_meta( $user_id, '_lastlogin_prev', $lastloginprev);
				add_user_meta( $user_id, '_userflag', $userflag);
				add_user_meta( $user_id, '_accountstatus', $accountstatus);
				
				/** Start Send Mail to user  **/
				
			/*$adminemail =  get_option('admin_email');	
				
		   $to = $uemail . ',' . $adminemail;

			$subject = 'Registration Successful';

			$headers = "From: " . strip_tags($adminemail) . "\r\n";
			$headers .= "Reply-To: ". strip_tags($contactemail) . "\r\n";
			//$headers .= "CC: susan@example.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";  
			$headers .= 'X-Mailer: PHP/'.phpversion();
			//echo $headers;
			
			$message = '<html><body>';
			$message .= "<h4>Registration Details - </h4><br/>";
			$message .= "<strong>Profile Name:</strong> " . strip_tags($uname) . "<br/><br/>";
			$message .= "<strong>E-mail:</strong> " . strip_tags($uemail) . "<br/><br/>";
			$message .= "<strong>Username:</strong> " . strip_tags($usernm) . "<br/><br/>";
			$message .= "<strong>password:</strong> " . strip_tags($upassword) . "<br/><br/>";
			$message .= "<strong>City or area:</strong> " . strip_tags($ucity) . "<br/><br/>";
			$message .= "<strong>Contact information:</strong> " . strip_tags($uaddr) . "<br/><br/>";
			$message .= "<strong>Workspaces:</strong> " . strip_tags($uworkspaces) . "<br/><br/>";
			$message .= "<strong>Services:</strong> " . strip_tags($uservices) . "<br/><br/>";
			$message .= "<strong>Sex:</strong> " . strip_tags($usex) . "<br/><br/>";
			$message .= "<strong>Register as a VIP?:</strong> " . strip_tags($vip) . "<br/><br/>";
			
			$message .= "<strong>Profile-text:</strong> " . htmlentities($uprofiltext) . "<br/><br/>"; 
			//$message .= "<strong>Profile-images: " . htmlentities($uimages) . "<br/>"; 
			
			$message .= "</body></html>";
			
			//echo $message;
			

		   $issent = wp_mail($to, $subject, $message, $headers);

			/* if($issent){
			  $msg = "<b>Thank you for using our mail form</b>.";
			}else{
			   $msg = "<b>Mail sending failed</b>"; 
			} */
				
				
				/** End Send Mail to user  **/
				
				
				
				
			    /*$msg = "You are registered sucessfully. Please check your email.";
				$cls = "rsucess";
				
			}else{
				
			  $msg = "Some error occured. Please try again.";	
			  $cls = "rerror";
			}
			
		 }else{
				
			 $msg = "Email already exists.";
             $cls = "rerror";			 
			
			}				
			
		} */ ?>	
		
        <div class="registeration-form">
		
          <form method="post" action="" id="regform" class="form-inline" enctype='multipart/form-data'>
		  <div id="reg_fields">
            <div class="form-group">
            <label>Profilnavn (Vil være synlig)</label>
              <input type="text" name="uname" id="uname" class="form-control" placeholder="Angiv et navn til din profil">
            </div>
            <div class="form-group">
              <label>E-mail</label>
              <input type="email" name="uemail" id="uemail" class="form-control" placeholder="Din e-mail">
            </div>
            <div class="form-group">
              <label>Adgangskode</label>
              <input type="password" name="upassword" id="upassword" class="form-control" placeholder="Adgangskode, min 6 tegn">
            </div>
			
			 <div class="form-group">
              <label>Bruger type</label>
              <select class="form-control utype" id="utype" name="utype">
			   <option value="">Vælg bruger</option>
                <option value="subscriber">Service udbyder</option>
                <option value="privat">Privat</option>
              </select>
            </div>
			
			<div class="forprovider" id="forprovider" style="display:none">
			
            <div class="form-group">
              <label>By eller område</label>
              <input type="text" name="ucity" id="ucity" class="form-control" placeholder="Vil stå ud for din profil">
            </div>
			
			<div class="form-group">
              <label>telefon</label>
              <input type="text" name="utelefon" id="utelefon" class="form-control" placeholder="telefon">
            </div>
			
            <div class="form-group">
              <label>Kontaktoplysninger</label>
              <input type="text" name="uaddr" id="uaddr" class="form-control" placeholder="Det er vigtigt at du skriver tlf nr. eller e-mail, så dine kunder kan kontakte dig.">
            </div>
            <div class="form-group">
              <label>Arbejdsområder (Du kan vælge flere)</label>
              <select name="uworkspaces[]" id="uworkspaces" class="form-control" multiple>
                
                <option value="København">København</option>
                <option value="Østjylland">Østjylland</option>
                <option value="Nordjylland">Nordjylland</option>
                <option value="Midtjylland">Midtjylland</option>
                <option value="Sydjylland">Sydjylland</option>
                <option value="Sjælland">Sjælland</option>
                <option value="Aarhus">Aarhus</option>
                <option value="Vestjylland">Vestjylland</option>
                <option value="Sønderjylland">Sønderjylland</option>
                <option value="Fyn">Fyn</option>
                <option value="Odense">Odense</option>
                <option value="Aalborg">Aalborg</option>
              </select>
            </div>
            <div class="form-group">
              <label>Ydelser (Du kan vælge flere)</label>
              <select name="uservices[]" id="uservices" class="form-control" multiple>
                
                <option value="escort">Escort (Hvis du kører ud)</option>
                <option value="massage">Massage (klinik eller privat)</option>
                <option value="dominans">Dominans</option>
              </select>
            </div>
            <div class="form-group">
              <label>Køn</label>
              <select class="form-control" id="usex" name="usex">
                <option value="kvinde" selected="selected">Kvinde</option>
                <option value="mand">Mand</option>
              </select>
            </div>
			<div class="form-group">
              <label>Registrer som VIP?</label>
              <div class="checkbox01">
                <label><input type="radio" class="vip"  name="vip" value="yes"> Yes</label>
                <label><input type="radio" class="vip" name="vip" value="no"> No</label>
              </div>
            </div>
			<div id="paycnt" class="form-group" style="display: none;">
              <label>Pay here for VIP Account</label>
              <div class="checkbox01">
               
					$10 USD
                  
                
              </div>
            </div>
			<div class="form-group">
			  <label> Profil-tekst</label>
			  <textarea name="uprofiltext" id="uprofiltext" class="form-control"></textarea>
			</div>
			
		 </div>
		 
		  <div class="form-group">
			<?php /* <div class="fallback">
            <input name="file[]" type="file" multiple="multiple"/>
            </div> */ ?>
			<label>Profilbilleder </label>
				<ul class="profil-img-con">
				<li>Billeder skal være i JPG/JPEG format.</li>
				<li class="minpic">Vælg min. 2 billeder til din profil</li>
				</ul>
		    <div id="dropwrapper">

				<div id="dropzone">

					<div class="dropDefaultText">

						<h1>Tryk <strong>her</strong>, eller træk billeder herover.</h1>

						<p id="picdesc">

							For at få en flot profil er det vigtigt med nogle gode billeder. Vi påkræver at

							du uploader minimum 2 billeder (MEGET GERNE FLERE).
                        </p> 
							<br><br>
                        <p>
							Billederne er med til at give din profil flere besøgende, og så kigger vi også

							billederne igennem

						</p>

					</div>

				</div>

	       </div>
           </div>
		   
		    
		   
		   
            <div class="form-group handicap" style="display:none">
              <div class="checkbox01">
                <label><input type="checkbox" id="uterms" name="uterms"> Jeg tager imod handicappede</label>
              </div>
            </div>
			
            <input type="button" class="btn btn-default profile-btn regajaxbtn" value="Sidste trin">
			
			</div>
          </form>
		 <div id="msg_cnt"> </div>
		 
		  
	







<?php 
$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; // Live Paypal API URL
$paypal_id='satyendra-facilitator@infoicon.co.in'; // Live Business email ID 
?>
<form action="<?php echo $paypal_url; ?>" method="post" class="form-vertical"  id="formdata">
<div class="form-group">

<input type="hidden"  name="amount" value="10">
<input type='hidden' name='item_name' value='VIP User'>
<input type="hidden" name="business" value="<?php echo $paypal_id ?>">
<input type='hidden' name='rm' value='2'>
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="credits" value="510"> 
<input type="hidden" id="puserid" name="custom" value="25">
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="handling" value="0">
<input type='hidden' name='cancel_return' value='<?php echo get_page_link(263); ?>'>
<input type='hidden' name='return' value='<?php echo get_page_link(261); ?>'>

</form>

    










	

<?php /* <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" id="formdata1">
	<input type='hidden' name='business' value='satyendra-facilitator@infoicon.co.in'>
	<input type='hidden' name='item_name' value='VIP User'>
	<input type='hidden' name='item_number' value=''>
	<input type='hidden' name='amount' value='2'>
	<input type='hidden' name='no_shipping' value='1'>
	<input type='hidden' name='currency_code' value='USD'>
	<input type='hidden' name='notify_url' value=''>
	<input type='hidden' name='cancel_return' value='<?php echo get_page_link(263); ?>'>
	<input type='hidden' name='return' value='<?php echo get_page_link(261); ?>'>
	<!-- COPY and PASTE Your Button Code -->
	<input type="hidden" name="cmd" value="_s-xclick">
	
</form> 
		   */ ?>
		  
		  
		  
        </div><!-- Registeration Form -->
    </article><!-- Left Panel -->
    <aside class="col-md-5 register-right">
      <div class="register-text-col">
        <h3><i class="fa fa-check-square-o" aria-hidden="true"></i> <?php the_field('right_section_1_title'); ?></h3>
        <?php the_field('right_section_1_content'); ?>
      </div>
      <div class="register-text-col">
        <h3><i class="fa fa-hand-o-right" aria-hidden="true"></i> <?php the_field('right_section_2_title'); ?></h3>
		
       <?php the_field('right_section_2_features'); ?> 
	   
       <?php the_field('right_section_2_content'); ?> 
      </div>
    </aside><!-- Right Panel -->

    </div><!-- Row -->
    </div><!-- Register Wrapper -->
    </div><!-- Container -->
</div><!-- Content Wrapper -->

<?php get_footer(); ?>