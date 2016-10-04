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
use \html\Menu as Menu;
use \configuration\Globals as Globals;


$session = new Session();
$session->verifyIfSessionIsStarted();

Menu::startMenu();
    Menu::startItem();
    Menu::addItem(PROJECT_ROOT . "#", "Páginas");
        Menu::initSubItem();
            Menu::addItem(PROJECT_ROOT . "category.php", "Edição de Categoria");
            Menu::addItem(PROJECT_ROOT . "newPage.php", "Nova Página");
            Menu::addItem(PROJECT_ROOT . "pages.php", "Gerenciar Páginas");
        Menu::endSubItem();
    Menu::endItem();
Menu::endMenu();

Page::header(Globals::ENTERPRISE_NAME);

echo "<h1>Atualização de Página</h1>";

try{
  $web_page = new WebPage($_POST['title'], $_POST['author'], $_POST['categories'], $_POST['postage'], $_POST['code']);
  $web_page_dao = new WebPageDAO($web_page);
  $web_page_dao->updatePage($_POST['title'], $_POST['author'], $_POST['categories'], $_POST['postage']);

  echo "Salvo com sucesso.";
} catch (Expetion $msg){
  echo $msg;
}

Page::footer();
Page::closeBody();
