<?php
/**
 * Simple factory class managing (singleton) instances
 *
 * @TODO DI-Container 4 cfg
 *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Core;


use P7TriviaGame\Application\Error;
use P7TriviaGame\Application\View;
use P7TriviaGame\Communication\HttpRequest;
use P7TriviaGame\Communication\HttpResponse;
use P7TriviaGame\Persistence\Session;
use P7TriviaGame\Application\Configuration;
use P7TriviaGame\Communication\DbCacheClient;

class Factory
{

    const ERROR_FACTORY_UNKNOWN = 'The given key %s for factory container is not allowed!';
    /**
     * Static array containing (singleton) instances
     *
     * @var mixed[] | null[]
     */
    protected static array $container = [
        'session' => null, 'foo' => null, 'config' => null, 'view' => null, 'configuration' => null,
        'request' => null, 'response' => null,
        'db_cache_client' => null
    ];

    /**
     * Getter for instances built by this factory
     *
     * @param string $key
     * @return Session|null
     * @throws \InvalidArgumentException
     */
    public static function get(string $key)
    {
        $key = strtolower($key);

        if (!array_key_exists($key, self::$container)) {
            throw new \InvalidArgumentException(Error::getMessage(self::ERROR_FACTORY_UNKNOWN, $key));
        } else {
            switch ($key) {
                case 'session':
                    if (is_null(self::$container['session'])) {
                        self::$container['session'] = Session::getInstance();
                    }
                    return self::$container['session'];
                    break;
                // Dummy container element for testing
                case 'foo':
                    if (is_null(self::$container['foo'])) {
                        $foo = new \stdClass();
                        $foo->name = 'Foo';
                        $foo->created = date('Y-m-d H:i:s');
                        $foo->id = md5(microtime());
                        self::$container['foo'] = $foo;

                    }
                    return self::$container['foo'];
                    break;

                case 'view':
                    if (is_null(self::$container['view'])) {
                        self::$container['view'] = new View();
                    }
                    return self::$container['view'];
                    break;
                    //

                case 'configuration':
                    if (is_null(self::$container['configuration'])) {
                        self::$container['configuration'] = new Configuration();
                    }
                    return self::$container['configuration'];
                    break;

                case 'response':
                    if (is_null(self::$container['response'])) {
                        self::$container['response'] = new HttpResponse();
                    }
                    return self::$container['response'];
                    break;

                case 'request':
                    if (is_null(self::$container['request'])) {
                        self::$container['request'] = new HttpRequest();
                    }
                    return self::$container['request'];
                    break;

                case  'db_cache_client':
                    if (is_null(self::$container['db_cache_client'])) {
                        self::$container['db_cache_client'] = DbCacheClient::getInstance(self::get('configuration'));
                    }
                    return self::$container['db_cache_client'];
                    break;
            }
        }
    }


    protected function factoryByConfiguration($key)
    {

    }
}