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
          echo "<header id=\"header\">";
          echo "<figure id=\"logo\">";
          echo "<a href=" . PROJECT_ROOT . "><img src=\"".IMG_PATCH."Menu.png\" alt=\"eletronjun\" /></a>";
          echo "</figure>";
          Menu::menuMobile();
          echo "</header>";
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
            <div class=\"dropdown\" id=\"". str_replace(" ", "", $name). "\">
            <button onclick=\"dropdownClick('". str_replace(" ", "", $name) . "')\" class=\"dropbtn\">{$name}</button>";
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
        }

        protected static function menuMobile() {
          echo "<span class=\"anchor_menu\" onClick=\"menuClick();\"><div></div><div></div><div></div></span>\n";
        }
    }
}
