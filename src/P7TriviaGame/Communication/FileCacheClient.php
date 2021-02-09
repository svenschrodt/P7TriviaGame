<?php
declare(strict_types=1);
/**
 * FileCacheClient - to be used like the API client in cases of:
 *
 * - Mocking data for testing
 * - Mocking data for debugging
 * - Mocking data if http resources do not work
 *
 *
 *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-07
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Communication;

use P7TriviaGame\Application\Configuration;
use P7TriviaGame\Core\Factory;
use P7TriviaGame\Entity\Category;
use P7TriviaGame\Entity\CategoryCacheElement;


class FileCacheClient
{

    const CATEGORY_CACHE_FILE = 'category.cache';

    const QUESTION_CACHE_DIRECTORY = 'question.cache';

    /**
     * Used time to live for connection in seconds
     *
     * @var int
     */
    private int $ttlCache = 3600 * 48; // two days

    protected ?Configuration $configuration = null;

    protected string $categoryCacheResource = '';

    protected string $questionCacheDirectory = '';
    /**
     * Constructor function
     *
     *
     */
    public function __construct()
    {
        $this->configuration = Factory::get('configuration');
        $this->categoryCacheResource =  $this->configuration->getNamedPath(Configuration::APPLICATION_CACHE_PATH_SUFFIX). self::CATEGORY_CACHE_FILE;
    }

    /**
     * Initializing cUrl request with set parameters
     *
     * @param string $uri
     * @todo implement public setters for configuration instead of hard coding
     *
     */
    public function init()
    {
       ;
        $ac = new ApiClient();
        $list = $ac->getCategories();
        $newList = [];
        for ($i = 0; $i < count($list); $i++) {
            $catCacheElement = new CategoryCacheElement($list[$i]);
            $newList[] = $catCacheElement;
        }
        var_dump($newList);

        file_put_contents($this->categoryCacheResource, serialize($newList));

    }


    public function writeToFile($resource, $data)
    {
        file_put_contents($resource,serialize($data));
    }


    public function readFromFile($resource)
    {
        return unserialize(file_get_contents($resource));
    }


    public function setCategories(array $data)
    {
        file_put_contents($this->categoryCacheResource, serialize($data));
    }
    public function getCategories()
    {

        return unserialize(file_get_contents($this->categoryCacheResource ));
    }

}
