<?php
namespace App;

use Iterator;
use Closure;
use FilterIterator;

class Filter extends FilterIterator {

    protected $callback;

    public function __construct(Iterator $iterator, Closure $callback = null) {
        $this->callback = $callback;
        parent::__construct($iterator);
    }

    public function accept() {
        return call_user_func(
            $this->callback, 
            $this->current(), 
            $this->key(), 
            $this->getInnerIterator(),
            $this->filters
        );
    }
}
