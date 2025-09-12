<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Services\CompanyService;

class CompanyController
{
    public function index() {
        $companies = Company::all();

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

    public function store(StoreCompanyRequest $request, CompanyService $companyService) {
        $company = $companyService->storeCompany($request->validated());

//        Mail::to($job->employer->user)->queue(new JobPosted($job));

        return redirect()->route('companies.show', $company)
            ->with('success', 'Company created successfully!');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', ['company' => $company]);
    }

    public function update(UpdateCompanyRequest $request, Company $company, CompanyService $companyService) {
        $company = $companyService->updateCompany($company, $request->validated());

        return view('companies.show', ['company' => $company]);
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect('/companies');
    }
}
