<?PHP
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
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
  <title>Agenda</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/jquery-impromptu.css" rel="stylesheet">
		<link rel="stylesheet" href="css/calendar.css">
	<link href='css/fullcalendar.css' rel='stylesheet' />	
	<link href="css/alertify.default.css" rel="stylesheet">
	<link href="css/bootstrap-editable.css" rel="stylesheet">
	<link type="text/css" href="css/bootstrap-timepicker.css" />	  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="img/favicon.png">
  	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  		<script type="text/javascript" src="js/jquery.min.js"></script>
	<script src='js/fullcalendar.js'></script>
	<script type="text/javascript" src="js/alertify.js"></script>
	<script type="text/javascript" src="js/jquery-impromptu.js"></script>
	<script type="text/javascript" src="js/jasny-bootstrap.js"></script>
	<script type="text/javascript" src="js/bootstrap-timepicker.js"></script>
	<script type="text/javascript" src="js/jquery.blockUI.js"></script>
	<script src='js/jquery-ui.custom.min.js'></script>
	<script src='js/Gruntfile.js'></script>
	<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>	
		
	<script type="text/javascript" src="js/bootstrap-editable.js"></script>
			<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript" src="js/underscore-min.js"></script>
    <script type="text/javascript" src="js/calendar.js"></script>
    <script src='js/jqBootstrapValidation.js'></script>
    <style>
    div.pac-container {
   z-index: 1051 !important;
}    </style>
    <script type="text/javascript">
function initialize() {
    var input = document.getElementById("startaddress1");
    var options = {componentRestrictions: {country: 'us'}};
                 
    new google.maps.places.Autocomplete(input, options);
}
             
google.maps.event.addDomListener(window, 'load', initialize);
</script>
 <script type="text/javascript">
function initialize() {
    var input = document.getElementById("endaddress1");
    var options = {componentRestrictions: {country: 'us'}};
                 
    new google.maps.places.Autocomplete(input, options);
}
             
google.maps.event.addDomListener(window, 'load', initialize);
</script>
 <script type="text/javascript">
function initialize() {
    var input = document.getElementById("stop11");
    var options = {componentRestrictions: {country: 'us'}};
                 
    new google.maps.places.Autocomplete(input, options);
}
             
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script type="text/javascript">
            $('#timepicker4').timepicker({
                minuteStep: 1,
                secondStep: 5,
                showInputs: false,
                template: 'modal',
                modalBackdrop: true,
                showSeconds: true,
                showMeridian: false
            });
        </script>
        <script>
                $(function() {
                    $('#time1').timepicker();
                });
            </script>
             

 <script type="text/javascript">
function initialize() {
    var input = document.getElementById("stop22");
    var options = {componentRestrictions: {country: 'us'}};
                 
    new google.maps.places.Autocomplete(input, options);
}
             
google.maps.event.addDomListener(window, 'load', initialize);
</script>

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
    <script type="text/javascript">   
    function verifyAdd(address3)
    {  
   
   var address = address3;
   
      
			$.ajax({
				url: 'https://api.smartystreets.com/street-address',
				dataType: 'JSONP',  // NOTE: This is what allows the cross-domain ajax call.
				data: {
					'auth-token': '1834853838104465515',      // Put your HTML Key in this input
					'street': address
										
				},
				success: function (data, status, xhr) {
					
					if (data.length == 0){alert("Wrong Address: "+address);}
					else{return 1;}					
										
				}
			});
							   }   
</script>    
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
function deleteevent(){
		$('#myModal').modal('hide');
		var decision = confirm("Do you really want to delete event?"); 
if (decision) {
$.ajax({
type: "POST",
url: "delete_events.php",

data: "&id=" + iden,
});
$('#calendar').fullCalendar('removeEvents', iden);

} else {
}
		    
              
          
   }    

</script>
         <script>
   
   function updateEvent(){
		$('#myModal').modal('hide');
				var title=$('#title1').val();
      var name=$('#name1').val();
      var phone1=$('#phone11').val();
      var phone2=$('#phone22').val(); 
       var startaddress=$('#startaddress1').val(); 
       var endaddress=$('#endaddress1').val();
        var stop1=$('#stop11').val();  
         var stop2=$('#stop22').val();
         var deposit=$('#deposit1').val(); 
         var billrate=$('#billingrate1').val();
         var servicefee=$('#servicefee1').val(); 
         var flatrate=$('#flatrate1').val();
         var weight=$('#weight1').val();
         var extra=$('#extras1').val();  
         var staff=$('#staff1').val();   
         var truck=$('#truck1').val(); 
         var creditno=$('#credit1').val();  
         var expire=$('#expire1').val();         
         var cvv=$('#cvv1').val();
         var zip=$('#zip1').val(); 
          var source=$('#source1').val();  
          var state=$('#state1').val(); 
          var note=$('#note1').val();
          var time3=$('#time3').val();
                    var temp='19';		
		$.ajax({
		url: 'http://msoperation.com/updatecal.php',
   data: 'title='+ title +'&name='+ name +'&phone1=' +phone1 +'&phone2='+ phone2 +'&startaddress='+ startaddress+'&endaddress='+ endaddress +'&stop1='+ stop1 +'&stop2='+ stop2 +'&deposit='+ deposit +'&billrate='+ billrate +'&servicefee='+ servicefee +'&flatrate='+ flatrate+'&weight='+ weight +'&extra='+ extra +'&staff='+ staff +'&truck='+ truck +'&creditno='+ creditno +'&expire='+ expire +'&cvv='+ cvv +'&zip='+ zip +'&source='+ source+'&state='+ state +'&note='+ note +'&id='+iden+"&time3="+time3,
   type: "POST",
   success:function(json) {
   location.reload();
      }
		
		
		});        //Stop form submission & check the validation
              
          
  }    

</script>
<script type="text/javascript"> 
function verifyAddress(var string1)
{    
   var geocoder = new google.maps.Geocoder();
   var address = string1;

   if (geocoder) {
      geocoder.geocode({ 'address': address }, function (results, status) {
         if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
            alert("Geocoding failed: " + status);         }
         else {
            alert("Geocoding success: " + status);
         }
      });
   }    
</script>

    <script>

 $(document).ready(function() {
  var date = new Date();
  var d = date.getDate();
  var m = date.getMonth();
  var y = date.getFullYear();
  var title1;
   var url1;
   var name,phone1,phone2;
  var calendar = $('#calendar').fullCalendar({
   editable: true,
   header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,agendaWeek,agendaDay'
   },
   
   events: "http://msoperation.com/events.php",
   
   // Convert the allDay from string to boolean
   eventRender: function(event, element, view) {
   	   
       if (event.allDay == 'true') {
     event.allDay = true;
         } else {
     event.allDay = false;
    }
    
    
      if(event.state == "michigan" && event.stopaddress2 != "m0x0x0x0x") {
                if(event.hour =="AM")
                    element.css('background-color', '#A9D0F5');
                    if(event.hour =="PM")
                    element.css('background-color', '#0080FF');
                                    }                
                if(event.state == "illinois" && event.stopaddress2 != "m0x0x0x0x") {
                if(event.hour== "AM")
                    element.css('background-color', '#BFF5A6');
                    if(event.hour =="PM")
                    element.css('background-color', '#31B404');
                                    } 
                
   if(event.state == "florida" && event.stopaddress2 != "m0x0x0x0x") {
   				if(event.hour =="AM")
                    element.css('background-color', '#FFDA7A');
                     if(event.hour =="PM")
                    element.css('background-color', '#FFB700');
                                    }  
                  
                  if(event.stopaddress2 == "m0x0x0x0x")
                  {
	                element.css('background-color', '#D461F7');  
                  }
                
             
                
                  },
     
   selectable: true,
   selectHelper: true,
   select: function(start, end, allDay) {
   

$('#myModal2').modal('show');
$( "#createbutton" ).click(function() {
  $('#myModal2').modal('hide');
  
  $.blockUI({message: 'Saving to Calendar. Please Wait.', css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } }); 
});
$('#myModal2').on('hide.bs.modal', function (e) {

title=$('#title').val();
name=$('#name').val();
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
           if (name) {
    start = $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
    end = $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");
    
    var varname = '<?php  echo $_SESSION['userid']; ?>';
   $.ajax({
   url: 'http://msoperation.com/add_events.php',
   data: 'title='+ title+'&start='+ start +'&end='+ end +'&url='+ url +'&name='+ name +'&phone1=' +phone1 +'&phone2='+ phone2 +'&startaddress='+ startaddress+'&endaddress='+ endaddress +'&stop1='+ stop1 +'&stop2='+ stop2 +'&deposit='+ deposit +'&billrate='+ billrate +'&servicefee='+ servicefee +'&flatrate='+ flatrate+'&weight='+ weight +'&extra='+ extra +'&staff='+ staff +'&truck='+ truck +'&creditno='+ creditno +'&expire='+ expire +'&cvv='+ cvv +'&zip='+ zip +'&source='+ source+'&state='+ state +'&note='+ note +'&userid='+ varname+'&time='+time,
   type: "POST",
   success: function() {
    $.unblockUI();
	window.location.href = "http://msoperation.com/Event3.php";//location.reload(true);
  
         }
   });
               $('#myModal2').unbind('hide.bs.modal');
               calendar.fullCalendar('renderEvent',
   {
   title: title,
   start: start,
   end: end,
   allDay: allDay
     
      },
   true // make the event "stick"
   
   );
}	
calendar.fullCalendar('unselect');
  // do something...
});


   },
   
   editable: true,
   eventDrop: function(event, delta) {
	   
      var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
   var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
   $.ajax({
   url: 'http://msoperation.com/update_events.php',
   data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
   type: "POST",
   success: function(json) {
       }
   });
   
   },
   
   eventClick: function(event) {
   iden=event.id;
   

$.ajax({
type: "POST",
url: "fetchcal.php",

data: "&id=" + event.id,
dataType: 'json',
success: function(data)          //on recieve of reply
      {
	if (data[10]!="m0x0x0x0x") {
	/*var timeString;
	var temp2=data[1];
	var timetemp=temp2.substr(11,temp2.length);
	var H = +timetemp.substr(0, 2);
	var h = (H % 12) || 12;
	var ampm = H < 12 ? "AM" : "PM";
	if(H<10)
	{
		timeString = "0" + h + timeString.substr(2, 3) +" "+ampm;		
	}
	else
	{
	timeString = h + timeString.substr(2, 3) +" "+ampm;
	}*/
	 $('#time3').val(data[27]);
	 $('#title1').val(data[0]);
      $('#name1').val(data[4]);
      $('#phone11').val(data[5]);
      $('#phone22').val(data[6]); 
       $('#startaddress1').val(data[7]); 
       $('#endaddress1').val(data[8]);
        $('#stop11').val(data[9]);  
         $('#stop22').val(data[10]);
         $('#deposit1').val(data[11]); 
         $('#billingrate1').val(data[12]);
         $('#servicefee1').val(data[13]); 
         $('#flatrate1').val(data[14]);
         $('#weight1').val(data[15]);
         $('#extras1').val(data[16]);  
         $('#staff1').val(data[17]);   
         $('#truck1').val(data[18]); 
         $('#credit1').val(data[19]);  
         $('#expire1').val(data[20]);         
         $('#cvv1').val(data[21]);
         $('#zip1').val(data[22]); 
          $('#source1').val(data[23]);  
          $('#state1').val(data[24]);
           
          $('#note1').val(data[25]);
		   $('#codelabel').text("Job Code: "+data[28]);
         $('#namelabel').text("Name: "+data[4]);
         $('#phonelabel').text("Phone: "+data[5]);
         $('#fromaddresslabel').text("From: "+data[7]);
         $('#toaddresslabel').text("To: "+data[8]);
         $('#stafflabel').text("Number of Staff: "+data[17]);
         $('#trucklabel').text("Number of Trucks: "+data[18]);
         $('#billingratelabel').text("Billing Rate: "+data[12]);
         $('#datelabel').text("Date-Time: "+data[1]);
         $('#servicefeelabel').text("Service Fee: "+data[13]);
         $('#userid1').text(data[26]);
                  
                                                      $('#myModal').modal('show');
	}
	else
	{
	  $('#funamelabel').text("Name: "+data[0]);
	  $('#fuemaillabel').text("Email: "+data[4]);
	  $('#fuphonelabel').text("Phone: "+data[5]);
	  $('#fufromziplabel').text("From Zip: "+data[6]);
	  $('#futoziplabel').text("To Zip: "+data[7]);
	  $('#fudatelabel').text("Date: "+data[8]);
	  $('#funotelabel').text("Note: "+data[9]);
	  $('#myModal4').modal('show');
	}
      
                                                                                       	   
                           }  
      });



},      
   
      eventResize: function(event) {
   
      var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
   var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
   $.ajax({
    url: 'http://msoperation.com/update_events.php',
    data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
    type: "POST",
    success: function(json) {
     
    }
   });

}
   
  });
  
 });

</script>
<script>
$("#myModal").on('hidden.bs.modal', function () {
    $(this).data('bs.modal', null);
});
</script>
<style>

 body {
  margin-top: 1px;
  text-align: center;
  font-size: 14px;
  font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;

  }


 #calendar {
  width: 900px;
  margin: 0 auto;
  }

</style>
    </head>

<body>
 <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">See Event</h4>
        </div>
        <div class="modal-body">
        <ul class="nav nav-tabs">
  <li ><a href="#tab_a" data-toggle="tab">Client</a></li>
  <li><a href="#tab_b" data-toggle="tab">Locations</a></li>
  <li><a href="#tab_c" data-toggle="tab">Attributes</a></li>
  <li><a href="#tab_d" data-toggle="tab">Billing</a></li>
  <li><a href="#tab_e" data-toggle="tab">State</a></li>
  <li class="active"><a href="#tab_f" data-toggle="tab">Summary</a></li>
  </ul> 
  <div class="tab-content">
        <div class="tab-pane" id="tab_a">
        <h4><span class="label label-default">Time</span></h4>
                 <select id="time3" class="form-control">
	      <option>10:00 AM</option>
	      <option>09:00 AM</option>
  <option>06:30 AM</option>
  <option>07:00 AM</option>
  <option>07:30 AM</option>
  <option>08:00 AM</option>
  <option>08:30 AM</option>
  <option>09:00 AM</option>
  <option>09:30 AM</option>
  <option>10:00 AM</option>
  <option>10:30 AM</option>
  <option>11:00 AM</option>
  <option>11:30 AM</option>
  <option>12:00 PM</option>
  <option>12:30 PM</option>
  <option>01:00 PM</option>
  <option>01:30 PM</option>
  <option>02:00 PM</option>
  <option>02:30 PM</option>
  <option>03:00 PM</option>
  <option>03:30 PM</option>
  <option>04:00 PM</option>
  <option>04:30 PM</option>
  <option>05:00 PM</option>
  <option>05:30 PM</option>
  <option>06:00 PM</option>
   <option>06:30 PM</option>
  <option>07:00 PM</option>
  <option>07:30 PM</option>
  <option>08:00 PM</option>
  
    </select>

          
                         <h4><span class="label label-default">Title</span></h4>
            <input type="text" name="title1" id="title1" class="form-control" data-validation-required-message="Field required" required/>
        
            <h4><span class="label label-default">Customer Name</span></h4>
              <input type="text" name="name1" id="name1" class="form-control">
            <h4><span class="label label-default">Phone 1</span></h4>
            <input type="text" name="phone11" id="phone11" data-mask="9999999999" class="form-control">
            <h4><span class="label label-default">Phone 2</span></h4>
            <input type="text" name= "phone22" id="phone22" data-mask="9999999999" class="form-control">
            <h4><span class="label label-default">Special Info</span></h4>
            <textarea name='note1' id="note1" class="form-control"></textarea>        
        </div>
         <div class="tab-pane" id="tab_b"> 
          <h4><span class="label label-default">Start Address</span></h4>
            <textarea id="startaddress1" name="startaddress1" class="form-control"></textarea> 
           <h4><span class="label label-default">End Address</span></h4>
            <textarea id="endaddress1" name="endaddress1" class="form-control"></textarea> 
             <h4><span class="label label-default">Stop Address 1</span></h4>
            <textarea id="stop11"  class="form-control"></textarea>    
            <h4><span class="label label-default">Stop Address 2</span></h4>
            <textarea id="stop22" class="form-control"></textarea> 
         </div>
         
         <div class="tab-pane" id="tab_c">  
              
             <h4><span class="label label-default">Deposit</span></h4>
            <input type="text" name="title1" id="deposit1" class="form-control">
        
            <h4><span class="label label-default">Billing Rate</span></h4>
              <input type="text" name="billingrate1" id="billingrate1" class="form-control">
            <h4><span class="label label-default">Service Fee</span></h4>
            <input type="text" name="servicefee1" id="servicefee1" class="form-control">
            <h4><span class="label label-default">Flat Rate</span></h4>
            <input type="text" name= "flatrate1" id="flatrate1" class="form-control">
            <h4><span class="label label-default">Estimated Weight</span></h4>
            <input type="text" name= "weight1" id="weight1" class="form-control">
            <h4><span class="label label-default">Extras</span></h4>
            <input type="number" name= "extras1" id="extras1" class="form-control">  
            <h4><span class="label label-default"># of Staff</span></h4>
            <input type="text" name= "staff1" id="staff1" class="form-control">
            <h4><span class="label label-default"># of Trucks</span></h4>
            <input type="text" name= "truck1" id="truck1" class="form-control">    
        </div>
        
        <div class="tab-pane" id="tab_d">  
              
             <h4><span class="label label-default">Credit Card Number</span></h4>
            <input type="text" name="credit1" id="credit1" class="form-control">
        
            <h4><span class="label label-default">Expiry Date</span></h4>
              <input type="text" name="expire1" id="expire1" class="form-control">
              <h4><span class="label label-default">CVV</span></h4>
            <input type="text" name= "cvv1" id="cvv1" class="form-control">
            <h4><span class="label label-default">Billing Zip Code</span></h4>
            <input type="text" name= "zip1" id="zip1" data-mask="999999" class="form-control"> 
                
        </div>
        
        <div class="tab-pane" id="tab_e">  
  
            <h4><span class="label label-default">Source</span></h4>
              <select id="source1" class="form-control">
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
            <select id="state1" class="form-control">
  <option>michigan</option>
  <option>illinois</option>
  <option>florida</option>
</select>
 <h4><span class="label label-default">Entered By</span></h4>
            <h3><span class="label label-primary" name= "userid1" id="userid1" class="form-control"></h3>          
                
        </div>
        
        <div class="tab-pane active" id="tab_f">  
			<h3><span class="label label-primary" id="codelabel"></span></h3>
			<h3><span class="label label-primary" id="namelabel"></span></h3>
			<h3><span class="label label-primary" id="phonelabel"></span></h3>
			<h3><span class="label label-primary" id="fromaddresslabel"></span></h3>
			<h3><span class="label label-primary" id="toaddresslabel"></span></h3> 
			<h3><span class="label label-primary" id="stafflabel"></span></h3> 
			<h3><span class="label label-primary" id="trucklabel"></span></h3>
			<h3><span class="label label-primary" id="billingratelabel"></span></h3>
			<h3><span class="label label-primary" id="servicefeelabel"></span></h3>    
			<h3><span class="label label-primary" id="datelabel"></span></h3>        
                
        </div>

        
                                     		 			 		   		   		   		   		             
    
    <span class="add-on"><i class="icon-th"></i></span>
</div>
 
                                  

         
        </div>
        <div class="modal-footer">
            
                 <button type="button" class="btn btn-warning" data-dismiss="modal"id="closebutton">Close</button>
                  <button type="button" class="btn btn-success"  id="updatebutton" onclick="updateEvent();">Update</button> 
                 <button type="button" class="btn btn-danger"  id="deletebutton" onclick="deleteevent();">Delete</button>            
                         </div>
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
        
        <h4><span class="label label-default">Time</span></h4>
            <select id="time2" class="form-control">
	      <option>10:00 AM</option>
	      <option>09:00 AM</option>
  <option>06:30 AM</option>
  <option>07:00 AM</option>
  <option>07:30 AM</option>
  <option>08:00 AM</option>
  <option>08:30 AM</option>
  <option>09:00 AM</option>
  <option>09:30 AM</option>
  <option>10:00 AM</option>
  <option>10:30 AM</option>
  <option>11:00 AM</option>
  <option>11:30 AM</option>
  <option>12:00 PM</option>
  <option>12:30 PM</option>
  <option>01:00 PM</option>
  <option>01:30 PM</option>
  <option>02:00 PM</option>
  <option>02:30 PM</option>
  <option>03:00 PM</option>
  <option>03:30 PM</option>
  <option>04:00 PM</option>
  <option>04:30 PM</option>
  <option>05:00 PM</option>
  <option>05:30 PM</option>
  <option>06:00 PM</option>
   <option>06:30 PM</option>
  <option>07:00 PM</option>
  <option>07:30 PM</option>
  <option>08:00 PM</option>
  
    </select>

          
                         <h4><span class="label label-default">Title</span></h4>
            <input type="text" name="title1" id="title" class="form-control" data-validation-required-message="Field required" required>
        
            <h4><span class="label label-default">Customer Name</span></h4>
              <input type="text" name="name1" id="name" class="form-control">
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
            
                 
                  <button type="button" class="btn btn-success"  id="createbutton" >Schedule</button> 
                             
                         </div>
                         </div>
                         
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
  <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Follow Up Summary</h4>
        </div>
        <div class="modal-body">
          
          <h3><span class="label label-primary" id="namelabel"></span></h3>
			<h3><span class="label label-primary" id="funamelabel"></span></h3>
			<h3><span class="label label-primary" id="fuemaillabel"></span></h3>
			<h3><span class="label label-primary" id="fuphonelabel"></span></h3> 
			<h3><span class="label label-primary" id="fufromziplabel"></span></h3> 
			<h3><span class="label label-primary" id="futoziplabel"></span></h3>
			<h3><span class="label label-primary" id="fudatelabel"></span></h3>
			<h3><span class="label label-primary" id="funotelabel"></span></h3>    
			
        </div>
        <div class="modal-footer">
            
                 
                
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>            
                         </div>
                         
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  
  
  
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
				
			
 <!-- Button trigger modal -->			 <div id='calendar'></div>    
			 	</div>
</div>
</body>
</html>
