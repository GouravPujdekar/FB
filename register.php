<?php session_start();
include('header.php');

require_once 'fbConfig.php';
require_once 'User.php';

if(isset($accessToken)){
	if(isset($_SESSION['facebook_access_token'])){
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}else{
		// Put short-lived access token in session
		$_SESSION['facebook_access_token'] = (string) $accessToken;
		
	  	// OAuth 2.0 client handler helps to manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();
		
		// Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
		
		// Set default access token to be used in script
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}
	
	// Redirect the user back to the same page if url has "code" parameter in query string
	if(isset($_GET['code'])){
		header('Location: ./');
	}
	
	// Getting user facebook profile info
	try {
		$profileRequest = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,locale,picture');
		$fbUserProfile = $profileRequest->getGraphNode()->asArray();
	} catch(FacebookResponseException $e) {
		echo 'Graph returned an error: ' . $e->getMessage();
		session_destroy();
		// Redirect user back to app login page
		header("Location: ./");
		exit;
	} catch(FacebookSDKException $e) {
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	
	// Initialize User class
	$user = new User();
	
	// Insert or update user data to the database
	$fbUserData = array(
		'oauth_provider'=> 'facebook',
		'oauth_uid' 	=> $fbUserProfile['id'],
		'first_name' 	=> $fbUserProfile['first_name'],
		'last_name' 	=> $fbUserProfile['last_name'],
		'email' 		=> $fbUserProfile['email'],
		'gender' 		=> $fbUserProfile['gender'],
		'locale' 		=> $fbUserProfile['locale'],
		'picture' 		=> $fbUserProfile['picture']['url'],
		'link' 			=> $fbUserProfile['link']
	);
	$userData = $user->checkUser($fbUserData);
	
	// Put user data into session
	$_SESSION['userData'] = $userData;
	
	// Get logout url
	$logoutURL = $helper->getLogoutUrl($accessToken, $redirectURL.'logout.php');
	
	// Render facebook profile data
	
	if(!empty($userData)){
		//$output  = '<h1>Facebook Profile Details </h1>';
		//$output .= '<img src="'.$userData['picture'].'">';
       // $output .= '<br/>Facebook ID : ' . $userData['oauth_uid'];
       // $output .= '<br/>Name : ' . $userData['first_name'].' '.$userData['last_name'];
      //  $output .= '<br/>Email : ' . $userData['email'];
       // $output .= '<br/>Gender : ' . $userData['gender'];
       // $output .= '<br/>Locale : ' . $userData['locale'];
       // $output .= '<br/>Logged in with : Facebook';
		//$output .= '<br/><a href="'.$userData['link'].'" target="_blank">Click to Visit Facebook Page</a>';
       // $output .= '<br/>Logout from <a href="'.$logoutURL.'">Facebook</a>';

				 $_SESSION["username"] =$userData['_Username'];
				 $_SESSION["userid"] =$userData['_ID'];	  
					 echo '<script>  window.location="index.php"; </script>';		 
	   
	}else{
		//$output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
		$_SESSION["error_credential"] ="<br>Error: Invalid UserName or Password.<br>"; 
	}
	
	
}else{
	// Get login url
	$loginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
	
	// Render facebook login button
	$output = '<a href="'.htmlspecialchars($loginURL).'"><img height="60px"  class="btn " src="images/fblogin-btn.png"></a>';
}
 ?>

    <div id="all">

        <div id="content">
            <div class="container">

             <!--   <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>New account / Sign in</li>
                    </ul>

                </div>
-->
 
                <div class="col-md-6">
                    <div class="box">
                        <h1>New Account</h1>

                        <p class="lead">Not our registered customer yet?</p>
                       <!-- <p>With registration with us new world of fashion, fantastic discounts and much more opens to you! The whole process will not take you more than a minute!</p>
                        <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>
-->
                        <hr>
						<?php include "dbfunctions/send_register.php"; ?>

                        <form action="" method="post" id="form_1">
                            <div class="form-group">
                                <label for="mobile">User-name</label>
                                <input type="text" class="form-control"  value="<?php echo $username; ?>" id="username" name="username" required>
                            </div>
							<div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control"  value="<?php echo $name; ?>" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control"  value="<?php echo $email; ?>" id="email" name="email" required>
                            </div>
							<div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text" class="form-control"  value="<?php echo $mobile; ?>" id="mobile" name="mobile" required>
                            </div>
							
							  <div class="row">
							<div class="col-sm-6">
							<div class="form-group">
                                <label for="mobile"> Postcode prefix </label>
                              <!--  <input type="text" class="form-control"  value="" id="postcode" name="postcode" required>-->
							  <select class="form-control" id="postcode" name="postcode" required  >
										
								</select>
                            </div>
							</div>
							<div class="col-sm-6">
							<div class="form-group">
                                <label for="mobile"> Full Postcode </label>
                              <input type="text" class="form-control"  value="<?php echo $postcode_suffix1; ?>" id="postcode_suffix" name="postcode_suffix" required>
							 
                            </div>
							</div>
							</div>
							
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" value=""  id="password" name="password" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="submit_1" class="btn btn-primary"><i class="fa fa-user-md"></i> Register</button>
                            </div>
                        </form>
						
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box">
                        <h1>Login</h1>

                        <p class="lead">Already our customer?</p>
                   

                        <hr>
						
						
						<?php
								if(isset($_SESSION['error_credential']))
								{
							?>
							  <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <?php echo $_SESSION['error_credential']; ?>
                                </div>
						   <?php
						   }
							?>	
							<?php
								if(isset($_SESSION['success_credential']))
								{
							?>
							  <div class="alert alert-success alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <?php echo $_SESSION['success_credential']; ?>
                                </div>
						   <?php
						   }
							?>	

                        <form action="dbfunctions/checkLogin.php" method="post">
                            <div class="form-group">
                                <label for="email">User-name</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="text-center">
                                <button type="submit" name="submit_2" class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
								<?php echo $output; ?>
                            </div>
                        </form>
						
						
						    <p class="text-muted"><strong>How it works</strong></p>
							<ol>
                                <li> Sign up as a <a href="#">Member</a>  its free to join!</li>
                                <li>  List product or service on  <a href="#">Suffolkshops.com facebook group sell page</a>  include your member ID, a link will be added to your listings allowing other members to buy your items.</li>
								<li>Start shopping!! Spend up to your Token credit limit or wait and spend Tokens received from sales. Use the link in listings to checkout, if the item is oversize then add appropriate delivery surcharge to your order.</li>
                                
                            </ol>
                    </div>
                </div>


            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
		
		
	<script >
var selectCategory = document.getElementById("postcode");

	loadCategory();	
			 
 function loadCategory()
  {
	     //  document.getElementById('selectCategory').options.length = 0;
			 $("#postcode").append("<option value='' >SelectPostCode</option>");
			 // document.getElementById('selectVersion').disabled = false;
			 
			$.ajax({
					url:'dbfunctions/getAllPostcodes.php',
					type:'post',
					dataType:"JSON",
					data:{ },
					success:function(data){
						if(data.valid){
									
									for(var i=0;i<data.result.length;i++){
										//alert(""+data.result[i]._Name);
										
										$("#postcode").append("<option value='"+data.result[i]._postcode+"' >"+data.result[i]._postcode+"</option>");
									}
									//document.getElementById("selectCategory").className = "selectpicker";
									// $("#selectCategory").addClass("selectpicker");
									 selectCategory.value = "<?php echo $postcode; ?>";
									
									
								}else alert("No Version found in database!");

								
						}
			});
 }
 
		</script >

<?php include('footer.php'); ?>
