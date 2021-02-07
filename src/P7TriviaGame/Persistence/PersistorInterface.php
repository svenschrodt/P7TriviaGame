<?php
declare(strict_types=1);
/**
 * Interface defining  API for persistor classes
 *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
* @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Persistence;

interface PersistorInterface
{


    /**
     * Public getter for (singleton) instance - one persistor to rule them all
     *
     * @return Session
     */
    public static function getInstance(): PersistorInterface;


    /**
     * Getter for key in persistor
     *
     * @param string
     * @return mixed | null
     */
    public function get(string $key);

    /**
     * Setter for key in persistor
     *
     * @return Session
     */
    public function set(string $key, $value): PersistorInterface;


    /**
     * Unsetter for key in persistor
     *
     * @return Session
     */
    public function unset(string $key): PersistorInterface;

    /**
     * Discarding current persistor's state and restore previous
     *
     * @return Session
     */
    public function rollback(): PersistorInterface;

}
