<?php
/**
 * Created by PhpStorm.
 * User: SAMSUNG
 * Date: 02/04/2017
 * Time: 15:07
 */

namespace MyApp\VideoBundle\Entity;
use FOS\CommentBundle\Model\Tree;
use FOS\CommentBundle\Sorting\SortingInterface;

    /**
     *
     */
class OrderSorting implements SortingInterface
{
    /**
     * Takes an array of Tree instances and sorts them.
     *
     * @param  array $tree
     * @return Tree
     */
    public function sort(array $tree)
    {
        //Implement sorting strategy
    }

    /**
     * Sorts a flat comment array.
     *
     * @param  array $comments
     * @return array
     */
    public function sortFlat(array $comments)
    {
        //Implement sorting strategy
    }
}