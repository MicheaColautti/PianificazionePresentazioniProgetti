<?php

/**
 * Login model
 * @version 26.05.2023
 * @author Michea Colautti
 */
class LoginModel
{
    /**
     * The username of the amdin.
     * @var $username the username
     */
    private $username;
    /**
     * The encoded sha256 password of the amdin.
     * @var $password the password
     */
    private $password;

    /**
     * Instance of database.
     * @var $db the databse
     */
    private $db;


    /**
     * Constructor method.
     */
    public function __construct()
    {
        require_once 'application/models/Database.php';
        $this->db = new Database();
    }

    /**
     * This metohod allows to validate a text input.
     * @return void
     */
    private function validateInput()
    {
        $this->username = filter_var($this->username, FILTER_UNSAFE_RAW);
        $this->password = filter_var($this->password, FILTER_UNSAFE_RAW);
    }

    /**
     * This method allows to authenticate di admin if the number of result is null auth fails.
     * @return int|null the number of the results, null if there are none.
     */
    public function authenticateAdmin()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            session_start();

            $this->username = $_POST['username'];
            $this->password = $_POST['password'];
            $this->validateInput();
            $this->password = hash('sha256', $this->password);


            require_once 'Database.php';
            $connection = $this->db->getConnection();
            $sql = 'select username,password FROM login WHERE username = :username and password = :password';
            $result = $connection->prepare($sql);

            $result->bindParam(':username', $this->username, PDO::PARAM_STR);
            $result->bindParam(':password', $this->password, PDO::PARAM_STR);
            $result->execute();
            $count = $result->rowCount();

            return $count;
        }
    }
}