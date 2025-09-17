<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipientRequest;
use App\Http\Requests\UpdateRecipientRequest;
use App\Models\Recipient;
use App\Services\CompanyService;
use App\Services\RecipientService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RecipientController
{
    // TODO Refactor la toate controllere
    protected $query;
    public function __construct(protected RecipientService $recipientService) {
        $query = $this->recipientService->resetQuery();
    }
    public function index()
    {
        $recipients = $this->recipientService->getFilteredRecipients();

        $this->recipientService->logInfo("accessed the users index page", Auth::id(), request()->ip());

        return view('recipients.index', ['recipients' => $recipients]);
    }

    public function show(Recipient $recipient)
    {
        return view('recipients.show', ['recipient' => $recipient]);
    }

    public function edit(Recipient $recipient)
    {
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

            $this->recipientService->logInfo("added a new recipient with ID {$recipient->id}", Auth::id(), request()->ip());

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

            $this->recipientService->logInfo("updated recipient with ID {$recipient->id}", Auth::id(), request()->ip());

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

            $this->recipientService->logInfo("deleted recipient with ID {$recipient->id}", Auth::id(), request()->ip());

            return redirect()->route('recipients.index')
                ->with('success', 'Recipient deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
