<?php
/**
 *Base class to persist data
 *
 *@author  Iasmin Mendes <mendesiasmin96@gmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/controller/savePage.php
 */
require_once __DIR__ . "/../class/autoload.php";

use \utilities\Session as Session;
use \html\Page as Page;
use \html\AdministratorMenu as AdministratorMenu;
use \model\webPage as WebPage;
use \dao\WebPageDAO as WebPageDAO;
use \configuration\Globals as Globals;
use \exception\     WebPageException as WebPageException;

$session = new Session();
$session->verifyIfSessionIsStarted();


$menu = new AdministratorMenu();
$menu->construct();

Page::header(Globals::ENTERPRISE_NAME);

//use \exception\DatabaseException as DatabaseException;*/

echo "<h1>Nova Página</h1>";

try {
    $new_page = new WebPage($_POST['title'], $_POST['author'], $_POST['category'], $_POST['postage']);
    $web_page_dao = new WebPageDAO($new_page);
    $web_page_dao->register();
    echo "Salvo com sucesso!";
} catch (Exception $msg) {
    echo $msg;
}

Page::footer();
Page::closeBody();
