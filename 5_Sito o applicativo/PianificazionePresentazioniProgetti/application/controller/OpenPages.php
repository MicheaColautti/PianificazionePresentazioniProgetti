<?php

/**
 * Open pages controller
 */
class OpenPages
{

    /**
     * This function allows to open the classroom view
     * @return void
     */
    public function openClassroom()
    {
        require_once 'application/views/templates/header.php';
        require_once 'application/views/pages/ClassroomView.php';
        require_once 'application/views/templates/footer.php';
    }
    /**
     * This function allows to open the class view
     * @return void
     */
    public function openClass()
    {
        require_once 'application/views/templates/header.php';
        require_once 'application/views/pages/ClassView.php';
        require_once 'application/views/templates/footer.php';
    }
    /**
     * This function allows to open the teacher view
     * @return void
     */
    public function openTeachers()
    {
        require_once 'application/views/templates/header.php';
        require_once 'application/views/pages/TeacherView.php';
        require_once 'application/views/templates/footer.php';
    }
    /**
     * This function allows to open the student view
     * @return void
     */
    public function openStudents()
    {
        require_once 'application/views/templates/header.php';
        require_once 'application/views/pages/StudentView.php';
        require_once 'application/views/templates/footer.php';
    }
    /**
     * This function allows to open the general view
     * @return void
     */
    public function openGeneral()
    {
        require_once 'application/views/templates/header.php';
        require_once 'application/views/pages/GeneralView.php';
        require_once 'application/views/templates/footer.php';
    }
    /**
     * This function allows to open the home view
     * @return void
     */
    public function openHome()
    {
        require_once 'application/views/templates/header.php';
        require_once 'application/views/Home.php';
        require_once 'application/views/templates/footer.php';
    }

}
?>