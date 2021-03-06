<?php

namespace App\Http\Controllers;

use App\Company;
use App\ForeignCompany;
use App\ForeignInvoice;
use App\Http\Requests\SaveCompanyRequest;
use App\Invoice;
use App\PaymentInstrument;
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

        $companyTotal = 0;
        $years = [];
        foreach ($invoices as $invoice)
        {
            $invoice->invoice_date = Carbon::createFromTimestamp(strtotime($invoice->invoice_date));
            $companyTotal = $companyTotal + $invoice->total;
            array_push($years, $invoice->invoice_date->format('Y'));
        }
        $years = array_unique($years);

        $yearsTotals = array();
        foreach ($years as $year)
        {
            $yearTotal = 0;
            foreach ($invoices as $invoice)
            {
                if($invoice->invoice_date->format('Y') == $year)
                {
                    $yearTotal = $yearTotal + $invoice->total;
                }
            }
            $yearsTotals[$year] = $yearTotal;
        }



        $invoices = $invoices->sortByDesc('invoice_date');
        return view('pages.company_details', ['company' => $company, 'invoices' => $invoices, 'companyTotal' => $companyTotal, 'yearsTotals' => $yearsTotals]);
        
    }

    // vnesi racun za nakup pri posameznem podjetju
    public function addCompanyInvoice($companyId)
    {
        $company = Company::find($companyId);
        $instruments = PaymentInstrument::all();
        $foreignCompanies = ForeignCompany::all();
        return view('pages.new_company_invoice', ['company' => $company, 'instruments' => $instruments, 'foreignCompanies' => $foreignCompanies]);
    }

    //shrani podatke o novem racunu podjetja
    public function saveCompanyInvoice($companyId, Requests\SaveInvoiceRequest $request)
    {
        $invoice = new Invoice;

        // podatki iz obrazca
        $dateString = $request->get('invoice_date');
        $date = strtotime($dateString);
        $invoiceDate = date('Y-m-d', $date);

        $instrument = $request->get('instruments');
        $instrument = $instrument[0];


        // shranjevanje podatkov v tabelo invoices
        $invoice->company_id = $companyId;
        $invoice->invoice_nr = $request->get('invoice_nr');
        $invoice->invoice_date = $invoiceDate;
        $invoice->payment_instrument_id = $instrument;
        $invoice->total = $request->get('total');

        $invoice->save();

        //  foreign invoices logic
        if($companyId == 999999)
        {
            $foreignCompany = $request->get('foreignCompanies');
            $foreignCompany = $foreignCompany[0];
            $country = $request->get('country');
            $countryCode = $request->get('country_code');


            $foreignInvoice = new ForeignInvoice;
            $foreignInvoice->invoice_id = $invoice->id;
            $foreignInvoice->foreign_company_id = $foreignCompany;
            $foreignInvoice->country = $country;
            $foreignInvoice->country_code = $countryCode;

            $foreignInvoice->save();
        }

        return redirect(route('invoice_details', ['id' => $invoice->id]));
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
