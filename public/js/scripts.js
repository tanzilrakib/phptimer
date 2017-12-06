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

		}

		}
		