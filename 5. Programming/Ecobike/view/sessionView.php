<?php
date_default_timezone_set('Asia/Bangkok');

$start_time_string = $_SESSION['startTime']; // Assuming this is a string in 'Y-m-d H:i:s' format


// Create a DateTime object from the string
$start_time1 = new DateTime($start_time_string);

// Set the format for the DateTime object
$start_time = $start_time1->format('Y-m-d H:i:s');




?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Count-Up Timer with Session Control</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>

<div id="clockdiv">00:00:00</div>
<button id="start">Start</button>
<button id="pause">Pause</button>
<button id="resume">Resume</button>
<button id="end">End Session</button>

<!-- <button class="return-bike"><a href="requestHandler.php?request=returningBikeToDock&sessionId=?php echo $bike->getId(); ?>">RETURN BIKE</a></button> -->

<button class="return-bike"><a href="requestHandler.php?request=returningBikeToDock&sessionId=43">RETURN BIKE</a></button>

<script>
// Fake session data for demonstration
var start_time = new Date("<?php echo $start_time; ?>");
var last_pause_time ;
var end_time = new Date("") ;// You might set this value based on your logic
start_time.setTime(start_time.getTime() - (5 * 60 * 60 * 1000)); // Adding 7 hours in milliseconds
function format_time(seconds) {
  const hours = Math.floor(seconds / 3600);
  const minutes = Math.floor((seconds % 3600) / 60);
  const remainingSeconds = seconds % 60;
  return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
}

function update_clock() {
  const current_time = new Date();
  const elapsed_seconds = Math.floor((current_time - start_time) / 1000);
  document.getElementById('clockdiv').innerHTML = format_time(elapsed_seconds);
}

function start_clock() {
  interval = setInterval(update_clock, 1000);
  document.getElementById('start').disabled = true;
}

function pause_clock() {
  last_pause_time = new Date(); // Update last pause time
  clearInterval(interval);
}

function resume_clock() {
  const paused_duration = Math.floor((new Date() - last_pause_time) / 1000);
  start_time = new Date(start_time.getTime() + paused_duration * 1000);
  interval = setInterval(update_clock, 1000);
}

function end_session() {
  end_time = new Date(); // Record end time in the database
  clearInterval(interval);
  // You can also update the end_time in the database using an AJAX request
  $.post("session_api.php", { action: "end", end_time: end_time.getTime() }, function(response) {
  // Handle response from the server
  if (response === "success") {
    // Session ended successfully, update UI or perform other actions
    alert("Session ended successfully");
    console.error(response);
  } else {
    // Session end failed or unexpected response, handle accordingly
    alert("Session end failed");
    console.error(response);
  }
});

}

// On page load
window.onload = function() {
  // Start the clock if the session has started
  if (start_time.getTime() > 0 ) {
    interval = setInterval(update_clock, 1000);
    document.getElementById('start').disabled = true;
  }
};

document.getElementById('start').onclick = start_clock;
document.getElementById('pause').onclick = pause_clock;
document.getElementById('resume').onclick = resume_clock;
document.getElementById('end').onclick = end_session;
</script>

</body>
</html>
