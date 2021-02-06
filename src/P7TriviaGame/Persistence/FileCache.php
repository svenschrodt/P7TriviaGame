<?php
/**
 * Simple class managing usage of file system as  cache
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

namespace P7TriviaGame\Persistence;


class FileCache implements PersistorInterface
{
    public static function getInstance(): PersistorInterface
    {
        // TODO: Implement getInstance() method.
    }

    public function get(string $key)
    {
        // TODO: Implement get() method.
    }

    public function set(string $key, $value): PersistorInterface
    {
        // TODO: Implement set() method.
    }

    public function unset(string $key): PersistorInterface
    {
        // TODO: Implement unset() method.
    }

    public function rollback(): PersistorInterface
    {
        // TODO: Implement rollback() method.
    }


}