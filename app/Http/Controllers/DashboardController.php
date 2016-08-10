<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Category;
use App\Http\Requests\SaveCategoryRequest;
use App\Http\Requests\SavePaymentInstrumentRequest;
use App\PaymentInstrument;
use App\Unit;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

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

        $attachments = Attachment::all();


        return view('pages.dashboard', ['categories' => $categories, 'paymentInstruments' => $paymentInstruments, 'units' => $units, 'attachments' => $attachments]);
    }
    
    // add new category
    public function saveCategory()
    {
        $category = new Category();
        if(Request::ajax())
        {
            $name = Request::input('category_name');

            $category->name = $name;
            $category->save();

            $response = array(
                'stauts' => 'success',
                'msg' => 'New Category added successfully!'
            );
            return Response::json($response);
        }
        else
        {
            return 'NO';
        }


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

    // add attachment type - vrste dokumentov - vezano na upload files
    public function saveAttachment()
    {
        $label = Request::get('label');
        $label = strtoupper($label);

        $attachment = new Attachment;
        $attachment->name = Request::get('attachment_name');
        $attachment->label = $label;
        $attachment->save();

        return redirect(route('dashboard'));
    }
    
}
