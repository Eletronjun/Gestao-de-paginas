<?php
/**
 * file: html.pageTest.php
 */

namespace htmlTests{

    use \html\Page as Page;
    use \exception\PageException as PageException;

    class PageTest extends \PHPUnit_Framework_TestCase
    {
    
        public function testValidtitle()
        {
            Page::header("nova", "Description of this page");
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
    }
}
