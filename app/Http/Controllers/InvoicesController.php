<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Category;
use App\Company;
use App\File;
use App\Http\Requests\SaveInvoiceRequest;
use App\Invoice;
use App\Item;
use App\PaymentInstrument;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class InvoicesController extends Controller
{
    // konstruktor - obvezna prijava
    
    public function __construct()
    {
         return $this->middleware('auth');
    }
    // seznam vseh racunov
    public function invoices()
    {
        $invoices = Invoice::where('deleted', '=', false)->get();
        $invoices = $invoices->sortByDesc('invoice_date');
        
        foreach ($invoices as $invoice)
        {
            $invoice->invoice_date = Carbon::createFromTimestamp(strtotime($invoice->invoice_date));
        }

        return view('pages.invoices', ['invoices' => $invoices]);
    }

    // obrazec vnos racuna
    public function addInvoice()
    {
        $companies = Company::all();
        $instruments = PaymentInstrument::all();
        
        return view('pages.new_invoice', ['companies' => $companies, 'instruments' => $instruments]);
    }

    // shrani nov racun
    public function saveInvoice( SaveInvoiceRequest $request)
    {
        $invoice = new Invoice;
        
        // podatki iz obrazca
        $company = $request->get('companies');
        $company = $company[0];

        $dateString = $request->get('invoice_date');
        $date = strtotime($dateString);
        $invoiceDate = date('Y-m-d', $date);

        $instrument = $request->get('instruments');
        $instrument = $instrument[0];

        
        // shranjevanje podatkov v tabelo invoices
        $invoice->company_id = $company;
        $invoice->invoice_nr = $request->get('invoice_nr');
        $invoice->invoice_date = $invoiceDate;
        $invoice->payment_instrument_id = $instrument;
        $invoice->total = $request->get('total');

        $invoice->save();
        

        return redirect(route('invoice_details', ['id' => $invoice->id]));
    }

    // podrobnosti o racunu postavke
    public  function invoiceDetails($id)
    {
        $items = Item::where('invoice_id', '=', $id)->get();
        $invoice = Invoice::find($id);
        $invoice->invoice_date = Carbon::createFromTimestamp(strtotime($invoice->invoice_date));

        return view('pages.invoice_details', ['invoice' => $invoice, 'items' => $items]);
    }
    
    // urejanje podatkov racuna
    public function editInvoiceDetails($id)
    {
        $invoice = Invoice::find($id);
        
        return view('pages.edit_invoice', ['invoice' => $invoice]);
    }

    // shrani spremembe na racunu
    public function updateInvoiceDetails(SaveInvoiceRequest $request, $id)
    {

        $dateString = $request->get('invoice_date');
        $date = strtotime($dateString);
        $invoiceDate = date('Y-m-d', $date);
        
        $invoice = Invoice::find($id);

        $invoice->invoice_nr = $request->get('invoice_nr');
        $invoice->invoice_date = $invoiceDate;
        $invoice->total = $request->get('total');

        $invoice->save();

        return redirect(route('invoice_details', ['id' => $invoice->id]));
    }

    // brisanje racuna - soft delete
    public function deleteInvoice($invoiceId)
    {
        $invoice = Invoice::find($invoiceId);

        $invoice->deleted = true;
        $invoice->save();

        return redirect(route('invoices'));
    }

    
}
