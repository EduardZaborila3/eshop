<?php

namespace App\Services;

use App\Models\Recipient;

class RecipientService
{
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
