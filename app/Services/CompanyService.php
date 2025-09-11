<?php

namespace App\Services;

use App\Models\Company;

class CompanyService
{
    public function storeCompany(array $data): Company
    {
        $address = request('street') . ' '
            . request('street_number') . ', '
            . request('city') . ' '
            . request('postcode') . ', '
            . request('country');

        return Company::create([
            'name' => request('name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'address' => [
                'street' => request('street'),
                'street_number' => request('street_number'),
                'city' => request('city'),
                'postcode' => request('postcode'),
                'country' => request('country')
            ],
            'slug' => fake()->unique()->bothify('SKU-##??'),
            'is_active' => request('is_active'),
            'deleted_at' => null,
        ]);
    }

    public function updateCompany(Company $company, array $data): Company
    {
        $address = [
            'street' => $data['street'],
            'street_number' => $data['street_number'],
            'city' => $data['city'],
            'postcode' => $data['postcode'],
            'country' => $data['country'],
        ];

        $company->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $address,
            'is_active' => $data['is_active'],
        ]);

        return $company;
    }
}
