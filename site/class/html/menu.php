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

    require_once(__DIR__ . "/../autoload.php");

    class Menu
    {
        public static function startMenu()
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
                PROJECT_ROOT . "utils/destroySession.php\" 
                OnClick=\"return confirm('Tem certeza que deseja sair?');",
                "Sair"
            );
            self::endItem();
        }
        
        public static function startItem()
        {
            echo "<div class=\"item\">";
        }

        public static function endItem()
        {
            echo "</div>";
        }

        public static function addItem($host, $name)
        {
            echo "<a href=\"{$host}\">{$name}</a>";
        }

        public static function initSubItem()
        {
            echo "<div class=\"sub-item neue-font\">";
        }

        public static function endSubItem()
        {
            echo "</div>";
        }

        public static function endMenu()
        {
            echo "</nav></div>";
            echo "</div>";
            echo "<br>";
        }
    }
}
