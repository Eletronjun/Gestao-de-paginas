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
        }

        public function construct()
        {
            if ($_SESSION['code_directorate'] == self::MARKETING) {
                $this->pageOptions();
            }
            
            parent::endMenu();
        }

        private function pageOptions()
        {
            parent::startItem();
                parent::addItem(PROJECT_ROOT . "#", "Páginas");
                    parent::initSubItem();
                        parent::addItem(PROJECT_ROOT . "adm/category.php", "Edição de Categoria");
                        parent::addItem(PROJECT_ROOT . "adm/newPage.php", "Nova Página");
                        parent::addItem(PROJECT_ROOT . "adm/pages.php", "Gerenciar Páginas");
                    parent::endSubItem();
                parent::endItem();
        }
    }
}
