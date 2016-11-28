<?php
/**
 *Controller to get all categories
 *
 *@author  Iasmin Mendes <mendesiasmin96@gmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/controller/findCategoryData.php
 */
require_once __DIR__ . "/../class/autoload.php";

use \html\FindCategories as FindCategories;
use \dao\CategoryDAO as CategoryDAO;

use \utilities\Session as Session;

$session = new Session();
$session->verifyIfSessionIsStarted();

try {
  if(isset($_GET['code'])){
    $category = CategoryDAO::findCategory($_GET['code']);
    echo "<label>Novo Nome:</label><br>";
    echo "<input type=\"text\" name=\"category\" id=\"category_name\" value=\"{$category->getName()}\" size=\"50%\" required >";
    echo "<label>Layout Padrão:</label><br>";
    echo "<select id=\"update_layout\" name=\"update_layout\">";

    if($category->getLayout() == "video") {
      echo "<option value=\"publication\">Geral</option>";
      echo "<option value=\"short_publication\">Publicação Curta</option>";
      echo "<option value=\"video\" selected>Vídeo</option>";
    }
    else if($category->getLayout() == "short_publication") {
      echo "<option value=\"publication\">Geral</option>";
      echo "<option value=\"short_publication\" selected>Publicação Curta</option>";
      echo "<option value=\"video\">Vídeo</option>";
    }
    else {
      echo "<option value=\"publication\" selected >Geral</option>";
      echo "<option value=\"short_publication\">Publicação Curta</option>";
      echo "<option value=\"video\">Vídeo</option>";
    }
    echo "</select>";
  }
  else {
    echo "<input type=\"text\" name=\"category\" id=\"category_name\" size=\"50%\" required>";
    echo "<label>Layout Padrão:</label><br>";
    echo "<select id=\"update_layout\" name=\"update_layout'>";
    echo "</select>";
  }
} catch (Exception $e) {
    echo $e;
}