<?php
date_default_timezone_set('Asia/Bangkok');

$start_time_string = $_SESSION['startTime']; // Assuming this is a string in 'Y-m-d H:i:s' format

$sessionId = $_SESSION['sessionId'];


$sessionManager = SessionManager::getInstance();

$newSession = $sessionManager->getSessionById($sessionId);

$sessionEnded = ($newSession !== null && $newSession->getEndTime() !== null);
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
  <style>
    /* Kiểu cho khu vực chứa toàn bộ nội dung */
    .container {
      border: 3px solid #FF9966;
      border-radius: 15px;
      padding: 20px;
      margin: 50px auto;
      max-width: 970px;
      background-color: white;
      align-items: center;
      justify-content: center;
    }
      .custom-button {
      text-align: center; /* Center the buttons horizontally */
      margin-top: 20px; /* Add margin to space from clock */
    }

    #clockdiv {
      font-size: 36px;
      font-weight: bold;
      text-align: center;
      margin-top: 20px;
      margin-bottom: 20px;
      margin-left: auto;
      margin-right: auto;
      padding: 10px;
      background-color: #f2f2f2;
      border-radius: 10px;
      border: 2px solid #cccccc;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
      width: 200px;
      align-items: center;
    }

    /* Kiểu cho các nút */
    /* ... (Những phần CSS bạn đã có cho nút) */
    /* Kiểu cho nút "Start" */
    .custom-button{
      margin-left: auto;
      margin-right: auto;
      align-items: center;
      justify-content: center;
      align-content: center;
    }
     .custom-button button:disabled {
      opacity: 0.7; /* Reduce opacity for disabled buttons */
      cursor: not-allowed; /* Show "not-allowed" cursor for disabled buttons */
    }
    #start {
      background-color: #FFE4E1;
      color: black;
      border: none;
      border-radius: 6px;
      padding: 10px 20px;
      font-family: 'Arial Bold';
      font-size: 18px;
      cursor: pointer;
    }

    /* Kiểu hover cho nút "Start" */
    #start:hover {
      background-color: #DA70D6;
    }

    /* Kiểu cho nút "End Session" */
    #end {
      background-color: #FFE4E1;
      color: black;
      border: none;
      border-radius: 6px;
      padding: 10px 20px;
      font-family: 'Arial Bold';
      font-size: 18px;
      cursor: pointer;
    }

    /* Kiểu hover cho nút "End Session" */
    #end:hover {
      background-color: #DA70D6;
    }

    /* Kiểu cho nút "RETURN BIKE" */
    a {
      text-decoration: none;
      color: black;
    }

    .return-bike {
      background-color: #6699CC;
      color: black;
      border: none;
      border-radius: 6px;
      padding: 10px 20px;
      font-family: 'Arial Bold';
      font-size: 18px;
      text-decoration: none;
      cursor: pointer;
    }

    /* Kiểu hover cho nút "RETURN BIKE" */
    .return-bike:hover {
      background-color: #0056b3;
    }
  </style>

</head>

<body>

  <div class="container">
    <div id="clockdiv">00:00:00</div>
    <div class="custom-button">
      <button id="start">Start</button>
      <!-- <button id="pause">Pause</button>
    <button id="resume">Resume</button> -->
      <button id="end">End Session</button>
      <button class="return-bike"><a href="requestHandler.php?request=returningBikeToDock">RETURN BIKE</a></button>
    </div>

  </div>
    <script>
      var start_time = new Date("<?php echo $start_time; ?>");
      start_time.setTime(start_time.getTime() - (5 * 60 * 60 * 1000)); // Adding 7 hours in milliseconds
      // var last_pause_time = localStorage.getItem('lastPauseTime');
      // console.log("bro: ", last_pause_time)

      // if (last_pause_time) {
      //   last_pause_time = new Date(last_pause_time);
      //   const paused_duration = Math.floor((new Date() - last_pause_time) / 1000);
      //       start_time = new Date(start_time.getTime() + paused_duration * 1000);
      //       console.log("bro: ", paused_duration);
      //       console.log("bro11: ", start_time);
      //       localStorage.setItem('startTime',start_time);
      //       localStorage.removeItem('lastPauseTime');
      // }
      var end_time = null; // You might set this value based on your logic
      var sessionEnded = <?php echo $sessionEnded ? 'true' : 'false'; ?>;

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

      // function pause_clock() {
      //   last_pause_time = new Date(); // Update last pause time
      //   localStorage.setItem('lastPauseTime', last_pause_time);
      //   console.log("bro1: ", last_pause_time);



      //   clearInterval(interval);
      // }

      // function resume_clock() {
      //   const paused_duration = Math.floor((new Date() - last_pause_time) / 1000);
      //   start_time = new Date(start_time.getTime() + paused_duration * 1000);
      //   localStorage.removeItem('lastPauseTime');
      //   last_pause_time = null;
      //   interval = setInterval(update_clock, 1000);
      // }
      function disableButtons() {
        document.getElementById('start').disabled = true;
        // document.getElementById('pause').disabled = true;
        // document.getElementById('resume').disabled = true;
        document.getElementById('end').disabled = true;
      }

      function checkSessionStatus() {
        console.log("sessionEnded:", sessionEnded);
        console.log("start_time.getTime():", start_time.getTime());
        console.log("end_time:", end_time);
        if (sessionEnded) {
          end_time = new Date(); // Set end_time if the session has ended
          update_clock();
          disableButtons();
        }
      }


      function end_session() {
        end_time = new Date(); // Record end time in the database
        clearInterval(interval);
        document.getElementById('clockdiv').innerHTML = format_time(Math.floor((end_time - start_time) / 1000));
        disableButtons();
        // You can also update the end_time in the database using an AJAX request
        $.post("session_api.php", {
          action: "end",
          end_time: end_time.getTime()
        }, function(response) {
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

        // Start the clock if the session has started and hasn't ended
        if (start_time.getTime() > 0 && end_time === null) {

          interval = setInterval(update_clock, 1000);
          document.getElementById('start').disabled = true;
        } else if (end_time !== null) {
          update_clock();
          disableButtons(); // Disable buttons for ended sessions
        }

        // Check the session status
        checkSessionStatus();
      };

      document.getElementById('start').onclick = start_clock;
      // document.getElementById('pause').onclick = pause_clock;
      // document.getElementById('resume').onclick = resume_clock;
      document.getElementById('end').onclick = end_session;
    </script>

  


</body>

</html>