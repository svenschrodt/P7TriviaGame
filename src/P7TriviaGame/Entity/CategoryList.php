<?php
/**
 * Class managing list of P7TriviaGame\Entity\Category

 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-07
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Entity;


class CategoryList
{

    /**
     * Array holding list of categories
     *
     * @var Question[]
     */
    protected array $data = [];

    /**
     * List of (hashed text) category
     * @var array
     */
    protected array $idIndex = [];

    protected array $hashToIndex = [];


    /**
     * CategoryList constructor function
     *
     * @param array $data
     */
    public function __construct(array $data = [], bool $indexing = false)
    {
        $this->data = $data;
        if($indexing) {
            //@TODO write temporary internal index for search optimization
        }
    }

    public function push(Category $category)
    {
        $this->data [] = $category;
    }

    /**
     * Getting element with index $index of internally stored data
     *
     * @param int $index
     * @return Category
     */
    public function get(int $index) : Category
    {
        return $this->data[$index] ?? null;
    }

    /**
     * Getting category by its ID (md5 hashed $name) from CategoryList
     *
     * @param string $id
     * @return mixed|Question|null
     */
    public function getById(string $id)
    {
        if(!array_key_exists($id,$this->hashToIndex)) {
            return null;
        } else {
            return $this->data[$this->hashToIndex[$id]];
        }
    }

    public function getByName($name)
    {
        foreach ($this->data as $item) {
            if($item->getName() === $name) {
                return $item;
            }
        }
    }

    public function addToIndex(string$key)
    {
        array_push( $this->idIndex, $key);
        $this->hashToIndex = array_flip($this->idIndex);
    }

    /**
     * Counter function for internally stored elements
     *
     * @return int
     */
    public function count() : int
    {
        return count($this->data);
    }




}