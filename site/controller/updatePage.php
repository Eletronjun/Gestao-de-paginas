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

Page::startHeader(Globals::ENTERPRISE_NAME);
Page::closeHeader();

echo "<main>";
echo "  <h1>Atualização de Página</h1>";

try {
    $web_page = WebPageDAO::getPage($_POST['code']);
    $web_page_dao = new WebPageDAO($web_page);
    if (!empty($_FILES['imageFile']['tmp_name'])) {
        date_default_timezone_set("Brazil/East"); //Define TimeZone
        $ext = strtolower(substr($_FILES['imageFile']['name'], -4)); //Get extension of file
        $new_name = md5(date("Y.m.d-H.i.s")) . $ext; //Define a new name for file

        //Verify if mime-type is image
        if (eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $_FILES['imageFile']["type"])) {
            $web_page_dao->updatePage($_POST['title'], $_POST['author'], $_POST['categories'], $_POST['postage'], $_POST['isActivity'], $new_name, $_POST['reference']);

            move_uploaded_file($_FILES['imageFile']['tmp_name'], UPLOAD_ROOT . $new_name); //Save upload of file
        } else {
            throw new Exception("O arquivo precisa ser uma imagem.");
        }
    } else {
        $web_page_dao->updatePage($_POST['title'], $_POST['author'], $_POST['categories'], $_POST['postage'], $_POST['isActivity'], null, $_POST['reference']);
    }

    echo "Salvo com sucesso.";
} catch (Expetion $msg) {
    echo $msg;
}

echo "</main>";
Page::footer();
Page::closeBody();
