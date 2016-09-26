<?php
/**
 *Controller to get all pages
 *
 *@author  Iasmin Mendes <mendesiasmin96@gmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/controller/findPage.php
 */
require_once __DIR__ . "/../class/autoload.php";

use \model\WebPage as WebPage;
use \dao\WebPageDAO as WebPageDAO;
use \exception\WebPageException as WebPageException;
use \exception\DatabaseException as DatabaseException;

$data = WebPageDAO::getWebPages();

for ($i=0; $i < count($data); $i++) {
    echo "<option value=\"{$data[$i][0]}\">{$data[$i][1]}</option>";
}
