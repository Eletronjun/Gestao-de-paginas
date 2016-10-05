<?php
/**
 *Controller to get one pages
 *
 *@author  Iasmin Mendes <mendesiasmin96@gmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/controller/getPage.php
 */
require_once __DIR__ . "/../autoload.php";

use \model\WebPage as WebPage;
use \dao\WebPageDAO as WebPageDAO;
use \exception\WebPageException as WebPageException;
use \exception\DatabaseException as DatabaseException;

//echo $_GET_['code'] . "<br>";
//$web_page = new WebPage($_GET['title'], " ", 1, "", $_GET['code']);
$web_page = new WebPage("Titulo", "Author", 1, "", 80);
$web_page_dao = new WebPageDAO($web_page);
$web_page_dao->getPage();

echo "<label>Id</label><br>";
echo "<input type='text' id='code' name ='code' value='{$web_page->getCode()}' readonly='true'><br><br>";
echo "<label>Autor</label><br>";
echo "<input type='text' id='author' name='author' value='{$web_page->getAuthor()}' required><br><br>";
echo "<label>Categoria</label><br>";
echo "<select name='categories' id='select_update'>";
include 'findCategory.php';
echo "</select><br><br>";
echo "<label>Título</label><br>";
echo "<input type='text' id='title' name='title' value='{$web_page->getTitle()}' required><br><br>";
echo "<textarea rows='20' cols='80' id='postage' name='postage'>{$web_page->getContent()}</textarea><br><br>";
