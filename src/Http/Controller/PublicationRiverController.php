<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use JournalMedia\Sample\Classes\HtmlResponse;
use JournalMedia\Sample\Classes\DataHandler;

class PublicationRiverController extends DataHandler
{
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $view = new HtmlResponse();
        return $view('index', ['data' => $this->getPublication()]);
    }
}
