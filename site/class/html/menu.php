<?php
/**
 *Class for processing framework with HTML standards.
 *
 *@package Html
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/html/menu.php
 */
namespace html{

    include_once __DIR__ . "/../autoload.php";

    class Menu
    {
        protected static function startMenu(){
          echo "<div id=\"header\">";
          echo "<figure id=\"logo\">";
          echo "<a href=" . PROJECT_ROOT . "><img src=\"".IMG_PATCH."Menu.png\" alt=\"eletronjun\" /></a>";
          echo "</figure>";
        }

        protected static function startMenuOptions()
        {
            echo "<nav class=\"menu\">\n";
        }


        protected static function addItem($host, $name)
        {
            echo "<a href=\"{$host}\" class=\"clean_link\">{$name}</a>\n";
        }

        protected static function startDropdown($name)
        {
            $id = "itemDD_" . str_replace(" ", "", $name);
            echo "
            <div class=\"dropdown\">
            <button onclick=\"dropdownClick('{$id}')\" class=\"dropbtn\">{$name}</button>";
            echo  "<div id=\"{$id}\" class=\"dropdown-content\">";
        }

        protected static function endDropdown()
        {
            echo "  </div>";
            echo "</div>";
        }

        protected static function endMenu()
        {
            echo "</nav>";
            echo "</div>";
            echo "<br>";
        }

        protected function wellcomeUser()
        {
            echo "<section id=\"wellcomeUser\" class=\"flex\">";
            echo "<figure><img src=" . IMG_PATCH . "user.png></figure>";
            echo "<p>Olá, Usuário!<br><span class=\"right\" style=\"font-size:0.9rem\">logout | conta</span></p>";
            echo "</section>";
        }
    }
}
