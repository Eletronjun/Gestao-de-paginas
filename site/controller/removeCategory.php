<?php
/**
 *Controller to remove an especific category
 *
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/controller/findCategory.php
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
    $category = new Category($_GET['name'], $_GET['id']);

    $category_dao = new CategoryDAO($category);

    $category_dao->remove();
    
    echo "Removido com sucesso!";
} catch (Exception $msg) {
    echo $msg;
}
