<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        try {
            $contactUs = Contact::create($validatedData);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Database error'], 500);
        }

        if ($contactUs) {
            return response()->json(['message' => 'Message sent successfully'], 201);
        } else {
            return response()->json(['error' => 'Failed to create message'], 500);
        }
    }
}
