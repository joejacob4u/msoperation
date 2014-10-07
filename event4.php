<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>MSOperation</title>
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
 
			<!-- Button trigger modal -->
			<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Configurator</h3>
  </div>
  <div class="panel-body">
    <a data-toggle="modal" href="#myModal" class="btn btn-primary input-block-level">Email Settings</a>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Email Settings</h4>
        </div>
        <div class="modal-body">
          <form action="email.php" name="myform" method="POST" id="form1" >
          <div class="controls controls-row">
          <input  size="45" type="text" class="span1" name="emailsub" id="subject" placeholder="Subject">
                                            
        <textarea  class="form-control" name="emailbody" id="emailbody" placeholder="Body" rows="5" ></textarea>          
          </div>
        </div>
        <div class="modal-footer">
            
                 
                <input type="Submit" id="submit" value="Update"  class="btn btn-success"> 
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>            
                         </div>
                         </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
    <a data-toggle="modal" href="#myModal2" class="btn btn-info input-block-level">SMS Settings</a> 
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">SMS Settings</h4>
        </div>
        <div class="modal-body">
          <form action="sms.php" name="myform2" method="POST" id="form2" >
          <div class="controls controls-row">
                     
        <textarea  class="form-control" name="sms" id="sms" placeholder="SMS Message (150 chars)" rows="5" ></textarea>          
          </div>
        </div>
        <div class="modal-footer">
            
                 
                <input type="Submit" id="submit" value="Update"  class="btn btn-success"> 
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>            
                         </div>
                         </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
  <a data-toggle="modal" href="#myModal6" class="btn btn-warning input-block-level">Email/SMS Preview</a>
    <div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Email/SMS Preview</h4>
        </div>
        <div class="modal-body">
          <?php
//set up mysql connection
mysql_connect("localhost", "silverback", "silverback953") or die(mysql_error());
//select database
mysql_select_db("MVOperation") or die(mysql_error());
// Retrieve all the data from the "tblstudent" table
$currentdate=date("j F Y");
$result = mysql_query("SELECT * FROM Messages") or die(mysql_error());
// store the record of the "tblstudent" table into $row
$row = mysql_fetch_array($result); 
echo "<b>Email Subject: </b><br/>";
echo $row['emailsub'];
echo "<br/><br/><br/>";
echo "<b>Email Body: </b><br/>";
echo $row['emailmess'];
echo "<br/><br/><br/>";
echo "<b>SMS Text: </b><br/>";
echo $row['smsmess'];

  
   ?>
          
        </div>
        <div class="modal-footer">
            
                 
                
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>            
                         </div>
                         
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
                  <a href="trackingpage.php" class="btn btn-info input-block-level">
                    Truck Tracking
                </a>

  
  </div>
  
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Email/SMS Logs</h3>
  </div>
  <div class="panel-body">
    <table class="table table-striped" id="table1">
      <thead>
        <tr>
          <th>Email</th>
 
          <th>Phone</th>

            <th>Name</th>

            <th>Move Date</th>
 
          <th>Email Status</th>
 
          <th>SMS Status</th>
                         
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
$result = mysql_query("SELECT * FROM EmailSMS") or die(mysql_error());
// store the record of the "tblstudent" table into $row
 
while ($row = mysql_fetch_array($result)) {
    // Print out the contents of the entry 
     echo '<tr>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td>' . $row['number'] . '</td>';
    echo '<td>' . $row['Name'] . '</td>';
    echo '<td>' . $row['Date'] . '</td>';
    echo '<td>' . $row['EmailStatus'] . '</td>';
    echo '<td>' . $row['SMSStatus'] . '</td>'; 
    }
   
   ?>
        
      </tbody>
 
      
    </table>
    </div> 
     </div>
</div>				</div>
</div>
</body>
</html>
