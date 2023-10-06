<?php

/**
 * Login controller
 */
class Login
{

    /**
     * The index function
     * @return void
     */
    public function index()
    {
        $error = '';
        require_once 'application/views/templates/header.php';
        require_once 'application/views/Home.php';
        require_once 'application/views/templates/footer.php';
    }

    /**
     * This method allow to autenticate a user
     * @return void
     */
    public function authenticate()
    {
        require_once 'application/models/login_model.php';
        $login = new LoginModel();

        if ($login->authenticateAdmin() > 0) {
            require_once 'application/views/templates/header.php';
            require_once 'application/views/Home.php';
            require_once 'application/views/templates/footer.php';
        } else {
            $error = "Errore di login";
            require_once 'application/views/templates/header.php';
            require_once 'application/views/Login.php';
            require_once 'application/views/templates/footer.php';
        }
    }


}