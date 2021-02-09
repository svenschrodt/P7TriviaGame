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


class PdoMysql implements DbDriver
{

    /**
     * Db user name - to be optionally  overwritten by constructor
     *
     * @var string
     */
    protected string $user = 'root';

    /**
     * Db user's password - to be optionally  overwritten by constructor
     *
     * @var string
     */
    protected string $pass = '';

    /**
     * Db name - to be optionally  overwritten by configuration
     *
     * @var string
     */
    protected string $name = '';

    /**
     * Db host name | IP address - to be optionally  overwritten by configuration
     *
     * @var string
     */
    protected string $host = 'localhost';

    /**
     * Db server's port - to be optionally  overwritten by configuration
     *
     * @var string
     */
    protected int $port = 3306;

    /**
     * Data Source Name <dsn> for current PDO connection
     *
     * @var string
     */
    protected string $dsn;

    /**
     * @var
     */
    protected $handle;

    /**
     * @var \PDOStatement
     */
    protected \PDOStatement $curStmt;

    /**
     * (Singleton) Instance of PdoMysql (?  nullable)
     *
     * @var PdoMysql|null
     */
    protected static ?PdoMysql $instance = null;

    /**
     * PdoMysql constructor function
     *
     * @param array $config
     * @param bool $autoConnect
     */
    private function __construct(array $config, bool $autoConnect = true)
    {
        $this->configure($config);

        if ($autoConnect) {
            $this->connect();
        }
    }

    /**
     * Setting up connection to Mysql server and storing connection handle
     *
     * @return PdoMysql
     */
    public function connect(): PdoMysql
    {
        // Should we allow, that character encoding may be configurable? NOT yet, maybe never!
        $this->dsn = "mysql:host={$this->host}:{$this->port};dbname={$this->name};charset=utf8";
        $this->handle = new \PDO($this->dsn, $this->user, $this->pass);
        return $this;
    }

    /**
     * Setting up PdoMysl with options from configuration
     *
     * @param array
     */
    public function configure(array $cfg) : PdoMysql
    {
        //@TODO validate array structure's sanity

        // Setting up instance's properties from config

        $this->host = $cfg['host'];
        $this->port = $cfg['port'];
        $this->name = $cfg['name'];
        $this->user = $cfg['user'];
        $this->pass = $cfg['pass'];
        return $this;
    }

    /**
     * Sending sql statement to server and let it be executed
     *
     * @param $sql
     * @return $this
     */
    public function query($sql): PdoMysql
    {
        $this->curStmt = $this->handle->query($sql);
        return $this;
    }

    /**
     * Fetching (next) result from db server
     *
     * @param string $className
     * @return mixed
     */
    public function fetch(string $className = 'stdClass')
    {
        return $this->curStmt->fetchObject($className);
    }

    /**
     * Fetching complete result set as array
     *
     * @param string $className
     * @return array
     */
    public function fetchAll(string $className = 'stdClass'): array
    {
        return $this->curStmt->fetchAll(\PDO::FETCH_CLASS, $className);
    }

    /**
     * Getting (singleton) instance of PdoMysql
     *
     * @param array $config
     * @param bool $autoConnect
     * @return PdoMysql
     */
    public static function getInstance(array $config, bool $autoConnect = true): PdoMysql
    {
        if (is_null(self::$instance)) {
            self::$instance = new self($config, $autoConnect);
        }
        return self::$instance;
    }

    /**
     * Returning (nullable) handle to connection with db server
     * - by default a connection will be established, if not yet done
     *
     *
     * @param bool $autoConnect
     * @return \PDO|null
     */
    public function getHandle(bool $autoConnect = true): ?\PDO
    {
        if (is_null($this->handle) && $autoConnect) {
            $this->connect();
        }
        return $this->handle;
    }
}