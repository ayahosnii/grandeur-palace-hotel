<?php

namespace App\LinkedList;

use App\LinkedListQueue;

class TaskManager
{
    public $queue;

    public function __construct()
    {
        $this->queue = new LinkedListQueue();
    }
}
