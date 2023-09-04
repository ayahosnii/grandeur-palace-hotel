<?php

namespace App;

use App\LinkedList\Node;
use Illuminate\Support\Facades\Session;


class LinkedListQueue
{
    private $head;
    private $tail;

    public function __construct()
    {
        $this->head = $this->tail = null;

        // Initialize the linked list from the session if it exists
        $sessionList = Session::get('theLinkedList');
        if ($sessionList) {
            $this->head = $this->tail = null; // Reset the current list
            $sessionList = json_decode($sessionList, true);

            foreach ($sessionList as $data) {
                $this->enqueue($data);
            }
        }
    }


    public function isEmpty()
    {
        return $this->head === null;
    }

    public function enqueue($data)
    {
        $node = new Node($data);

        if ($this->isEmpty()) {
            $this->head = $this->tail = $node;
        } else {
            $this->tail->next = $node;
            $this->tail = $node;
        }

        // Retrieve the existing linked list from the session
        $sessionList = json_decode(Session::get('theLinkedList')) ?? null;

        // Create a new linked list if it doesn't exist in the session
        if ($sessionList === null) {
            $sessionList = (object)[
                'data' => $data,
                'next' => null,
            ];
        } else {
            // Find the last item and update its 'next' value
            $lastItem = $sessionList;
            while (isset($lastItem->next) && $lastItem->next !== null) {
                $lastItem = $lastItem->next;
            }
            $lastItem->next = (object)[
                'data' => $data,
                'next' => null,
            ];
        }

        // Serialize the updated linked list and store it in the session
        Session::put('theLinkedList', json_encode($sessionList));
    }




    public function dequeue()
    {
        // Retrieve the existing linked list from the session
        $sessionList = json_decode(Session::get('theLinkedList'), true); // Decode JSON into PHP array

        if (!empty($sessionList)) {
            // Remove the first element from the linked list
            $removedData = $sessionList['data']; // Store the data of the removed node
            $sessionList = $sessionList['next']; // Update the linked list to the next node

            // Serialize the updated linked list and store it in the session
            Session::put('theLinkedList', json_encode($sessionList));

            return $removedData; // Return the dequeued data
        } else {
            // Handle the case where the linked list is empty
            return null;
        }
    }


    public function getLinkedList()
    {
        $linkedNodes = [];
        $currentNode = $this->head;

        while ($currentNode !== null) {
            $linkedNodes[] = $currentNode;
            $currentNode = $currentNode->next;
        }

        return $linkedNodes;
    }
}
