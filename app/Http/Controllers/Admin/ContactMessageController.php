<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);

        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);

        if ($message->status === 'unread') {
            $message->update(['status' => 'read']);
        }

        return view('admin.contact-messages.show', compact('message'));
    }
}
