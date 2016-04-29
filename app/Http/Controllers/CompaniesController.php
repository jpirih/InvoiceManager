<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\SaveCompanyRequest;
use Illuminate\Http\Request;

use App\Http\Requests;

class CompaniesController extends Controller
{
    // obvezna prijava
   public function __construct()
   {
        return $this->middleware('auth');
   }
    
    // seznam vseh podjetji
    public function companies()
    {
        $companies = Company::all();
        $companies = $companies->sortBy('name');
        return view('pages.companies', ['companies' => $companies]);
    }
    
    // dodaj novo podjetje 
    public function addCompany()
    {
        return view('pages.new_company');
    }
    
    // shrani podatke o podjetju
    public function saveCompany(SaveCompanyRequest $request)
    {
        $company = new Company;
        
        $company->name = $request->get('name');
        $company->full_name = $request->get('full_name');
        $company->address = $request->get('address');
        $company->postal_code = $request->get('postal_code');
        $company->city = $request->get('city');
        $company->country = $request->get('country');
        $company->url = $request->get('url');
        $company->company_logo = $request->get('company_logo');
        
        $company->save();
        
        return redirect(route('companies'))->with('status', 'Podjetje shranjeno OK');
    }


}
