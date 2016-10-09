<?php
/**
 *Controller to update page
 *
 *@author  Iasmin Mendes <mendesiasmin96@gmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/controller/updatePage.php
 */
require_once __DIR__ . "/../class/autoload.php";

use \model\WebPage as WebPage;
use \dao\WebPageDAO as WebPageDAO;
use \exception\WebPageException as WebPageException;
use \exception\DatabaseException as DatabaseException;
use \utilities\Session as Session;
use \html\Page as Page;
use \html\AdministratorMenu as AdministratorMenu;
use \configuration\Globals as Globals;

$session = new Session();
$session->verifyIfSessionIsStarted();

$menu = new AdministratorMenu();
$menu->construct();

Page::header(Globals::ENTERPRISE_NAME);

echo "<h1>Atualização de Página</h1>";

try {
    $web_page = new WebPage($_POST['title'], $_POST['author'], $_POST['categories'], $_POST['postage'], $_POST['code']);
    $web_page_dao = new WebPageDAO($web_page);
    $web_page_dao->updatePage($_POST['title'], $_POST['author'], $_POST['categories'], $_POST['postage']);

    echo "Salvo com sucesso.";
} catch (Expetion $msg) {
    echo $msg;
}

Page::footer();
Page::closeBody();
