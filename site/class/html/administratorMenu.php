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
    use \configuration\Globals as Globals;

    class AdministratorMenu extends Menu
    {

        const ADMINISTRATIV_FINANCEIRO = 1;
        const GESTAO_PESSOAS_PROCESSOS = 2;
        const MARKETING = 3;
        const PROJETOS = 4;

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
            parent::addItem(PROJECT_ROOT . "adm/organization_chart.php", "Organograma");
            if ($_SESSION['code_directorate'] == self::MARKETING) {
                $this->pageOptions();
            }

            parent::endMenu();
        }

        private function pageOptions()
        {
                parent::startDropdown("Páginas");
                  parent::addItem(PROJECT_ROOT . "adm/category.php", "Gerenciar Categorias");
                  parent::addItem(PROJECT_ROOT . "adm/pages.php", "Gerenciar Páginas");
                  parent::addItem(PROJECT_ROOT . "adm/newPage.php", "Nova Página");
                parent::endDropdown();
        }

        private function logout()
        {
            echo "<a href=\"" . PROJECT_ROOT . "controller/destroySession.php\"
                OnClick=\"return confirm('Tem certeza que deseja sair?');\" class=\"clean_link\">logout</a>";
        }

        protected function wellcomeUser()
        {
            echo "<section id=\"wellcomeUser\" class=\"flex\">";
            echo "<figure><img src=" . IMG_PATCH . "user.png></figure>";
            echo "<p>Olá, Usuário!<br><span class=\"right\" style=\"font-size:0.9rem\">";
            $this->logout();
            echo " | <a href='index.php'>conta</a></span></p>";
            echo "</section>";
        }
    }
}
