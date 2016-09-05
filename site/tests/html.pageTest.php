<?php
/**
 * file: html.pageTest.php
 */
 
class PageTest extends PHPUnit_Framework_TestCase
{
	
	public function testValidtitle()
	{
		Page::header("nova","Description of this page");
	}
	
	public function testValidtitleWithNullDescription()
	{
		Page::header("nova");
	}
	
	/**
	* @expectedException PageException
	*/
	public function testNulltitle()
	{
		Page::header(null);
	}
	
	/**
	* @expectedException PageException
	*/
	public function testEmptytitle()
	{
		Page::header("");
	}
	
}

