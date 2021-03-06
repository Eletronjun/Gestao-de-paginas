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
    $web_page = WebPageDAO::getPage($_GET['code']);
    $web_page_dao = new WebPageDAO($web_page);

    if ($image = $web_page->getImage()) {
        $image_delete = "/var/www/html/site/res/file/" . $image;
        trim($image_delete);
        unlink($image_delete);
        $web_page_dao->deleteImage();
    }

    $web_page_dao->delete();

    echo "Página Excluída";
} catch (Exception $msg) {
    echo $msg;
}
