<?php
/**
 *Class for processing framework with HTML standards.
 *
 *@package Html
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/html/forms.php
 */
namespace html{

    include_once __DIR__ . "/../autoload.php";
    use \configuration\Globals as Globals;
    use \model\WebPage as WebPage;
    use \dao\WebPageDAO as WebPageDAO;
    use \dao\CategoryDao as CategoryDao;
    use \exception\WebPageException as WebPageException;
    use \exception\DatabaseException as DatabaseException;
    use \html\FindCategories as FindCategories;

    class Forms
    {
        public static function updatePageForm($code)
        {
            try {
                $web_page = WebPageDAO::getPage($code);
                $layout = CategoryDao::findCategory($web_page->getCategory())->getLayout();

                $yes = "";
                $no = "";

                if ($web_page->getIsActivity() == 'n') {
                    $yes = "checked";
                } else {
                    $no = "checked";
                }

                echo "<input type='hidden' id='code' name ='code' value='{$web_page->getCode()}'>";
                echo "<label>Autor</label><br>";
                echo "<input type='text' id='author' name='author' value='{$web_page->getAuthor()}' required><br><br>";
                echo "<label>Categoria</label><br>";
                echo "<select name='categories' id='select_update'>";
                FindCategories::getOptions($web_page->getCategory());
                echo "</select><br><br>";
                echo "<label>Título</label><br>";
                echo "<input type='text' id='title' name='title' value='{$web_page->getTitle()}' required><br><br>";
                echo "<textarea rows='20' cols='80' id='postage' name='postage'>{$web_page->getContent()}</textarea><br><br>";

                if($layout == "video") {
                  echo "<input type=\"hidden\" name=\"imageFile\">";
                  echo "<label>Video</label><input type=\"text\" name=\"videoLink\" value=\"{$web_page->getVideo()}\">";
                  echo "<input type=\"hidden\" name=\"formLink\">";
                  echo "<input type=\"hidden\" name=\"reference\">";
                }
                else if($layout == "form") {
                  echo "<input type=\"hidden\" name=\"imageFile\">";
                  echo "<input type=\"hidden\" name=\"videoLink\">";
                  echo "<label>Formulário Google Docs</label><input type=\"text\" name=\"formLink\" value=\"{$web_page->getForm()}\">";
                  echo "<input type=\"hidden\" name=\"reference\">";
                }
                else if($layout == "short_publication") {
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

                echo "<div style='width:100%;text-align:center;'>";
                echo "<label class='center'>Oculto?</label><br><br>";
                echo "<input class='center' type='radio' name='isActivity' value='n' {$yes}>Sim";
                echo "<input class='center' type='radio' name='isActivity' value='y' {$no}>Não";
                echo "</div>";
                echo "<br>";
            } catch (WebPageException $msg) {
                echo $msg;
            }
        }
    }
}
