<?php
/**
 *Class for processing framework with HTML standards.
 *
 *@package Html
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/html/communityMenu.php
 */
namespace html{

    include_once __DIR__ . "/../autoload.php";

    use \utilities\Session as Session;
    use \html\Page as Page;
    use \html\Menu as Menu;
    use \configuration\Globals as Globals;
    use \dao\CategoryDao as CategoryDao;

    class CommunityMenu extends Menu
    {

        public function __construct()
        {
            parent::startMenu();
        }

        public function construct()
        {
            parent::addItem(PROJECT_ROOT ."enterprise.php", "A Empresa");
            parent::addItem(PROJECT_ROOT ."projects.php", "Projetos");
            parent::addItem(PROJECT_ROOT ."events.php", "Eventos");
            parent::addItem(PROJECT_ROOT ."selective_process.php", "Processos Seletivos");
            $this->publicationOptions();
            parent::endMenu();
        }

        private function publicationOptions()
        {
            parent::startDropdown("Publicações");
            foreach (CategoryDao::returnActiveCategories() as $code => $name) {
                parent::addItem(PROJECT_ROOT . "categories.php?code={$code}", $name);
            }
            parent::endDropdown();
        }
    }
}
