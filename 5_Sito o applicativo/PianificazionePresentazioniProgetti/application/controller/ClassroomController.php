<?php
/**
 * Classroom controller
 * @version 26.05.2023
 * @author Michea Colautti
 */
class ClassroomController
{

    /**
     * Method to add a classrom and call the model.
     * @return void
     */
    public function addClassroom()
    {
        //int phase
        session_start();
        ini_set("log_errors", 0);
        //ini_set("error_log", "C:/Users/michea.colautti/Downloads/error.txt");

        //require phase
        require 'application/models/Classroom.php';
        require_once 'application/models/Model.php';
        $model = new Model();

        //retrive data
        $data = json_decode(file_get_contents('php://input'), true);
        $data = array_values($data);
        $classroomName = $model->filterField($data[0]);
        $wifi = $data[1];
        $hours = array_values($data[2]);

        //1step insert classroom and retrive id
        $classroomModel = new Classroom();
        $classroomId = $classroomModel->newClassroom($classroomName, $wifi);

        //2step insert availability
        $startDate = $_SESSION["startDate"];
        $endDate = $_SESSION["endDate"];
        $classroomModel->insertAvailability($classroomId, $startDate, $endDate, $hours);

    }


}
?>