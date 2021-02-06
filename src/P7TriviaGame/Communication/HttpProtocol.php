<?php declare(strict_types=1);
/**
 * P7Tools\Http\Protocol
 *
 * Class representing general HTTP protocol (methods, headers , other  attributes etc.)
 *
 * @see https://opentdb.com/api_config.php
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Communication;

class HttpProtocol
{
    //@todo add more comments -> @TODO add RFCs
    const VERSION_10 = '1.0';
    const VERSION_11 = '1.1';
    const VERSION_20 = '2.0';

    //Methods -> @TODO add RFCs
    const METHOD_OPTIONS = 'OPTIONS';
    const METHOD_GET = 'GET';
    const METHOD_HEAD = 'HEAD';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';
    const METHOD_TRACE = 'TRACE';
    const METHOD_CONNECT = 'CONNECT';

    // Separator character sequences -> @TODO add RFCs
    const HEADER_SEPARATOR = "\r\n";
    const MESSAGE_SEPARATOR = "\r\n\r\n";

    /**
     * HTTP status codes acc. to RFC 216 sec 10 'Status Code Definitions':
     *
     * Status code equals array key and value reason phrase
     *
     * @link  http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html#sec10
     * @var array
     */

    // Informational 1xx
    const STATUS_CODE_CONTINUE = 100;
    const STATUS_CODE_SWITCHING_PROTOCOLS = 101;
    const STATUS_CODE_PROCESSING = 102;

    // Successful 2xx
    const STATUS_CODE_OK = 200;
    const STATUS_CODE_CREATED = 201;
    const STATUS_CODE_ACCEPTED = 202;
    const STATUS_CODE_NON_AUTHORITATIVE_INFORMATION = 203;
    const STATUS_CODE_NO_CONTENT = 204;
    const STATUS_CODE_RESET_CONTENT = 205;
    const STATUS_CODE_PARTIAL_CONTENT = 206;
    const STATUS_CODE_MULTI_STATUS = 207;
    const STATUS_CODE_ALREADY_REPORTED = 208;

    // Redirection 3xx
    const STATUS_CODE_MULTIPLE_CHOICES = 300;
    const STATUS_CODE_MOVED_PERMANENTLY = 301;
    const STATUS_CODE_FOUND = 302;
    const STATUS_CODE_SEE_OTHER = 303;
    const STATUS_CODE_NOT_MODIFIED = 304;
    const STATUS_CODE_USE_PROXY = 305;
    const STATUS_CODE_SWITCH_PROXY = 306;
    const STATUS_CODE_TEMPORARY_REDIRECT = 307;


    // Client Error 4xx
    const STATUS_CODE_BAD_REQUEST = 400;
    const STATUS_CODE_UNAUTHORIZED = 401;
    const STATUS_CODE_PAYMENT_REQUIRED = 402;
    const STATUS_CODE_FORBIDDEN = 403;
    const STATUS_CODE_NOT_FOUND = 404;
    const STATUS_CODE_METHOD_NOT_ALLOWED = 405;
    const STATUS_CODE_NOT_ACCEPTABLE = 406;
    const STATUS_CODE_PROXY_AUTHENTICATION_REQUIRED = 407;
    const STATUS_CODE_REQUEST_TIME_OUT = 408;
    const STATUS_CODE_CONFLICT = 409;
    const STATUS_CODE_GONE = 410;
    const STATUS_CODE_LENGTH_REQUIRED = 411;
    const STATUS_CODE_PRECONDITION_FAILED = 412;
    const STATUS_CODE_REQUEST_ENTITY_TOO_LARGE = 413;
    const STATUS_CODE_REQUEST_URI_TOO_LONG = 414;
    const STATUS_CODE_UNSUPPORTED_MEDIA_TYPE = 415;
    const STATUS_CODE_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    const STATUS_CODE_EXPECTATION_FAILED = 417;
    const STATUS_CODE_IM_A_TEAPOT = 418;
    const STATUS_CODE_UNPROCESSABLE_ENTITY = 422;
    const STATUS_CODE_LOCKED = 423;
    const STATUS_CODE_FAILED_DEPENDENCY = 424;
    const STATUS_CODE_UNORDERED_COLLECTION = 425;
    const STATUS_CODE_UPGRADE_REQUIRED = 426;
    const STATUS_CODE_PRECONDITION_REQUIRED = 428;
    const STATUS_CODE_TOO_MANY_REQUESTS = 429;
    const STATUS_CODE_REQUEST_HEADER_FIELDS_TOO_LARGE = 431;

    // Server Error 5xx
    const STATUS_CODE_INTERNAL_SERVER_ERROR = 500;
    const STATUS_CODE_NOT_IMPLEMENTED = 501;
    const STATUS_CODE_BAD_GATEWAY = 502;
    const STATUS_CODE_SERVICE_UNAVAILABLE = 503;
    const STATUS_CODE_GATEWAY_TIME_OUT = 504;
    const STATUS_CODE_HTTP_VERSION_NOT_SUPPORTED = 505;
    const STATUS_CODE_VARIANT_ALSO_NEGOTIATES = 506;
    const STATUS_CODE_INSUFFICIENT_STORAGE = 507;
    const STATUS_CODE_LOOP_DETECTED = 508;
    const STATUS_CODE_NETWORK_AUTHENTICATION_REQUIRED = 511;


    /**
     * Array with valid HTTP request methods
     *
     * @var array
     */
    protected  $validMethods = array(self::METHOD_OPTIONS, self::METHOD_GET, self::METHOD_HEAD , self::METHOD_POST, self::METHOD_PUT, self::METHOD_DELETE, self::METHOD_TRACE, self::METHOD_CONNECT);

    /**
     * HTTP status codes acc. to RFC 216 sec 10 'Status Code Definitions':
     *
     * Status code equals array key and value reason phrase
     *
     * @link  http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html#sec10
     * @var array
     */
    public static array $statusCodes = array(
        // Informational 1xx
        100 => 'Continue', 101 => 'Switching Protocols', 102 => 'Processing',

        // Successful 2xx
        200 => 'OK', 201 => 'Created', 202 => 'Accepted', 203 => 'Non-Authoritative Information',
        204 => 'No Content', 205 => 'Reset Content', 206 => 'Partial Content', 207 => 'Multi-status',
        208 => 'Already Reported',

        // Redirection 3xx
        300 => 'Multiple Choices', 301 => 'Moved Permanently', 302 => 'Found', 303 => 'See Other',
        304 => 'Not Modified', 305 => 'Use Proxy', 306 => 'Switch Proxy', // Deprecated
        307 => 'Temporary Redirect',

        // Client Error 4xx
        400 => 'Bad Request', 401 => 'Unauthorized', 402 => 'Payment Required', 403 => 'Forbidden',
        404 => 'Not Found', 405 => 'Method Not Allowed', 406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required', 408 => 'Request Time-out', 409 => 'Conflict',
        410 => 'Gone', 411 => 'Length Required', 412 => 'Precondition Failed',
        413 => 'Request Entity Too Large', 414 => 'Request-URI Too Long', 415 => 'Unsupported Media Type',
        416 => 'Requested range not satisfiable', 417 => 'Expectation Failed', 418 => 'I\'m a teapot',
        422 => 'Unprocessable Entity', 423 => 'Locked', 424 => 'Failed Dependency',
        425 => 'Unordered Collection', 426 => 'Upgrade Required', 428 => 'Precondition Required',
        429 => 'Too Many Requests', 431 => 'Request Header Fields Too Large',

        // Server Error 5xx
        500 => 'Internal Server Error', 501 => 'Not Implemented', 502 => 'Bad Gateway',
        503 => 'Service Unavailable', 504 => 'Gateway Time-out', 505 => 'HTTP Version not supported',
        506 => 'Variant Also Negotiates', 507 => 'Insufficient Storage', 508 => 'Loop Detected',
        511 => 'Network Authentication Required'
    );

    /***
     * Returning HTTP status codes
     *
     * @param bool $codeOnly
     * @return array
     */
    public function getStatusCodes($codeOnly = false)
    {
        return ($codeOnly) ? array_keys(self::$statusCodes) : self::$statusCodes;
    }

    /**
     * Returning valid request methods
     *
     * @return array
     */
    public function getMethods()
    {
        return $this->validMethods;
    }

    /**
     * Checking if given method is valid HTTP method
     *
     * @param $method
     * @return bool
     */
    public function isValidMethod($method)
    {
        return in_array(strtoupper($method), $this->validMethods, true);
    }

}