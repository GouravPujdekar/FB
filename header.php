<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Obaju e-commerce template">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">

    <title>Suffolkshops</title>

    <meta name="keywords" content="">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">

    <!-- theme stylesheet -->
    <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="css/custom.css" rel="stylesheet">

    <script src="js/respond.min.js"></script>

    <link rel="icon" href="img/favicon.png">

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

</head>

<body>

    <!-- *** TOPBAR ***
 _________________________________________________________ -->
    <div id="top">
        <div class="container">
            <div class="col-md-6 offer" data-animate="fadeInDown">
              <!--  <a href="#" class="btn btn-success btn-sm" data-animate-hover="shake">Offer of the day</a>  <a href="#">Get flat 35% off on orders over $50!</a> -->
            </div>
            <div class="col-md-6" data-animate="fadeInDown">
                <ul class="menu">
                  <!--  <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                    </li> -->
					
					<?php  if (!isset($_SESSION["username"])) { ?>
                    <li><a href="register.php"><i class="fa fa-sign-in"></i>Login/Register</a> </li>
					<?php } else {	?>
                    <li><a href="customer-account.php"><i class="fa fa-user"></i>My Account</a> </li>
				   <?php } ?>
                    <li><a href="contact_us.php"><i class="fa fa-phone"></i>Contact</a>
                    </li>
                    <!--<li><a href="#">Recently viewed</a>
                    </li>-->
                </ul>
            </div>
        </div>
        

    </div>
	<br>

    <!-- *** TOP BAR END *** -->

    <!-- *** NAVBAR ***
 _________________________________________________________ -->

    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">

                <a class="navbar-brand home" href="index.php" data-animate-hover="bounce">
                    <img src="img/logo1.png" alt="Obaju logo" class="hidden-xs">
                    <img src="img/logo1.png" alt="Obaju logo" class="visible-xs">
					<span class="sr-only">Suffolkshops</span>
                </a>
                <div class="navbar-buttons">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-align-justify"></i>
                    </button>
                    <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                   <a class="btn btn-default navbar-toggle" href="basket.html">
                        <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs">3 items in cart</span>
                    </a>-->
                </div>
            </div>
            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation">

                <ul class="nav navbar-nav navbar-left">
                    <li ><a data-hover="dropdown" href="index.php">Home</a>
                    </li>
                  <!--  <li class="dropdown yamm-fw">
                        <a href="shop.php"  data-hover="dropdown" data-delay="200">Shop</a>                      
                    </li> -->

                    <li class="dropdown yamm-fw">
                        <a href="#" data-hover="dropdown" data-delay="200">About Us </a>
                    </li>
					 <li class="dropdown yamm-fw">
                        <a href="delivery.php" data-hover="dropdown" data-delay="200">Delivery </a>
                    </li>

                    <li class="dropdown yamm-fw">
                        <a href="contact_us.php" data-hover="dropdown" data-delay="200">Contact Us</a>
                    </li>
                </ul>

            </div>
            <!--/.nav-collapse -->

            <div class="navbar-buttons">

              <!--  <div class="navbar-collapse collapse right" id="basket-overview">
                    <a href="basket.html" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm">3 items in cart</span></a>
                </div> -->
                <!--/.nav-collapse 

                <div class="navbar-collapse collapse right" id="search-not-mobile">
                    <button type="button" class="btn navbar-btn btn-primary" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                </div>-->

            </div>

            <div class="collapse clearfix" id="search">

                <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-btn">

			<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>

		    </span>
                    </div>
                </form>

            </div>
            <!--/.nav-collapse -->

        </div>
        <!-- /.container -->
    </div>
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->