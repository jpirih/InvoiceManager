<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\SaveCategoryRequest;
use App\Http\Requests\SavePaymentInstrumentRequest;
use App\PaymentInstrument;
use App\Unit;

use App\Http\Requests;
use Illuminate\Support\Facades\Request;

class DashboardController extends Controller
{
    // login required
    public function __construct()
    {
        return $this->middleware('auth');
    }
    //  Invoice manager dashboard page
    public function dashboard()
    {
        $categories = Category::all();
        $paymentInstruments = PaymentInstrument::all();
        $units = Unit::all();
        $units = $units->sortBy('name');

        return view('pages.dashboard', ['categories' => $categories, 'paymentInstruments' => $paymentInstruments, 'units' => $units]);
    }
    
    // add new category
    public function saveCategory(SaveCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->get('category_name');
        
        $category->save();
        return redirect(route('dashboard'))->with('status', 'Kategorija shranjena OK');
    }

    // add payment instrumnet
    public function savePayInstrument(SavePaymentInstrumentRequest $request)
    {
        $instrument = new PaymentInstrument;
        $instrument->name = $request->get('instrument_name');

        $instrument->save();
        return redirect(route('dashboard'));

    }
    
    // add packing unit 
    public function savePackingUnit()
    {
        $unit = new Unit;
        $unit->label = Request::get('label');
        $unit->name = Request::get('unit_name');
        $unit->save();
        
        return redirect(route('dashboard'));
    }
    
}
