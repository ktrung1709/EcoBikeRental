<?php
require_once 'StandardBike.php';
require_once 'TwinBike.php';
require_once 'StandardElectricalBike.php';
require_once 'TwinElectricalBike.php';
require_once 'model/dock/DockManager.php';
require_once 'model/db/EBRDB.php';

class BikeManager {
    private static $instance;
    private $bikeList = array();
    const STANDARD_BIKE_CODE = 1;
    const TWIN_BIKE_CODE = 2;
    const STANDARD_ELECTRICAL_BIKE_CODE = 3;
    const TWIN_ELECTRICAL_BIKE_CODE = 4;

    private function __construct() {
        $this->refreshBikeList();
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new BikeManager();
        }
        return self::$instance;
    }

    public function getBikeList() {
        return $this->bikeList;
    }

    public function setBikeList($bikeList) {
        $this->bikeList = $bikeList;
    }

    public function addBike($bike) {
        $this->bikeList[] = $bike;
    }

    public function removeBike($bike) {
        $index = array_search($bike, $this->bikeList);
        if ($index !== false) {
            array_splice($this->bikeList, $index, 1);
        }
    }

    public function refreshBikeList() {
        $sql = "SELECT * FROM bike
                LEFT JOIN e_bike on bike.id = e_bike.bike_id";
        try {
            $connection = EBRDB::getConnection();
            $statement = $connection->prepare($sql);
            $statement->execute();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $bike = null;
                switch ($row['type']) {
                    case self::STANDARD_BIKE_CODE:
                        $bike = $this->createStandardBike($row);
                        break;
                    case self::TWIN_BIKE_CODE:
                        $bike = $this->createTwinBike($row);
                        break;
                    case self::STANDARD_ELECTRICAL_BIKE_CODE:
                        $bike = $this->createStandardElectricalBike($row);
                        break;
                    case self::TWIN_ELECTRICAL_BIKE_CODE:
                        $bike = $this->createTwinElectricalBike($row);
                        break;
                    default:
                        break;
                }
                if ($bike != null) {
                    $this->bikeList[] = $bike;
                }
            }
        } catch (PDOException $exception) {
            $exception->getMessage();
        }
    }

    public function getBikeListInDock($dockId) {
        $sql = "SELECT * FROM bike
                LEFT JOIN e_bike on bike.id = e_bike.bike_id
                WHERE dock_id = :dockId";
        $bikeListOfDock = array();

        try {
            $connection = EBRDB::getConnection();
            $statement = $connection->prepare($sql);
            $statement->bindValue(':dockId', $dockId, PDO::PARAM_STR);
            $statement->execute();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $bike = null;
                switch ($row['type']) {
                    case self::STANDARD_BIKE_CODE:
                        $bike = $this->createStandardBike($row);
                        break;
                    case self::TWIN_BIKE_CODE:
                        $bike = $this->createTwinBike($row);
                        break;
                    case self::STANDARD_ELECTRICAL_BIKE_CODE:
                        $bike = $this->createStandardElectricalBike($row);
                        break;
                    case self::TWIN_ELECTRICAL_BIKE_CODE:
                        $bike = $this->createTwinElectricalBike($row);
                        break;
                    default:
                        break;
                }
                if ($bike != null) {
                    $bikeListOfDock[] = $bike;
                }
            }
        } catch (PDOException $exception) {
            $exception->getMessage();
        }
        return $bikeListOfDock;
    }

    private function createStandardBike($row) {
        $bike = new StandardBike(
            $row['id'],
            $row['barcode'],
            $row['value'],
            $row['rental_fees']
        );
        $bike->setPairOfPedals($row['pedal_num']);
        $bike->setSaddle($row['saddle_num']);
        $bike->setDockId($row['dock_id']);
        $bike->setRearSeat($row['rear_seat_num']);
        $bike->setImageURL($row['image_url']);
        return $bike;
    }

    private function createTwinBike($row) {
        $bike = new TwinBike(
            $row['id'],
            $row['barcode'],
            $row['value'],
            $row['rental_fees']
        );
        $bike->setPairOfPedals($row['pedal_num']);
        $bike->setSaddle($row['saddle_num']);
        $bike->setRearSeat($row['rear_seat_num']);
        $bike->setDockId($row['dock_id']);
        $bike->setImageURL($row['image_url']);
        return $bike;
    }

    private function createStandardElectricalBike($row) {
        $bike = new StandardElectricalBike(
            $row['id'],
            $row['barcode'],
            $row['value'],
            $row['rental_fees']
        );
        $bike->setPairOfPedals($row['pedal_num']);
        $bike->setSaddle($row['saddle_num']);
        $bike->setRearSeat($row['rear_seat_num']);
        $bike->setImageURL($row['image_url']);
        $bike->setBattery($row['battery']);
        $bike->setDockId($row['dock_id']);
        $bike->setTimeLeft($row['time_remain']);
        return $bike;
    }

    private function createTwinElectricalBike($row) {
        $bike = new TwinElectricalBike(
            $row['id'],
            $row['barcode'],
            $row['value'],
            $row['rental_fees']
        );
        $bike->setPairOfPedals($row['pedal_num']);
        $bike->setSaddle($row['saddle_num']);
        $bike->setRearSeat($row['rear_seat_num']);
        $bike->setImageURL($row['image_url']);
        $bike->setDockId($row['dock_id']);
        $bike->setBattery($row['battery']);
        $bike->setTimeLeft($row['time_remain']);
        return $bike;
    }

    public function getBikeById($id) {
        foreach ($this->bikeList as $bike) {
            if ($bike->getId() === $id) {
                return $bike;
            }
        }
        return null;
    }

    public function getBikeByBarcode($barcode) {
        foreach ($this->bikeList as $bike) {
            if ($bike->getBarcode() === $barcode) {
                return $bike;
            }
        }
        return null;
    }

    public function updateDockOfBike($bike, $dockId) {
        $SQL = "UPDATE bike 
                SET dock_id = :dockId
                WHERE id = :bikeId";
        if ($dockId == null || $dockId === '') {
            $SQL = "UPDATE bike 
                    SET dock_id = NULL 
                    WHERE id = :bikeId";
        }

        try {
            $connection = EBRDB::getConnection();
            $statement = $connection->prepare($SQL);
            $statement->bindParam(':dockId', $dockId, PDO::PARAM_STR);
            $statement->bindParam(':bikeId', $bike->getId(), PDO::PARAM_STR);
            $statement->execute();
        } catch (PDOException $exception) {
            $exception->getMessage();
        }

        if ($dockId != null && $dockId !== '') {
            DockManager::getInstance()->getDockById($dockId)->addBike($bike);
        }
    }
}
?>
