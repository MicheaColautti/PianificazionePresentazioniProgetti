<?php

/**
 * Home controller
 * @version 26.05.2023
 * @author Michea Colautti
 */
class Home
{

    /**
     * Index method, call home page.
     * @return void
     */
    public function index()
    {
        session_start();
        require_once 'application/views/templates/header.php';
        require_once 'application/views/Home.php';
        require_once 'application/views/templates/footer.php';
    }
}