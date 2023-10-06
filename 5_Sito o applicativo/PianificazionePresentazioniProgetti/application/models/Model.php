<?php

/**
 * Model model
 * @version 26.05.2023
 * @author Michea Colautti
 */
class Model
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
     * Dictonary with the days od the week and it's number
     * @var array the dictonary withd number:day
     */
    private $daysFromNumber = array(
        1 => "monday",
        2 => "tuesday",
        3 => "wednesday",
        4 => "thursday",
        5 => "friday",
    );


    /**
     * This method allows you to filter and clean the fields.
     *
     * @param string $data is the data to clean
     * @return string the cleaned data
     */
    public function filterField($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    /**
     * This method allows to get the availability of a specified elment given the marked hours in the page.
     * @param mixed $hours the matrix with the day amd timespan in witch the element is available
     * @param mixed $startDate the start date of whole planning 
     * @param mixed $endDate the end date of the whole planning
     * @param mixed $id the id of the desired element
     * @return array the matrix with the availability
     */
    public function getAvailability($hours, $startDate, $endDate, $id)
    {
        $availability = array();
        foreach ($hours as $el) {
            $dates = $this->getSpecifiedDayInRange($startDate, $endDate, $el[0]);
            foreach ($dates as $date) {
                array_push($availability, $this->createArrayTime($id, $date, $el));
            }
        }
        return $availability;
        /*Matrix Result
         * startTime: 2023-06-05 08:20 
         * endTime: 2023-06-05  09:05
         * elementId: 1
         */
    }



    /**
     * This method allows to get all the sepcified days of the week in a given time span.
     * @param mixed $dateFromString the begin date of the interval
     * @param mixed $dateToString the end date of the interval
     * @param mixed $dayNumber the number of the day (from 1->MO, to 5->FRI)
     * @return array<string>
     */
    public function getSpecifiedDayInRange($dateFromString, $dateToString, $dayNumber)
    {
        $dayName = $this->daysFromNumber[$dayNumber];
        $dateFrom = new DateTime($dateFromString);
        $dateTo = new DateTime($dateToString);
        $dates = [];

        if ($dateFrom > $dateTo) {
            return $dates;
        }

        if ($dayNumber != $dateFrom->format('N')) {
            $dateFrom->modify('next ' . $dayName);
        }

        while ($dateFrom <= $dateTo) {
            $dates[] = $dateFrom->format('Y-m-d');
            $dateFrom->modify('+1 week');
        }

        return $dates;
    }


    /**
     * This method allows to create an array of availability to insert data in the DB.
     * @param mixed $elementId the id of the element in question in the DB
     * @param mixed $date the string with the date availability (ex: 01-01-2001)
     * @param mixed $el the string with the time availability (09:00 - 10:00)
     * @return array the created array (startDateTime | endDateTime | elementId)
     */
    public function createArrayTime($elementId, $date, $el)
    {
        $total = $date . "|" . $el[1];
        $total = explode("|", $total);
        $date = $total[0];
        $time = explode("-", $total[1]);
        $start = $date . " " . $time[0];
        $end = $date . " " . $time[1];
        $timepsan = array($start, $end, $elementId);
        return $timepsan;

    }

    /**
     * This method allows to get the data to fill a select input.
     * @param mixed $field the field to search in the DB
     * @param mixed $table the table to serach in the DB
     * @return array the array with the data
     */
    public function getData($field, $table)
    {
        $sql = "SELECT " . $field . " FROM " . $table;
        $query = $this->connection->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


}

?>