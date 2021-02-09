<?php
declare(strict_types=1);
/**
 * P7TriviaGame\Persistence\Driver\PdoMysql - wrapper for PDO MySql (Maria DB, Percona ...)
 *
 *
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7TriviaGame
 * @since 2021-02-07
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @link https://travis-ci.org/svenschrodt/P7TriviaGame
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 */

namespace P7TriviaGame\Persistence\Driver;


interface DbDriver
{


    /**
     * Setting up connection to Mysql server and storing connection handle
     *
     * @return PdoMysql
     */
    public function connect(): DbDriver;

    /**
     * Setting up PdoMysl with options from configuration
     *
     * @param array
     */
    public function configure(array $cfg): DbDriver;


    /**
     * Sending sql statement to server and let it be executed
     *
     * @param $sql
     * @return $this
     */
    public function query($sql): DbDriver;

    /**
     * Fetching (next) result from db server
     *
     * @param string $className
     * @return mixed
     */
    public function fetch(string $className = 'stdClass');


    /**
     * Fetching complete result set as array
     *
     * @param string $className
     * @return array
     */
    public function fetchAll(string $className = 'stdClass'): array;

    /**
     * Getting (singleton) instance of PdoMysql
     *
     * @param array $config
     * @param bool $autoConnect
     * @return PdoMysql
     */
    public static function getInstance(array $config, bool $autoConnect = true): DbDriver;


    /**
     * Returning (nullable) handle to connection with db server
     * - by default a connection will be established, if not yet done
     *
     *
     * @param bool $autoConnect
     * @return \PDO|null
     */
    public function getHandle(bool $autoConnect = true): ?\PDO;
}
