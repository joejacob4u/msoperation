<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="img/favicon.png">
  
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
</head>

<body>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<nav class="navbar navbar-default" role="navigation">
				<div class="navbar-header">
					 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="index.html">MSoperation</a>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">Leads<strong class="caret"></strong></a>
              <ul class="dropdown-menu">
                <li >
                            <?php include 'conn.php'; $currentdate=date("j F Y");
                $result = mysql_query("SELECT * FROM FollowUp WHERE FollowUp LIKE '%{$currentdate}%'") or die(mysql_error());
                            $num_rows = mysql_num_rows($result);?>
              <a href="Event2.php">FollowUp  <span class="badge"><?php echo $num_rows;?></span></a>
            </li>
                <li>
              <?php include 'conn.php'; $date3=date("m-d-y"); $result = mysql_query("SELECT * FROM EmailSMS WHERE dateentered LIKE '%{$date3}%' AND checked='unread' ORDER BY id DESC");
                        $num_rows = mysql_num_rows($result);?>
                        <a href="leadinbox2.php">Inbox  <span class="badge"><?php echo $num_rows;?></a>
            </li>
                <li>
            <a href="Event3.php">Agenda</a>
                        
            </li>
                
              </ul>
            </li>
						<li>
            <a href="payrollpage.php">Payroll</a>
                        
            </li>
						
					</ul>
					<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="text" class="form-control">
						</div> <button type="submit" class="btn btn-default">Search System</button>
					</form>
					<ul class="nav navbar-nav navbar-right">
					<li>
					  <a href="laborpage.php">Move Status</a>
                        
						</li>
					<li>
							<a href="event7.php">References</a>
						</li>
					<li>
							<a href="trackingpage.php">Tracking</a>
						</li>						
						
						
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Logged In!<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="event6.php">Info</a>
								</li>
								<li>
									<a href="#">Another action</a>
								</li>
								<li>
									<a href="#">Something else here</a>
								</li>
								<li class="divider">
								</li>
								<li>
									<a href="logout.php">Logout</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				
			<!-- User Registration -->
			<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">New User Login</h3>
  </div>
  <div class="panel-body">
       <form class="form-inline">
    <input type="text" id="username1" class="input-small"  placeholder="Username" value="">
    <input type="password" id="password1" class="input-small" placeholder="Password" value="">
    <input type="text" id="name" class="input-small" placeholder="Name" value="">
    
    <button type="submit" class="btn" id="createuser">Create</button>
    </form>
  </div>
</div>
<!-- End of User Registration -->
		</div>
	</div>
</div>
</body>
</html>
