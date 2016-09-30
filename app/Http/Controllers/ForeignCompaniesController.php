<?php

namespace App\Http\Controllers;

use App\ForeignCompany;
use App\Http\Requests\SaveForeignCompanyRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class ForeignCompaniesController extends Controller
{
    // foreign Companies
    public function foreignCompanies()
    {
        $foreignCompanies = ForeignCompany::all();
        $foreignCompanies = $foreignCompanies->sortBy('name');

        return view('pages.foreign_companies', ['foreignCompanies' => $foreignCompanies]);
    }

    // save foreign company
    public function saveForeignCompany(SaveForeignCompanyRequest $request)
    {
        // get form data
        $foreignCompanyName = $request->get('fc_name');
        $foreignCompanyUrl = $request->get('fc_url');
        $foreignCompanyLogo = $request->get('fc_logo_url');

        // save data to database

        $fc = new ForeignCompany;
        $fc->name = $foreignCompanyName;
        $fc->url = $foreignCompanyUrl;
        $fc->logo = $foreignCompanyLogo;

        $fc->save();

        return redirect(route('foreign_companies'));

    }

    // foreign company details and statistics
    public function foreignCompanyDetails($foreignCompanyId)
    {
        $foreignCompany = ForeignCompany::find($foreignCompanyId);

        // date convesion and company total calc
        $companyTotal = 0;
        $years = [];
        foreach ($foreignCompany->foreignInvoices as $invoice)
        {
            $invoice->invoice->invoice_date = Carbon::createFromTimestamp(strtotime($invoice->invoice->invoice_date));
            $companyTotal = $companyTotal + $invoice->invoice->total;
            array_push($years, $invoice->invoice->invoice_date->format('Y'));
        }
        $years = array_unique($years);

        $yearsTotals = array();
        foreach ($years as  $year)
        {
            $yearTotal = 0;
            foreach ($foreignCompany->foreignInvoices as $invoice)
            {
                if($invoice->invoice->invoice_date->format('Y') == $year)
                {
                    $yearTotal = $yearTotal + $invoice->invoice->total;
                }
            }
            $yearsTotals[$year] = $yearTotal;
        }




        return view('pages.foreign_company_details', ['foreignCompany' => $foreignCompany, 'companyTotal' => $companyTotal, 'yearsTotals' => $yearsTotals]);
    }


}
