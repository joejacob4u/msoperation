<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>MSoperation</title>
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
						<li class="active">
							<a href="Event2.php">Follow Up</a>
						</li>
						<li>
							<a href="Event3.php">Agenda</a>
						</li>
						
					</ul>
					<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="text" class="form-control">
						</div> <button type="submit" class="btn btn-default">Search System</button>
					</form>
					<ul class="nav navbar-nav navbar-right">
					<li>
							<a href="event7.php">Referral</a>
						</li>
					<li>
							<a href="event6.php">Info</a>
						</li>
					<li>
							<a href="event4.php">Email/SMS</a>
						</li>						
						<li>
							<a href="logout.php">Logout</a>
						</li>
						
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Logged In!<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="#">Action</a>
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
									<a href="#">Separated link</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				
			</nav>
			<div>
				<div class="panel-heading">
  <?php
  date_default_timezone_set('America/New_York');
    $today = date("j F Y");
  ?>
   <h3 class="panel-title"> Truck Tracking Status </h3>
  </div>
  <div class="panel-body">
    
    <table class="table table-striped" id="table1">
      <thead>
        <tr>
          <th>Truck</th>
 
          <th>Date/Time</th>
 
          <th>Direction</th>
 
          <th>Address</th>
          
          <th>State</th>  
          
          <th>City</th>
          
          <th>Zip</th>
               
            </tr>
      </thead>
 
      <tbody>
        <?php
//set up mysql connection
mysql_connect("localhost", "silverback", "silverback953") or die(mysql_error());
//select database
mysql_select_db("MVOperation") or die(mysql_error());
// Retrieve all the data from the "tblstudent" table
$currentdate=date("j F Y");
$result = mysql_query("SELECT * FROM Tracking ") or die(mysql_error());
// store the record of the "tblstudent" table into $row
 
while ($row = mysql_fetch_array($result)) {
    // Print out the contents of the entry 
    $time=substr($row['FollowUp'],strlen($row['FollowUp'])-8,8);
    echo'<tr>
<td>'.$row['truck'].'</td>
<td>'.$row['date'].'</td>
<td>'.$row['direction'].'</td>
<td>'.$row['address'].'</td>
<td>'.$row['city'].'</td>
<td>'.$row['state'].'</td>
<td>'.$row['zip'].'</td>
</tr>';
 
    }
   
   ?>
 
      </tbody>
 
      
    </table>
        </div>
            </div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
