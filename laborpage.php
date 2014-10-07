<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">

  <title>Labor Tracking</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="description" content="">

  <meta name="author" content="">



	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->

	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->

	<!--script src="js/less-1.3.3.min.js"></script-->

	<!--append �#!watch� to the browser URL, then refresh the page. -->

	

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

    <script type="text/javascript" src="js/bootstraper-datepicker.js"></script> 

  <script type="text/javascript" src="js/bootstrap-timepicker.js"></script> 

  <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>

  <script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>

    <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>

	<script type="text/javascript" src="js/jquery.min.js"></script>

	<script type="text/javascript" src="js/bootstrap.min.js"></script>

	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>

	<script type="text/javascript" src="js/scripts.js"></script>

		<script type="text/javascript" src="js/alertify.js"></script>

		<script type="text/javascript" src="js/bootstrap-editable.js"></script>

		<script type="text/javascript" src="js/bootstrap-dialog.js"></script>

	<script>

	  function activaTab(tab){

    $('.nav-tabs a[href="#' + tab + '"]').tab('show');

};

	</script>

   <script>

$(function(){

    $('.datepicker').datepicker({autoclose: true})});

</script>

	

	<script>

	  function downloadSign(code){

		window.open("http://www.msoperation.com/embedsign.php?code="+code);

    

}
function downloadInvoice(code){

		window.open("http://www.msoperation.com/invoicetemp.php?code="+code);

    

}

function downloadCash(code){

    window.open("http://www.msoperation.com/cccash.php?code="+code);

    

}

	</script>

	

    <script>

	  jQuery( function($) { 

    $('tbody').delegate('tr[data-href]','click', function() {		

	  code= $(this).attr('data-href');

	  id=$(this).attr('data-href2');

	  var $tr = $(this).closest('tr');

	  $('#laborstaff').html("");

	  $('[name="signature"]').attr("id",+code);
	  $('[name="invoice"]').attr("id",+code);
    $('[name="cccash"]').attr("id",+code);

	   $.ajax({

   url: 'http://msoperation.com/android/summary.php',

   data: 'code='+ parseInt(code) ,

   type: "POST",

   success: function(json) {

	

	if (isNaN(code)) {

	  var obj3 = jQuery.parseJSON( json );

	  start1=obj3.start;

	  end1=obj3.end;

	  

	  //dialog

	 BootstrapDialog.show({

            message: '<b>Move Details</b><br/><br/><b>From:</b> '+start1+'<br/><b>To:</b> '+end1,

            buttons: [ {

                label: 'Delete',

                cssClass: 'btn-danger',

                action: function(dialogItself){

				  //delete auth

				  dialogItself.close();

				  BootstrapDialog.show({

            title: 'Authorize Delete',

            message: "Enter Password:<input type='password' name='pass_word' id='pass_word'></input>",

            buttons: [{

                label: 'Confirm',

				cssClass: 'btn-success',

                action: function(dialogItself) {

				  dialogItself.close();

				  if ($('#pass_word').val()=='cameron953') {

					 $.ajax({

        url: 'deletemovestaff.php',

        type: 'post',

        data: 'id='+ parseInt(id),

        success: function(response) {

            dialogItself.close();

			$tr.find('td').fadeOut(1000,function(){ 

                            $tr.remove();}); 

            alertify.error("Record Deleted");        }

    });

				  }

				  else

				  {

					alertify.error("Incorrect Password!");

                   

				  }

                }

            }, {

                label: 'Close',

				cssClass: 'btn-warning',

                action: function(dialogItself) {

                    dialogItself.close();

                }

            }]

        });

				  //delete auth end

                    

                }

            }, {

                label: 'Close',

				cssClass: 'btn-warning',

                action: function(dialogItself){

                    dialogItself.close();

                }

            }]

        });

	  //dialogend

	  

	}

	else

	{

	

	

	$.ajax({

   url: 'http://msoperation.com/android/laborlist.php',

   data: 'code='+ code ,

   type: "POST",

   success: function(json2) {

	 obj2 = jQuery.parseJSON(json2);

	// $("#laborstaff").html("Name &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Time &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; End<br\>");

	var content = '<table class="table table-striped"><thead><tr> <th>Name</th><th>Started</th><th>Ended</th></tr></thead>';

$.each(obj2, function(key,value) {

  content+='<tr>';

  content += '<td>' +  value.name + '</td>';

  content += '<td>' +  value.time + '</td>';

  content += '<td>' +  value.endtime + '</td>';

  content+='</tr>';

	 });

  content += "</table>";

  $('#laborstaff').append(content);

   }

   });

	//************

	var obj = jQuery.parseJSON( json );

	$("#deposit1").val (obj.deposit);

	$("#billingrate1").val (obj.billrate);

	$("#servicefee1").val (obj.servicefee);

	$("#staff1").val (obj.staff);

	$("#credit1").val (obj.creditno);

	$("#expire1").val (obj.expire);

	$("#cvv1").val (obj.cvv);

	$("#codelabel").text ("Move Code:"+code);

	$("#namelabel").text ("Name:"+obj.name);

	$("#billratelabel").text ("Billrate: $"+obj.billrate);

	$("#servicefeelabel").text ("Service Fee: $"+obj.servicefee);

    $("#my_image").attr("src","data:image/jpeg;base64, "+obj.signature);

    $("#my_image").attr("height","300");

    $("#my_image").attr("width","300");

	

	$('#myModal').modal('show');

       }

   }});

      

	   

       

    }); 

}); 

	</script>

	<script>

	  function makeAjaxRequest2() {

      var date=$('#date').val();

      var search= $('#search').val()

    $.ajax({

        url: 'movesearch.php',

        type: 'post',

        data: 'search='+search+'&date='+date,

        success: function(response) {

            $('table#searchtable tbody').html(response);

            alertify.success("Searched Database!");        }

    });

}

	</script>

  <script>

   

   function updateEvent(){

		$('#myModal').modal('hide');

				

         var deposit=$('#deposit1').val(); 

         var billrate=$('#billingrate1').val();

         var servicefee=$('#servicefee1').val(); 

         

           

         var staff=$('#staff1').val();   

           var lock= $('#lock').val();

		 

         

         

		$.ajax({

		url: 'http://msoperation.com/updatelabor.php',

   data: '&code='+code+'&deposit='+ deposit +'&billrate='+ billrate +'&servicefee='+ servicefee +'&staff='+ staff+'&lock='+lock,

   type: "POST",

   success:function(json) {

		window.location.href = "http://msoperation.com/laborpage.php";

      }

		

		

		});        //Stop form submission & check the validation

              

          

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

   <button type="button" class="btn btn-primary" id="scroll" data-toggle="button" onClick="window.location.reload()">Refresh Status</button> 

   </div>

    </form>

  </div>

</div>



                <ul class="nav nav-pills">

                    <li class="active"><a href="#tab_a" data-toggle="tab">Job Status</a></li>

                    <li><a href="#tab_b" data-toggle="tab">Search</a></li>

                    



                </ul>



                <div class="tab-content">

                    <div class="tab-pane active" id="tab_a">

                <div class="panel-heading">

                    <?php

                    date_default_timezone_set('America/New_York');

                    $today = date("j F Y");

                    ?>

                    <h3 class="panel-title"> Jobs for <?php echo $today?> </h3>

                </div>

                        <div class="panel-body">



                            <table class="table table-striped" id="table1">

                                <thead>

                                <tr class="clickable">

                                    <th>Job Code</th>

									

								    <th>Name</th>



                                    <th>From</th>



                                    <th>To</th>



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

                                $currentdate = date("m-d-y");

                                $result = mysql_query("SELECT * FROM trackingcode WHERE date LIKE '%{$currentdate}%'") or die(mysql_error());

                                // store the record of the "tblstudent" table into $row



                                while ($row = mysql_fetch_array($result)) {

                                    // Print out the contents of the entry

                                  if($row['status'] == 'movepreview' || $row['status'] == 'logged in')

                                  {

                                    $status = "Logged In";

                                  }

                                  if($row['status'] == 'timerscreen')

                                  {

                                    $status = "Move Authorized";

                                  }

                                  if($row['status'] == 'timerscreen2')

                                  {

                                    $status = "Started Billing";

                                  }

                                  if($row['status'] == 'summary')

                                  {

                                    $status = "Bill Summary";

                                  }

                                  if($row['status'] == 'payment')

                                  {

                                    $status = "Payment";

                                  }
                                  if($row['status'] == 'Credit')

                                  {

                                    $status = "Credit Card";

                                  }
                                   if($row['status'] == 'Cash')

                                  {

                                    $status = "Cash Payment";

                                  }



                                    echo '<tr data-href="'.$row['code'].'">

									<td>'.$row['code'].'</td>

									<td>'.$row['name'].'</td>

									<td>'.$row['fromplace'].'</td>

									<td>'.$row['toplace'].'</td>

									<td>'.$status.'</td>

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

                        <h3 class="panel-title"> Search for a Move </h3>

                    </div>

                    <div class="panel-body">

					  <input class="search" size="25" type="text" id="search" name="search" placeholder="Phone or Code">

             <input class="datepicker" size="16" type="text" id="date" name="date" placeholder="Date" onKeyDown=”javascript:if (event.keyCode==13) makeAjaxRequest();” >

					  <span class="add-on"><i class="icon-th"></i></span>

					  <button   class="btn btn-primary" type="button" class="btnSearch2"  id="btn5" onclick="makeAjaxRequest2()"  >Search</button>



                        <table class="table table-striped" id="searchtable">

                            <thead>

                            <tr>

                                 <th>Job Code</th>

								 

								    <th>Name</th>



                                    <th>From</th>



                                    <th>To</th>



                                    <th>Status</th>



                            </tr>

                            </thead>



                            <tbody>

                           

                            </tbody>





                        </table>

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

<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">

      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

          <h4 class="modal-title">See Event</h4>

        </div>

        <div class="modal-body">

        <ul class="nav nav-tabs">

  

  <li><a href="#tab_z" data-toggle="tab">Attributes</a></li>

  <li><a href="#tab_y" data-toggle="tab">Billing</a></li>

  <li><a href="#tab_x" data-toggle="tab">Labor</a></li>

<li><a href="#tab_w" data-toggle="tab">Signature</a></li>

 

  <li class="active"><a href="#tab_f" data-toggle="tab">Summary</a></li>

  </ul> 

  <div class="tab-content">

        

         

         

         <div class="tab-pane" id="tab_z">  

              

             <h4><span class="label label-default">Deposit</span></h4>

            <input type="text" name="title1" id="deposit1" class="form-control">

        

            <h4><span class="label label-default">Billing Rate</span></h4>

              <input type="text" name="billingrate1" id="billingrate1" class="form-control">

            <h4><span class="label label-default">Service Fee</span></h4>

            <input type="text" name="servicefee1" id="servicefee1" class="form-control">             

            <h4><span class="label label-default"># of Staff</span></h4>

            <input type="text" name= "staff1" id="staff1" class="form-control">

            <h4><span class="label label-default"># of Trucks</span></h4>

            <input type="text" name= "truck1" id="truck1" class="form-control">

			  <h4><span class="label label-default">Lock Back Button</span></h4>

			  <select id="lock" class="form-control">

	      <option selected="selected" value="yes">Yes</option>

		  <option value="no">No</option>

		</select>

        </div>

        

        <div class="tab-pane" id="tab_y">  

              

             <h4><span class="label label-default">Credit Card Number</span></h4>

            <input type="text" name="credit1" id="credit1" class="form-control" readonly>

        

            <h4><span class="label label-default">Expiry Date</span></h4>

              <input type="text" name="expire1" id="expire1" class="form-control" readonly>

              <h4><span class="label label-default">CVV</span></h4>

            <input type="text" name= "cvv1" id="cvv1" class="form-control" readonly>

            <h4><span class="label label-default">Billing Zip Code</span></h4>

            <input type="text" name= "zip1" id="zip1" data-mask="999999" class="form-control" readonly> 

                

        </div>

        

        <div class="tab-pane" id="tab_x">  

  

           <div id="laborstaff"></div>

                      

                

        </div>

        

        <div class="tab-pane active" id="tab_f">  

  

			<h3><span class="label label-primary" id="codelabel"></span></h3>

			<h3><span class="label label-primary" id="namelabel"></span></h3>

			<h3><span class="label label-primary" id="billratelabel"></span></h3>

			<h3><span class="label label-primary" id="servicefeelabel"></span></h3> 

			<h3><span class="label label-primary" id="stafflabel"></span></h3> 

			<h3><span class="label label-primary" id="trucklabel"></span></h3>

			<h3><span class="label label-primary" id="billingratelabel"></span></h3>

			<h3><span class="label label-primary" id="servicefeelabel"></span></h3>    

			<h3><span class="label label-primary" id="datelabel"></span></h3>        

                

        </div>

      <div class="tab-pane" id="tab_w">



         
		  <img id="my_image" src="first.jpg"/>
		  <div class="btn-group-vertical">
		  <button name="signature" type="button" class="btn btn-link"  id="signlink" onclick="downloadSign(this.id)">Download Signed Pages</a>		  
		  <button name="invoice" type="button" class="btn btn-link"  id="invoicelink" onclick="downloadInvoice(this.id)">Download Invoice</a>
        <button name="cccash" type="button" class="btn btn-link" id="cccashlink" onclick="downloadCash(this.id)">Download CC/Cash</a>
		  </div>
		   
		  



      </div>



        

                                     		 			 		   		   		   		   		             

    

    <span class="add-on"><i class="icon-th"></i></span>

</div>

 

                                  



         

        </div>

        <div class="modal-footer">

            

                 <button type="button" class="btn btn-warning" data-dismiss="modal" id="closebutton">Close</button>

                  <button type="button" class="btn btn-success" id="updatebutton" onclick="updateEvent();">Update</button> 

                 <!--<button type="button" class="btn btn-danger"  id="deletebutton" onclick="deleteevent();">Delete</button>-->            

                         </div>

                         </div>

                         

      </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->

  </div><!-- /.modal -->

</html>

