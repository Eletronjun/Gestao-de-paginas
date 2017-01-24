<?php
/**
 *Class for processing framework with HTML standards.
 *
 *@package Html
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/html/administratorMenu.php
 */
namespace html{

    include_once __DIR__ . "/../autoload.php";

    use \utilities\Session as Session;
    use \html\Page as Page;
    use \html\Menu as Menu;
    use \model\Member as Member;
    use \configuration\Globals as Globals;

    class AdministratorMenu extends Menu
    {

        public function __construct()
        {
            $session = new Session();
            $session->verifyIfSessionIsStarted();
            parent::startMenu();
            $this->wellcomeUser();
            parent::startMenuOptions();
        }

        public function construct()
        {
            switch (Member::$DIRECTORATE[$_SESSION['code_directorate']-1]) {
                case Member::$DIRECTORATE[0]:
                    break;
                case Member::$DIRECTORATE[1]:
                    $this->gppPageOptions();
                    break;
                case Member::$DIRECTORATE[2]:
                    $this->marketngPageOptions();
                    break;
                case Member::$DIRECTORATE[3]:
                    break;
                case Member::$DIRECTORATE[4]:
                    $this->marketngPageOptions();
                    $this->gppPageOptions();
                    break;
            }
            $this->logout("mobile");
            parent::endMenu();
        }

        private function marketngPageOptions()
        {
                parent::startDropdown("Páginas");
                  parent::addItem(PROJECT_ROOT . "adm/category.php", "Gerenciar Categorias");
                  parent::addItem(PROJECT_ROOT . "adm/pages.php", "Gerenciar Páginas");
                  parent::addItem(PROJECT_ROOT . "adm/newPage.php", "Nova Página");
                parent::endDropdown();
        }

        private function gppPageOptions()
        {
                parent::startDropdown("Processos");
                  parent::addItem(PROJECT_ROOT . "adm/users.php", "Gerenciar Usuário");
                parent::endDropdown();
        }

        private function logout($mode = "desk")
        {
            if($mode == "mobile") {
              echo "<div id=\"logout\"><a href='index.php'>minha conta</a>";
              echo "<a href=\"" . PROJECT_ROOT . "controller/destroySession.php\"
                  OnClick=\"return confirm('Tem certeza que deseja sair?');\" class=\"clean_link\">logout</a></div>";
            } else {
              echo "<a href=\"" . PROJECT_ROOT . "controller/destroySession.php\"
                OnClick=\"return confirm('Tem certeza que deseja sair?');\" class=\"clean_link\">logout</a>";
            }
        }

        protected function wellcomeUser()
        {
            echo "<section id=\"wellcomeUser\" class=\"flex\">";
            echo "<figure><img src=\"" . PROJECT_ROOT . "res/member_image/{$_SESSION['image']}\"></figure>";
            echo "<p>Olá, {$_SESSION['nick']}!";
            echo "<br><span class=\"right\" style=\"font-size:0.9rem\">";
            $this->logout();
            echo " | <a href='index.php'>conta</a></span></p>";
            echo "</section>";
        }
    }
}
