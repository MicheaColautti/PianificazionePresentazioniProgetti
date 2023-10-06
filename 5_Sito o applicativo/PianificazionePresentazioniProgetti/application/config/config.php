<?php

/**
 * Configurazione
 *
 * For more info about constants please @see http://php.net/manual/en/function.define.php
 * If you want to know why we use "define" instead of "const" @see http://stackoverflow.com/q/2447791/1114320
 */

/**
 * Configurazione di : Error reporting
 * Utile per vedere tutti i piccoli problemi in fase di sviluppo, in produzione solo quelli gravi
 */
ini_set("display_errors", 0);

/**
 * Configurazione di : URL del progetto
 */
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
$dir = str_replace('\\', '/', getcwd() . '/');
$final = $actual_link . str_replace($documentRoot, '', $dir);

define('URL', $final);

// Definisco delle costanti per il db MySQL
define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "gestionepresentazioniprogetti");
define("DB_PORT", "3306");

define('LOGPATH', 'log.log');