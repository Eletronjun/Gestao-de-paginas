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
use \dao\CategoryDao as CategoryDao;
use \configuration\Globals as Globals;
use \exception\WebPageException as WebPageException;

$session = new Session();
$session->verifyIfSessionIsStarted();

Page::startHeader(Globals::ENTERPRISE_NAME);
Page::styleSheet("user");
Page::closeHeader();

$menu = new AdministratorMenu();
$menu->construct();

//use \exception\DatabaseException as DatabaseException;*/

echo "<main><h1>Nova Página</h1>";

try {

    $new_name = null;
    if(!empty($_FILES["imageFile"]["type"])) {
      date_default_timezone_set("Brazil/East"); //Define TimeZone
      $ext = strtolower(substr($_FILES['imageFile']['name'], -4)); //Get extension of file
      $new_name = md5(date("Y.m.d-H.i.s")) . $ext; //Define a new name for file
      //Verify if mime-type is image
      if (eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $_FILES['imageFile']["type"])) {
          move_uploaded_file($_FILES['imageFile']['tmp_name'], UPLOAD_ROOT . $new_name); //Save upload of file
      } else {
          throw new Exception("O arquivo precisa ser uma imagem.");
      }
    }
    $new_page = new WebPage(
        $_POST['title'],
        $_POST['author'],
        $_POST['category'],
        $_POST['postage'],
        null,
        null,
        null,
        $new_name,
        $_POST['reference'],
        $_POST['isActivity'],
        $_POST['formLink'],
        $_POST['videoLink']
    );
    $web_page_dao = new WebPageDAO($new_page);
    $web_page_dao->register();
    echo "Salvo com Sucesso!<br>";
    if ($_POST['formLink'] != null) {
      echo "<br><b>Link para o formulário: </b><a href=\"" . PROJECT_ROOT . " form_publication.php?code={$web_page_dao->getWebPageModel()->getCode()}\">" . PROJECT_ROOT . "form_publication.php?code={$web_page_dao->getWebPageModel()->getCode()}<br>";
    }

} catch (Exception $msg) {
    echo "<script>alert(\"{$msg}\"); history.go(-1);</script>";
}
echo "</main>";
Page::footer();
Page::closeBody();
