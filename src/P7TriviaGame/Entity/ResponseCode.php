<?php
declare(strict_types=1);

/**
 * Class ResponseCode - The open trivia database API appends a "Response Code" to each API Call to help tell
 *                      developers what the API is doing.
 *
 * @see https://opentdb.com/api_config.php
 *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
* @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Entity;
use P7TriviaGame\Application\Error;

class ResponseCode
{
    /**
     * Code 0: Success - Returned results successfully.
     */
    const MSG_SUCCESS = 0;

    /**
     * Code 1: No Results - Could not return results. The API doesn't have enough questions for your query. (Ex. Asking for 50 Questions in a Category that only has 20.)
     */
    const MSG_NO_RESULT = 1;

    /**
     * Code 2: Invalid Parameter - Contains an invalid parameter. Arguements passed in aren't valid. (Ex. Amount = Five)
     */
    const MSG_INVALID_PARAM = 2;

    /**
     * Code 3: Token Not Found - Session Token does not exist.
     */
    const MSG_TOKEN_NOT_FOUND = 3;


    /**
     * Code 4: Token Empty Session  - Token has returned all possible questions for the specified query. Resetting the Token is necessary.
     */
    const MSG_TOKEN_EMPTY_SESSION = 4;


    /**
     * List of (short) messages for response codes
     *
     * @var array|string[]
     */
    protected static array $messages = [
        self::MSG_SUCCESS => 'Success',
        self::MSG_NO_RESULT => 'No result',
        self::MSG_INVALID_PARAM => 'Invalid param',
        self::MSG_TOKEN_NOT_FOUND => 'Token not found',
        self::MSG_TOKEN_EMPTY_SESSION => 'Token empty session'
    ];

    /**
     * List of verbose messages for response codes
     *
     * @var array|string[]
     */
    protected static array $messageVerbose = [
        self::MSG_SUCCESS => 'Code 0: Success Returned results successfully.',
        self::MSG_NO_RESULT => 'Code 1: No Results Could not return results. The API does not have enough questions for your query. (Ex. Asking for 50 Questions',
        self::MSG_INVALID_PARAM => 'Code 2: Invalid Parameter Contains an invalid parameter. Arguements passed in are not valid. (Ex. Amount = Five)',
        self::MSG_TOKEN_NOT_FOUND => 'Code 3: Token Not Found Session Token does not exist.',
        self::MSG_TOKEN_EMPTY_SESSION => 'Code 4: Token Empty Session Token has returned all possible questions for the specified query. Resetting the Token is necessary.'
    ];




    /**
     * Prove, if given (int) number is a valid response code
     *
     * @param int $code
     * @return bool
     */
    public static function isValidCode(int $code)
    {
        return in_array($code, self::getConstants());
    }

    /**
     * Getting short|verboe message to correponding code
     *
     * @param int $code
     * @param bool $verbose
     */
    public static function getMessageByCode(int $code, bool $verbose=false) : string
    {
        if(!self::isValidCode($code)) {
            throw new  \InvalidArgumentException(Error::getMessage(ERROR::INVALID_RESPONSE_CODE, (string) $code, self::toString()));
        } else {
            return ($verbose === true) ? self::$messageVerbose[$code] : self::$messages[$code];
        }
    }

    /**
     * Getting list of class constants
     *
     * @return array
     */
    public static function getConstants()
    {
        $class = new \ReflectionClass(__CLASS__);
        return $class->getConstants();
    }

    /**
     * Get string representation of response code constants
     *
     * @return string
     */
    public static function toString()
    {
       $tmp = [];
        foreach (self::getConstants() as $key => $val) {
            $tmp[] = "'{$key}' => '{$val}'";
        }
        return implode(', ', $tmp);
    }
}