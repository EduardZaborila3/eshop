<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipientRequest;
use App\Http\Requests\UpdateRecipientRequest;
use App\Models\Recipient;
use App\Services\CompanyService;
use App\Services\RecipientService;

class RecipientController
{
    public function __construct(protected RecipientService $recipientService) {}
    public function index()
    {
        $query = $this->recipientService->getRecipients();
        $query = $this->recipientService->whereActive($query, request()->input('is_active'));

        $recipients = $this->recipientService->search($query);

        $recipients = $this->recipientService->applyOrdering($query)
            ->simplePaginate($this->recipientService->perPage());

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

    public function store(StoreRecipientRequest $request)
    {
        try {
            $recipient = $this->recipientService->storeRecipient($request->validated());

            return redirect()->route('recipients.show', ['recipient' => $recipient])
                ->with('success', 'Recipient created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(UpdateRecipientRequest $request, Recipient $recipient)
    {
        try {
            $recipient = $this->recipientService->updateRecipient($recipient, $request->validated());

            return redirect()->route('recipients.show', ['recipient' => $recipient])
                ->with('success', 'Recipient updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Recipient $recipient)
    {
        try {
            $recipient->delete();

            return redirect()->route('recipients.index')
                ->with('success', 'Recipient deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
