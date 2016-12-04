<?php
/**
 *Base class to persist data
 *
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/controller/updateCategory.php
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
    $category = new Category($_GET['name'], $_GET['description'], $_GET['id']);
    $category->validateName($_GET['new_name']);
    $category->validateLayout($_GET['new_layout']);

    $category_dao = new CategoryDAO($category);

    $category_dao->update($_GET['new_name'], $_GET['new_layout']);

    echo "Atualizado com sucesso!";
} catch (Exception $msg) {
    echo $msg;
}
