<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\SaveCompanyRequest;
use App\Invoice;
use Carbon\Carbon;
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

        $postalCodes = file_get_contents( public_path('postal_codes.json'));
        $zipCodes = json_decode($postalCodes, true);


        return view('pages.new_company', ['zipCodes' => $zipCodes]);
    }
    
    // shrani podatke o podjetju
    public function saveCompany(SaveCompanyRequest $request)
    {
        $zipCodes = $request->get('zip_codes');
        $postalCode = $zipCodes[0];

        $company = new Company;
        
        $company->name = $request->get('name');
        $company->full_name = $request->get('full_name');
        $company->address = $request->get('address');
        $company->postal_code = $postalCode;
        $company->city = $request->get('city');
        $company->country = $request->get('country');
        $company->url = $request->get('url');
        $company->company_logo = $request->get('company_logo');
        
        $company->save();
        
        return redirect(route('companies'))->with('status', 'Podjetje shranjeno OK');
    }
    
    // vsi podatki o podjtju in racuni za nakupe pri tem podjetju
    public function companyDetails($company_id)
    {
        $company = Company::find($company_id);
        $invoices = Invoice::where('company_id', '=', $company_id)->get();

        foreach ($invoices as $invoice)
        {
            $invoice->invoice_date = Carbon::createFromTimestamp(strtotime($invoice->invoice_date));
        }
        $invoices = $invoices->sortByDesc('invoice_date');
        return view('pages.company_details', ['company' => $company, 'invoices' => $invoices]);
        
    }
    
    // uredi podatke o podjetju 
    public function editCompanyDetails($id)
    {
        $company = Company::find($id);
        
        return view('pages.edit_company', ['company' => $company]);
    }
    
    // shrani spremenjene podatke o podjetju nazaj v bazo
    public function updateCompanyDetails(SaveCompanyRequest $request,$id)
    {
        $company = Company::find($id);
        
        $company->name = $request->get('name');
        $company->full_name = $request->get('full_name');
        $company->address = $request->get('address');
        $company->postal_code = $request->get('postal_code');
        $company->city = $request->get('city');
        $company->country = $request->get('country');
        $company->url = $request->get('url');
        $company->company_logo = $request->get('company_logo');
        
        $company->save();
        
        return redirect(route('company_details', ['id' => $id]));
    }


}
