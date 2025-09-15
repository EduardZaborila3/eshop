<?php

namespace App\Services;

use App\Models\Company;

class CompanyService
{
    public function getCompanies()
    {
        return Company::query();
    }

    public function search($query)
    {
        if (request()->filled('name')) {
            return $query->where('name', 'LIKE', '%' . request()->input('name') . '%');
        }

        return $query;
    }

    public function perPage()
    {
        return request()->input('per_page', 15);
    }
    public function orderBy()
    {
        $allowed = ['name', 'email', 'created_at'];
        $col = request()->input('order_by', 'name');
        return in_array($col, $allowed, true) ? $col : 'name';
    }

    public function direction()
    {
        $dir = strtolower(request()->input('direction', 'asc'));
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

    public function storeCompany(): Company
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
