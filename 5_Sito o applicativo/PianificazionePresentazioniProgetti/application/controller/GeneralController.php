<?php
/**
 * General controller
 * @version 26.05.2023
 * @author Michea Colautti
 */
class GeneralController
{

    /**
     * Method to add the general info
     * @return void
     */
    public function addInfo()
    {


        ini_set("log_errors", 0);
        //ini_set("error_log", "C:/Users/michea.colautti/Downloads/error.txt");

        require_once 'application/models/Model.php';
        $model = new Model();

        $data = json_decode(file_get_contents('php://input'), true);
        $data = array_values($data);

        $year = $model->filterField($data[0]);
        $session = $model->filterField($data[1]);
        $projManager = $model->filterField($data[2]);
        $chief = $model->filterField($data[3]);
        $startDate = $model->filterField($data[4]);
        $endDate = $model->filterField($data[5]);


        //1step inserisci l'aula nella tabella e prendi l'id dell'ultimo elemento
        require 'application/models/General.php';
        $generalModel = new General();
        $lastId = $generalModel->newInfo($year, $session, $projManager, $chief);

        //3step inserisci la disponibilità
        $generalModel->insertAvailability($lastId, $startDate, $endDate);



    }
}
?>