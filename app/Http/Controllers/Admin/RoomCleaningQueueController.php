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
        $this->queue = Session::get('roomCleaningQueue', new LinkedListQueue());
    }


    public function index()
    {
        Session::get('roomCleaningQueue');
        return view('admin.tasks.room_cleaning_queue', ['queue' => $this->queue]);
    }
    public function dd()
    {
        dd(Session::get('roomCleaningQueue'));
    }

    public function enqueue(Request $request)
    {
        $roomNumber = $request->input('room_number');

        if ($roomNumber) {
            $this->queue->enqueue($roomNumber);

            // Store the updated queue in the session
            Session::put('roomCleaningQueue', $this->queue);
        }

        return redirect('/room-cleaning-queue');
    }

    public function clean()
    {
        $cleanedRoom = $this->queue->dequeue();

        if ($cleanedRoom !== null) {
            Log::info("Room {$cleanedRoom} cleaned successfully.");
        } else {
            Log::info("No rooms in the queue.");
        }

        return redirect('/room-cleaning-queue');
    }
}
