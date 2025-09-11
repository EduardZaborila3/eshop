<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipientRequest;
use App\Http\Requests\UpdateRecipientRequest;
use App\Models\Recipient;
use App\Services\CompanyService;
use App\Services\RecipientService;

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

    public function edit(Recipient $recipient)
    {
        // dd($recipient);
        return view('recipients.edit', ['recipient' => $recipient]);
    }

    public function create()
    {
        return view('recipients.create');
    }

    public function store(StoreRecipientRequest $request, RecipientService $recipientService)
    {
        $recipient = $recipientService->storeRecipient($request->validated());

        return view('recipients.show', ['recipient' => $recipient]);
    }

    public function update(UpdateRecipientRequest $request, RecipientService $recipientService, Recipient $recipient)
    {
        $recipient = $recipientService->updateRecipient($recipient, $request->validated());

        return view('recipients.show', ['recipient' => $recipient]);
    }

    public function destroy(Recipient $recipient)
    {
        $recipient->delete();

        return redirect('/recipients');
    }
}
