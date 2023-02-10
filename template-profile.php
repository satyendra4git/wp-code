<?php ob_start();
/** Template Name: Profile
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

</style>
<?php

if(!defined('ABSPATH')){ die("Cannot access pages directly."); }

$current_user1 = wp_get_current_user(); 

//echo "<pre>"; print_r($current_user);
$uid = $current_user1->ID;
$role = $current_user1->roles[0];

if($uid>0){

/** Start saving user data  **/

if(isset($_POST['saveuser'])){
	
	extract($_POST);
	
	 //echo "<pre>"; print_r($_POST);
	
	 $edituworkspacesstr = implode(",", $edituworkspaces);
	 $edituservicesstr = implode(",", $edituservices);
	 
    $user_id = wp_update_user( array( 'ID' => $uid, 'display_name' => $editprofilename ) );

	if ( is_wp_error( $user_id ) ) {
		// There was an error, probably that user doesn't exist.
	    $msg = "Error in updating. Please try again";
		$cls = "rerror";
		
	} else {
		// Success!
	    $msg = "Successfully Updated.";
		$cls = "rsucess";
		
	}	
	
  if($role!="privat"){ 
  
   update_user_meta($uid, '_ucity', $editucity); 
   update_user_meta($uid, '_uaddr', $editucontact);   
   update_user_meta($uid, '_uworkspaces', $edituworkspacesstr); 	
   update_user_meta($uid, '_uservices', $edituservicesstr); 	
   update_user_meta($uid, '_utelephone', $editutelephon); 
   
  }
	
	
}

if(isset($_POST['saveuserprofil'])){
	
	extract($_POST);
	//echo "<pre>"; print_r($_POST);
$edituprofiltexts = htmlspecialchars($edituprofiltext);	
update_user_meta($uid, '_uprofiltext', $edituprofiltexts); 
	
$msg = "Successfully Updated.";
$cls = "rsucess";	
	
	
}	

if(isset($_POST['saveusergalleria'])){
	
     extract($_POST);
	//echo "<pre>"; print_r($_POST);
	//echo "<pre>"; print_r($_FILES);
	$farr = array();
    $ds  = "/";  //1
 
	$storeFolder = 'useruploads';   //2
	//echo $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
 
if (!empty($_FILES)) {
     
     $tempFile = $_FILES['filesa']['tmp_name'];          //3             
      
     $targetPath = dirname(dirname( __FILE__ )) . $ds. $storeFolder . $ds;  //4
     //echo "<br>"; 
     $targetFile =  $targetPath. $_FILES['filesa']['name'];  //5
 
     $fmoved = move_uploaded_file($tempFile, $targetFile); //6
   
   if($fmoved){ 
   
	$uimgs = get_user_meta($uid, '_uimages', true); 
	
	if($uimgs!=""){  
		
    $uimgsarr = explode(",", $uimgs); 	
	//echo "<pre>";print_r($uimgsarr);
	array_push($uimgsarr,$_FILES['filesa']['name']);
	//echo "<pre>";print_r($uimgsarr);
	 $uimgsnew = implode(",",$uimgsarr);
	 
    }else{
		
      $uimgsnew = $_FILES['filesa']['name'];	
	  
    }
	update_user_meta($uid, '_uimages', $uimgsnew ); 	
	
	
	$msg = "Image Successfully Uploaded.";
    $cls = "rsucess";	
    //echo "moved - $fmoved";	
	//$farr['filenm'] = $_FILES['file']['name'];
	//header('Content-Type: application/json');
	//print_r();
	//echo json_encode($farr);
	
	   
   }else{
	 
	  $msg = "Error in image uploading.";
      $cls = "rerror";	   
	   
   }
     
}
		
	
	
	
}	

if(isset($_POST['saveusergallerib'])){
	
	 extract($_POST); 
	//echo "<pre>"; print_r($_POST);
	
	
}	

if(isset($_POST['saveuseradgangskode'])){
	
     extract($_POST);
	//echo "<pre>"; print_r($_POST);	
	
	if( $current_user && wp_check_password( $oldupassword, $current_user->data->user_pass, $current_user->ID) ){
		
	   
	   if($newupassword == $connewupassword){
		   
		wp_set_password( $newupassword, $current_user->ID );
		        $creds = array();
                $creds['user_login'] = $current_user->data->user_login;
                $creds['user_password'] = $newupassword;
               /* if($userrem){
                    $creds['remember'] = true;
                }
                else{
                    $creds['remember'] = false;
                }*/
                $user_ = wp_signon( $creds, false );
                if ( is_wp_error($user_) ){
					
				$msg = $user_->get_error_message(); 	
				
				}else{
					
						$msg = "Password changed successfully."; 
						$cls = "rsucess";			
				}
	  }else{
		  
		$msg = "Password donot match";  
		$cls = "rerror";
		  
	  }	 
	
	}else{
	 
     $msg = "Wrong old password"; 
	 $cls = "rerror";
		
		
	}	
	
	
}	

if(isset($_POST['saveuserstatus'])){
	
     extract($_POST);
	 //echo "<pre>"; print_r($_POST);	
	 if(isset($accountstatus)){
		update_user_meta($uid, '_accountstatus', $accountstatus);  
	 }else{
		$active = 1; 
		update_user_meta($uid, '_accountstatus', $active);   
	 }
	 
	 update_user_meta($uid, '_userflag', $edituserflag); 
	 
	 $msg = "Status Updated Successfully.";
	 $cls = "rsucess";		
	 
	
	
	
	
	
}	

/** End saving user data  **/

$current_user = get_user_by('id', $uid);

//echo "<pre>"; print_r($current_user);
$uid = $current_user->ID;
$profilename = $current_user->display_name;
$username = $current_user->user_login;
$uemail = $current_user->user_email;

$ucity = get_user_meta($uid, '_ucity', true);
$uaddr = get_user_meta($uid, '_uaddr', true);
$uworkspaces = get_user_meta($uid, '_uworkspaces', true);
$uservices = get_user_meta($uid, '_uservices', true);
$usex = get_user_meta($uid, '_usex', true);
$uprofiltext = get_user_meta($uid, '_uprofiltext', true);

$uimages = get_user_meta($uid, '_uimages', true);

if($uimages!=""){
$uimagesarr = explode(",", $uimages);
}else{
	
$uimagesarr = array();
	
}

$uworkspacesarr = explode(",", $uworkspaces);
$uservicesarr = explode(",", $uservices);


$uprofilepic = get_user_meta( $uid, "_uprofilepic", true);

$utelephone = get_user_meta( $uid, "_utelephone", true);

$remarr = array();
$remarr[] = $uprofilepic;

//echo "<pre>"; print_r($uimagesarr); 
//echo "<pre>"; print_r($remarr); 

if($uprofilepic != ""){

    $uimagesarr = array_diff($uimagesarr, $remarr);	
	
}else{
	
     $uprofilepic = 	$uimagesarr[0];
	
}

//echo "<pre>"; print_r($uimagesarr); 
//echo "<pre>";print_r($uimagesarr);
 $acntst = get_user_meta($uid, '_accountstatus', true); 
 $uflag = get_user_meta($uid, '_userflag', true); 




?>
<div class="content-wrap">
	<div class="container">
		<div class="row">
			<article class="col-md-12 left-panel">
			 <section class="about-Massage clearfix">
			 <div class="bread_cnt"> 
			  <?php 
			  
			  if(function_exists('bcn_display'))
				{
					bcn_display();
				}
				
				?>
			 </div>
			 
			  
			 <div class="dashborad-wrap">
				<h1 class="page-title">Indstillinger</h1>
					<?php if(is_user_logged_in()){ ?>
				 
					 <h5 style="float:right"><a href="<?php echo wp_logout_url(get_page_link(168)); ?>">Logout</a></h5>
				   
				   <?php } ?>
				   
			    <p>Velkommen til&nbsp;massage&nbsp;24-7 - du kan nu rette i dine indstillinger.</p>
			    				<hr>
                 <?php if(!empty($msg)){ ?>
					<div class="form-msg <?php echo $cls; ?>"> 
					 <h5><?php echo $msg; ?> </h5>
					</div>
				<?php }//end if  ?>
				
				 
			 
				<?php
				//echo $hashval;
				//if(trim($hashval)=="adgangskode"){ echo "found"; } else { echo "Nhi mila";}
				
				?>
				<ul class="nav nav-pills nav-pills-custom mycustomtab">
				
				  <li id="kontakt1" class=""><a href="#kontakt" data-toggle="tab"><i class="fa fa-user"></i> Grundlæggende information</a></li>
				  
				  <?php if($role!="privat"){ ?>
				  <li id="profil1" class=""><a href="#profil" data-toggle="tab"><i class="fa fa-file-o"></i> Profil beskrivelse</a></li>
				  <?php }//end if ?>
				  
				  <li id="galleri1" class=""><a href="#galleri" data-toggle="tab"><i class="fa fa-picture-o"></i> Billedegalleri</a></li>
				  
				  <li id="adgangskode1" class=""><a href="#adgangskode" data-toggle="tab"><i class="fa fa-lock"></i> Adgangskode</a></li>
				  
				   <?php if($role!="privat"){ ?>
				   <li id="status1" class=""><a href="#status" data-toggle="tab"><i class="fa fa-eye"></i> Profil status</a></li>
				   <?php }//end if ?>
				</ul>
				<br>
				<div class="tab-content">
				
				  	<div class="tab-pane" id="kontakt">
				  		<div class="row">
						<form method="post" action="" class="editfrmkontakt" id="editfrmkontakt">
							<div class="form-group input-group-sm col-sm-6">
								<strong>E-mail</strong>
								<input type="text" name="edituemail" placeholder="Din e-mail" disabled="" value="<?php echo $uemail; ?>" required="" class="form-control">
							</div>
							<div class="form-group input-group-sm col-sm-6">
								<strong>Brugernavn</strong>
								<input type="text" name="editprofilename" placeholder="Brugernavn" value="<?php echo $profilename; ?>"  class="form-control">
							</div>
							 <?php if($role!="privat"){ ?>
							<div class="form-group input-group-sm col-sm-6 only_profile">
								<strong>By navn (Den by du arbejder i)</strong>
								<input type="text" name="editucity" placeholder="Den by du arbejder i" value="<?php echo $ucity; ?>" required="" class="form-control">
							</div>
							<div class="form-group input-group-sm col-sm-6 only_profile">
								<strong>Kontaktoplysninger</strong>
								<input type="text" name="editucontact" placeholder="Tlf" value="<?php echo $uaddr;  ?>" required="" class="form-control">
							</div>
							<div class="form-group input-group-sm col-sm-6 only_profile">
								<strong>Telephon</strong>
								<input type="text" name="editutelephon" placeholder="Tlf" value="<?php echo $utelephone;  ?>" required="" class="form-control">
							</div>
							<div class="form-group input-group-sm col-sm-6 only_profile">
							 <strong>Arbejdsområder</strong>
							    <select name="edituworkspaces[]" id="uworkspaces" class="form-control" multiple>
									<option value="København" <?php if(in_array("København", $uworkspacesarr)){ echo "selected"; } ?>>København</option>
									<option value="Østjylland" <?php if(in_array("Østjylland", $uworkspacesarr)){ echo "selected"; } ?>>Østjylland</option>
									<option value="Nordjylland" <?php if(in_array("Nordjylland", $uworkspacesarr)){ echo "selected"; } ?>>Nordjylland</option>
									<option value="Midtjylland" <?php if(in_array("Midtjylland", $uworkspacesarr)){ echo "selected"; } ?>>Midtjylland</option>
									<option value="Sydjylland" <?php if(in_array("Sydjylland", $uworkspacesarr)){ echo "selected"; } ?>>Sydjylland</option>
									<option value="Sjælland" <?php if(in_array("Sjælland", $uworkspacesarr)){ echo "selected"; } ?>>Sjælland</option>
									<option value="Aarhus" <?php if(in_array("Aarhus", $uworkspacesarr)){ echo "selected"; } ?>>Aarhus</option>
									<option value="Vestjylland" <?php if(in_array("Vestjylland", $uworkspacesarr)){ echo "selected"; } ?>>Vestjylland</option>
									<option value="Sønderjylland" <?php if(in_array("Sønderjylland", $uworkspacesarr)){ echo "selected"; } ?>>Sønderjylland</option>
									<option value="Fyn" <?php if(in_array("Fyn", $uworkspacesarr)){ echo "selected"; } ?>>Fyn</option>
									<option value="Odense" <?php if(in_array("Odense", $uworkspacesarr)){ echo "selected"; } ?>>Odense</option>
									<option value="Aalborg" <?php if(in_array("Aalborg", $uworkspacesarr)){ echo "selected"; } ?>>Aalborg</option>
								</select>

							</div>
							<div class="form-group input-group-sm col-sm-6 only_profile">
							<strong>Ydelser</strong>
								<select name="edituservices[]" id="uservices" class="form-control" multiple>
								<option value="escort" <?php if(in_array("escort", $uservicesarr)){ echo "selected"; } ?>>Escort</option>
								<option value="massage" <?php if(in_array("massage", $uservicesarr)){ echo "selected"; } ?>>Massage</option>
								<option value="dominans" <?php if(in_array("dominans", $uservicesarr)){ echo "selected"; } ?>>Dominans</option>
							  </select>
							</div>
							 <?php }//end if ?>
							
						<button type="submit" name="saveuser" class="btn btn-purple-light pull-right"><i class="fa fa-cog"></i> Gem indstillinger</button>
						
						</form>
						</div>
					</div>
					
				<?php if($role!="privat"){ ?>
				  <div class="tab-pane" id="profil">
				  	<div class="row">
					<form method="post" action="" class="editfrmprofil" id="editfrmprofil">
					  <div class="col-xs-12">
						<strong>Profil beskrivelse</strong>
						  <textarea name="edituprofiltext" id="edituprofiltext" class="form-control" style="height:250px">
						
						    <?php echo htmlspecialchars_decode($uprofiltext); ?>
							
                        </textarea>	
					</div>
					<button type="submit" name="saveuserprofil" class="btn btn-purple-light pull-right"><i class="fa fa-cog"></i> Gem indstillinger</button>
						
				  </form>
					</div>
				  </div>
				<?php }//end if ?>
				
				<div class="tab-pane" id="galleri">
		         <form method="post" action="" class="editfrmgalleria" id="editfrmgalleria" enctype="multipart/form-data">
					    	<div class="upload-pictures">
					    		<h3>Upload billeder</h3>
					    		<p>Upload billeder til dit galleri. Billeder skal være i JPG/JPEG format.</p><br>
					    		<input type="file" name="filesa"> 
					    		<br>
					    		<button type="submit" name="saveusergalleria" class="btn btn-success"><i class="fa fa-upload"></i> Upload billeder</button>
					    	</div><!-- Upload pictures -->
						</form>
						<form method="post" action="" class="editfrmgallerib" id="editfrmgallerib">
					    	<div class="your-pics-wrap">
					    		<h3>Dine billeder</h3>
					    		<p>
					    			For at få en flot profil er det vigtigt med nogle gode billeder. Vi påkræver at du uploader minimum 2 billeder (MEGET GERNE FLERE). 
					    			<br>
									Billederne er med til at give din profil flere besøgende, og så kigger vi også billederne igennem 
									<br>
									inden vi vurderer om profiloprettelsen er seriøs.
					    		</p>	
					    		<div class="row galeriwrap">
								<div class="col-md-4">
									
									   <?php if($uprofilepic != ""){ ?>
									   <div class="profile_cnt">
										<a href="<?php bloginfo('template_url'); ?>/useruploads/<?php echo $uprofilepic; ?>" class="swipebox">
										
										  <img src="<?php bloginfo('template_url'); ?>/useruploads/<?php echo $uprofilepic; ?>" title="" alt=""/>
											
										</a>
										</div>
										<br>
										
										<a href="javascript:;" class="btn delbtn btn-xs btn-danger confirm" data="<?php echo $uprofilepic; ?>" data-uid="<?php echo $uid; ?>"><i class="fa fa-trash-o"></i> Fjern</a>
										<a href="javascript:;" class="btn btn-xs btn-success" data="<?php echo $uprofilepic; ?>" data-uid="<?php echo $uid; ?>"><i class="fa fa-check"></i> Profilbillede</a>
                                        <br><br>
										
									  <?php  }else{ ?>
									  <?php if(count($uimagesarr)>0){ ?>
									  <div class="profile_cnt">
									  <a href="<?php bloginfo('template_url'); ?>/useruploads/<?php echo $uimagesarr[0]; ?>" class="swipebox">
									  
									   <img src="<?php bloginfo('template_url'); ?>/useruploads/<?php echo $uimagesarr[0]; ?>" title="" alt=""/>
											
										</a>
									 </div>
										<br>
										
										<a href="javascript:;" class="btn delbtn btn-xs btn-danger confirm" data="<?php echo $uprofilepic; ?>" data-uid="<?php echo $uid; ?>"><i class="fa fa-trash-o"></i> Fjern</a>
										<a href="javascript:;" class="btn btn-xs btn-success" data="<?php echo $uprofilepic; ?>" data-uid="<?php echo $uid; ?>"><i class="fa fa-check"></i> Profilbillede</a>

									  <br><br>
									  <?php } ?>
									  <?php } ?>
									</div>
									
								<?php 
								
								 /* echo "COUNT".count($uimagesarr); 
								echo "<pre>"; print_r($uimagesarr);   */
								
								if(count($uimagesarr)>0){ 
								
								?>	
								<?php foreach($uimagesarr as $galimg){ ?>
								<div class="col-md-4">
								       <div class="generic_cnt">
										<a href="<?php bloginfo('template_url'); ?>/useruploads/<?php echo $galimg; ?>" class="swipebox">
									  
									   <img src="<?php bloginfo('template_url'); ?>/useruploads/<?php echo $galimg; ?>" title="" alt=""/>
											
										</a>
										</div>
										<br>
										
										<a href="javascript:;" class="btn delbtn btn-xs btn-danger confirm"data="<?php echo $galimg; ?>" data-uid="<?php echo $uid; ?>"><i class="fa fa-trash-o"></i> Fjern</a>
										<a href="javascript:;" class="btn profilebtn btn-xs btn-default" data="<?php echo $galimg; ?>" data-uid="<?php echo $uid; ?>"><i class="fa fa-check"></i> Profilbillede</a>
										<input type="hidden" name="Profilbilledeimg" value="<?php echo $galimg; ?>">
									  <br><br>
								</div>
								<?php }//end while ?>
								<?php }//end if ?>
																				
								</div>
							  </div>
							  <?php /*  <button type="submit" name="saveusergallerib" class="btn btn-purple-light pull-right"><i class="fa fa-cog"></i> Gem indstillinger</button> */ ?>
							</form>
				    </div>
				  <div class="tab-pane" id="adgangskode">
				    <form method="post" action="" class="editfrmadgangskode" id="editfrmadgangskode">
				  	<div class="form-group input-group-sm">
						<strong>Nuværende adgangskode</strong>
						<input type="password" name="oldupassword" autocomplete="off" placeholder="Angiv din nuværende"  class="form-control">
					</div>
				  	<div class="form-group input-group-sm">
						<strong>Ny adgangskode</strong>
						<input type="password" name="newupassword" autocomplete="off" placeholder="Adgangskode, min 6 tegn"  class="form-control">
					</div>
					<div class="form-group input-group-sm">
						<strong>Gentag ny adgangskode</strong>
						<input type="password" name="connewupassword" autocomplete="off" placeholder="Gentag dine nye adgangskode"  class="form-control">
					</div>
					  <button type="submit" name="saveuseradgangskode" class="btn btn-purple-light pull-right"><i class="fa fa-cog"></i> Gem indstillinger</button>
					</form>
					
				  </div>
				  
				 <?php if($role!="privat"){ ?>
				  <div class="tab-pane" id="status">
				   <form method="post" action="" class="editfrmstatus" id="editfrmstatus">
					<div class="form-group input-group-sm">
						<strong>Vælg status for din profil</strong>
						<select name="edituserflag" class="form-control selectpicker">
							<option value="1" <?php if($uflag == "1"){ ?> selected="" <?php } ?>>Aktiv</option>
							<option value="0" <?php if($uflag == "0"){ ?> selected="" <?php } ?>>Inaktiv (Skjult)</option>
						</select>
					</div>
					<div class="form-group input-group-sm">
						<strong>Deaktiver profil</strong><br>
						<p>Bemærk, at du altid kan genaktivere din profil igen med den samme e-mail adresse.</p>
						<div class="checkbox">
		                	<input id="delete" type="checkbox" name="accountstatus" class="deletebtn" value="0" style="opacity: 1;" <?php if($acntst == 0){ ?> checked="checked" <?php } ?>>
							
		                	
							<a href="javascript:;" id="deleteBtn" class="disabled btn-default">Tryk her, hvis du ønsker at deaktiver din profil</a>
						</div>
					</div>
					<button type="submit" name="saveuserstatus" class="btn btn-purple-light pull-right"><i class="fa fa-cog"></i> Gem indstillinger</button>
					</form>
				  </div>
				 <?php }//end if ?>
				</div>
		     
		      
		      
			</div>
			 
			 
			 
			 <?php /**if(is_user_logged_in()){ ?>
			 
               <h5 style="float:right"><a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a></h5>
			   
             <?php } ?>
			 
               <h3 style="text-align:center;">Welcome <?php echo $profilename; ?></h3>
			   
			   <div class="row user_cnt">
			     <h4>Profil</h4>
				 <div class="col-md-4">
					 <img src="<?php bloginfo('template_url'); ?>/useruploads/<?php echo $uimagesarr[0]; ?>" title="" alt=""/>
					 <h5><?php echo $profilename; ?></h5>
				 </div>
				 <div class="col-md-8">
				  <div class="table-responsive">
                   <table  class="table table-bordered table-hover">
                    <thead> 
					</thead>
					 <tbody>
					 <tr>
					  <td><strong>Name</strong></td>
					  <td><?php echo $profilename; ?></td>
					 </tr>
					 
					 <tr>
					  <td><strong>Email</strong></td>
					  <td><?php echo $uemail; ?></td>
					 </tr>
					 
                    <tr>
					  <td><strong>Sex</strong></td>
					  <td><?php echo $usex; ?></td>
					 </tr> 
					 
					 <tr>
					  <td><strong>City</strong></td>
					  <td><?php echo $ucity; ?></td>
					 </tr>
					 
					 <tr>
					  <td><strong>Address</strong></td>
					  <td><?php echo $uaddr; ?></td>
					 </tr>
					 
					 <tr>
					  <td><strong>Services</strong></td>
					  <td><?php echo $uservices; ?></td>
					 </tr>
					 
					 <tr>
					  <td><strong>Area</strong></td>
					  <td><?php echo $uworkspaces; ?></td>
					 </tr>
					 
					 <tr>
					  <td><strong>Description</strong></td>
					  <td><?php echo $uprofiltext; ?></td>
					 </tr>
					 
					  <tr>
					  <td><strong>Gallery Images</strong></td>
					  <td>
					  <?php foreach($uimagesarr as $img){ ?>
						  
						<img src="<?php bloginfo('template_url'); ?>/useruploads/<?php echo $img; ?>" title="" alt=""/>  
						  
					  <?php }  **/ ?>
					  </td>
					 </tr>

					</tbody>			
				  </table>
				</div><!--end of .table-responsive-->
				 
				 </div>
			   </div>
          </section>
      <article class="col-md-9 left-panel">
     </div><!-- Row -->
    </div><!-- Container -->
</div><!-- Content Wrapper -->
<?php }else{       
                    $udash = get_page_link(168);
                    wp_redirect($udash);
                    exit;
					
			}//end if for uid 0
?>
<?php ob_flush(); ?>
<?php get_footer(); ?>