<?php
/**
 * file: html.pageTest.php
 */

namespace htmlTests{

    use \html\Page as Page;
    use \html\AdministratorMenu as AdministratorMenu;
    use \html\CommunityMenu as CommunityMenu;
    use \html\FindCategories as FindCategories;
    use \exception\PageException as PageException;
    use \utilities\Session as Session;

    class PageTest extends \PHPUnit_Framework_TestCase
    {
    
        public function testValidtitle()
        {
            Page::header("nova", "Description of this page");
            $menu = new CommunityMenu();
            $menu->construct();
            Page::footer();
            Page::closeBody();
        }
    
        public function testValidtitleWithNullDescription()
        {
            Page::header("nova");
            $menu = new CommunityMenu();
            $menu->construct();
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
