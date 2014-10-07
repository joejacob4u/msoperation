<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Payroll</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
	<link href="css/bootstraper-datetimepicker.min.css" rel="stylesheet">	
	<link href="css/bootstrap-editable.css" rel="stylesheet">
	<link href="css/alertify.bootstrap.css" rel="stylesheet">	
	<link href="css/alertify.core.css" rel="stylesheet">
	<link href="css/alertify.default.css" rel="stylesheet">
  <link href="css/bootstrap-dialog.css" rel="stylesheet">
	<link type="text/css" href="css/bootstrap-timepicker.css" />
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
  <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.css"> 
  <script type="text/javascript" src="js/bootstraper-datepicker.js"></script>  	
  	<script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery.noty.packaged.min.js"></script>
  <script type="text/javascript" src="js/topRight.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript" src="js/bootstrap-editable.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-editable.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
	<script type="text/javascript" src="js/validator.js"></script>
	<script type="text/javascript" src="js/bootstrap-select.js"></script>
  <script type="text/javascript" src="js/bootstrap-dialog.js"></script>
  <script type="text/javascript" src="js/jasny-bootstrap.js"></script>
	<script type="text/javascript" src="js/bootstrap-timepicker.js"></script>	
	<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>
		<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="js/typeahead.bundle.js"></script>	
	<script type="text/javascript" src="js/moment-with-langs.js"></script>	
	<script type="text/javascript" src="js/typeahead.bundle.js"></script>
	<script type="text/javascript" src="js/alertify.js"></script>
  <script type="text/javascript" src="js/jquery.blockUI.js"></script>
  <script>$('.selectpicker').selectpicker();</script>
  <script>
$(function(){
    $('.datepicker').datepicker({autoclose: true})});
</script>
  <script type="text/javascript">
    
    function makeAjaxRequest2() {
      var search=$('#date').val();
      var date2=$('#date2').val();
      var e = document.getElementById("selectState");
      var state = e.options[e.selectedIndex].text;
      var f = document.getElementById("selectStaff");
      var staff = f.options[f.selectedIndex].text;
    $.ajax({
        url: 'payrollsearch.php',
        type: 'get',
        data: 'search='+search+'&state='+state+'&staff='+staff+'&date2='+date2,
        success: function(response) {
            $('table#gotoTable2 tbody').html(response);
            alertify.success("Searched Database!");        }
    });
}
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
			<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Payroll</h3>
  </div>
  <div class="panel-body">
    <form class="form-inline" role="form">
    	<div class="form-group">
    
  <input class="datepicker" size="16" type="text" id="date" name="date" placeholder="Start Date" onKeyDown=”javascript:if (event.keyCode==13) makeAjaxRequest();” >
<input class="datepicker" size="16" type="text" id="date2" name="date2" placeholder="End Date" onKeyDown=”javascript:if (event.keyCode==13) makeAjaxRequest();” >
  <span class="add-on"><i class="icon-th"></i></span>
  <select id="selectState" style="width:auto;" class="form-control selectWidth">
          <option class="">State</option>
          <option class="">Michigan</option>
          <option class="">Florida</option>
        </select>
        <select id="selectStaff" style="width:auto;" class="form-control selectWidth">
          <option class="">Staff</option>
          <?php 
          include 'conn.php';
          $sql="SELECT DISTINCT name FROM movestaff ORDER BY name";
          $result=mysql_query($sql);
      while($row = mysql_fetch_assoc($result))
     {
      $name=$row["name"];
      echo "<OPTION VALUE=\"$name\">".$name.'</option>';
      }
     ?>

        </select>
  <button   class="btn btn-primary" type="button" class="btnSearch2"  id="btn5" onclick="makeAjaxRequest2()">Search</button>
</div>
 </form>
    <table class="table" id="gotoTable2">
      <thead>
        <tr>
          <th>Job Code</th>
 
          <th>Date</th>
 
          <th>Name</th>
          
          <th>Time Started</th>
          
          <th>Time Ended</th>
          
          <th>Duration </th>
	  
	  <th>State</th>
 
         
                         
            </tr>
      </thead>
 
      <tbody>

        
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