<?php

namespace App\Http\Controllers;

use App\Models\Company;

class CompanyController
{
    public function index() {
        $companies = Company::where('deleted_at', null)->get();

        return view('companies.index', [
            'companies' => $companies
        ]);
    }

    public function show(Company $company)
    {
        return view('companies.show', ['company' => $company]);
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store() {

        // IN REQUEST FILE
        request()->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'min:10', 'numeric'],
            'street' => ['required'],
            'street_number' => ['required', 'numeric'],
            'city' => ['required'],
            'postcode' => ['required', 'min:4'],
            'country' => ['required'],
            'is_active' => ['required']
        ]);

        // IN SERVICE
        $address = request('street') . ' '
            . request('street_number') . ', '
            . request('city') . ' '
            . request('postcode') . ', '
            . request('country');

        $company = Company::create([
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

//        Mail::to($job->employer->user)->queue(new JobPosted($job));

        return redirect('/companies');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', ['company' => $company]);
    }

    public function update(Company $company) {
        request()->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'min:10'],
            'street' => ['required'],
            'street_number' => ['required', 'numeric'],
            'city' => ['required'],
            'postcode' => ['required', 'min:4'],
            'country' => ['required'],
            'is_active' => ['required']
        ]);

        $company->update([
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
            'is_active' => request('is_active')
        ]);

        return redirect("/companies/{$company->id}");
    }

    public function destroy(Company $company)
    {
        $company->update(['deleted_at' => now()]);

        return redirect('/companies');
    }
}
