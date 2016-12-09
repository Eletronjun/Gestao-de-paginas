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
use \exception\WebPageException as WebPageException;

$session = new Session();
$session->verifyIfSessionIsStarted();


$menu = new AdministratorMenu();
$menu->construct();

Page::startHeader(Globals::ENTERPRISE_NAME);
Page::closeHeader();

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
          echo $new_name;
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
        'y',
        $_POST['formLink']
    );
    $web_page_dao = new WebPageDAO($new_page);
    $web_page_dao->register();
    echo "Salvo com Sucesso!";

} catch (Exception $msg) {
    echo "<script>alert(\"{$msg}\"); history.go(-1);</script>";
}
echo "</main>";
Page::footer();
Page::closeBody();
