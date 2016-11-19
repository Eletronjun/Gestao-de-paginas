<?php
/**
 *Redirects to the right layout page
 *
 *@author  Iasmin Mendes <mendesiasmin96@gmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/controller/generatePublication.php
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

try {
    $page = WebPageDao::getPage($_GET['code']);
    $layout = CategoryDao::findCategory($page->getCategory())->getLayout();

    if($layout == "short_publication") {
      header("Location: ../short_publication.php?code={$_GET['code']}");
    } else if($layout == "video") {
      header("Location: ../video_publication.php?code={$_GET['code']}");
    } else {
      header("Location: ../publications.php?code={$_GET['code']}");
    }

} catch (Exception $msg) {
    echo $msg;
}
