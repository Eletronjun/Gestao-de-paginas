<?php
/**
 * file: html.pageTest.php
 */

namespace htmlTests{

    use \html\Page as Page;
    use \html\Menu as Menu;
    use \html\FindCategories as FindCategories;
    use \exception\PageException as PageException;

    class PageTest extends \PHPUnit_Framework_TestCase
    {
    
        public function testValidtitle()
        {
            Page::header("nova", "Description of this page");
            Menu::startMenu();
            Menu::startItem();
                Menu::addItem(PROJECT_ROOT . "#", "Páginas");
                    Menu::initSubItem();
                        Menu::addItem(PROJECT_ROOT . "category.php", "Edição de Categoria");
                    Menu::endSubItem();
                Menu::endItem();
            Menu::endMenu();
            Page::footer();
            Page::closeBody();
        }
    
        public function testValidtitleWithNullDescription()
        {
            Page::header("nova");
            Page::footer();
            Page::closeBody();
        }
    
        /**
         * @expectedException \exception\PageException
         */
        public function testNulltitle()
        {
            Page::header(null);
            Page::footer();
            Page::closeBody();
        }
    
        /**
         * @expectedException \exception\PageException
         */
        public function testEmptytitle()
        {
            Page::header("");
            Page::footer();
            Page::closeBody();
        }

        public function testgetCategoriesOptions()
        {
            FindCategories::getOptions();
            FindCategories::getCheckboxTable();
        }
    }
}
