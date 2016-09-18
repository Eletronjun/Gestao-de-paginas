<?php
/**
 *Controller to get all categories
 *
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/html/findCategory.php
 */

namespace html{
    
    require_once __DIR__ . "/../autoload.php";

    use \model\Category as Category;
    use \dao\CategoryDAO as CategoryDAO;
    use \exception\CategoryException as CategoryException;
    use \exception\DatabaseException as DatabaseException;

    class FindCategories
    {
        public static function getOptions()
        {
            $data = CategoryDAO::getCategories();

            for ($i=0; $i < count($data); $i++) {
                echo "<option value=\"{$data[$i][0]}\">{$data[$i][1]}</option>";
            }
        }

        public static function getCheckboxTable()
        {
            $data = CategoryDAO::getCategories();

            for ($i=0; $i < count($data); $i++) {
                echo "<tr>\n";
                echo "<td>{$data[$i][1]}</td>\n";
                echo "<td><input type=\"checkbox\" name=\"categories\" value=\"{$data[$i][0]}-_-{$data[$i][1]}\"";
                if ($data[$i][2] == "y") {
                    echo "checked";
                }
                echo "></td>";
                echo "</tr>\n";
            }
        }
    }
}
