<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Category;
use App\Http\Requests\SavePaymentInstrumentRequest;
use App\PaymentInstrument;
use App\Unit;

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

            $newestCategory = count(Category::all());

            $response = array(
                'stauts' => 'success',
                'msg' => 'New Category added successfully!',
                'category_id' => $newestCategory
            );
            return Response::json($response);
        }
        else
        {
            return 'Error';
        }


    }

    // add payment instrumnet
    public function savePayInstrument()
    {
        if(Request::ajax())
        {
            $instrumentName = Request::input('instrument_name');

            $instrument = new PaymentInstrument;
            $instrument->name = $instrumentName;

            $instrument->save();

            $response = array(
                'msg' => 'Payment instrument added successfully!'
            );
            return Response::json($response);
        }
        else
        {
            return 'Error';
        }


    }
    
    // add packing unit 
    public function savePackingUnit()
    {
        if(Request::ajax())
        {
            $unitLabel = Request::input('label');
            $unitName = Request::input('unit_name');

            $unit = new Unit;
            $unit->label = $unitLabel;
            $unit->name = $unitName;
            $unit->save();

            $response = array(
                'msg' => 'New packing unit added successfully!'
            );

            return Response::json($response);
        }
        else
        {
            return 'Error';
        }

    }

    // add attachment type - vrste dokumentov - vezano na upload files
    public function saveAttachment()
    {
        if(Request::ajax())
        {
            $label = Request::input('attachment_label');
            $attachmentName = Request::input('attachment_name');
            $label = strtoupper($label);


            $attachment = new Attachment;
            $attachment->name = $attachmentName;
            $attachment->label = $label;
            $attachment->save();

            $response = array(
                'msg' => 'New document type added successfully'
            );

            return Response::json($response);
        }
        else
        {
            return 'Error';
        }

    }
    
}
