<?php
/**
 *Base class to persist data
 *
 *@author  Iasmin Mendes <mendesiasmin96@gmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/controller/savePage.php
 */
require_once __DIR__ . "/../class/autoload.php";

//use \model\Category as Category;
use \model\webPage as WebPage;
use \dao\WebPageDAO as WebPageDAO;
use \exception\     WebPageException as WebPageException;

//use \exception\DatabaseException as DatabaseException;*/

try {
    $new_page = new WebPage($_POST['title'], $_POST['author'], $_POST['category']);
    echo $_POST['category'];
    $web_page_dao = new WebPageDAO($new_page);
    $web_page_dao->register();
    echo "Salvo com sucesso!";
} catch (Exception $msg) {
    echo $msg;
}
