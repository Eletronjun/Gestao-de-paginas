<?php
/**
 * Delete page in database
 *
 *@author  Iasmin Mendes <mendesiasmin96@gmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/controller/deletePage.php
 */
require_once __DIR__ . "/../class/autoload.php";

use \model\WebPage as WebPage;
use \dao\WebPageDAO as WebPageDAO;
use \exception\WebPageException as WebPageException;
use \exception\DatabaseException as DatabaseException;
use \utilities\Session as Session;

$session = new Session();
$session->verifyIfSessionIsStarted();

try {
    $web_page = new WebPage($_GET['title'], "IASMIN", 1, "", $_GET['code']);

    $web_page_dao = new WebPageDAO($web_page);

    $web_page_dao->delete();

    echo "Página Excluída";
} catch (Exception $msg) {
    echo $msg;
}
