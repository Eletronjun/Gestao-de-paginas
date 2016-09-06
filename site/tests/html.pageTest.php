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
        }
    
        public function testValidtitleWithNullDescription()
        {
            Page::header("nova");
        }
    
        /**
         * @expectedException \exception\PageException
         */
        public function testNulltitle()
        {
            Page::header(null);
        }
    
        /**
         * @expectedException \exception\PageException
         */
        public function testEmptytitle()
        {
            Page::header("");
        }
    }
}
