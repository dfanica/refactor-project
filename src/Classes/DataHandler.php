<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Classes;

use GuzzleHttp\Client as GuzzleClient;
use JournalMedia\Sample\Entity\ArticleEntity;
use JournalMedia\Sample\Classes\CachingService as Cache;

abstract class DataHandler
{
    const DEFAULT_PUBLICATION_NAME = 'thejournal';

    private $demoMode;
    private $apiUrl;
    private $username;
    private $password;

    public function __construct()
    {
        $this->demoMode = getenv('DEMO_MODE') === 'true' ? true : false;
        $this->apiUrl = getenv('API_URL');
        $this->username = getenv('API_USER');
        $this->password = getenv('API_PASS');
    }

    public function getArticleById($id): ArticleEntity
    {
        $url = sprintf('%s/article/%d', $this->apiUrl, intval($id));
        $article = $this->demoMode
            ? $this->fetchFile(self::DEFAULT_PUBLICATION_NAME, $id)
            : $this->fetchAPI($url)->response->page_items[0];
        return $this->articleEntity($article);
    }

    /**
     * @todo Pagination can be done here
     */
    public function getPublication(
        $name = self::DEFAULT_PUBLICATION_NAME,
        $page = null
    ): array
    {
        $url = sprintf('%s/sample/%s', $this->apiUrl, $name);
        // pagination info found here...
        $articleList = $this->demoMode
            ? $this->fetchFile($name)
            : $this->fetchAPI($url)->response->articles;
        return $this->processArticles($articleList);
    }

    /**
     * @todo Pagination can be done here
     */
    public function getPublicationByTag($tag, $page = null): array
    {
        $url = sprintf('%s/sample/tag/%s', $this->apiUrl, $tag);
        // pagination info found here...
        $articleList = $this->demoMode
            ? $this->fetchFile($tag)
            : $this->fetchAPI($url)->response->articles;
        return $this->processArticles($articleList);
    }

    private function processArticles(array $articles): array
    {
        $result = [];
        foreach ($articles as $article) {
            if ($article->type === ArticleEntity::ARTICLE_TYPE_POST) {
                $result[] = $this->articleEntity($article);
            }
        }
        return $result;
    }

    private function articleEntity($article): ArticleEntity
    {
        $tags = [];
        foreach ((@$article->tags ?? []) as $i => $tag) {
            $tags[$i] = $tag->slug;
        }
        $entity = new ArticleEntity();
        $entity->setId(@$article->id ?: '');
        $entity->setTitle(@$article->title ?: '');
        $entity->setExcerpt(@$article->excerpt ?: '');
        $entity->setContent(@$article->content ?: '');
        $entity->setTags($tags);
        $entity->setImage(@$article->images->thumbnail->image ?: '');
        return $entity;
    }

    public function fetchAPI($url)
    {
        $guzzle = new GuzzleClient();
        $cache = new Cache();
        try {
            $options = ['auth' => [$this->username, $this->password]];
            // cache the api request for 24 hours
            if (!($response = $cache->get($url))) {
                $response = $guzzle->get($url, $options)->getBody()->getContents();
                $cache->set($response, $url);
            }
            return json_decode($response);
        } catch (\Exception $e) {
            // do nothing for the moment
        }
        return [];
    }

    public function fetchFile($filename, $articleId = null)
    {
        $file = DEMO_RESPONSES . "/{$filename}.json";
        try {
            if (file_exists($file)) {
                $data = json_decode(file_get_contents($file));
                if ($articleId && $articleId > 0) {
                    foreach ($data as $article) {
                        if ($article->id == $articleId) {
                            return $article;
                        }
                    }
                    return null;
                }
                return $data;
            }
        } catch (\Exception $e) {
            // do nothing for the moment
        }
        return [];
    }
}
