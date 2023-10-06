<?php
/**
 * Student controller
 * @version 26.05.2023
 * @author Michea Colautti
 */
class StudentController
{

    /**
     * Summary of addStudent
     * @return void
     */
    public function addStudent()
    {
        //int phase
        session_start();
        ini_set("log_errors", 0);
        //ini_set("error_log", "C:/Users/michea.colautti/Downloads/error.txt");


        //require phase
        require 'application/models/Model.php';
        require 'application/models/Student.php';
        $model = new Model();
        $studentModel = new Student();

        //retrive data
        $data = json_decode(file_get_contents('php://input'), true);
        $data = array_values($data);
        $name = $model->filterField($data[0]);
        $lastname = $model->filterField($data[1]);
        $email = $model->filterField($data[2]);
        $projName = $model->filterField($data[3]);
        $studClass = $model->filterField($data[4]);
        $projTeach = $model->filterField($data[5]);


        //1step insert student and assoc. to class and retrive student id
        $studentId = $studentModel->newStudent($name, $lastname, $email, $studClass);

        //2step insert project data
        $studentModel->newProject($projName, $projTeach, $studentId);

    }


    /**
     * This method allow to generte a select input
     * @return string the select inpit
     */
    public function populateSlectClass()
    {
        require_once 'application/models/Model.php';
        $model = new Model();
        $dati = $model->getData("id,nome", "classe");
        $select = '<select id="studClass" class="form-select" aria-label="Default select example"> <option selected>Seleziona una classe</option>';
        foreach ($dati as $dato) {
            $select .= '<option value="' . $dato['id'] . '">' . $dato['nome'] . '</option>';
        }
        $select .= '</select>';
        return $select;
    }

    public function populateSlectTeacher()
    {
        require_once 'application/models/Model.php';
        $model = new Model();

        $selectData = $model->getData("id,nome,cognome", "docente");
        $select = '<select id="projTeach" class="form-select" aria-label="Default select example"> <option selected>Seleziona un docente</option>';
        foreach ($selectData as $el) {
            $select .= '<option value="' . $el['id'] . '">' . $el['nome'] . " " . $el["cognome"] . '</option>';
        }
        $select .= '</select>';
        return $select;
    }
}
?>