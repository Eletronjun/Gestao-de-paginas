<?php
/**
 * file: model.webPageTest.php
 */

namespace htmlTests{

    use \model\WebPage as WebPage;
    use \exception\WebPageException as WebPageException;

    class WebPageTest extends \PHPUnit_Framework_TestCase
    {
        public function testWebPageValidWebPage()
        {
            new WebPage("Test Page", "EletronJun", 1, "Post Test", 1, "09-01-1996", "09-01-1996");
        }

        public function testWebPageValidWebPageWithoutContentAndDates()
        {
            new WebPage("Test Page", "EletronJun", 1, "Post Teste");
        }

        /**
         * @expectedException \exception\WebPageException
         */
        public function testTitleInvalid()
        {
            new WebPage("", "EletronJun", 1, "Post Teste");
        }

        /**
         * @expectedException \exception\WebPageException
         */
        public function testTitleLarger()
        {
            new WebPage(
                "12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678900",
                "EletronJun",
                1,
                "Post Teste"
            );
        }

        /**
         * @expectedException \exception\WebPageException
         */
        public function testAuthorInvalid()
        {
            new WebPage("Page Test", "", 1, "Post Teste");
        }

        /**
         * @expectedException \exception\WebPageException
         */
        public function testAuthorLarger()
        {
            new WebPage("Page Test", "12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678900", 1, "Post Teste");
        }

        /**
         * @expectedException \exception\WebPageException
         */
        public function testContentInvalid()
        {
            new WebPage("", "EletronJun", 1, "
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test Post Test
            Post");
        }

        /**
         * @expectedException \exception\WebPageException
         */
        public function testCategoryInvalid()
        {
            new WebPage("Page Test", "EletronJun", null, "Post Teste");
        }
    }
}
