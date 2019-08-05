<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Classes;

use Jenssegers\Blade\Blade;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse as Html;

class HtmlResponse
{
    const DIR_VIEWS = '../src/View';
    const DIR_CACHE = '../storage/cache';

    public function __invoke($view, $params = []): ResponseInterface
    {
        $blade = new Blade(self::DIR_VIEWS, self::DIR_CACHE);
        return new Html($blade->render($view, $params));
    }
}
