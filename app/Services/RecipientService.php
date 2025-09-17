<?php

namespace App\Services;

use App\Models\Recipient;
use Illuminate\Support\Facades\Log;

class RecipientService
{
    protected $query;
    public function __construct()
    {
        $this->query = Recipient::query();
    }

    public function resetQuery(): self
    {
        $this->query = Recipient::query();
        return $this;
    }

    public function getFilteredRecipients()
    {
        return Recipient::query()
            ->applyAllFilters();
    }

    public function logInfo($message, $id, $ip)
    {
        Log::info("User with ID {$id} " . $message . ". IP: {$ip}");
    }

    public function storeRecipient(array $data): Recipient
    {
        return Recipient::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address_data' => [
                'street' => $data['street'],
                'street_number' => $data['street_number'],
                'city' => $data['city'],
                'postal_code' => $data['postal_code'],
                'country' => $data['country']
            ],
            'notes' => $data['notes'],
            'deleted_at' => null
        ]);
    }

    public function updateRecipient(Recipient $recipient, array $data): Recipient
    {
        $address = [
            'street' => $data['street'],
            'street_number' => $data['street_number'],
            'city' => $data['city'],
            'postal_code' => $data['postal_code'],
            'country' => $data['country'],
        ];

        $recipient->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address_data' => $address,
            'notes' => $data['notes'],
        ]);

        return $recipient;
    }
}
