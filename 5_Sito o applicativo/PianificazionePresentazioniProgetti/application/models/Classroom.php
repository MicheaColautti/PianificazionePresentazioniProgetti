<?php


/**
 * Classroom model
 * @version 26.05.2023
 * @author Michea Colautti
 */
class Classroom
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
     * This method allow to create a new Classrom.
     * @param mixed $name the classroom name
     * @param mixed $wifi the wifi of the class, yes or no
     * @return int the inserted class id
     */
    public function newClassroom($name, $wifi)
    {
        //TODO controllo su sequneza di esecuzione
        $sql = "INSERT INTO aula(nome,wifi) VALUES (?,?)";
        $query = $this->connection->prepare($sql);
        $query->bindParam(1, $name, PDO::PARAM_STR);
        $query->bindParam(2, $wifi, PDO::PARAM_STR);
        $query->execute();
        return $this->connection->lastInsertId();
    }

    /**
     * This method allows to insert the availability of a given classroom in the DB.
     * @param mixed $classroomId the classroom's id
     * @param mixed $startDate the start date of whole planning 
     * @param mixed $endDate the end date of the whole planning
     * @param mixed $hours the array with all the hours of availability
     * @return void
     */
    public function insertAvailability($classroomId, $startDate, $endDate, $hours)
    {
        require_once 'application/models/Model.php';
        $model = new Model();
        $availability = $model->getAvailability($hours, $startDate, $endDate, $classroomId);

        //insert into DB
        foreach ($availability as $el) {
            $sql = "INSERT INTO orariprogettiaula(inizio,fine,aulaId) VALUES (?,?,?)";
            $query = $this->connection->prepare($sql);
            $query->bindParam(1, $el[0], PDO::PARAM_STR);
            $query->bindParam(2, $el[1], PDO::PARAM_STR);
            $query->bindParam(3, $el[2], PDO::PARAM_STR);
            $query->execute();
        }


    }

}
?>