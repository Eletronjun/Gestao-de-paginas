<?php
/**
 *Base class to persist data
 *
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/controller/destroySession.php
 */
require_once __DIR__ . "/../class/autoload.php";

use \utilities\Session as Session;
use \exception\SessionException as SessionException;

//Create a session instance
$session = new Session();

$session->disconnect();

header("location:" . PROJECT_ROOT . "login.php");
