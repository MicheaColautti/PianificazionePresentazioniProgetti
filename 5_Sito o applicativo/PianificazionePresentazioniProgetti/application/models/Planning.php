<?php

/**
 * PLanning model
 * @version 26.05.2023
 * @author Michea Colautti
 */
class Planning
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

    #region <--------------------------Classes-------------------------->

    /**
     * This method allows to return the ids of the class in the specified year.
     * @param mixed $yearId the year id in wich the class are
     * @return array the ids of the classes
     */
    function getClassesId($yearId)
    {
        $sql = "SELECT DISTINCT classeId FROM allievoClasseAnno WHERE annoId=?";
        $query = $this->connection->prepare($sql);
        $query->bindParam(1, $yearId, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetchAll();
        $classes = array();
        foreach ($row as $el) {
            array_push($classes, $el["classeId"]);
        }
        /**
         * Array of:
         * classId,
         * classId,
         * ...
         * */
        return $classes;
    }

    /**
     * This method allows to pack a matrix with the data of the class.
     * @param mixed $classes the array with the classes ids
     * @return array the matrix with the data (see bottom)
     */
    function getClassesData($classes)
    {
        $classesData = array();
        foreach ($classes as $classId) {
            $classesData[$classId] = $this->getThisClassData($classId);
        }
        return $classesData;
        /**
         * Matrix of:
         * classId{
         *      name
         * }; 
         * ...
         * */
    }


    /**
     * This method allows to get the data of a class from the DB.
     * @param mixed $classId the id of the class to query
     * @return array the arry with the data of the class
     */
    function getThisClassData($classId)
    {
        $sql = "SELECT nome FROM classe WHERE id=?";
        $query = $this->connection->prepare($sql);
        $query->bindParam(1, $classId, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetchAll();
        $class = array();
        foreach ($row as $el) {
            $class = array($el["nome"]);
        }
        //Retrun array with class name
        return $class;
    }


    /**
     * This method allows to pack a matrix with the availability of a class
     * @param mixed $classes the array with the classes ids
     * @return array a matrix with the availability of the classes (see bottom)
     */
    function getClassesAvailability($classes)
    {
        $classAvailability = array();
        foreach ($classes as $classId) {
            $classAvailability[$classId] = $this->getAvailability("orariProgettiClasse", "classeId", $classId);
        }
        /**
         * Matrix of:
         * classId{
         *      Availability,
         *      Availability,
         *      ...
         */
        return $classAvailability;
    }

    #endregion classes


    #region <--------------------------Students-------------------------->

    /**
     * This method allows to pack the ids of the students with the class, in the specified classes.
     * @param mixed $classes the classes id in wich the students are
     * @return array the matrix with the classId and the studentsId. (see bottom)
     */
    function getStudentsAndCalss($classes)
    {
        $students = array();
        foreach ($classes as $classId) {
            $students[$classId] = $this->getStudentsFromClass($classId);
        }
        /**
         * Matrix of:
         * classId{
         *      studId,
         *      studId,
         *};
         */
        return $students;
    }

    /**
     * This method allows to get the data about the relationship between the student and the class from the DB.
     * @param mixed $classId the id of the class to query
     * @return array the array with the id of the student in the class
     */
    function getStudentsFromClass($classId)
    {
        $sql = "SELECT allievoId FROM allievoClasseAnno WHERE classeId=?";
        $query = $this->connection->prepare($sql);
        $query->bindParam(1, $classId, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetchAll();
        $students = array();
        foreach ($row as $el) {
            array_push($students, $el["allievoId"]);
        }
        //Retrun array with students ids
        return $students;
    }


    /**
     * This method allows to pack the matrix with the data of the students.
     * @param mixed $studentsIds the ids of the students
     * @return array the matrix with the data of the students (see bottom)
     */
    function getStudentsData($studentsIds)
    {
        $studentData = array();
        foreach ($studentsIds as $studId) {
            $studentData[$studId] = $this->getThisStudentData($studId);
        }
        return $studentData;
        /**
         * Matrix of:
         * studentId{
         *      name,
         *      lastname,
         *      email
         * }; 
         * */
    }

    /**
     * This method allows to get the data of a student from the DB.
     * @param mixed $studId the id of the student to query
     * @return array the arry with the data of the student
     */
    function getThisStudentData($studId)
    {
        $sql = "SELECT nome,cognome,email FROM allievo WHERE id=?";
        $query = $this->connection->prepare($sql);
        $query->bindParam(1, $studId, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetchAll();
        $student = array();
        foreach ($row as $el) {
            $student = array($el["nome"], $el["cognome"], $el["email"]);
        }
        //Retrun array with student name lastname and email
        return $student;

    }
    #endregion


    #region <--------------------------Projects-------------------------->

    /**
     * This method allows to pack the matrix with the data of the project.
     * @param mixed $studentsId the ids of the students who develop the project
     * @return array the matrix with the project data (see bottom)
     */
    function getPorjectsData($studentsId)
    {
        $studentsProject = array();
        foreach ($studentsId as $studId) {
            $studentsProject[$studId] = $this->getLastProjectOfStudent($studId);
        }
        /** 
         * Matrix of:
         * Return array of these:
         * StudentId{
         *      projId,
         *      projName,
         *      projTeacher,
         * };
         */

        return $studentsProject;

    }

    /**
     * This method allows to get the data of the last project develped by a student from the DB.
     * @param mixed $studentId the id of the student to query
     * @return array the array with the data of the project
     */
    function getLastProjectOfStudent($studentId)
    {
        $sql = "SELECT id,nome,docenteId FROM progetto WHERE allievoId=? ORDER BY id DESC LIMIT 1";
        $query = $this->connection->prepare($sql);
        $query->bindParam(1, $studentId, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetchAll();
        $project = array();
        foreach ($row as $el) {
            array_push($project, $el["id"], $el["nome"], $el["docenteId"]);
        }
        //Retrun array with project id name and responsable teacher
        return $project;
    }

    /**
     * This method allows to isolate the ids of the projects from the matrix returned by getPorjectsData.
     * @param mixed $projetcs the matrix from getPorjectsData with the project data
     * @return array the array with the ids
     */
    function getProjectsIds($projetcs)
    {
        $ids = array();
        foreach ($projetcs as $proj) {
            $ids[] = $proj[0];
        }
        //return array with projects ids
        return $ids;
    }

    #endregion


    #region <--------------------------Teachers-------------------------->


    /**
     * This method allows to pack the array with the ids of the teacher involved in the projects.
     * @param mixed $projectIds the ids of the projects
     * @return array the array with the ids of the teacher
     */
    function getInvolvedTeachers($projectIds)
    {
        $teachersIds = array();
        foreach ($projectIds as $projId) {
            $teachersIds[] = $this->getTeacherId($projId);
        }
        //return array with involved teachers id
        return $teachersIds;
    }

    /**
     * This fucntion allows to get the responsable theacher id of a project from the DB.
     * @param mixed $projectId the id of the project to query
     * @return mixed the id of the responsable teacher
     */
    function getTeacherId($projectId)
    {
        $sql = "SELECT docenteId FROM progetto WHERE id=?";
        $query = $this->connection->prepare($sql);
        $query->bindParam(1, $projectId, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $id = $row['docenteId'];
        //return single teacher id
        return $id;

    }

    /**
     * This method allows to pack the matrix with the data of the teachers.
     * @param mixed $teacherIds the ids of the teachers
     * @return array the matrix with the teacher data (see bottom)
     */
    function getTeachersData($teacherIds)
    {
        $teacherData = array();
        foreach ($teacherIds as $teacherId) {
            $teacherData[$teacherId] = $this->getThisTeacherData($teacherId);
        }
        return $teacherData;
        /**
         * Matrix of:
         * teacherId{
         *      name,
         *      lastname,
         *      email
         * }; 
         * */
    }


    /**
     * This method allows to get the data of a teacher from the DB.
     * @param mixed $teacherId the id of the teacher to query
     * @return array the arry with the data of the teacher
     */
    function getThisTeacherData($teacherId)
    {
        $sql = "SELECT nome,cognome,email FROM docente WHERE id=?";
        $query = $this->connection->prepare($sql);
        $query->bindParam(1, $teacherId, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetchAll();
        $teacher = array();
        foreach ($row as $el) {
            $teacher = array($el["nome"], $el["cognome"], $el["email"]);
        }
        //array with the teacher name,lastname and email
        return $teacher;

    }

    /**
     * This method allows to pack a matrix with the availability of a teacher
     * @param mixed $teacherIds the array with the teachers ids
     * @return array a matrix with the availability of the teachers (see bottom)
     */
    function getTeachersAvailability($teacherIds)
    {
        $teachersAvailability = array();
        foreach ($teacherIds as $teacherId) {
            $teachersAvailability[$teacherId] = $this->getAvailability("orariProgettiDocente", "docenteId", $teacherId);
        }
        /**
         * Matrix of:
         * teacherId{
         *      Availability,
         *      Availability,
         *      ...
         */
        return $teachersAvailability;
    }
    #endregion


    #region <--------------------------Classrooms-------------------------->

    /**
     * This method allows to pack and query the data of all the classrooms.
     * @return array<array> the matrix with the data of the classrooms (see bottom)
     */
    function getClassroomsData()
    {
        $sql = "SELECT id,nome,WIFI FROM aula";
        $query = $this->connection->prepare($sql);
        $query->execute();
        $row = $query->fetchAll();
        $classrooms = array();
        foreach ($row as $el) {
            $dum = array($el["nome"], $el["WIFI"]);
            $classrooms[$el["id"]] = $dum;

        }
        /** 
         * Return array of these:
         * classroomId{
         *      classroomName,
         *      wifi,
         *};
         */
        return $classrooms;
    }

    /**
     * This method allows to pack a matrix with the availability of a classroom.
     * @param mixed $teacherIds the array with the classroom ids
     * @return array a matrix with the availability of the classroom (see bottom)
     */
    function getClassroomsAvailability($classroomsIds)
    {
        $classroomsAvailability = array();
        foreach ($classroomsIds as $classroomId) {
            $classroomsAvailability[$classroomId] = $this->getAvailability("orariProgettiAula", "aulaId", $classroomId);
        }
        /** 
         * Return array of these:
         * classroomId{
         *      Availability,
         *      Availability,
         *};
         */
        return $classroomsAvailability;
    }

    #endregion


    #region <--------------------------Support fetch data-------------------------->

    /**
     * This method allows to flatten a nested array.
     * @param mixed $array the array to flatten
     * @return array|bool the falattened array, flase if input is not array
     */
    function nestedToArray($array)
    {
        if (!is_array($array)) {
            return false;
        }
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, $this->nestedToArray($value));
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }


    /**
     * This method allows to extract the availability from a table in the DB.
     * @param mixed $tableName the name of the table to query
     * @param mixed $elementName the name of the FK id to query
     * @param mixed $elementId the value of the Fk id to query
     * @return array
     */
    function getAvailability($tableName, $elementName, $elementId)
    {

        $sql = "SELECT inizio,fine FROM " . $tableName . " WHERE " . $elementName . " = ?";
        $query = $this->connection->prepare($sql);
        $query->bindParam(1, $elementId, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetchAll();
        $availability = array();
        foreach ($row as $el) {
            $dum = array($el["inizio"], $el["fine"]);
            array_push($availability, $dum);
        }
        return $availability;

    }

    #endregion


    #region <--------------------------Plannig-------------------------->
    /**
     * This method allows to merge into a matrix the data of the project, the student with the class and the availability.
     * @param mixed $projects the array of projects
     * @param mixed $studentsAndClass the relationship between the students and the classes
     * @param mixed $studentsIds the ids involved in the project session
     * @param mixed $classAvailability the availability of the classes
     * @return array the matrix with the data packed (see bottom)
     */
    public function mergeStudentProjectClassData($projects, $studentsAndClass, $studentsIds, $classAvailability)
    {
        ini_set("log_errors", 0);
        //ini_set("error_log", "C:/Users/michea.colautti/Downloads/error.txt");
        $mergedData = array();
        foreach ($studentsAndClass as $key => $class) {
            foreach ($studentsIds as $stud) {
                if (in_array($stud, $class)) {
                    $ava = $classAvailability[$key];
                    $proj = $projects[$stud];
                    $dum = array($proj, $ava, $stud);
                    array_push($mergedData, $dum);
                }
            }
        }
        /**
         * Return matrix of
         * {
         *      projData
         *      availability
         *      studentId
         * }
         */
        return $mergedData;
    }


    /**
     * This method allows to merge the avaulability and the data given by the mergeStudentProjectClassData function and find a available classroom.
     * @param mixed $mergedData the data merged from mergeStudentProjectClassData
     * @param mixed $classroomsAvailability the availability of all the classrooms
     * @param mixed $classroomsData the data of all the classrooms
     * @return mixed the matrix with the packed data (see bottom)
     */
    public function chooseClassroom($mergedData, $classroomsAvailability, $classroomsData)
    {
        //Function does not work. Choose unexixting data
        foreach ($mergedData as $key => $data) {
            $dataAva = $data[1];
            $possibleDatas = $this->getEqualElements($dataAva, $classroomsAvailability);
            $mergedData[$key][1] = $possibleDatas[0];
            array_push($mergedData[$key], $possibleDatas[1]);
        }
        return $mergedData;
        /**
         * Return matrix of
         * {
         *      projData
         *      avalability
         *      student 
         *      roomId
         * }
         */

    }

    /**
     * This function allows to find the matches between a class availability and a classroom availability + it's key.
     * @param mixed $dataAva the availability of the class
     * @param mixed $classroomsAvailability the availability of the classrooms
     * @return array|null the array with the merged availability and the key of the classroom
     */
    public function getEqualElements($dataAva, $classroomsAvailability)
    {
        //edit array to put end and start time in one level
        $newDataAva = array();
        foreach ($dataAva as $ava) {
            $compressedAva = $ava[0] . " | " . $ava[1];
            $newDataAva[] = $compressedAva;
        }

        //edit array to remove one level & put end and start time in one level
        $newClassroomAvailability = array();
        foreach ($classroomsAvailability as $key => $class) {
            foreach ($class as $el) {
                $compressedAva = $el[0] . " | " . $el[1];
                $newClassroomAvailability[$key][] = $compressedAva;
            }

        }

        //merge array and pick first availability
        $result = $this->mergeArrays($newDataAva, $newClassroomAvailability);
        $key = array_keys($result);
        if (count($key) > 0) {
            $key = $key[0];
            $choosenOne = array_shift($result);
            return array($choosenOne, $key);
        }


    }


    /**
     *This method allows to plan the presentation and find a support teacher
     * @param mixed $mergedData the whole merged data given by chooseClassroom
     * @param mixed $teachersAvailability the availability of the teachers
     * @return array the matrix with the planning (see bottom)
     */
    public function planPresentation($mergedData, $teachersAvailability)
    {
        //todo support teacher must be different from project teacher
        $projects = array();
        $timestamps = array();
        $supportTeacher = array();
        $students = array();
        $classroomsId = array();

        $newTeachersAvailability = array();
        foreach ($teachersAvailability as $key => $class) {
            foreach ($class as $el) {
                $compressedAva = $el[0] . " | " . $el[1];
                $newTeachersAvailability[$key][] = $compressedAva;
            }

        }
        $teachersAvailability = $newTeachersAvailability;

        //split data & timestamp
        foreach ($mergedData as $data) {
            array_push($projects, $data[0]);
            $projTeach = $data[0][2];
            $timestampsAndTeacher = $this->mergeArrays($data[1], $teachersAvailability);
            $timestampsAndTeacher = $this->chooseAvailability($timestampsAndTeacher, $timestamps, $projTeach);
            array_push($timestamps, $timestampsAndTeacher[0]);
            array_push($supportTeacher, $timestampsAndTeacher[1]);
            array_push($students, $data[2]);
            array_push($classroomsId, $data[3]);

        }
        $planning = array();
        for ($i = 0; $i < count($projects); $i++) {
            $dum = array($projects[$i], $timestamps[$i], $supportTeacher[$i], $students[$i], $classroomsId[$i]);
            array_push($planning, $dum);
        }
        /**
         * Matrix of:
         * {
         *      projectData
         *      timeStamp
         *      supportTeacherId
         *      studentId
         *      classroomId
         * }
         */
        return $planning;


    }

    /**
     * This method allows to select a timestamp for the presentation based on the availability.
     * @param mixed $teacherTimeStamp the merged final availability
     * @param mixed $timestamps the current timestamp of the presentation
     * @param mixed $projTeach the id of the teacher that is tied to the project
     * @return mixed the timestamp of the presentation
     */
    public function chooseAvailability($teacherTimeStamp, $timestamps, $projTeach)
    {
        $teacheSize = count($teacherTimeStamp);
        //find way to thow error if there is not available time
        while (true) {
            $teach = rand(1, $teacheSize);
            if ($teach != $projTeach) {
                if (!is_null($teacherTimeStamp) & count($teacherTimeStamp) > 0) {
                    foreach ($teacherTimeStamp[$teach] as $time) {
                        if (!in_array($time, $timestamps)) {
                            return array($time, $teach);
                        }
                    }
                }
            }

        }

    }

    /**
     * This function allows to convert the data to a pritable HTML table.
     * @param mixed $planning the matrix with the planning from planPresentation
     * @param mixed $studentsData the data of the students
     * @param mixed $studentsAndClass the relationship between the students and the classes
     * @param mixed $teachersData the data of the teachers
     * @param mixed $classesData the data of the classes
     * @param mixed $classroomsData the data of the classrooms
     * @return string the HTML table with the planning
     */
    public function toPrintableTable($planning, $studentsData, $studentsAndClass, $teachersData, $classesData, $classroomsData)
    {

        $projectsData = array();
        $timeStamps = array();
        $supportTeachersId = array();
        $studentId = array();
        $classroomId = array();

        foreach ($planning as $el) {
            array_push($projectsData, $el[0]);
            array_push($timeStamps, $el[1]);
            array_push($supportTeachersId, $el[2]);
            array_push($studentId, $el[3]);
            array_push($classroomId, $el[4]);
        }


        $supportTeachers = array();
        foreach ($supportTeachersId as $sup) {
            array_push($supportTeachers, $teachersData[$sup]);

        }

        $projTitle = array();
        $teachers = array();
        foreach ($projectsData as $proj) {
            $teachId = $proj[2];
            array_push($projTitle, $proj[1]);
            array_push($teachers, $teachersData[$teachId]);

        }

        $students = array();
        $classes = array();
        foreach ($studentId as $stud) {
            array_push($students, $studentsData[$stud]);
            $classId = $this->getClassOfStudent($stud, $studentsAndClass);
            array_push($classes, $classesData[$classId]);
        }

        $classrooms = array();
        foreach ($classroomId as $class) {
            array_push($classrooms, $classroomsData[$class]);
        }

        // Data | Orario Inizio | Orario Fine | Aula | Allievo|  Classe| Docente| Docente| Progetto|

        $toPrint = "";
        for ($i = 0; $i < count($planning); $i++) {
            //get data
            $times = $this->getStartEnd($timeStamps[$i]);

            $toPrint .= "<tr><td>" . $times[0] . "</td><td>" . $times[1] . "</td><td>" . $times[2] . "</td>" .
                "<td>" . $classrooms[$i][0] . "</td><td>" . $students[$i][0] . " " . $students[$i][1] . "</td><td>" .
                $classes[$i][0] . "</td><td>" . $teachers[$i][0] . " " . $teachers[$i][1] .
                "</td><td>" . $supportTeachers[$i][0] . " " . $supportTeachers[$i][1] . "</td><td>" . $projTitle[$i] . "</td></tr>";
        }

        return $toPrint;
    }

    /**
     * This funtion allows to merge the equal elemetns of two arrays
     * @param mixed $array1 the first array
     * @param mixed $array2 the second array
     * @return array the resutl array
     */
    function mergeArrays($array1, $array2)
    {
        $mergedArray = [];

        foreach ($array2 as $key => $subArray) {
            $mergedSubArray = [];

            foreach ($subArray as $element) {
                if (in_array($element, $array1)) {
                    $mergedSubArray[] = $element;
                }
            }

            if (!empty($mergedSubArray)) {
                $mergedArray[$key] = $mergedSubArray;
            }
        }

        return $mergedArray;
    }


    /**
     * This function allows to get the data out of a datetime for the HTML table.
     * @param mixed $time the time
     * @return array<string> the result array (see bottom)
     */
    public function getStartEnd($time)
    {
        $arr = explode("|", $time);

        $start = explode(" ", $arr[0]);
        $startDay = $start[0];
        $startTime = $start[1];

        $end = explode(" ", $arr[1]);
        $endTime = $end[count($end) - 1];
        //array with startDay - startTime - endTime
        return array($startDay, $startTime, $endTime);
    }

    /**
     * This method allows to get the class of a student.
     * @param mixed $studentId the id of the stuends
     * @param mixed $studentsAndClass the matrix with the relationship between class and student
     * @return mixed the id of the class
     */
    public function getClassOfStudent($studentId, $studentsAndClass)
    {
        foreach ($studentsAndClass as $key => $stud) {
            if (in_array($studentId, $stud)) {
                return $key;
            }
        }

    }

#endregion


}


?>