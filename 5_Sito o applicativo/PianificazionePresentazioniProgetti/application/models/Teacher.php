<?php


/**
 * Teahcer model
 * @version 26.05.2023
 * @author Michea Colautti
 */
class Teacher
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
     * This method allow to create a new Teacher.
     * @param mixed $name the teacher name
     * @param mixed $lastname the teacher lastname
     * @param mixed $email the email of the teacher
     * @return int the inserted teacher id
     */
    public function newTeacher($name, $lastname, $email)
    {
        //TODO controllo su sequneza di esecuzione
        $sql = "INSERT INTO docente(nome,cognome,email) VALUES (?,?,?)";
        $query = $this->connection->prepare($sql);
        $query->bindParam(1, $name, PDO::PARAM_STR);
        $query->bindParam(2, $lastname, PDO::PARAM_STR);
        $query->bindParam(3, $email, PDO::PARAM_STR);
        $query->execute();
        return $this->connection->lastInsertId();
    }

    /**
     * This method allows to insert the availability of a given teacher in the DB.
     * @param mixed $teacherId the teacher's id
     * @param mixed $startDate the start date of whole planning 
     * @param mixed $endDate the end date of the whole planning
     * @param mixed $hours the array with all the hours of availability
     * @return void
     */
    public function insertAvailability($teacherId, $startDate, $endDate, $hours)
    {
        require_once 'application/models/Model.php';
        $model = new Model();
        $availability = $model->getAvailability($hours, $startDate, $endDate, $teacherId);

        //insert into DB
        foreach ($availability as $el) {
            $sql = "INSERT INTO orariprogettidocente(inizio,fine,docenteId) VALUES (?,?,?)";
            $query = $this->connection->prepare($sql);
            $query->bindParam(1, $el[0], PDO::PARAM_STR);
            $query->bindParam(2, $el[1], PDO::PARAM_STR);
            $query->bindParam(3, $el[2], PDO::PARAM_STR);
            $query->execute();
        }


    }



}


?>