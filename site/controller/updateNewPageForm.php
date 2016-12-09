<?php
/**
 *Controller to get all categories
 *
 *@author  Iasmin Mendes <mendesiasmin96@gmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/controller/updateNewPageForm.php
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

    if($category->getLayout() == "video") {
      echo "<input type=\"hidden\" name=\"imageFile\">";
      echo "<label>Video</label><input type=\"text\" name=\"videoLink\">";
      echo "<input type=\"hidden\" name=\"formLink\">";
      echo "<input type=\"hidden\" name=\"reference\">";
    }
    else if($category->getLayout() == "form") {
      echo "<input type=\"hidden\" name=\"imageFile\">";
      echo "<input type=\"hidden\" name=\"videoLink\">";
      echo "<label>Formulário Google Docs</label><input type=\"text\" name=\"formLink\">";
      echo "<input type=\"hidden\" name=\"reference\">";
    }
    else if($category->getLayout() == "short_publication") {
      echo "<label>Imagem</label><input type=\"file\" name=\"imageFile\">";
      echo "<input type=\"hidden\" name=\"videoLink\">";
      echo "<input type=\"hidden\" name=\"formLink\">";
      echo "<input type=\"hidden\" name=\"reference\">";
    }
    else {
      echo "<label>Imagem</label><input type=\"file\" name=\"imageFile\">";
      echo "<input type=\"hidden\" name=\"videoLink\">";
      echo "<input type=\"hidden\" name=\"formLink\">";
      echo "<label>Referências</label><br>
            <textarea rows=\"4\" cols=\"80\" id=\"reference\" maxlenght=\"300\" name=\"reference\" required=\"true\">
            </textarea><br><br>";
    }
  }
} catch (Exception $e) {
    echo $e;
}
