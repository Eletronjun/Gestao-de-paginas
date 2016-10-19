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
                echo "  <link rel=\"icon\" type=\"image/png\" href=\"" . IMG_PATCH . "favicon.png\" />";
                echo "  <link rel= \"stylesheet\" type=\"text/css\" href=\"" . PROJECT_ROOT . "css/styles.css\" />";
                echo "  <link rel= \"stylesheet\" type=\"text/css\" href=\"" . PROJECT_ROOT . "css/footer.css\" />";
                echo "  <link rel= \"stylesheet\" type=\"text/css\" href=\"" . PROJECT_ROOT . "css/form.css\" />";
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
         * Method to include stylesheets
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
            echo "      <a href=\"https://www.youtube.com/channel/UCMyP5qIbM_UXFHJjvwhc_Ow\"><img ";
            echo "         class=\"footer-img\" src=\"" . IMG_PATCH . "Youtube.png\" alt=\"YouTube\"
                            title=\"EletronTube\"></a>";
            echo "      <a href=\"https://www.instagram.com/eletronjun\"><img ";
            echo "         class=\"footer-img\" src=\"" . IMG_PATCH . "Instagram.png\" alt=\"Instagram\"
                            title=\"Instagram\"></a>";
            echo "      <a href=\"https://www.facebook.com/eletronjun\"><img ";
            echo "         class=\"footer-img\" src=\"" . IMG_PATCH . "Facebook.png\" alt=\"face\"
                            title=\"EletronFace\"></a>";
            echo "      <a href=\"mailto:eletronjun@gmail.com\"><img ";
            echo "         class=\"footer-img\" src=\"" . IMG_PATCH . "Email.png\" alt=\"Email\"
                            title=\"eletronjun@gmail.com\"></a>";
            echo "  </address>";
            echo "<div class=\"authorship\">";
            echo "    EletronJun - Engenharia Eletrônica Júnior<br>";
            echo "      @2016 Todos os direitos reservados<br>";
            echo "</div>";
            echo "</div>";
            echo "<script type=\"text/javascript\" src=\"http://code.jquery.com/jquery-1.4.3.min.js\"></script>";
        }
    }
}
