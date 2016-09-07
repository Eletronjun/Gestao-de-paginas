<?php
/**
 *Base class to persist data
 *
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/utils/initSession.php
 */
require_once(__DIR__ . "/../class/autoload.php");

use \utilities\Session as Session;
use \exception\SessionException as SessionException;

//Create a session instance
$session = new Session();

//SQL Injection previne
$email = addslashes($_POST["email"]);
$password = addslashes($_POST["password"]);

//try initialize session
try {
    $session->initSession($email, $password);
    echo "<script>alert('ENTROU')</script>";
} catch (SessionException $msg) {
    echo "<script>alert('{$msg}');history.go(-1);</script>";
}
