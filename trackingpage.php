<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Tracking</title>
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
    <link href="css/alertify.bootstrap.css" rel="stylesheet">	
	<link href="css/alertify.core.css" rel="stylesheet">
	<link href="css/alertify.default.css" rel="stylesheet">
  <style>
    #mapmodals label { width: auto!important; display:inline!important; }
    #mapmodals img { max-width: none!important; }
    html, body, #map_canvas {
      margin: 0;
      padding: 0;
      height: 100%;
    }
    #map-canvas {
      width:100%;
      height: 300px;
    }
    </style>
  
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
		<script type="text/javascript" src="js/alertify.js"></script>
	<script>
	  $('#scroll').click(function () {
$('html, body').animate({scrollTop:$(document).height()}, 'slow');
return false;
});
	</script>
	
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
              <?php include 'conn.php';$date3=date("m-d-y"); $result = mysql_query("SELECT * FROM EmailSMS WHERE dateentered LIKE '%{$date3}%' AND checked='unread' ORDER BY id DESC");
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
        
      </nav>
				
			
			
      <div class="modal fade" id="mapmodals">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myCity">Cineplex Odeon Yonge & Dundas Cinemas</h4>
            </div>
            <div class="modal-body">
	      <h3><span class="label label-primary" id="maplabel">Primary</span></h3>
              <img id="mappic" src="http://maps.googleapis.com/maps/api/staticmap?center="+address2+"&zoom=18&size=530x300&sensor=false">
            </div>
            <div class="modal-footer">
              <button type="button" class="close" data-dismiss="modal">Close</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
			<div>
			<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    <form class="form-inline" role="form">
   <div class="form-group">
    <select id="truck" class="form-control">
   
  <option value="0">Pick Truck</option>
  <option value="5">SVL #5</option>
  <option value="6">SVL #6</option>
  <option value="9">SVL #9</option>
  <option value="10">SVL #10</option>
</select>
   </div>
   <div class="form-group">
 <button type="button" class="btn btn-primary" id="launch" data-toggle="button" onclick="launchModal()">Map Location</button> 
</div>
   <div class="form-group">
   <button type="button" class="btn btn-primary" id="scroll" data-toggle="button">Latest Logs</button> 
   </div>
    </form>
  </div>
</div>

                <ul class="nav nav-pills">
                    <li class="active"><a href="#tab_a" data-toggle="tab">Alerts</a></li>
                    <li><a href="#tab_b" data-toggle="tab">All Logs</a></li>
                    <li><a href="#tab_c" data-toggle="tab">Search</a></li>

                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="tab_a">
                <div class="panel-heading">
                    <?php
                    date_default_timezone_set('America/New_York');
                    $today = date("j F Y");
                    ?>
                    <h3 class="panel-title"> Alerts for <?php echo $today?> </h3>
                </div>
                        <div class="panel-body">

                            <table class="table table-striped" id="table1">
                                <thead>
                                <tr>
                                    <th>Truck</th>

                                    <th>Address</th>

                                    <th>Time</th>

                                    <th>Status</th>

                                    <th>Duration</th>



                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                //set up mysql connection
                                mysql_connect("localhost", "silverback", "silverback953") or die(mysql_error());
                                //select database
                                mysql_select_db("MVOperation") or die(mysql_error());
                                // Retrieve all the data from the "tblstudent" table
                                $currentdate = date("Y-m-d");
                                $result = mysql_query("SELECT * FROM TrackingAlert WHERE date LIKE '%{$currentdate}%' ORDER BY truck") or die(mysql_error());
                                // store the record of the "tblstudent" table into $row

                                while ($row = mysql_fetch_array($result)) {
                                    // Print out the contents of the entry

                                    echo'<tr>
<td>'.$row['truck'].'</td>
<td>'.$row['address'].'</td>
<td>'.$row['arrived'].'</td>
<td>'.$row['status'].'</td>
<td>'.$row['duration'].'</td>
</tr>';

                                }

                                ?>

 
      </tbody>
 
      
    </table>
        </div>

                </div>
                <div class="tab-pane" id="tab_b">
                    <div class="panel-heading">
                        <?php
                        date_default_timezone_set('America/New_York');
                        $today = date("j F Y");
                        ?>
                        <h3 class="panel-title"> Truck Tracking Status for <?php echo $today?> </h3>
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

                                <th>Status</th>

                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            //set up mysql connection
                            mysql_connect("localhost", "silverback", "silverback953") or die(mysql_error());
                            //select database
                            mysql_select_db("MVOperation") or die(mysql_error());
                            // Retrieve all the data from the "tblstudent" table
                            $currentdate = date("Y-m-d");
                            $result = mysql_query("SELECT * FROM Tracking WHERE date LIKE '%{$currentdate}%' ") or die(mysql_error());
                            // store the record of the "tblstudent" table into $row

                            while ($row = mysql_fetch_array($result)) {
                                // Print out the contents of the entry

                                echo'<tr>
<td>'.$row['truck'].'</td>
<td>'.$row['date'].'</td>
<td>'.$row['direction'].'</td>
<td>'.$row['address'].'</td>
<td>'.$row['city'].'</td>
<td>'.$row['state'].'</td>
<td>'.$row['zip'].'</td>
<td>'.$row['status'].'</td>
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
</div>
<script type="text/javascript">
	function launchModal()
	{
	  
	var truck=$('#truck').val();
	if (truck==10) {
	  code="#10 SVL";
	}
	if (truck==9) {
	 code="#9 SVL";
	}
	if (truck==5) {
	 code="#5 SVL";
	}
	if (truck==6) {
	 code="6# SLV";
	}
	
	if (truck==0) {
	  alertify.error("No trucks selected!");
	  return;//code
	}
      $.ajax({
        type: "POST",
		url: "getlocation.php",

		data: "&code="+code,
        dataType: "json",
        success: function(data)
        {
	      time=data[2];
		     direction=data[3];
			var address=data[4];
			var city=data[5];
			var state=data[6];
			zip=data[7];
			 address2=address+","+city+","+state;
    	    	time=time.substr(11,time.length);
      $("#myCity").html(address2);
      $("#maplabel").text("Heading "+direction+" at "+time+" today");
      $("#mappic").attr("src","http://maps.googleapis.com/maps/api/staticmap?center="+address2+"&zoom=13&size=530x300&markers=color:red%7Clabel:S%7C"+address2+"&sensor=false");
        $("#mapmodals").modal('show');

									        
		}
    });
       /*$.ajax({
        type: "POST",
		url: "getweather.php",

		data: "&zip="+zip,
        dataType: "json",
        success: function(data)
        {
	      condition=data.value;
	      temperature=data.value2;
    	    								        
		}
    });*/
        
	}


	      //end of modal google map
    </script>

</body>
</html>
