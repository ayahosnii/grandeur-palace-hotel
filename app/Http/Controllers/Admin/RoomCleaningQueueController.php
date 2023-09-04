<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LinkedListQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class RoomCleaningQueueController extends Controller
{
    private $queue;

    public function __construct()
    {
        $this->queue = new LinkedListQueue();

    }


    public function index()
    {
        $sessionList = json_decode(Session::get('theLinkedList'), true);
        return view('admin.tasks.room_cleaning_queue', compact('sessionList'));
    }
    public function dd()
    {
        dd(\session()->all());
    }

    public function enqueue(Request $request)
    {
        $roomNumber = $request->input('room_number');

        if ($roomNumber) {
            $this->queue->enqueue($roomNumber);

        }

        return redirect('/room-cleaning-queue');
    }

    public function clean()
    {
        $this->queue->dequeue();

        return redirect()->back();
    }
}
