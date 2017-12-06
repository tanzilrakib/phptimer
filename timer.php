<?php

	require "../config/config.php";
	require "../data/get-init.php";

?>

<!-- <div class="container"> -->
	<div id="bg-timer">

	<h3 class="text-center timer-field-label">Timer</h3>
	<div>
		<div class="col-xs-3 text-center timer-field" id="DD">--</div>
		<div class="col-xs-3 text-center timer-field" id="HH">--</div>
		<div class="col-xs-3 text-center timer-field" id="MM">--</div>
		<div class="col-xs-3 text-center timer-field" id="SS">--</div>
	</div>
	<div  class="row">
		<div class="col-xs-3 text-center timer-field-label label-14px">Days</div>
		<div class="col-xs-3 text-center timer-field-label label-14px">Hours</div>
		<div class="col-xs-3 text-center timer-field-label label-14px">Minutes</div>
		<div class="col-xs-3 text-center timer-field-label label-14px">Seconds</div>
	</div>

	</div>

	<h3 class="text-center">Set Timer</h3>
		
	<form id="settimerForm" method="post" action="data/save-timer.php">
		<div class="row">
			<div class="form-group">
			  <!-- <label class="control-label col-sm-offset-3 col-sm-3" for="company">Company</label> -->
			  <div class="col-sm-3 col-md-3">
			    <select id="days" id="name" class="form-control">
			    	<?php for($i=0;$i<=30;$i++){
			    		echo '<option>'. sprintf('%02d', $i) .'</option>';
		    		}?>
			    </select> 
			  </div>
			  <div class="col-sm-3 col-md-3">
			    <select id="hours" name="hours" class="form-control">
			    	<?php for($i=0;$i<=24;$i++){
			    		echo '<option>'. sprintf('%02d', $i) .'</option>';
		    		}?>
			    </select> 
			  </div>
			  <div class="col-sm-3 col-md-3">
			    <select id="minutes" name="minutes" class="form-control">
			    	<?php for($i=0;$i<=60;$i++){
			    		echo '<option>'. sprintf('%02d', $i) .'</option>';
		    		}?>
			    </select> 
			  </div>
			  <div class="col-sm-3 col-md-3">
			    <select id="seconds" name="seconds" class="form-control">
			    	<?php for($i=0;$i<=60;$i++){
			    		echo '<option>'. sprintf('%02d', $i) .'</option>';
		    		}?>
			    </select> 
			  </div>
			</div>
		</div>

		<div class="row margin-20 text-center">
			<input hidden="true" name="finish-time" id="finish-time">
			<!-- <input class="btn btn-primary" type="submit" name="settime" id="settimerBtn" value="Start"> -->
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#setConfirm">Start</button>

			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#resetConfirm">Reset</button>
		</div>
	</form>



  <!-- Modal -->
  <div class="modal fade" id="setConfirm" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Set Timer?</h4>
        </div>
        <div class="modal-body text-center">
          <p>
          <button type="button" id="btnYes" class="btn btn-primary" data-dismiss="modal">Yes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          </p>
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="resetConfirm" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reset Timer?</h4>
        </div>
        <div class="modal-body text-center">
          <p>
          <button type="button" id="btnReset" class="btn btn-danger" data-dismiss="modal">Yes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          </p>
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>
</div>

<!-- </div> -->
<script type="text/javascript">
	window.onload = function () { 

	var data = JSON.parse('<?php echo json_encode($row) ?>');

		setStyles();

		var start = new Date(data['start_from']);
		var end = new Date(data['finish_at']);
		
		setInterval(checkClock, 1000);

		function checkClock() {

			var now = new Date();

			if(start<end && end>=now){
				var diff = end-now;
				var daysLeft = Math.floor(diff/(1000*60*60*24));
				var hoursLeft = Math.floor( (diff%(1000*60*60*24)) / (1000*60*60));
				var minutesLeft = Math.floor( (diff%(1000*60*60)) / (1000*60));
				var secondsLeft = Math.floor( (diff%(1000*60)) / 1000);
				setHtml(daysLeft,hoursLeft,minutesLeft,secondsLeft);
			} else {
				resetHtml();
			}

		}

		function setHtml(dd,hh,mm,ss){
			 document.getElementById('DD').innerHTML = dd;
			 document.getElementById('HH').innerHTML = hh;
			 document.getElementById('MM').innerHTML = mm;
			 document.getElementById('SS').innerHTML = ss;
		}

		function resetHtml(){
			 document.getElementById('DD').innerHTML = '--';
			 document.getElementById('HH').innerHTML = '--';
			 document.getElementById('MM').innerHTML = '--';
			 document.getElementById('SS').innerHTML = '--';
		}


		document.getElementById('btnYes').addEventListener("click", function(event){
    		event.preventDefault();

    		var current = new Date();

			timerDays = document.getElementById('days').value;
			timerHours = document.getElementById('hours').value;
			timerMinutes = document.getElementById('minutes').value;
			timerSeconds = document.getElementById('seconds').value;

			var next = timerDateFormat(timerDays, timerHours, timerMinutes, timerSeconds );
			
			document.getElementById('finish-time').value = next;
			document.getElementById('settimerForm').submit();

		});

		document.getElementById('btnReset').addEventListener("click", function(event){
    		event.preventDefault();
			var next = timerDateFormat(0, 0, 0, 0);
			document.getElementById('finish-time').value = next;
			document.getElementById('settimerForm').submit();

		});

		function timerDateFormat( timerDays, timerHours, timerMinutes, timerSeconds ){
			return new Date(Date.now() + timerDays*24*60*60*1000  + timerHours*60*60*1000  + timerMinutes*60*1000 + timerSeconds*1000 );
		}

		document.getElementById('cbcolor').addEventListener("change", function(event){
			var timerFields = document.getElementsByClassName("timer-field");
			for (var i = 0; i < timerFields.length; i++) {
			  timerFields[i].style.backgroundColor = document.getElementById('cbcolor').value;
			}
		});

		document.getElementById('ccolor').addEventListener("change", function(event){
			var timerFields = document.getElementsByClassName("timer-field");
			for (var i = 0; i < timerFields.length; i++) {
			  timerFields[i].style.color = document.getElementById('ccolor').value;
			}
		});

		document.getElementById('fontsize').addEventListener("change", function(event){
			var timerFields = document.getElementsByClassName("timer-field");
			for (var i = 0; i < timerFields.length; i++) {
			  timerFields[i].style.fontSize = document.getElementById('fontsize').value+"px";
			}
		});

		document.getElementById('lcolor').addEventListener("change", function(event){
			var timerLabelFields = document.getElementsByClassName("timer-field-label");
			for (var i = 0; i < timerLabelFields.length; i++) {
			  timerLabelFields[i].style.color = document.getElementById('lcolor').value;
			}
		});


		function setStyles(){

			var timerFields = document.getElementsByClassName("timer-field");
			for (var i = 0; i < timerFields.length; i++) {
			  timerFields[i].style.fontSize = data['fontsize']+"px";
			  timerFields[i].style.backgroundColor = data['cbcolor'];
			  timerFields[i].style.color = data['ccolor'];

			}
			var timerLabelFields = document.getElementsByClassName("timer-field-label");
			for (var i = 0; i < timerLabelFields.length; i++) {
			  timerLabelFields[i].style.color = data['lcolor'];
			}

			document.getElementById('bg-timer').style.backgroundImage = "url('"+  data['cbimage'] + "')";

		}


		document.getElementById('rm-img').addEventListener("click", function(event){
    		event.preventDefault();
    		// alert('ok');
    		document.getElementById('rm-img-form').submit();

    	});

    	
		document.getElementById("cbimage").addEventListener("change", function(event){
			// alert('ok');
		  readURL(this);
		});

	
		function readURL(input) {

		  if (input.files && input.files[0]) {
		    var reader = new FileReader();

		    reader.onload = function(event) {
		      // document.getElementById('bg-timer').setAttribute('src', event.target.result);
		      document.getElementById('bg-timer').style.backgroundImage = "url('"+ event.target.result + "')";
		    }

		    reader.readAsDataURL(input.files[0]);
		  }
		}





		}





</script>