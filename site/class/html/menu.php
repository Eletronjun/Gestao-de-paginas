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
        protected static function startMenu()
        {
            echo "<div id=\"header\">";
            echo "<figure id=\"logo\">";
            echo "<img src=\"".IMG_PATCH."logoh_sidebar.png\" alt=\"eletronjun\" />";
            echo "</figure>";
            echo "<div class=\"menu eightone-font\">";
            echo "<input type=\"checkbox\" id=\"control-nav\"/>";
            echo "<label for=\"control-nav\" class=\"control-nav\"></label>";
            echo "<nav>";
            self::startItem();
            self::addItem(
                PROJECT_ROOT . "controller/destroySession.php\" 
                OnClick=\"return confirm('Tem certeza que deseja sair?');",
                "Sair"
            );
            self::endItem();
        }
        
        protected static function startItem()
        {
            echo "<div class=\"item\">";
        }

        protected static function endItem()
        {
            echo "</div>";
        }

        protected static function addItem($host, $name)
        {
            echo "<a href=\"{$host}\">{$name}</a>";
        }

        protected static function initSubItem()
        {
            echo "<div class=\"sub-item neue-font\">";
        }

        protected static function endSubItem()
        {
            echo "</div>";
        }

        protected static function endMenu()
        {
            echo "</nav></div>";
            echo "</div>";
            echo "<br>";
        }
    }
}
