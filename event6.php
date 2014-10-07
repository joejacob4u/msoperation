<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Info</title>
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
                            <?php include 'conn.php'; $currentdate=date("j F Y");
								$result = mysql_query("SELECT * FROM FollowUp WHERE FollowUp LIKE '%{$currentdate}%'") or die(mysql_error());
                            $num_rows = mysql_num_rows($result);?>
							<a href="Event2.php">FollowUp  <span class="badge"><?php echo $num_rows;?></span></a>
						</li>
						<li>
							<?php include 'conn.php';$date3=date("m-d-y"); $result = mysql_query("SELECT * FROM EmailSMS WHERE dateentered LIKE '%{$date3}%' AND checked='unread' ORDER BY id DESC");
                        $num_rows = mysql_num_rows($result);?>
                        <a href="leadinbox2.php">Inbox  <span class="badge"><?php echo $num_rows;?></a>
						</li>
						
					</ul>
					<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="text" class="form-control">
						</div> <button type="submit" class="btn btn-default">Search System</button>
					</form>
					<ul class="nav navbar-nav navbar-right">
					<li>
					  <a href="Event3.php">Agenda</a>
                        
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
				
			</nav>
						<div class="jumbotron">
						<ul class="nav nav-tabs">
  <li><a href="#tab_a" data-toggle="tab">Phone</a></li>
  <li><a href="#tab_b" data-toggle="tab">Price</a></li>
  <li><a href="#tab_c" data-toggle="tab">Voicemail</a></li>
  
  
  </ul> 
  <div class="tab-content">
        <div class="tab-pane" id="tab_a">
          Silverback: Hi [CUSTOMER NAME]?<br/>

Customer: Yes this is<br/>
Silverback: Cameron with Silverback Moving & Storage. I understand you’re moving soon?<br/>
Customer: Yes we are.<br/>
Silverback: Excellent! From what city to what city?<br/>
Customer: Birmingham to Birmingham<br/>
Silverback: Is this a house to house or apartment to apartment<br/>
Customer: House to house<br/>

Silverback: Ask for the following<br/>
- Appliances<br/>
- Furniture<br/>
- # of boxes<br/>

[After taking note of their household goods determine how many men and deliver the pitch]<br/>
Pitch-<br/>
You have a very standard move, your move will require the work of 2 men and one 26' box truck. For this service we bill only $69 an hour PAUSE  with a single service fee of $199 to cover our INSURANCE & Workers Time to and from the site.<br/>1) We do not begin billing until we begin moving<br/>2) Only bill by the quarter of the hour. if we work for 3 hrs and 15 mins, you will only pay for 3 hrs and 15 mins not a full 4 hrs.<br/>
PAUSE<br/>
When were you looking to make this move?<br/>
 Oh we are very busy this month, but let me see what we have available<br/>
 Would you care to reserve a date?<br/>
 
Ask for:<br/><br/>Name<br/>
Telephone Number<br/>
Initial Address<br/>
New Address<br/>
Bill Rate<br/>
# of trucks and crew required<br/>

Will you be needing any storage, packing service, or boxes?<br/><br/>

Conclude by reviewing their information in the following form: As of right now NAME we have you scheduled for # OF MEN and one 26' box truck on DAY OF THE WEEK, MONTH DAY at TIME. We will be sending them to INITIAL ADDRESS. If we do not hear from you, our operations manager will be calling you the day prior before 5pm at xxx xxx xxxx to confirm your move.<br/>



Have a great day!

                                 
        </div>
         <div class="tab-pane" id="tab_b"> 
          Silverback Moving & Storage MICHIGAN minimum rates for services rendered:<br/> 
2 Men = $69 an hour<br/>3 Men = $99 an hour<br/>4 Men = $129 an hour<br/><br/> 
Single service fee of $149 for local / $199 for Ann Arbor and longer distance moves.<br/> 
1 vault of storage = 1 room of storage = $50 per vault<br/> 
$3.00 for Medium Box<br/>$3.50 for Large Box<br/>
         </div>
         
         <div class="tab-pane" id="tab_c">  
           Hi XXXXX! Cameron with Silverback Moving & Storage. I understand you're moving soon! If you give us a call back at 248 805 1063 again that is 248 805 1063 we'll set you up with the best move at the best rate!   
               
        </div>
        
       
				
				<p>
									</p>
				<p>
					
				</p>
			</div>
		</div>
	</div>
</div>
</body>
</html>
