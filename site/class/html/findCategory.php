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
        public static function getOptions($code = null)
        {
            $data = CategoryDAO::getCategories();

            if ($code == null) {
                for ($i=0; $i < count($data); $i++) {
                    echo "<option value=\"{$data[$i][0]}\">{$data[$i][1]}</option>";
                }
            } else {
                for ($i=0; $i < count($data); $i++) {
                    $selected = "";

                    if ($data[$i][0] == $code) {
                        $selected = " selected";
                    } else {
                        $selected = "";
                    }
                    echo "<option value=\"{$data[$i][0]}\"{$selected}>{$data[$i][1]}</option>";
                }
            }
        }

        private static function getCheckboxData($data, $index)
        {
            echo "<td>{$data[$index][1]}</td>\n";
            echo "<td><input type=\"checkbox\" name=\"categories\" value=\"{$data[$index][0]}-_-{$data[$index][1]}\"";
            if ($data[$index][2] == "y") {
                echo " checked";
            }
            echo "></td>";
        }

        public static function getCheckboxTable()
        {
            $data = CategoryDAO::getCategories();

            for ($i=0; $i < count($data); $i++) {
                echo "<tr>\n";
                FindCategories::getCheckboxData($data, $i);
                echo "</tr>\n";
            }
        }

        public static function getCheckboxTableRemoveButton()
        {

            $data = CategoryDAO::getCategories();

            for ($i=0; $i < count($data); $i++) {
                echo "<tr>\n";
                FindCategories::getCheckboxData($data, $i);
                echo "<td><button type='button' value='{$data[$i][0]}-_-{$data[$i][1]}' class='button_category'>Remover</button></td>";
                echo "</tr>\n";
            }
        }
    }
}
