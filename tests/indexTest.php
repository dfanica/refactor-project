<?php

use JournalMedia\Sample\Http\Controller\PublicationRiverController;
use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    public function setUp()
    {
        if (!defined('DEMO_RESPONSES')) {
            define('DEMO_RESPONSES', false);
        }
    }

    public function testFetchAPI()
    {
        $indexController = new PublicationRiverController();
        $this->assertTrue(is_array($indexController->fetchAPI('/')));
    }

    public function testFetchFile()
    {
        $indexController = new PublicationRiverController();
        $this->assertTrue(is_array($indexController->fetchFile('google')));
    }
}
