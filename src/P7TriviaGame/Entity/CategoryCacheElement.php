<?php
/**
 * CategoryCacheElement - representing element to be stored in category data cache
 *
 *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-07
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Entity;


class CategoryCacheElement
{
    protected int $id=0;

    protected string $name='';

    protected string $hash='';

   public function __construct(Category $data)
   {
        $this->setId($data->getId())->setName($data->getName())->setHash(md5($data->getName()));
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
     * @return CategoryCacheElement
     */
    public function setName(string $name): CategoryCacheElement
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     * @return CategoryCacheElement
     */
    public function setHash(string $hash): CategoryCacheElement
    {
        $this->hash = $hash;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return CategoryCacheElement
     */
    public function setId(int $id): CategoryCacheElement
    {
        $this->id = $id;
        return $this;
    }

}