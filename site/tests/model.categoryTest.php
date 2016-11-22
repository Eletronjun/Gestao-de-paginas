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
            $category = new Category("PCBS - ....", "aaaaa", 1);
            assert($category->getName() == "PCBS - ....");
            assert($category->getDescription() == "aaaaa");
            assert($category->getId() == 1);
            assert($category->getIsActivity() == "y");
        }

        public function testCreateValidCategoryWithoutId()
        {
            new Category("PCBS - ....", "aaaaa");
        }

        /**
         * @expectedException \exception\CategoryException
         */
        public function testNameInvalid()
        {
            new Category("", "aaaaa");
        }


        /**
         * @expectedException \exception\CategoryException
         */
        public function testLargeName()
        {
            new Category("aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa" .
                "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa", "aaaaa");
        }

        /**
         * @expectedException \exception\CategoryException
         */
        public function testIdInvalid()
        {
            new Category("aa", "aaaaa", "1a");
        }
    }
}
