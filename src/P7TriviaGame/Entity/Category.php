<?php
declare(strict_types=1);

/**
 * Entity class representing a category of open trivia database
 *
 * @see https://opentdb.com/api_config.php
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
* @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Entity;

class Category
{

    /**
     * ID of category (md5 hash)
     *
     * @var int
     */
    protected string $id = '';

    /**
     * @return \DateTime|null
     */
    public function getCreated(): ?\DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime|null $created
     * @return Category
     */
    public function setCreated(?\DateTime $created): Category
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Name of category
     *
     * @var string
     */
    protected string $name = '';

    protected ?\DateTime $created = null;

    protected int $apiId = 0;

    /**
     * Category constructor function
     *
     * @param string  $id
     * @param string $name
     * @param api_id
     * @param \DateTime $created
     */
    public function __construct(string $id, string $name, int $apiId=0, ?\DateTime $created = null )
    {
        $this->id = $id;
        $this->name = $name;
        if(!is_null($created)) {
            $this->created = $created;
        }
        if($apiId !==0 ) {
            $this->apiId = $apiId;
        }
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getApiId(): int
    {
        return $this->apiId;
    }

    /**
     * @param int $apiId
     * @return Category
     */
    public function setApiId(int $apiId): Category
    {
        $this->apiId = $apiId;
        return $this;
    }

    /**
     * @param string $id
     * @return Category
     */
    public function setId(string  $id): Category
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Category
     */
    public function setName(string $name): Category
    {
        $this->name = $name;
        return $this;
    }
}