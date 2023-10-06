<?php
/**
 * School class controller
 * @version 26.05.2023
 * @author Michea Colautti
 */
class SchoolClassController
{

    /**
     * Method to add a school class and call the model.
     * @return void
     */
    public function addClass()
    {
        //int phase
        session_start();
        ini_set("log_errors", 0);
        //ini_set("error_log", "C:/Users/michea.colautti/Downloads/error.txt");

        //require phase
        require 'application/models/Model.php';
        require 'application/models/SchoolClass.php';
        $model = new Model();
        $classModel = new SchoolClass();


        //retrive data
        $data = json_decode(file_get_contents('php://input'), true);
        $data = array_values($data);
        $className = $model->filterField($data[0]);
        $hours = array_values($data[1]);

        //1step insert school class and retrive id
        $classroomId = $classModel->newSchoolClass($className);

        //2step insert availability
        $startDate = $_SESSION["startDate"];
        $endDate = $_SESSION["endDate"];
        $classModel->insertAvailability($classroomId, $startDate, $endDate, $hours);
    }




}
?>