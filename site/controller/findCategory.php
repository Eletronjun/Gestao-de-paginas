<?php
/**
 *Controller to get all categories
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

$data = CategoryDAO::getCategories();

for ($i=0; $i < count($data); $i++) {
    echo "<option value=\"{$data[$i][0]}\">{$data[$i][1]}</option>";
}
