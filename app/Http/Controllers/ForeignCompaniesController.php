<?php

namespace App\Http\Controllers;

use App\ForeignCompany;
use App\Http\Requests\SaveForeignCompanyRequest;
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
}
