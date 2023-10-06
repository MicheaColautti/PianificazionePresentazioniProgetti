<?php


/**
 * Student model
 * @version 26.05.2023
 * @author Michea Colautti
 */
class Student
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
     * This method allows to add a student to the DB
     * @param mixed $name the student name
     * @param mixed $lastname the student lastname
     * @param mixed $email the email of the student
     * @param mixed $studClassId the id of the student's classe
     * @return int the inserted teacher id
     */
    public function newStudent($name, $lastname, $email, $studClassId)
    {

        //init
        ini_set("log_errors", 0);
        //ini_set("error_log", "C:/Users/michea.colautti/Downloads/error.txt");
        require_once "application/models/General.php";
        $general = new General();


        //insert student
        $sql = "INSERT INTO allievo(nome,cognome,email) VALUES (?,?,?)";
        $query = $this->connection->prepare($sql);
        $query->bindParam(1, $name, PDO::PARAM_STR);
        $query->bindParam(2, $lastname, PDO::PARAM_STR);
        $query->bindParam(3, $email, PDO::PARAM_STR);
        $query->execute();
        $studentId = $this->connection->lastInsertId();

        //insert student in class
        $yearId = $general->getYearId();
        $sql = "INSERT INTO allievoclasseanno(allievoId,classeId,annoId) VALUES (?,?,?)";
        $query = $this->connection->prepare($sql);
        $query->bindParam(1, $studentId, PDO::PARAM_STR);
        $query->bindParam(2, $studClassId, PDO::PARAM_STR);
        $query->bindParam(3, $yearId, PDO::PARAM_STR);
        $query->execute();

        //returns student id
        return $studentId;
    }

    /**
     * This method allows to add a project to the DB
     * @param mixed $projName the project name
     * @param mixed $projTeachId the teacher's id of the project
     * @param mixed $studentId the student's id who develops the project
     * @return void
     */
    public function newProject($projName, $projTeachId, $studentId)
    {
        //init
        ini_set("log_errors", 0);
        //ini_set("error_log", "C:/Users/michea.colautti/Downloads/error.txt");

        //insert project
        $sql = "INSERT INTO progetto(nome,docenteId,allievoId) VALUES (?,?,?)";
        $query = $this->connection->prepare($sql);
        $query->bindParam(1, $projName, PDO::PARAM_STR);
        $query->bindParam(2, $projTeachId, PDO::PARAM_STR);
        $query->bindParam(3, $studentId, PDO::PARAM_STR);
        $query->execute();

    }
}


?>