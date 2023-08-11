<?php

require_once 'model/dock/Dock.php';
require_once 'model/db/EBRDB.php';
class DockManager {

    private static $instance; // singleton
    private $dockList;

    public function __construct() {
        $this->dockList = array();
        $this->refreshDockList();
    }

    /**
     * Get the instance of DockManager
     * @return DockManager instance
     */
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new DockManager();
        }

        return self::$instance;
    }

    /**
     * Updating local dock list with the current info in the database
     */
    public function refreshDockList() {
        $this->dockList = array();
        echo "refreshing";

        // Query for all Docks
        $SQL = "SELECT * FROM dock ORDER BY dock.name";

        try {
            $conn = EBRDB::getConnection();
            $stmt = $conn->prepare($SQL);
            $stmt->execute();

            while ($row = $stmt->fetch()) {
                $dock = new Dock($row['id'], $row['name'], $row['location'], $row['capacity'], $row['image_url']);
                $dock->setNumberOfAvailableBike($row['taken_slot']);
                $this->dockList[] = $dock;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function getDockList() {
        return $this->dockList;
    }

    /**
     * Get dock instance by dock's id
     * @param id dock's id
     * @return instance of that Dock, null if id not found
     */
    public function getDockById($id) {
		echo "1";
        foreach ($this->dockList as $dock) {
            if ($dock->getId() == $id)
                return $dock;
        }
        return null;
    }

    /**
     * Search dock by its name or address
     * @param nameOrAddress dock's name or dock's address
     * @return searched dock
     */
    public function searchDockByKeyword($nameOrAddress) {
        $searchedDock = array();
        foreach ($this->dockList as $dock) {
            if (stripos($dock->getName(), $nameOrAddress) !== false ||
                stripos($dock->getLocation(), $nameOrAddress) !== false) {
                $searchedDock[] = $dock;
            }
        }
        return $searchedDock;
    }
}
