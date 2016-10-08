<?php
/**
 *Controller to get all categories
 *
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/controller/findCategory.php
 */
require_once __DIR__ . "/../class/autoload.php";

use \html\FindCategories as FindCategories;

use \utilities\Session as Session;

$session = new Session();
$session->verifyIfSessionIsStarted();

if (isset($_GET['code'])) {
    FindCategories::getOptions($_GET['code']);
} else {
    FindCategories::getOptions();
}
