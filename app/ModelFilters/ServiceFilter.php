<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ServiceFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function name($name)
    {
        return $this->where('name', 'like', "%$name%");
    }

    public function Category($category_id)
    {
        return $this->where('category_id', $category_id);
    }

}
