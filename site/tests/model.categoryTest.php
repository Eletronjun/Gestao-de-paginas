<?php
/**
 * file: model.categoryTest.php
 */

namespace htmlTests{

    use \model\Category as Category;
    use \exception\CategoryException as CategoryException;

    class CategoryTest extends \PHPUnit_Framework_TestCase
    {
        public function testCreateValidCategory()
        {
            new Category("PCBS - ....", 1);
        }

        public function testCreateValidCategoryWithoutId()
        {
            new Category("PCBS - ....");
        }

        /**
         * @expectedException \exception\CategoryException
         */
        public function testNameInvalid()
        {
            new Category("");
        }

        /**
         * @expectedException \exception\CategoryException
         */
        public function testIdInvalid()
        {
            new Category("aa", "1a");
        }
    }
}
