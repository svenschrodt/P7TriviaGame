<?php
declare(strict_types=1);
/**
 * Simple session management class  - abstracting from:
 *  -sessions* functions and
 * - super global $_SESSION
 *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Persistence;

class Session implements PersistorInterface
{

    /**
     * Static instance (or null, if unused) of Session
     *
     * @var Session | null
     */
    public static ?Session $instance = null;

    /**
     * Private constructor function initializing session, private - only one instance to rule 'em all
     *
     * @see self::getInstance()
     */
    private function __construct()
    {
        session_start();
    }

    /**
     * Public getter for (singleton) instance of Session - one session to rule them all
     *
     * @return Session
     */
    public static function getInstance(): Session
    {
        // Alive yet?
        if (is_null(self::$instance)) {
            self::$instance = new Session();
        }
        return self::$instance;
    }

    /**
     * Getter for key in Session
     *
     * @param string
     * @return mixed | null
     */
    public function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * Setter for key in Session
     *
     * @return Session
     */
    public function set(string $key, $value): Session
    {
        $_SESSION[$key] = $value;
        return $this;
    }

    /**
     * Unsetter for key in Session
     *
     * @return Session
     */
    public function unset(string $key): Session
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
        return $this;
    }

    /**
     * Discarding current session's state and restore previous
     *
     * @return Session
     */
    public function rollback(): Session
    {
        session_abort();
        return $this;
    }

}
