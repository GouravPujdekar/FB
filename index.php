<?php session_start();
if(isset($_SESSION['userid']))
$UserID= $_SESSION["userid"]; 
else
header("Location: register.php");

include('header.php');
require('dbfunctions/connection.php');
$connection=mysqli_connect($host , $user , $password , $db);
$sqluser = "SELECT * from tble_user WHERE _ID ='$UserID'";
$resultuser = mysqli_query($connection, $sqluser);
$row = $resultuser->fetch_array();

$sqluser1 = "SELECT COUNT(*) AS no_of_members, SUM(_money) as money_available, SUM(_CreditLimit) as credit_available from tble_user";
$resultuser1 = mysqli_query($connection, $sqluser1);
$row1 = $resultuser1->fetch_array();
$mymoney =(float)$row1['money_available'];
$mycredit =(float)$row1['credit_available'];
$myamarketMoney= $mymoney + $mycredit;

$sqluser2 = "SELECT  IFNULL(SUM(_ProductPrice),0) as money_itemlisted from tble_product WHERE _UserID ='$UserID' AND _status!='SoldOut'";
$resultuser2 = mysqli_query($connection, $sqluser2);
$row2 = $resultuser2->fetch_array();
 
$sqltars1 = "SELECT COUNT(*) AS no_of_tars_day from tble_recentactivity  WHERE STR_TO_DATE(_dateTime, '%Y-%m-%d') > DATE_SUB(NOW(), INTERVAL 1 DAY)";
$resulttars1 = mysqli_query($connection, $sqltars1);
$rowtars1 = $resulttars1->fetch_array();

$sqltars2 = "SELECT COUNT(*) AS no_of_tars_week from tble_recentactivity  WHERE STR_TO_DATE(_dateTime, '%Y-%m-%d') > DATE_SUB(NOW(), INTERVAL 1 WEEK)";
$resulttars2 = mysqli_query($connection, $sqltars2);
$rowtars2 = $resulttars2->fetch_array();

$sqltars3 = "SELECT COUNT(*) AS no_of_tars_year from tble_recentactivity  WHERE STR_TO_DATE(_dateTime, '%Y-%m-%d') > DATE_SUB(NOW(), INTERVAL 1 YEAR)";
$resulttars3 = mysqli_query($connection, $sqltars3);
$rowtars3 = $resulttars3->fetch_array();


?>		
    <div id="all">

        <div id="content">
            <div class="container">

			      <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#checkout">DASHBOARD</a>
                        </li>
                        
						<li><a href="dbfunctions/logout.php"><i class="fa fa-sign-out"></i> Logout (<?php echo $_SESSION["username"]; ?>)</a>
                                </li>
                    </ul>
                </div>
						<div class="col-md-12">

                    <ul class="breadcrumb">
                       <!-- <li><a href="#">Home</a></li> -->
                        <li><a href="customer-account.php"><?php echo $_SESSION["username"]; ?></a> (<?php echo $row['_points']; ?>  <i class="fa fa-star"></i>)</li>
                    </ul>

                </div>

                <div class="col-md-12" id="checkout">

                    <div class="box">
                       <!-- <form method="post" action="#"> -->
                            <h1>DASHBOARD</h1>
                            <ul class="nav">
                                <li class="col-md-3"><i class=" fa fa-money"></i><br>BALANCE <!-- <sub>Available</sub> -->
								 <a href="#"><img width="25px" class="customicon" src="img/coin1.png" /><?php echo $row['_money']; ?> <!--GBP--></a>
                                </li>
                                <li class="col-md-3"><i class=" fa fa-credit-card"></i><br>CREDIT LIMIT
								<a href="#"><img width="25px" class="customicon" src="img/coin1.png" /> <?php echo $row['_CreditLimit']; ?> </a>
                                </li>
                                <li class="col-md-3"><i class=" fa fa-list"></i><br>ITEM LISTED
								<a href="#"><img width="25px" class="customicon" src="img/coin1.png" /><?php echo $row2['money_itemlisted']; ?> </a>
                                </li>
                        
								<li style="border-color: #009647" class="col-md-3"><i class=" fa fa-exchange"></i><br>
								<a href="transfer_money.php">TRANSFER MONEY</a><br>
                                </li>
								<li style="border-color: #009647" class="col-md-3"><i class=" fa fa-shopping-cart"></i><br>
								<a href="my-order.php">MY ORDER</a><br>
                                </li>
                                <li style="border-color: #009647" class="col-md-3"><i class=" fa fa-plus-circle"></i><br>
								<a href="list-item.php">LIST ITEM</a><br>
                                </li>
                                <li style="border-color: #009647" class="col-md-3"><i class="fa fa-clock-o"></i><br>
								<a href="recent_activity.php">RECENT ACTIVITY</a><br>
                                </li>
                                <li style="border-color: #009647" class="col-md-3"><i class="fa fa-bitbucket"></i><br>
								<a href="shop.php">SHOPPING</a><br>
                                </li>
								<li style="border-color: #009647" class="col-md-3"><i class="fa fa-th-list"></i><br>
								<a href="item-listed.php">ITEM LISTED</a><br>
                                </li>
								<li  class="col-md-9">
			
								<div class="col-md-4">
								<strong>MARKET DATA </strong> <br><br>
								NO. OF MEMBERS : <strong><?php echo $row1['no_of_members']; ?></strong>  <br><br>
								CREDIT AVAILABLE	: <img width="25px" class="customicon" src="img/coin1.png" /> <strong><?php echo $myamarketMoney ?></strong><br>
								</div>
								<div  class="col-md-5  col-md-offset-2 col-sm-offset-0 col-xs-offset-0">
								<br><br>
								<p >CREDIT LIMIT <span style="margin-left : 10px;">MIN: <strong>-<?php echo $row['_credit_limit_min']; ?> </strong></span>	<span style="margin-left : 10px;">MAX: <strong>-<?php echo $row['_credit_limit_max']; ?></strong></span></p>
								<p >CREDIT LIMIT INCREASE PER TRANS: <strong>5</strong></p><br>
								</div>
						
								
								<div class="col-md-12">
								<br>
								TRANSACTIONS <span style="margin-left : 30px;"> DAYS : <strong><?php echo $rowtars1['no_of_tars_day']; ?></strong></span>
											<span style="margin-left : 30px;"> WEEK:  <strong><?php echo $rowtars2['no_of_tars_week']; ?></strong></span>
											<span style="margin-left : 30px;"> YEAR : <strong><?php echo $rowtars3['no_of_tars_year']; ?></strong></span>
								<br>
								</div>
                                </li> 
                            </ul>
                    
                            </div>
                        <!--</form>-->
                    </div>
                </div>
            </div>
        </div>
		
		

               

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
<?php include('footer.php'); ?>