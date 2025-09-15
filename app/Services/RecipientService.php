<?php

namespace App\Services;

use App\Models\Recipient;

class RecipientService
{
    public function getRecipients()
    {
        return Recipient::where('id', '!=', auth()->id());
    }

    public function search($query)
    {
        if (request()->filled('email')) {
            return $query->where('email', 'LIKE', '%' . request()->input('email') . '%');
        }

        return $query;
    }
    public function perPage()
    {
        return request()->input('per_page', 15);
    }

    public function orderBy()
    {
        $allowed = ['email'];
        $col = request()->input('order_by', 'name');
        return in_array($col, $allowed, true) ? $col : 'name';
    }

    public function direction()
    {
        $dir = strtolower(request()->input('direction', 'asc'));
        if (request()->input('order_by') == 'created_at') {
            return $dir === 'desc' ? 'asc' : 'desc';
        }
        return $dir === 'desc' ? 'desc' : 'asc';
    }

    public function applyOrdering($query)
    {
        $column = $this->orderBy();
        $dir = $this->direction();

        if ($column === 'name') {
            return $query->orderByRaw("name {$dir}");
        }

        return $query->orderBy($column, $dir);
    }

    public function whereActive($query, $isActive)
    {
        if ($isActive != null && $isActive != '') {
            $query->where('is_active', $isActive);
        }
        return $query;
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
