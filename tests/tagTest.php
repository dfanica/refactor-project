<?php

use JournalMedia\Sample\Http\Controller\TagRiverController;
use PHPUnit\Framework\TestCase;

class TagTest extends TestCase
{
    public function setUp()
    {
        if (!defined('DEMO_RESPONSES')) {
            define('DEMO_RESPONSES', false);
        }
    }

    public function testTagFetchAPI()
    {
        $tagController = new TagRiverController();
        $this->assertTrue(is_array($tagController->fetchAPI('/')));

        $tagController2 = new TagRiverController();
        $this->assertTrue(is_array($tagController2->fetchAPI('/')));
    }

    public function testTagFetchFile()
    {
        $tagController = new TagRiverController();
        $this->assertTrue(is_array($tagController->fetchFile('google')));

        $tagController2 = new TagRiverController();
        $this->assertTrue(is_array($tagController2->fetchFile('microsoft')));
    }
}
