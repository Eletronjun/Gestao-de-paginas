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
    use \exception\WebPageException as WebPageException;
    use \exception\DatabaseException as DatabaseException;
    use \html\FindCategories as FindCategories;

    class Forms
    {
        public static function updatePageForm($code)
        {
            try {
                $web_page = WebPageDAO::getPage($code);

                $yes = "";
                $no = "";

                if ($web_page->getIsActivity() == 'n') {
                    $yes = "checked";
                } else {
                    $no = "checked";
                }

                echo "<label>Id</label><br>";
                echo "<input type='text' id='code' name ='code' value='{$web_page->getCode()}' readonly='true'><br><br>";
                echo "<label>Autor</label><br>";
                echo "<input type='text' id='author' name='author' value='{$web_page->getAuthor()}' required><br><br>";
                echo "<label>Categoria</label><br>";
                echo "<select name='categories' id='select_update'>";
                FindCategories::getOptions($code);
                echo "</select><br><br>";
                echo "<label>Título</label><br>";
                echo "<input type='text' id='title' name='title' value='{$web_page->getTitle()}' required><br><br>";
                echo "<textarea rows='20' cols='80' id='postage' name='postage'>{$web_page->getContent()}</textarea><br><br>";
                echo "<label>Imagem</label><br>";
                echo "<input type=\"file\" name=\"imageFile\" /><br>";
                echo "<label>Referências</label><br>";
                echo "<textarea rows='4' cols='80' id='reference' name='reference'>{$web_page->getReferences()}</textarea><br><br>";

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
