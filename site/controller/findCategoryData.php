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
    echo "<label>Novo Nome:</label><br>
      <input type='text' name='category' id='category_name' value='' size='50%' required>
      <label>Nova Descrição:</label><br>
      <textarea name=\"description\" id=\"update_description\" 
      maxlength=\"200\" rows=\"5\" cols=\"50\"></textarea><br>";
    echo "<label>Layout Padrão:</label><br>
      <select id='update_layout' name='update_layout'>";

    if($category->getLayout() == "video") {
      echo "<option value=\"publication\">Geral</option>";
      echo "<option value=\"short_publication\">Publicação Curta</option>";
      echo "<option value=\"video\" selected>Vídeo</option>";
      echo "<option value=\"form\">Formulário</option>";
    }
    else if($category->getLayout() == "short_publication") {
      echo "<option value=\"publication\">Geral</option>";
      echo "<option value=\"short_publication\" selected>Publicação Curta</option>";
      echo "<option value=\"video\">Vídeo</option>";
      echo "<option value=\"form\">Formulário</option>";
    }
    else if($category->getLayout() == "form") {
      echo "<option value=\"publication\">Geral</option>";
      echo "<option value=\"short_publication\">Publicação Curta</option>";
      echo "<option value=\"video\">Vídeo</option>";
      echo "<option value=\"form\" selected>Formulário</option>";
    }
    else {
      echo "<option value=\"publication\" selected >Geral</option>";
      echo "<option value=\"short_publication\">Publicação Curta</option>";
      echo "<option value=\"video\">Vídeo</option>";
      echo "<option value=\"form\">Formulário</option>";
    }
  }
} catch (Exception $e) {
    echo $e;
}
