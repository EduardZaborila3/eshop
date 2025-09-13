<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Support\Facades\Mail;

class CompanyController
{
    public function __construct(protected CompanyService $companyService) {}

    public function index() {
        $companies = Company::orderBy("name", "asc")->paginate(3);

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

    public function store(StoreCompanyRequest $request) {
        $company = $this->companyService->storeCompany($request->validated());

//        Mail::to($job->employer->user)->queue(new JobPosted($job));

        return redirect()->route('companies.show', $company)
            ->with('success', 'Company created successfully!');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', ['company' => $company]);
    }

    public function update(UpdateCompanyRequest $request, Company $company) {
        $company = $this->companyService->updateCompany($company, $request->validated());

        return redirect()->route('companies.show', ['company' => $company])
            ->with('success', 'Company updated successfully!');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.destroy')
            ->with('success', 'Company deleted successfully!');
    }
}
