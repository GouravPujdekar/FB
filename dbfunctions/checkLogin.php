<?php
// Start the session
session_start();

require('connection.php');
$connection=mysqli_connect($host , $user , $password , $db);
 
 if(isset($_POST['username']))
{
    $username=$_POST['username'];
    $pass=$_POST['password'];
	
	 if ($username=="" || $pass=="")
	{
    	
		
		 $_SESSION["error_credential"] ="<br>UserName and/or Password cannnot be empty.<br>"; 
			 header('Location: ../register.php');
			 

			
	}
	else
    {
 
  //$sql = "SELECT *  from tbl_admin";
//$result = $connection->query($sql);


		$sql="SELECT * FROM tble_user WHERE _Username='$username' AND _Password='$pass'";
        $result = $connection->query($sql);

		//echo $sql;
		if (!$result) 
		{
			$_SESSION["error_credential"] ="<br>Error: Invalid UserName or Password.<br>"; 
			 
			die("Query to show fields from table failed");
		}
		
		$row = $result->fetch_assoc();

  
		if ($row== 0) {
	 
				$_SESSION["error_credential"] ="<br>Error: Invalid UserName or Password.<br>"; 
			    header('Location: ../register.php');
				}
				else{
	
		// Set session variables
                 $_SESSION["username"] =$row['_Username'];
				 $_SESSION["userid"] =$row['_ID'];
               //  $_SESSION["username"] = $row['_Password'];
				

				 header('Location: ../index.php');
				}	


}		
}		//	echo json_encode( $data );

?>
