<?php

namespace App\Http\Controllers;

use App\Models\Recipient;

class RecipientController
{
    public function index()
    {
        $recipients = Recipient::all();

        return view('recipients.index', ['recipients' => $recipients]);
    }

    public function show(Recipient $recipient)
    {
        return view('recipients.show', ['recipient' => $recipient]);
    }
}
