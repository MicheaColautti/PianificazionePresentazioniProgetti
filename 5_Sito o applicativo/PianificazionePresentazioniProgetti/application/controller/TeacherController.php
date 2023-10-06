<?php
/**
 * Teahcer controller
 * @version 26.05.2023
 * @author Michea Colautti
 */
class TeacherController
{

    /**
     * Method to add a teacher and call the model.
     * @return void
     */
    public function addTeacher()
    {
        //int phase
        session_start();
        ini_set("log_errors", 0);
        //ini_set("error_log", "C:/Users/michea.colautti/Downloads/error.txt");

        //require phase
        require 'application/models/Teacher.php';
        require_once 'application/models/Model.php';
        $model = new Model();

        //retrive data
        $data = json_decode(file_get_contents('php://input'), true);
        $data = array_values($data);
        $name = $model->filterField($data[0]);
        $lastname = $model->filterField($data[1]);
        $email = $model->filterField($data[2]);
        $hours = array_values($data[3]);

        //1step insert teacher and retrive id
        $teacherModel = new Teacher();
        $teacherId = $teacherModel->newTeacher($name, $lastname, $email);

        //2step insert availability
        $startDate = $_SESSION["startDate"];
        $endDate = $_SESSION["endDate"];
        $teacherModel->insertAvailability($teacherId, $startDate, $endDate, $hours);


    }




}
?>