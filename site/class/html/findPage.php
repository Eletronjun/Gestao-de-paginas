<?php
/**
 *Controller to pages
 *
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/html/findPage.php
 */

namespace html{
    
    require_once __DIR__ . "/../autoload.php";

    use \dao\WebPageDAO as WebPageDAO;
    use \exception\CategoryException as CategoryException;
    use \exception\DatabaseException as DatabaseException;

    class FindPage
    {
        public static function getOptions($code)
        {
            $data = WebPageDAO::returnByCategory($code);

            for ($i=0; $i < count($data); $i++) {
                echo "<option value=\"{$data[$i]->getCode()}\">{$data[$i]->getTitle()}</option>";
            }

            return (count($data) != 0);
        }
    }
}
