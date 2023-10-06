<?php
/**
 * Home controller
 * @version 26.05.2023
 * @author Michea Colautti
 */
class PlanningController
{



    /**
     * This function allows to get the data for the planning.
     * @return void
     */
    public function generatePlanning()
    {
        session_start();
        //init
        ini_set("log_errors", 0);
        //ini_set("error_log", "C:/Users/michea.colautti/Downloads/error.txt");

        //require phase
        require 'application/models/Model.php';
        require 'application/models/General.php';
        require 'application/models/Planning.php';
        require 'application/controller/OpenPages.php';
        $model = new Model();
        $planningModel = new Planning();
        $generalModel = new General();



        //get the year id, get the classes involved in this session with the yearId, get the avalability
        $yearId = $generalModel->getYearId();
        $classesId = $planningModel->getClassesId($yearId);
        $classesData = $planningModel->getClassesData($classesId);
        $classAvailability = $planningModel->getClassesAvailability($classesId);

        //get student and class relationship, get list of studentId, get student info
        $studentsAndClass = $planningModel->getStudentsAndCalss($classesId);
        $studentsIds = $planningModel->nestedToArray($studentsAndClass);
        $studentsData = $planningModel->getStudentsData($studentsIds);

        //get the last project of each student with studentId, get all the project id
        $projects = $planningModel->getPorjectsData($studentsIds);
        $projectIds = $planningModel->getProjectsIds($projects);

        //get involved teacher's id based on projetcs, get teacher info, get availability 
        $teachersIds = $planningModel->getInvolvedTeachers($projectIds);
        $teachersData = $planningModel->getTeachersData($teachersIds);
        $teachersAvailability = $planningModel->getTeachersAvailability($teachersIds);

        //get the classrooms involved in this session, get the ids, get the availability
        $classroomsData = $planningModel->getClassroomsData();
        $classroomsIds = array_keys($classroomsData);
        $classroomsAvailability = $planningModel->getClassroomsAvailability($classroomsIds);


        //merge data of students, classes and project. get for each project when it can be done and the student responsable.
        $mergedData = $planningModel->mergeStudentProjectClassData($projects, $studentsAndClass, $studentsIds, $classAvailability);

        //find classroom with that avalability.
        $mergedData = $planningModel->chooseClassroom($mergedData, $classroomsAvailability, $classroomsData);

        //plan the presentation
        $planning = $planningModel->planPresentation($mergedData, $teachersAvailability);
        error_log(print_r($planning, 1));

        //parse to printable table
        $toPrint = $planningModel->toPrintableTable($planning, $studentsData, $studentsAndClass, $teachersData, $classesData, $classroomsData);
        error_log(print_r($toPrint, 1));
        echo $toPrint;
    }
}


?>