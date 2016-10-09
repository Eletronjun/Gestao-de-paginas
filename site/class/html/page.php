<?php
/**
 *Class for processing framework with HTML standards.
 *
 *@package Html
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/html/page.php
 */
namespace html{

    include_once __DIR__ . "/../autoload.php";

    class Page
    {
        //Exception constant
        const INVALID_TITLE = "Título inválido";

        /**
          * Method with all meta tag and header for html page
         *
          *@param string $title       title of the page, not null value or empty
          *@param string $description string with the meta tag descritpion
          */
        public static function header($title, $description = null)
        {
            if ($title != null && $title != "") {
                echo "<!DOCTYPE html>";
                echo "<html>";
                echo "<head>";
                echo "  <title>{$title}</title>";
                echo "  <meta charset=\"utf-8\">";
                echo "  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">";
                echo "  <link rel=\"icon\" type=\"image/png\" href=\"res/img/favicon.png\" />";
                echo "  <link rel= \"stylesheet\" type=\"text/css\" href=\"" . PROJECT_ROOT . "css/styles.css\" />";
                echo "  <meta name=\"description\" content=\"{$description}\">";
                echo "  <meta name=\"keywords\" content=\"EletronJun, Gama, UnB, ";
                echo "  Universidade de Brasília, FGA, eletrônica, desenvolvimento de ";
                echo "  projetos, empresa, empresa júnior\">";
                echo "</head>";
                echo "<body>";
                echo "  <div id=\"container\">";
            } else {
                throw new \exception\PageException(self::INVALID_TITLE);
            }
        }
        
        /**
         * Method to close html body
         */
        public static function closeBody()
        {
            echo "  </div>";
            echo "</body>";
            echo "</html>";
        }

        /**
         * Method to write a footer page
         */
        public static function footer()
        {
            echo "<div class=\"footer\">";
            echo "  <address class=\"right\">";
            echo "      <p><a href=\"mailto:eletronjun@gmail.com\"><span class=\"icon\">";
            echo "          &#9993; </span> eletronjun@gmail.com</a>";
            echo "      </p>";
            echo "      <p><a href=\"https://www.facebook.com/eletronjun\"><img ";
            echo "          class=\"link-img\" src=\"" . IMG_PATCH . "icon_face.png\" alt=\"face\"></a>";
            echo "          <a href=\"https://www.facebook.com/eletronjun\">facebook.com/eletronjun</a>";
            echo "      </p>";
            echo "  </address>";
            echo "<div class=\"left\">";
            echo "    <p>EletronJun - Engenharia Eletrônica Júnior</p>";
            echo "        <div class=\"autoria\">";
            echo "            <label for=\"control-autoria\" ";
            echo "                class=\"control-autoria helvetica-font\">";
            echo "                @2016 Todos os direitos Reservados &#9654;";
            echo "            </label>";
            echo "            <input type=\"checkbox\" id=\"control-autoria\"/>";
            echo "            <br>";
            echo "            <p>Salvo fotografia de capa - ";
            echo "                <a href=\"" . IMG_PATCH . "imgcapa_circuito.png\" target=\"_BLANK\">";
            echo "                    Circuito Eletrônico";
            echo "                </a>. ";
            echo "                Fornecida pela ";
            echo "                <a href=\"https://pixabay.com/pt/\" target=\"_BLANK\">";
            echo "                    Pixabay";
            echo "                </a> ";
            echo "                e livre de direitos autorais sob Creative Commons CC0.</p>";
            echo "        </div>";
            echo "</div>";
            echo "</div>";
            echo "<script type=\"text/javascript\" src=\"http://code.jquery.com/jquery-1.4.3.min.js\"></script>";
        }
    }
}
