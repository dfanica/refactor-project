<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use JournalMedia\Sample\Classes\HtmlResponse;
use JournalMedia\Sample\Classes\DataHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class TagRiverController extends DataHandler
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface
    {
        $view = new HtmlResponse();
        return $view('index', ['data' => $this->getPublicationByTag($args['tag'])]);
    }
}
