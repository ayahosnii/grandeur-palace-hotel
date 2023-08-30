<?php

namespace App;

use App\LinkedList\Node;

class LinkedListQueue
{
    public $head;
    public $tail;

    public function enqueue($data)
    {
        $node = new Node($data);
        if (!$this->head) {
            $this->head = $node;
            $this->tail = $node;
        } else {
            $this->tail->next = $node;
            $this->tail = $node;
        }
    }

    public function dequeue()
    {
        if (!$this->head) {
            return null;
        }

        $data = $this->head->data;
        $this->head = $this->head->next;

        return $data;
    }

    public function isEmpty()
    {
        return $this->head === null;
    }

    public function toArray()
    {
        $queueArray = [];
        $currentNode = $this->head;

        while ($currentNode !== null) {
            $queueArray[] = $currentNode->data;
            $currentNode = $currentNode->next;
        }

        return $queueArray;
    }

    public function initializeFromArray($dataArray)
    {
        $this->head = null;
        $this->tail = null;

        foreach ($dataArray as $data) {
            $this->enqueue($data);
        }
    }

}
