<?php


/**
 * General model
 * @version 26.05.2023
 * @author Michea Colautti
 */
class General
{
    /**
     * Instance of database.
     * @var $db the databse
     */
    private $db;


    /**
     * The connection to the DB.
     * @var $connection the connection
     */
    private $connection;


    /**
     * Constructor method.
     */
    public function __construct()
    {
        require_once 'application/models/Database.php';
        $this->db = new Database();
        $this->connection = $this->db->getConnection();

    }
    /**
     * Summary of newInfo
     * @param mixed $year
     * @param mixed $session
     * @param mixed $projManager
     * @param mixed $chief
     * @return int
     */
    public function newInfo($year, $session, $projManager, $chief)
    {
        session_start();
        //insert in different tables

        ini_set("log_errors", 0);
        //ini_set("error_log", "C:/Users/michea.colautti/Downloads/error.txt");

        //insert year
        $sql = "INSERT INTO anno(nome) VALUES (?)";
        $query = $this->connection->prepare($sql);
        $query->bindParam(1, $year, PDO::PARAM_STR);
        $query->execute();

        //get yeardId
        $yeardId = $this->connection->lastInsertId();
        $_SESSION["yearId"] = $yeardId;

        //insert session
        $sql = "INSERT INTO sessione(numeroProgetto,annoId,responsabile,capoLaboratorio) VALUES (?,?,?,?)";
        $query = $this->connection->prepare($sql);
        $query->bindParam(1, $session, PDO::PARAM_STR);
        $query->bindParam(2, $yeardId, PDO::PARAM_STR);
        $query->bindParam(3, $projManager, PDO::PARAM_STR);
        $query->bindParam(4, $chief, PDO::PARAM_STR);
        $query->execute();

        //getSessionID
        return $this->connection->lastInsertId();


    }

    /**
     * Summary of insertAvailability
     * @param mixed $sessionId
     * @param mixed $startDate
     * @param mixed $endDate
     * @return void
     */
    public function insertAvailability($sessionId, $startDate, $endDate)
    {
        session_start();
        $version = 1;

        $startDate = DateTime::createFromFormat('m/d/Y', $startDate);
        $endDate = DateTime::createFromFormat('m/d/Y', $endDate);
        $startDate = $startDate->format('Y-m-d');
        $endDate = $endDate->format('Y-m-d');

        $_SESSION["startDate"] = $startDate;
        $_SESSION["endDate"] = $endDate;

        //insert session
        $sql = "INSERT INTO pianificazione(versione,sessioneId,inizio,fine) VALUES (?,?,?,?)";
        $query = $this->connection->prepare($sql);
        $query->bindParam(1, $version, PDO::PARAM_STR);
        $query->bindParam(2, $sessionId, PDO::PARAM_STR);
        $query->bindParam(3, $startDate, PDO::PARAM_STR);
        $query->bindParam(4, $endDate, PDO::PARAM_STR);
        $query->execute();
    }


    /**
     * This method allow to return the last id in the "anno" table
     * @return int the year id;
     */
    public function getYearId()
    {

        $sql = "SELECT id FROM anno ORDER BY id DESC LIMIT 1";
        $query = $this->connection->query($sql);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $lastId = $row['id'];
        return $lastId;

    }
}
?>