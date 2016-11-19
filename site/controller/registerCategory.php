<?php
/**
 *Base class to persist data
 *
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/controller/registerCategory.php
 */
require_once __DIR__ . "/../class/autoload.php";

use \model\Category as Category;
use \dao\CategoryDAO as CategoryDAO;
use \exception\CategoryException as CategoryException;
use \exception\DatabaseException as DatabaseException;
use \utilities\Session as Session;

$session = new Session();
$session->verifyIfSessionIsStarted();

try {
    $category = new Category($_GET['name'], null, 'y', $_GET['layout']);

    $category_dao = new CategoryDAO($category);
    $category_dao->register();
    echo "Salvo com sucesso!";
} catch (Exception $msg) {
    echo $msg;
}
