<?php
declare(strict_types=1);
/**
 * DbCacheClient - to be used like the API client in cases of:
 *
 * - Mocking data for testing
 * - Mocking data for debugging
 * - Mocking data if http resources do not work
 *
 * Inn current version only PdoMysql is supported (for mySQL, MariaDB, Percona and other forks)
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

use P7TriviaGame\Core\DataMapper;
use P7TriviaGame\Persistence\Driver\DbDriver;
use P7TriviaGame\Persistence\Driver\PdoMysql;
use P7TriviaGame\Application\Configuration;
use P7TriviaGame\Core\Factory;


class DbCacheClient
{

    private DbDriver $driver;

    private static ?DbCacheClient $instance = null;

    private Configuration $configuration;

    /**
     * Getting list of categories as parsed PHP data structure:
     *
     * - P7TriviaGame\Entity\Category[] || CategoryList
     * -     *
     * @param false $asArray
     * @return array|mixed
     */
    public function getCategories()
    {
        $tmp = $this->driver->query("SELECT * FROM category")->fetchAll();

        //@FIXME use Factory here too
        $mapper = new DataMapper();
        return ($mapper->mapArrayToCategoryList($tmp));
    }


    /**
     * Getting $amount (random) questions from db cache
     *
     * @param int $amount
     */
    public function getQuestions(int $amount = 0)
    {
        if($amount === 0) {
            $amount = $this->configuration->getAmount();
        }
        $sql = "SELECT ";
        $sql .= "WHERE ID IN (SELECT id FROM question ORDER BY RAND() LIMIT {$amount})";
    }

    private function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
        switch ($configuration->getDbSettings()['type']) {
            case 'pdo_mysql':
                $this->driver = PdoMysql::getInstance($configuration->getDbSettings());
                break;

        };
    }

    public static function getInstance(Configuration $configuration)
    {
        if (is_null(self::$instance)) {
            self::$instance = new self($configuration);
        }
        return self::$instance;
    }

}
