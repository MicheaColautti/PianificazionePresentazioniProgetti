<?php

/**
 * Databse model
 * @version 26.05.2023
 * @author Michea Colautti
 */
class Database extends PDO
{
    /**
     * The host of the DB
     * @var $host host
     */
    private $host = DB_HOST;

    /**
     * The user of the DB
     * @var $user the db user
     */
    private $user = DB_USER;

    /**
     * The password of the DB
     * @var $password the db password
     */
    private $password = DB_PASS;

    /**
     * The name of the DB
     * @var $dbname the db name
     */
    private $dbname = DB_NAME;

    /**
     * The port of the DB
     * @var $port the port
     */
    private $port = DB_PORT;

    /**
     * The connection to the DB.
     * @var $connection the connection
     */
    private $connection = NULL;

    /**
     * Constructor method.
     */
    public function __construct()
    {
    }

    /**
     * This function allow to get the connection to the DB
     * @return PDO|string the connection, or an error message.
     */
    public function getConnection()
    {
        try {
            if ($this->connection != NULL) {
                return $this->connection;
            }

            $this->connection = new PDO(
                "mysql:host = " . $this->host . "; dbname=" . $this->dbname . "; port=" . $this->port,
                $this->user, $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->connection;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
?>