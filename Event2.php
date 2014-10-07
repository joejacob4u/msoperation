<?PHP

session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {

echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Please login first')
        window.location.href='index.html'
        </SCRIPT>");


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Follow Ups</title>
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

	
			
			<script>
$(function(){
    $('.Name').editable({
    	type: 'text',
            url: 'updatename.php',
            send: 'always',
            title: 'Edit:'
    });
});
</script>
 <script>
     $(function(){
         $('#myModal7').modal({
             keyboard: true,
             backdrop: "static",
             show:false

         }).on('show.bs.modal', function(){
                 var getIdFromRow = $(event.target).closest('tr').data('id');
		 $('#myModal7').modal('hide');
                 $.ajax({
        type: "POST",
	data:"email="+getIdFromRow+"&opt=emailsms",
        url: "checkemail.php",
        dataType: "json",
        cache: false,

        success: function(data)
        {
	  if (data[1].indexOf("@")>0) {

	    

          BootstrapDialog.show({
              title: 'View Later Actions',
              message: 'Name:'+data[3]+'<br/>Email:'+data[1]+'<br/>Phone:'+data[2]+'<br/>Move Date:'+data[4],
              buttons: [{
                  icon:'glyphicon glyphicon-check',
                  label: 'Schedule Move',
                  cssClass: 'btn-info',
                  action: function(dialog){
                      dialog.close();
		      $("#name1").val(data[3]);
		      $("#phone1").val(data[2]);
                      $("#myModal2").modal('show');
                  }


              }, {
                  icon:'glyphicon glyphicon-calendar',
                  label: 'Follow Up',
                  cssClass: 'btn-primary',
                  action: function(dialog){
                      dialog.close();
                      $.ajax({
                          type : 'POST',
                          url : 'deleteemail.php',
                          data : '&email='+ data[1],
                          success : function(data1) {
			       $('#myModal5').modal('hide');
                              $("#name").val(data[3]);
                              $("#email").val(data[4]);
                              $("#phone").val(data[2]);
                              $("#note").val("Move date is "+data[4]);
                              $("#myModal").modal('show');


                          }
                      })
                  }
              }, {
                  icon: 'glyphicon glyphicon-ban-circle',
                  label: 'Bad Lead',
                  cssClass: 'btn-danger',
		  action: function(dialog){
                      dialog.close();
                      $.ajax({
                          type : 'POST',
                          url : 'checklater.php',
                          data : '&email='+ data[1]+'&opt=1',
                          success : function(data1) {

                              alertify.log("Bad Lead Flagged!");


                          }
                      })
                  }
              },
                  {
                      icon: 'glyphicon glyphicon-time',
                      label: 'View Later',
                      cssClass: 'btn-warning',
		       action: function(dialog){
			dialog.close();
			 $.ajax({
                          type : 'POST',
                          url : 'checklater.php',
                          data : '&email='+ data[1]+'&opt=0',
                          success : function(data1) {

                             alertify.success("Reminder added!");


                          }
                      })
                      
                  }
                  }
                  ]
          });
	  $('#myModal7').modal('hide');
      }}})
                
             });
     });
 </script>
<style>
    div.pac-container {
   z-index: 1051 !important;
}    </style>
    <script type="text/javascript">
function initialize() {
    var input = document.getElementById("startaddress");
    var options = {componentRestrictions: {country: 'us'}};
                 
    new google.maps.places.Autocomplete(input, options);
}
             
google.maps.event.addDomListener(window, 'load', initialize);
</script>
 <script type="text/javascript">
function initialize() {
    var input = document.getElementById("endaddress");
    var options = {componentRestrictions: {country: 'us'}};
                 
    new google.maps.places.Autocomplete(input, options);
}
             
google.maps.event.addDomListener(window, 'load', initialize);
</script>
 <script type="text/javascript">
function initialize() {
    var input = document.getElementById("stop1");
    var options = {componentRestrictions: {country: 'us'}};
                 
    new google.maps.places.Autocomplete(input, options);
}
             
google.maps.event.addDomListener(window, 'load', initialize);
</script>
 <script type="text/javascript">
function initialize() {
    var input = document.getElementById("stop2");
    var options = {componentRestrictions: {country: 'us'}};
                 
    new google.maps.places.Autocomplete(input, options);
}
             
google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script>
jQuery( function($) { 
    $('tbody tr[data-href]').addClass('clickable').click( function() { 
        var note2 = $(this).attr('data-href'); 
        $.ajax({
        type: "POST",
	data:"&email="+note2,
        url: "checkemail.php",
        dataType: "json",
        cache: false,

        success: function(data)
        {
	  if (data[1].indexOf("@")>0) {

	    

          BootstrapDialog.show({
              title: 'Follow Up Actions',
              message: '<b>Name:</b>'+data[0]+'<br/><b>Email</b>:'+data[1]+'<br/><b>Phone</b>:'+data[2]+'<br/><b>Note</b>:'+data[6],
              buttons: [{
                  icon:'glyphicon glyphicon-check',
                  label: 'Schedule Move',
                  cssClass: 'btn-info',
                  action: function(dialog){
                      dialog.close();
		      $("#name1").val(data[0]);
		      $("#phone1").val(data[2]);
                      $("#myModal2").modal('show');
                  }


              }, {
                  icon:'glyphicon glyphicon-calendar',
                  label: 'Follow Up',
                  cssClass: 'btn-primary',
                  action: function(dialog){
                      dialog.close();
                      $.ajax({
                          type : 'POST',
                          url : 'deleteemail.php',
                          data : '&email='+ data[1],
                          success : function(data1) {

                              $("#name").val(data[0]);
                              $("#email").val(data[1]);
                              $("#phone").val(data[2]);
                              $("#note").val("Move date is "+data[3]);
                              $("#myModal").modal('show');


                          }
                      })
                  }
              }, {
                  icon: 'glyphicon glyphicon-ban-circle',
                  label: 'Bad Lead',
                  cssClass: 'btn-danger',
		  action: function(dialog){
                      dialog.close();
                      $.ajax({
                          type : 'POST',
                          url : 'checklater.php',
                          data : '&email='+ data[1]+'&opt=1',
                          success : function(data1) {

                              alertify.log("Bad Lead Flagged!");


                          }
                      })
                  }
              },{
                  icon: 'glyphicon glyphicon-time',
                  label: 'View Later',
                  cssClass: 'btn-warning',
                  action: function(dialog){
                      dialog.close();
                      BootstrapDialog.show({
                          message: 'View Later Options',
                          buttons: [{
                              label: 'Person was busy',
                              cssClass: 'btn-warning',
                              action: function(dialog){
                                  dialog.close();
                                  reason="busy";
                                  if (reason.length>0) {
                                      $.ajax({
                                          type : 'POST',
                                          url : 'checklater.php',
                                          data : '&email='+ data[1]+'&opt=0&reason=busy',
                                          success : function(data1) {

                                              alertify.success("Reminder added!");


                                          }
                                      })
                                  }
                              }
                          }, {
                              label: 'Left Voicemail',
                              cssClass: 'btn-primary',
                              action: function(dialog){

                                  reason="voicemail";
                                  dialog.close();
                                  if (reason.length>0) {
                                      $.ajax({
                                          type : 'POST',
                                          url : 'checklater.php',
                                          data : '&email='+ data[1]+'&opt=0&reason=voicemail',
                                          success : function(data1) {

                                              alertify.success("Reminder added!");


                                          }
                                      })
                                  }
                              }
                          }, {
                              icon: 'glyphicon glyphicon-ban-circle',
                              label: 'Busy',
                              cssClass: 'btn-info',
                              action: function(dialog){
                                  dialog.close();
                                  reason="busy";
                                  if (reason.length>0) {
                                      $.ajax({
                                          type : 'POST',
                                          url : 'checklater.php',
                                          data : '&email='+ data[1]+'&opt=0&reason=busy',
                                          success : function(data1) {

                                              alertify.success("Reminder added!");


                                          }
                                      })
                                  }
                              }
                          }, {
                              label: 'Other',
                              cssClass: 'btn-danger',
                              action: function(dialog){
                                  dialog.close();
                                  reason="busy";
                                  if (reason.length>0) {
                                      $.ajax({
                                          type : 'POST',
                                          url : 'checklater.php',
                                          data : '&email='+ data[1]+'&opt=0&reason=other',
                                          success : function(data1) {

                                              alertify.success("Reminder added!");


                                          }
                                      })
                                  }
                              }
                          }]
                      });



                  }
              }

              ]
          });

      }}})
            }) 
});
 </script>
<script type="text/javascript">
    
    function makeAjaxRequest() {
    $.ajax({
        url: 'gotodate.php',
        type: 'get',
        data: {date: $('input#date').val()},
        success: function(response) {
        
            $('table#gotoTable tbody').html(response);
            if(response!=" ")
            {
	            alertify.success("Searched Database!");   
	                     }
	                     
	                             }
    });
}
    </script>    
    <script type="text/javascript">
    
    function makeAjaxRequest2() {
    $.ajax({
        url: 'search.php',
        type: 'get',
        data: {search: $('input#search').val()},
        success: function(response) {
            $('table#gotoTable2 tbody').html(response);
            alertify.success("Searched Database!");        }
    });
}
    </script>
    <script  type="text/javascript">
      function dumpCal()
      {
          $('#myModal2').modal('hide');
          $.blockUI({ message:'Please wait. Scheduling Move.',
              css: {
              border: 'none',
              padding: '15px',
              backgroundColor: '#000',
              '-webkit-border-radius': '10px',
              '-moz-border-radius': '10px',
              opacity: .5,
              color: '#fff'
          } });
          //setTimeout($.unblockUI, 2000);
          title=$('#title').val();
          name=$('#name1').val();
          phone1=$('#phone1').val();
          phone2=$('#phone2').val();
          startaddress=$('#startaddress').val();
          endaddress=$('#endaddress').val();
          stop1=$('#stop1').val();
          stop2=$('#stop2').val();
          deposit=$('#deposit').val();
          billrate=$('#billingrate').val();
          servicefee=$('#servicefee').val();
          flatrate=$('#flatrate').val();
          weight=$('#weight').val();
          extra=$('#extras').val();
          staff=$('#staff').val();
          truck=$('#truck').val();
          creditno=$('#credit').val();
          expire=$('#expire').val();
          cvv=$('#cvv').val();
          zip=$('#zip').val();
          source=$('#source').val();
          state=$('#state').val();
          note=$('#note').val();
          time=$('#time2').val();
          url="";
          if (title) {
              start = time;
              end = time;

              var varname = '<?php  echo $_SESSION['userid']; ?>';
              $.ajax({
                  url: 'http://msoperation.com/add_events.php',
                  data: 'title='+ title+'&start='+ start +'&end='+ end +'&url='+ url +'&name='+ name +'&phone1=' +phone1 +'&phone2='+ phone2 +'&startaddress='+ startaddress+'&endaddress='+ endaddress +'&stop1='+ stop1 +'&stop2='+ stop2 +'&deposit='+ deposit +'&billrate='+ billrate +'&servicefee='+ servicefee +'&flatrate='+ flatrate+'&weight='+ weight +'&extra='+ extra +'&staff='+ staff +'&truck='+ truck +'&creditno='+ creditno +'&expire='+ expire +'&cvv='+ cvv +'&zip='+ zip +'&source='+ source+'&state='+ state +'&note='+ note +'&userid='+ varname+'&time='+time+'&from=external',
                  type: "POST",
                  success: function() {

                      $.unblockUI();
			    alertify.success("Move Scheduled!");
                  }
              });
          
	   }
	   }
    </script>
    <script type="text/javascript">
function gotoDate()
{
var date = document.getElementById("date").value;  
var xhr;  
 if (window.XMLHttpRequest) { // Mozilla, Safari, ...  
    xhr = new XMLHttpRequest();  
} else if (window.ActiveXObject) { // IE 8 and older  
    xhr = new ActiveXObject("Microsoft.XMLHTTP");  
}  
var data = "date=" + date;  
     xhr.open("POST", "gotodate.php", true);   
     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                    
     xhr.send(data); 
xhr.onreadystatechange = display_data;  
    function display_data() {  
     if (xhr.readyState == 4) {  
      if (xhr.status == 200) {  
       //alert(xhr.responseText);        
      document.getElementById("suggestion").innerHTML = xhr.responseText;  
      } else {  
        alert('There was a problem with the request.');  
      }  
     }  
    }  



    }
</script>
<script type="text/javascript">
$(function() {
$(".delete_button").click(function() {
var id = $(this).attr("id");
var dataString = 'id='+ id ;
var parent = $(this).parent();
var $tr = $(this).closest('tr');
alertify.prompt("Enter password to Delete.", function (e, str) {
    // str is the input text
    if (e) {
        if(str=="silverback953")
        {
	      $.ajax({
type: "POST",
url: "deleteajax.php",
data: dataString,
cache: false,

success: function()
{
if(id % 2)
{
 $tr.find('td').fadeOut(1000,function(){ 
                            $tr.remove();                    
                        }); 
alertify.log("Record Deleted!");
}
else
{
 $tr.find('td').fadeOut(1000,function(){ 
                            $tr.remove();                    
                        }); 
alertify.log("Record Deleted!");}
}
});
  
	        
        }
        else
        {
	        alertify.error("Wrong Password.");        }
    } else {
        // user clicked "cancel"
    }
}, "");

return false;
});
});
</script>
<script type="text/javascript">
$(function() {
$(".edit_button").click(function() {
var id = $(this).attr("id");
var dataString = 'id='+ id ;
var parent = $(this).parent();
$('#myModal3').modal('show');
$( "#submit2" ).click(function() {
  
  var date1=$('#followup2').val();
 $('#myModal3').modal('hide');
   	      $.ajax({
type: "POST",
url: "editfollowup.php",
data: 'id='+ id +'&date='+date1,
cache: false,
success:function(json)
{
	location.reload();
  }

});

});

});
});
</script>


<script type="text/javascript">
$(function() {
$(".delete_button2").click(function() {
var id = $(this).attr("id");
var dataString = 'id='+ id ;
var parent = $(this).parent();
 var $tr = $(this).closest('tr'); 

$.ajax({
type: "POST",
url: "deleteajax.php",
data: dataString,
cache: false,

success: function()
{
if(id % 2)
{

alertify.error("Record Deleted!");
$tr.find('td').fadeOut(1000,function(){ 
                            $tr.remove();                    
                        }); 
}
else
{
$tr.find('td').fadeOut(1000,function(){ 
                            $tr.remove();                    
                        }); 
alertify.error("Record Deleted!");}
}
});

return false;
});
});
</script>

<script>
$(function(){
    $('.datepicker').datepicker({autoclose: true})});
</script>
		 <script>
		$(document).ready(function () {
			$("input#submit").click(function(){
				$.ajax({
					type: "POST",
					url: "followup.php", // 
					data: $('form.myform').serialize(),
					success: function(msg){
					$("#myModal").modal('hide');	
					},
					error: function(){
						alert("failure");
					}
				});
			});
			$('#search').keypress(function(e) {
        if(e.which == 13) {
            makeAjaxRequest2();
        }
    });
    $('#date').keypress(function(e) {
        if(e.which == 13) {
            makeAjaxRequest();
        }
    });
    
    		});
    </script>

   <style>
.form_datetime{z-index: 100000 !important;}
</style>
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
    <h3 class="panel-title">Add</h3>
  </div>
  <div class="panel-body">
  <!-- Button trigger modal -->
  <a data-toggle="modal" href="#myModal" class="btn btn-primary input-block-level">Add Follow Up</a>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add Follow Up</h4>
        </div>
        <div class="modal-body">
          <form action="followup.php" name="myform" method="POST" id="form1" >
          <div class="controls controls-row">
          <input type="text" class="span3" name="name" id="name" placeholder="Name">
          <input type="email" class="span3" name="email" id="email" placeholder="Email">
          <input type="text" class="span3" name="phone" id="phone" data-mask="9999999999" placeholder="Phone">
          <input type="text" class="span3" name="fromzip" id="fromzip" data-mask="99999" placeholder="From Zip">
          <input type="text" class="span3" name="tozip" id="tozip" data-mask="99999" placeholder="To Zip">
          <input type="text" class="span3" name="billingrate" id="billingrate"  placeholder="Billing rate">
          <input type="text" class="span3" name="servicefee" id="servicefee"  placeholder="Service Fee"> 
          <input type="text" class="span3" name="truckcount" id="truckcount"  placeholder="Truck Count">
          <input type="text" class="span3" name="mancount" id="mancount"  placeholder="Man Count">     
          <div class="input-append date form_datetime">
    <input size="50" class="span3" type="text" name="followup" id="followup" placeholder="FollowUp Date"  >
    <span class="add-on"><i class="icon-th"></i></span>
</div>
 
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "dd MM yyyy - HH:ii P",
        showMeridian: true,
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left",
        minuteStep: 30
        
            });
</script>  
                                  
        <textarea name="note" class="form-control" name="note" id="note" placeholder="Internal Note" rows="3" ></textarea>
             <textarea name="note1" class="form-control" name="note1" id="note1" placeholder="Note to Customer" rows="3" ></textarea>
          </div>
        </div>
        <div class="modal-footer">
            
                 
                <input type="Submit" id="submit" value="Create!"  class="btn btn-success"> 
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>            
                         </div>
                         </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
      <a data-toggle="modal" href="#myModal5" class="btn btn-warning ">View Later Leads</a>

      <div class="modal fade" id="myModal5">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">View Later Leads</h4>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs">
                    <li><a href="#tab_l" data-toggle="tab">Today</a></li>
                    <li><a href="#tab_m" data-toggle="tab">Yesterday</a></li>
                    <li><a href="#tab_j" data-toggle="tab">Old</a></li>
                    <li><a href="#tab_k" data-toggle="tab">Last Week</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="tab_l">
                        <table class="table table-striped" id="table1">
                            <thead>
                            <tr>
                                <th>Email</th>

                                <th>Phone</th>

                                <th>Name</th>

                                <th>Move Date</th>



                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            //set up mysql connection
                            mysql_connect("localhost", "silverback", "silverback953") or die(mysql_error());
                            //select database
                            mysql_select_db("MVOperation") or die(mysql_error());
                            // Retrieve all the data from the "tblstudent" table
                            $date3=date("m-d-y");
                            $result = mysql_query("SELECT * FROM EmailSMS WHERE dateentered LIKE '%{$date3}%' AND (checked='unread' OR checked='busy' OR checked='voicemail' OR checked='other') ORDER BY id DESC") or die(mysql_error());
                            // store the record of the "tblstudent" table into $row

                            while ($row = mysql_fetch_array($result)) {
                                // Print out the contents of the entry
                                echo '<tr data-toggle="modal" data-id="'.$row['email'].'" data-target="#myModal7">';
                                echo '<td>' . $row['email'] . '</td>';
                                echo '<td>' . $row['number'] . '</td>';
                                echo '<td>' . $row['Name'] . '</td>';
                                echo '<td>' . $row['Date'] . '</td>';
                                echo '</tr>';

                            }

                            ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab_j">
                        <table class="table table-striped" id="table1">
                            <thead>
                            <tr>
                                <th>Email</th>

                                <th>Phone</th>

                                <th>Name</th>

                                <th>Move Date</th>



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
							$yesterday=date("m-d-y", strtotime("yesterday"));
                            $result = mysql_query("SELECT * FROM EmailSMS WHERE dateentered NOT LIKE '%{$date3}%' AND dateentered NOT LIKE '%{$yesterday}%' AND (checked='unread' OR checked='busy' OR checked='voicemail' OR checked='other') ORDER BY id DESC") or die(mysql_error());
                            // store the record of the "tblstudent" table into $row

                            while ($row = mysql_fetch_array($result)) {
                                // Print out the contents of the entry
                                echo '<tr data-toggle="modal" data-id="'.$row['email'].'" data-target="#myModal7">';
                                echo '<td>' . $row['email'] . '</td>';
                                echo '<td>' . $row['number'] . '</td>';
                                echo '<td>' . $row['Name'] . '</td>';
                                echo '<td>' . $row['Date'] . '</td>';
                                echo '</tr>';

                            }

                            ?>

                            </tbody>
                        </table>

                    </div>
					<div class="tab-pane" id="tab_m">
                        <table class="table table-striped" id="table1">
                            <thead>
                            <tr>
                                <th>Email</th>

                                <th>Phone</th>

                                <th>Name</th>

                                <th>Move Date</th>



                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            //set up mysql connection
                            mysql_connect("localhost", "silverback", "silverback953") or die(mysql_error());
                            //select database
                            mysql_select_db("MVOperation") or die(mysql_error());
                            // Retrieve all the data from the "tblstudent" table
                            $yesterday=date("m-d-y", strtotime("yesterday"));
                            $result = mysql_query("SELECT * FROM EmailSMS WHERE dateentered  LIKE '%{$yesterday}%' AND (checked='unread' OR checked='busy' OR checked='voicemail' OR checked='other') ORDER BY id DESC") or die(mysql_error());
                            // store the record of the "tblstudent" table into $row

                            while ($row = mysql_fetch_array($result)) {
                                // Print out the contents of the entry
                                echo '<tr data-toggle="modal" data-id="'.$row['email'].'" data-target="#myModal7">';
                                echo '<td>' . $row['email'] . '</td>';
                                echo '<td>' . $row['number'] . '</td>';
                                echo '<td>' . $row['Name'] . '</td>';
                                echo '<td>' . $row['Date'] . '</td>';
                                echo '</tr>';

                            }

                            ?>

                            </tbody>
                        </table>

                    </div>
					<div class="tab-pane" id="tab_k">
                        <table class="table table-striped" id="table1">
                            <thead>
                            <tr>
                                <th>Email</th>

                                <th>Phone</th>

                                <th>Name</th>

                                <th>Move Date</th>



                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            //set up mysql connection
                            mysql_connect("localhost", "silverback", "silverback953") or die(mysql_error());
                            //select database
                            mysql_select_db("MVOperation") or die(mysql_error());
                            // Retrieve all the data from the "tblstudent" table
                            $lastweek=date("m-d-y", strtotime("last Sunday"));
							$endlastweek=date("m-d-y", strtotime("-2 day"));
                            $result = mysql_query("SELECT * FROM EmailSMS WHERE dateentered  BETWEEN '$lastweek' AND '$endlastweek' AND (checked='unread' OR checked='busy' OR checked='voicemail' OR checked='other') ORDER BY id DESC") or die(mysql_error());
                            // store the record of the "tblstudent" table into $row

                            while ($row = mysql_fetch_array($result)) {
                                // Print out the contents of the entry
                                echo '<tr data-toggle="modal" data-id="'.$row['email'].'" data-target="#myModal7">';
                                echo '<td>' . $row['email'] . '</td>';
                                echo '<td>' . $row['number'] . '</td>';
                                echo '<td>' . $row['Name'] . '</td>';
                                echo '<td>' . $row['Date'] . '</td>';
                                echo '</tr>';

                            }

                            ?>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  <div class="modal fade" id="myModal7">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Edit</h4>
              </div>
              <div id="modalBody" class="modal-body">

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <a data-toggle="modal" href="#myModal6" class="btn btn-danger">Bad/Broken Leads</a>

  <div class="modal fade" id="myModal6">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Bad/Broken Leads</h4>
              </div>
              <div class="modal-body">
                  <table class="table table-striped" id="table1">
                      <thead>
                      <tr>
                          <th>Email</th>

                          <th>Phone</th>

                          <th>Name</th>

                          <th>Move Date</th>



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
                      $result = mysql_query("SELECT * FROM EmailSMS WHERE checked='badlead'") or die(mysql_error());
                      // store the record of the "tblstudent" table into $row

                      while ($row = mysql_fetch_array($result)) {
                          // Print out the contents of the entry
                          echo '<tr>';
                          echo '<td>' . $row['email'] . '</td>';
                          echo '<td>' . $row['number'] . '</td>';
                          echo '<td>' . $row['Name'] . '</td>';
                          echo '<td>' . $row['Date'] . '</td>';

                      }

                      ?>

                      </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
   <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit Follow Up Date</h4>
        </div>
        <div class="modal-body">
          
          <div class="controls controls-row">
              
          <div class="input-append date form_datetime">
    <input size="50" class="span3" type="text" name="followup2" id="followup2" placeholder="Edit FollowUp Date"  >
    <span class="add-on"><i class="icon-th"></i></span>
</div>
 
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "dd MM yyyy - HH:ii P",
        showMeridian: true,
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left",
        minuteStep: 30
        
            });
</script>  
                                  
              
          </div>
        </div>
        <div class="modal-footer">
            
                 
                <input type="Submit" id="submit2" value="Update"  class="btn btn-success"> 
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>            
                         </div>
                         
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <div class="modal fade bs-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Create Event</h4>
              </div>
              <div class="modal-body">
                  <ul class="nav nav-tabs">
                      <li ><a href="#tab_1" data-toggle="tab">Client</a></li>
                      <li><a href="#tab_2" data-toggle="tab">Locations</a></li>
                      <li><a href="#tab_3" data-toggle="tab">Attributes</a></li>
                      <li><a href="#tab_4" data-toggle="tab">Billing</a></li>
                      <li><a href="#tab_5" data-toggle="tab">State</a></li>

                  </ul>
                  <div class="tab-content">
                      <div class="tab-pane" id="tab_1">

                          <h4><span class="label label-default">Date</span></h4>
                          <input type="text" name="time2" id="time2" class="form-control">
                          <script type="text/javascript">
                              $("#time2").datetimepicker({
                                  format: "dd MM yyyy - HH:ii P",
                                  showMeridian: true,
                                  autoclose: true,
                                  todayBtn: true,
                                  pickerPosition: "bottom-left",
                                  minuteStep: 30

                              });
                          </script>


                          <h4><span class="label label-default">Title</span></h4>
                          <input type="text" name="title1" id="title" class="form-control" data-validation-required-message="Field required" required>

                          <h4><span class="label label-default">Customer Name</span></h4>
                          <input type="text" name="name1" id="name1" class="form-control">
                          <h4><span class="label label-default">Phone 1</span></h4>
                          <input type="text" name="phone11" id="phone1"  class="form-control">
                          <h4><span class="label label-default">Phone 2</span></h4>
                          <input type="text" name= "phone22" id="phone2"  class="form-control">
                          <h4><span class="label label-default">Special Info</span></h4>
                          <textarea name='note1' id="note" class="form-control"></textarea>
                      </div>
                      <div class="tab-pane" id="tab_2">
                          <h4><span class="label label-default">Start Address</span></h4>
                          <textarea id="startaddress" name="startaddress" class="form-control"></textarea>
                          <h4><span class="label label-default">End Address</span></h4>
                          <textarea id="endaddress" name="endaddress" class="form-control"></textarea>
                          <h4><span class="label label-default">Stop Address 1</span></h4>
                          <textarea id="stop1"  class="form-control"></textarea>
                          <h4><span class="label label-default">Stop Address 2</span></h4>
                          <textarea id="stop2" class="form-control"></textarea>
                      </div>

                      <div class="tab-pane" id="tab_3">

                          <h4><span class="label label-default">Deposit</span></h4>
                          <input type="text" name="deposit1" id="deposit" class="form-control">

                          <h4><span class="label label-default">Billing Rate</span></h4>
                          <input type="text" name="billingrate1" id="billingrate" class="form-control">
                          <h4><span class="label label-default">Service Fee</span></h4>
                          <input type="text" name="servicefee1" id="servicefee" class="form-control">
                          <h4><span class="label label-default">Flat Rate</span></h4>
                          <input type="text" name= "flatrate1" id="flatrate" class="form-control">
                          <h4><span class="label label-default">Estimated Weight</span></h4>
                          <input type="text" name= "weight1" id="weight" class="form-control">
                          <h4><span class="label label-default">Extras</span></h4>
                          <input type="number" name= "extras1" id="extras" class="form-control">
                          <h4><span class="label label-default"># of Staff</span></h4>
                          <input type="number" name= "staff1" id="staff" class="form-control">
                          <h4><span class="label label-default"># of Trucks</span></h4>
                          <input type="number" name= "truck1" id="truck" class="form-control">
                      </div>

                      <div class="tab-pane" id="tab_4">

                          <h4><span class="label label-default">Credit Card Number</span></h4>
                          <input type="text" name="credit1" id="credit" class="form-control">

                          <h4><span class="label label-default">Expiry Date</span></h4>
                          <input type="text" name="expire1" id="expire" class="form-control">
                          <h4><span class="label label-default">CVV</span></h4>
                          <input type="text" name= "cvv1" id="cvv" class="form-control">
                          <h4><span class="label label-default">Billing Zip Code</span></h4>
                          <input type="text" name= "zip1" id="zip" data-mask="99999" class="form-control">

                      </div>

                      <div class="tab-pane" id="tab_5">

                          <h4><span class="label label-default">Source</span></h4>
                          <select id="source" class="form-control">
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                              <option>6</option>
                              <option>7</option>
                              <option>8</option>
                              <option>9</option>

                          </select>

                          <h4><span class="label label-default">State</span></h4>
                          <select id="state" class="form-control">
                              <option>michigan</option>
                              <option>illinois</option>
                              <option>florida</option>
                          </select>


                      </div>





                      <span class="add-on"><i class="icon-th"></i></span>
                  </div>




              </div>
              <div class="modal-footer">


                  <button type="button" class="btn btn-success"  id="createbutton" onclick="dumpCal()" >Schedule</button>

              </div>
          </div>

      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


</div>  
 <ul class="nav nav-pills">
  <li class="active"><a href="#tab_a" data-toggle="tab">Today</a></li>
  <li><a href="#tab_b" data-toggle="tab">All</a></li>
  <li><a href="#tab_c" data-toggle="tab">Goto</a></li>
  <li><a href="#tab_d" data-toggle="tab">Search</a></li>
  <li><a href="#tab_e" data-toggle="tab">Recent</a></li>
</ul> 
<div class="tab-content">
        <div class="tab-pane active" id="tab_a">
            <div class="panel panel-default">
  <div class="panel-heading">
  <?php
  date_default_timezone_set('America/New_York');
    $today = date("j F Y");
  ?>
   <h3 class="panel-title"> Follow Up for <?php echo "$today"?> </h3>
  </div>
  <div class="panel-body">
    
    <table class="table table-striped" id="table1">
      <thead>
        <tr>
          <th>Name</th>
 
          <th>Email</th>
 
          <th>Phone</th>
 
          <th>From Zip</th>
          
          <th>To Zip</th>  
          
          <th>Time</th>
               
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
$result = mysql_query("SELECT * FROM FollowUp WHERE FollowUp LIKE '%{$currentdate}%'") or die(mysql_error());
// store the record of the "tblstudent" table into $row
 
while ($row = mysql_fetch_array($result)) {
    // Print out the contents of the entry 
    $time=substr($row['FollowUp'],strlen($row['FollowUp'])-8,8);
    echo'<tr data-href="'.$row['Email'].'">
<td><span class="Name" id="Name" data-type="text" data-pk="'.$row['id'].'" data-url="updatename.php">'.$row['Name'].'</span></td>
<td><span class="Name" id="Email" data-type="text" data-pk="'.$row['id'].'" data-url="updatename.php">'.$row['Email'].'</span></td>
<td><span class="Name" id="Phone" data-type="text" data-pk="'.$row['id'].'" data-url="updatename.php">'.$row['Phone'].'</span></td>
<td><span class="Name" id="FromZip" data-type="text" data-pk="'.$row['id'].'" data-url="updatename.php">'.$row['FromZip'].'</span></td>
<td><span class="Name" id="ToZip" data-type="text" data-pk="'.$row['id'].'" data-url="updatename.php">'.$row['ToZip'].'</span></td>
<td>'.$time.'</td>
<td><a href="#" id="'.$row['id'].'" class="edit_button">Reschedule</a></td>
<td><a href="#" id="'.$row['id'].'" class="delete_button">Delete</a></td>
</tr>';
 
    }
   
   ?>
 
      </tbody>
 
      
    </table>
        </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_b">
            <div class="panel panel-default">
  <div class="panel-heading">
  <?php
  date_default_timezone_set('America/New_York');
    $today = date("j F Y");
  ?>
   <h3 class="panel-title"> All Follow Ups </h3>
  </div>
  <div class="panel-body">
    
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Name</th>
 
          <th>Email</th>
 
          <th>Phone</th>
 
          <th>From Zip</th>
          
          <th>To Zip</th>  
                    
          <th>Date</th>
          
          <th>Time</th>
               
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
$result = mysql_query("SELECT * FROM FollowUp ") or die(mysql_error());
// store the record of the "tblstudent" table into $row
 
while ($row = mysql_fetch_array($result)) {
    // Print out the contents of the entry 
    $time=substr($row['FollowUp'],strlen($row['FollowUp'])-8,8);
    $date2=substr($row['FollowUp'],0,strlen($row['FollowUp'])-11);
        echo'<tr data-href="'.$row['Email'].'">
<td><span class="Name" id="Name" data-type="text" data-pk="'.$row['id'].'" data-url="updatename.php">'.$row['Name'].'</span></td>
<td><span class="Name" id="Email" data-type="text" data-pk="'.$row['id'].'" data-url="updatename.php">'.$row['Email'].'</span></td>
<td><span class="Name" id="Phone" data-type="text" data-pk="'.$row['id'].'" data-url="updatename.php">'.$row['Phone'].'</span></td>
<td><span class="Name" id="FromZip" data-type="text" data-pk="'.$row['id'].'" data-url="updatename.php">'.$row['FromZip'].'</span></td>
<td><span class="Name" id="ToZip" data-type="text" data-pk="'.$row['id'].'" data-url="updatename.php">'.$row['ToZip'].'</span></td>

<td>'.$date2.'</td>
<td>'.$time.'</td>
<td><a href="#" id="'.$row['id'].'" class="edit_button" font color="red" >Reschedule</a></td>
<td><a href="#" id="'.$row['id'].'" class="delete_button" font color="red" >Delete</a></td>

</tr>';
 
    }
   
   ?>
 
      </tbody>
 
      
    </table>
        </div>
            </div>

        </div>
        <div class="tab-pane" id="tab_c">
           <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Select Date to GoTo</h3>
  </div>
  <div class="panel-body">
  
     <div class="input-append date" id="dp3"  data-date-format="mm-dd-yyyy">
  <input class="datepicker" size="16" type="text" id="date" name="date" onKeyDown=”javascript:if (event.keyCode==13) makeAjaxRequest();” >
  <span class="add-on"><i class="icon-th"></i></span>
  <button  class="btn btn-primary" type="button" class="btnSearch"  id="btn4" onclick="makeAjaxRequest()" >Search</button>
   
  <table class="table table-striped" id="gotoTable">
      <thead>
        <tr>
          <th>Name</th>
 
          <th>Email</th>
 
          <th>Phone</th>
 
          <th>From Zip</th>
          
          <th>To Zip</th>  
          
          <th>Note</th>
          
          <th>Time</th>
               
            </tr>
      </thead>
 
      <tbody>
      </tbody>
  </table>
    </div>
</div>                
</div>
</div>
        <div class="tab-pane" id="tab_d">
            <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Search</h3>
  </div>
  <div class="panel-body">
  
     <div class="input-append date" id="dp3"  data-date-format="mm-dd-yyyy">
  <input class="search" size="25" type="text" id="search" name="search" placeholder="Email or Phone"  >
  <span class="add-on"><i class="icon-th"></i></span>
  <button   class="btn btn-primary" type="button" class="btnSearch2"  id="btn5" onclick="makeAjaxRequest2()"  >Search</button>
    
  <table class="table table-striped" id="gotoTable2">
      <thead>
        <tr>
          <th>Name</th>
 
          <th>Email</th>
 
          <th>Phone</th>
 
          <th>From Zip</th>
          
          <th>To Zip</th>  
          
          <th>Note</th>
          
          <th>Time</th>
               
            </tr>
      </thead>
 
      <tbody>
      </tbody>
  </table>
    </div>
</div>                
</div>
            </div>

            <div class="tab-pane" id="tab_e">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Search</h3>
                    </div>
                    <div class="panel-body">

                            <table class="table table-striped" id="gotoTable2">
                                <thead>
                                <tr>
                                    <th>Name</th>

                                    <th>Email</th>

                                    <th>Phone</th>

                                    <th>From Zip</th>

                                    <th>To Zip</th>

                                    <th>Note</th>

                                    <th>Time</th>

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
                                $result = mysql_query("SELECT * FROM FollowUp ORDER BY id DESC LIMIT 10 ") or die(mysql_error());
                                // store the record of the "tblstudent" table into $row

                                while ($row = mysql_fetch_array($result)) {
                                    // Print out the contents of the entry
                                    $time=substr($row['FollowUp'],strlen($row['FollowUp'])-8,8);
                                    $date2=substr($row['FollowUp'],0,strlen($row['FollowUp'])-11);
                                    echo'<tr data-href="'.$row['Email'].'">
<td><span class="Name" id="Name" data-type="text" data-pk="'.$row['id'].'" data-url="updatename.php">'.$row['Name'].'</span></td>
<td><span class="Name" id="Email" data-type="text" data-pk="'.$row['id'].'" data-url="updatename.php">'.$row['Email'].'</span></td>
<td><span class="Name" id="Phone" data-type="text" data-pk="'.$row['id'].'" data-url="updatename.php">'.$row['Phone'].'</span></td>
<td><span class="Name" id="FromZip" data-type="text" data-pk="'.$row['id'].'" data-url="updatename.php">'.$row['FromZip'].'</span></td>
<td><span class="Name" id="ToZip" data-type="text" data-pk="'.$row['id'].'" data-url="updatename.php">'.$row['ToZip'].'</span></td>

<td>'.$date2.'</td>
<td>'.$time.'</td>
<td><a href="#" id="'.$row['id'].'" class="edit_button" font color="red" >Reschedule</a></td>
<td><a href="#" id="'.$row['id'].'" class="delete_button" font color="red" >Delete</a></td>

</tr>';

                                }

                                ?>

                                </tbody>


</div><!-- tab content --> 
  </div><!-- /container -->
  
</div>  
  	</div>
</div>


</body>
</html>
