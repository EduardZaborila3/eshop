<?php

namespace App\Http\Controllers;

use App\Models\Company;

class CompanyController
{
    public function index() {
        $companies = Company::all();

        return view('components.companies.index', [
            'companies' => $companies
        ]);
    }

    public function show(Company $company)
    {
        return view('components.companies.show', ['company' => $company]);
    }

    public function create()
    {

    }

    public function store()
    {

    }
}
