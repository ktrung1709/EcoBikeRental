<?php

class SessionViewController {
    public function displaySessionView() {
        

        include 'view/sessionView.php';

    }

    public function processSession(){
        $sessionId = $_SESSION['sessionId'];

$sessionManager = SessionManager::getInstance();

$newSession = $sessionManager->getSessionById($sessionId);
$userTimeZone = new DateTimeZone('Asia/Bangkok'); // Replace with your time zone
$start_time = $newSession->getStartTime()->setTimezone($userTimeZone)->format('Y-m-d H:i:s');
      $_SESSION['startTime'] = $start_time;
      header("Location: requestHandler.php?request=viewSession");
      exit;


    }
   


}