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
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Core;


use P7TriviaGame\Application\Error;
use P7TriviaGame\Persistence\Session;

class Factory
{

    const ERROR_FACTORY_UNKNOWN = 'The given key %s for factory container is not allowed!';
    /**
     * Static array containing (singleton) instances
     *
     * @var mixed[] | null[]
     */
    protected static array $container = ['session' => null, 'foo' => null];

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
            }
        }
    }
}