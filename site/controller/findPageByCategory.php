<?php
/**
 *Controller to get all pages
 *
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/controller/findPageByCategory.php
 */
require_once __DIR__ . "/../class/autoload.php";

use \html\FindPage as FindPage;
use \utilities\Session as Session;

try {
    $session = new Session();
    $session->verifyIfSessionIsStarted();
    if ($_GET['code_category'] != -1) {
        if (!FindPage::getOptions($_GET['code_category'])) {
            echo "<option value='-1'>Categoria Vazia</option>";
        } else {
            // Nothing to do.
        }
    } else {
        echo "<option value='-1'>Selecione uma categoria primeiramente</option>";
    }
} catch (Exception $e) {
    echo $e;
}
