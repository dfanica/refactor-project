<?php

namespace JournalMedia\Sample\Http\Controller;

use JournalMedia\Sample\Classes\HtmlResponse;
use JournalMedia\Sample\Classes\DataHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ArticleController extends DataHandler
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface
    {
        $view = new HtmlResponse();
        return $view('page', ['data' => $this->getArticleById($args['id'])]);
    }
}
