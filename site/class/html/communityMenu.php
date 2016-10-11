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

            parent::startItem();
                parent::addItem(PROJECT_ROOT, "Home");
            parent::endItem();
            $this->publicationOptions();
            parent::endMenu();
        }

        private function publicationOptions()
        {
            parent::startItem();
            parent::addItem("#", "Publicações");
            parent::initSubItem();

            foreach (CategoryDao::returnActiveCategories() as $code => $name) {
                parent::addItem(PROJECT_ROOT . "categories.php?code={$code}", $name);
            }
            
            parent::endItem();
        }
    }
}
