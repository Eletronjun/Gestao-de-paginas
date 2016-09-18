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

try {
    $category = new Category($_GET['name'], $_GET['id']);

    $category_dao = new CategoryDAO($category);

    $category_dao->update($_GET['new_name']);
    
    echo "Atualizado com sucesso!";
} catch (Exception $msg) {
    echo $msg;
}