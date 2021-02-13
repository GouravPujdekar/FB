<?php
// Start the session
session_start();

require('connection.php');
$connection=mysqli_connect($host , $user , $password , $db);
 
 if(isset($_POST['username']))
{
    
	
	$name=$_POST['name'];
	$mobile=$_POST['mobile'];
	$email=$_POST['email'];
	$postcode=$_POST['postcode'];
   // $address=$_POST['address'];
	$username=$_POST['username'];
    $pass=$_POST['password'];
	//$cpass=$_POST['password'];
	 if ($username=="" || $pass=="")
	{
    	
		
		 $_SESSION["error_credential"] ="<br>All field mandatory.<br>"; 
			 header('Location: ../register.php');
			 

			
	}
	else
    {
 
  //$sql = "SELECT *  from tbl_admin";
//$result = $connection->query($sql);


		$sql="INSERT INTO `tble_user`( `_Name`, `_Mobile_Number`, `_Email`, `_Post_Code`, `_Username`, `_Password`) 
		VALUES ('$name', '$mobile', '$email', '$postcode', '$username', '$pass')";
        $result = $connection->query($sql);
		//echo $sql;
		if (!$result) 
		{
			//$_SESSION["error_credential"] ="<br>Error: Invalid UserName or Password.<br>"; 
			 
			die("Query to show fields from table failed");
		}
		else{
			unset($_SESSION['error_credential']);
			 $_SESSION["success_credential"] ="<br>Sign up Successful. You can Login now.<br>"; 
			 header('Location: ../register.php');
		}
		
	
  
	

}		
}		//	echo json_encode( $data );

?>
