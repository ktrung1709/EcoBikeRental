<?php



require_once "utils/Utils.php";


class SessionManager {

    private static $instance; //singleton
    private $sessions = array();

    private function __construct() {
        $this->refreshSessionsList();
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new SessionManager();
        }
        return self::$instance;
    }

    public function createSession($bike, $card, $rentTransaction) {
        $newSession = new Session($bike, $card, $rentTransaction);
        $newSession->setActive(true);
        $this->insertNewSessions($newSession);
        $this->sessions[] = $newSession;
        return $newSession;
    }

    public function endSession($session, $returnTransaction) {
        $session->setEndTime(new DateTime());
        $session->setReturnTransaction($returnTransaction);

        $affectedRows = 0;

        $pdo = EBRDB::getConnection();

        $sql = "UPDATE session " . "SET end_time = ?, return_transactionid = ?" . "WHERE id = ?";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $session->getEndTime()->format(Utils::DATE_FORMATER));
            $stmt->bindValue(2, $session->getReturnTransaction()->getId());
            $stmt->bindValue(3, $session->getId());

            $stmt->execute();
            $affectedRows = $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }

        return $affectedRows;
    }

    public function getSessionById($id) {
        foreach ($this->sessions as $session) {
            if ($session->getId() == $id) {
                return $session;
            }
        }
        return null;
    }

    public function getSessions() {
        return $this->sessions;
    }

    private function insertNewSessions(Session $newSession) {
        $SQL = "INSERT INTO session(bike_id, card_id, rent_transactionid, start_time) "
            . "VALUES(:bikeId, :cardId, :rentTransactionId, :startTime)";
        $id = "";
        
        try {
            $conn = EBRDB::getConnection();
            $stmt = $conn->prepare($SQL);
            
            $bikeId = $newSession->getBike()->getId();
            $cardId = $newSession->getCard()->getId();
            $rentTransactionId = $newSession->getRentTransaction()->getId();
          
            $startTime = $newSession->getStartTime()->format(Utils::DATE_FORMATER);
    
            $stmt->bindParam(':bikeId', $bikeId);
            $stmt->bindParam(':cardId', $cardId);
            $stmt->bindParam(':rentTransactionId', $rentTransactionId);
            $stmt->bindParam(':startTime', $startTime);
            
            $stmt->execute();
            $generatedId = $conn->lastInsertId();
    
            if ($generatedId) {
                $id = strval($generatedId);
            }
    
            $stmt->closeCursor();
            $conn = null;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    
        $newSession->setId($id);
        return $id;
    }
    

    private function refreshSessionsList() {
        $sessions = array();
        $SQL = "SELECT * FROM session";
    
        try {
            $conn = EBRDB::getConnection();
            $stmt = $conn->query($SQL);
    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id = $row["id"];
                $bike_id = $row["bike_id"];
                $card_id = $row["card_id"];
                $rent_transactionid = $row["rent_transactionid"];
                $return_transactionid = $row["return_transactionid"];
                $start_time = $row["start_time"];
                $end_time = $row["end_time"];
                $last_rent_time_before_lock = $row["last_rent_time_before_lock"];
                $last_resume_time = $row["last_resume_time"];
                $active = $row["active"];
    
                $bike = BikeManager::getInstance()->getBikeById($bike_id);
                $card = CreditCardManager::getInstance()->getCardById($card_id);
    
                if ($return_transactionid == null || $end_time == null) {
                    $session = new Session(
                        $bike,
                        $card,
                        PaymentTransactionManager::getInstance()->getTransactionById($rent_transactionid),
                    );
                    $session->setId($id);
                    $session->setStartTime(new DateTime($start_time));
                } else {

                    $session = new Session(
                        $bike,
                        $card,
                        PaymentTransactionManager::getInstance()->getTransactionById($rent_transactionid),
                    );
                    $session->setId($id);
                    $session->setStartTime(new DateTime($start_time));
                    $session->setReturnTransaction(PaymentTransactionManager::getInstance()->getTransactionById($return_transactionid));
                    $session->setEndTime(new DateTime($end_time));
                }
    
                $session->setActive($active);
    
                if ($last_resume_time == null) {
                    $session->setLastResumeTime(new DateTime($start_time)); // Convert to DateTime object
                } else {
                    $session->setLastResumeTime(new DateTime($last_resume_time)); // Convert to DateTime object
                }
    
                $session->setLastRentTimeBeforeLock($last_rent_time_before_lock);
                $sessions[] = $session;
            }
    
            $stmt->closeCursor();
            $conn = null;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    
        $this->sessions = $sessions;
    }
    
    

    private function pauseSession(Session $session) {
        $realRentingTime = $session->getLastRentTimeBeforeLock() + Utils::minusLocalDateTime(
            $session->getLastResumeTime(),
            new DateTime()
        );
        $session->setLastRentTimeBeforeLock($realRentingTime);
        $session->setActive(false);

        $affectedRows = 0;

        $pdo = EBRDB::getConnection();

        $sql = "UPDATE session " .
            "SET last_rent_time_before_lock = ?, active = ? " .
            "WHERE id = ?";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $realRentingTime);
            $stmt->bindValue(2, false);
            $stmt->bindValue(3, $session->getId());

            $stmt->execute();
            $affectedRows = $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }

        return $affectedRows;
    }

    private function resumeSession(Session $session) {
        $session->setLastResumeTime(new DateTime());
        $session->setActive(true);

        $affectedRows = 0;

        $pdo = EBRDB::getConnection();

        $sql = "UPDATE session " .
            "SET active = ?, last_resume_time = ? " .
            "WHERE id = ?";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, true);
            $stmt->bindValue(2, $session->getLastResumeTime()->format(Utils::DATE_FORMATER));
            $stmt->bindValue(3, $session->getId());

            $stmt->execute();
            $affectedRows = $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }

        return $affectedRows;
    }

    public function switchSessionState(Session $session) {
        if ($session->isActive()) {
            $this->pauseSession($session);
        } else {
            $this->resumeSession($session);
        }
    }
}
