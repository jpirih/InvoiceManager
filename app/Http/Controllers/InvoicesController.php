<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Category;
use App\Company;
use App\File;
use App\ForeignCompany;
use App\ForeignInvoice;
use App\Http\Requests\SaveInvoiceRequest;
use App\Invoice;
use App\Item;
use App\PaymentInstrument;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Picqer\Barcode\BarcodeGeneratorPNG;

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

        $invoices = Invoice::where('deleted', '=', false)->orderBy('invoice_date', 'desc')->paginate(15);



        $years = [];
        foreach ($invoices as $invoice) {
            $invoice->invoice_date = Carbon::createFromTimestamp(strtotime($invoice->invoice_date));
            array_push($years, $invoice->invoice_date->format("Y"));
        }
        $years = array_unique($years);


        return view('pages.invoices', ['invoices' => $invoices, 'years' => $years]);
    }

    // search invoice by invoice_nr

    public function searchInvoice()
    {
        // searched invoice nr
        $searchInvoiceNr = Request::get('invoice_nr_search');
        $searchInvoiceNr = str_replace("'", "", $searchInvoiceNr);


        // get all data from database
        $invoices = Invoice::all();
        foreach ($invoices as $invoice) {
            $invoceNr = str_replace('-', "", $invoice->invoice_nr);
            if ($invoceNr == $searchInvoiceNr) {
                $selectedInvoice = $invoice->id;
                return redirect(route('invoice_details', ['id' => $selectedInvoice]));
            }

        }

        return redirect(route('invoices'))->with('msg', 'Račun s številko: ' . $searchInvoiceNr . ' ne obstaja.');

    }

    // obrazec vnos racuna
    public function addInvoice()
    {
        $companies = Company::all();
        $instruments = PaymentInstrument::all();
        $foreignCompanies = ForeignCompany::all();

        return view('pages.new_invoice', ['companies' => $companies, 'instruments' => $instruments, 'foreignCompanies' => $foreignCompanies]);
    }

    // shrani nov racun
    public function saveInvoice(SaveInvoiceRequest $request)
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
        //  foreign invoices logic
        if ($company == 999999) {
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

    // podrobnosti o racunu postavke
    public function invoiceDetails($id)
    {
        $items = Item::where('invoice_id', '=', $id)->get();
        $invoice = Invoice::find($id);
        $foreignInvoice = ForeignInvoice::where('invoice_id', '=', $id)->get();
        $invoice->invoice_date = Carbon::createFromTimestamp(strtotime($invoice->invoice_date));

        return view('pages.invoice_details', ['invoice' => $invoice, 'items' => $items, 'foreignInvoice' => $foreignInvoice]);
    }

    // barcode generator and invoice_data
    public function invoiceData($invoiceId)
    {
        $invoice = Invoice::find($invoiceId);
        $foreignInvoices = ForeignInvoice::where('invoice_id', '=', $invoiceId)->get();
        $generator = new BarcodeGeneratorPNG();
        $code = $generator->getBarcode($invoice->invoice_nr, $generator::TYPE_CODE_128);

        // date format
        $invoice->invoice_date = Carbon::createFromTimestamp(strtotime($invoice->invoice_date));

        return view('pages.invoice_data', ['invoice' => $invoice, 'code' => $code, 'foreignInvoices' => $foreignInvoices]);
    }

    // urejanje podatkov racuna
    public function editInvoiceDetails($id)
    {
        $invoice = Invoice::find($id);
        $companies = Company::orderBy('name')->get();
        $instruments = PaymentInstrument::all();
        // slovenian date format for nicer look
        $invoice->invoice_date = date('d.m.Y', strtotime($invoice->invoice_date));

        return view('pages.edit_invoice', ['invoice' => $invoice, 'companies' => $companies, 'instruments' => $instruments]);
    }

    // shrani spremembe na racunu
    public function updateInvoiceDetails(SaveInvoiceRequest $request, $id)
    {

        $company = $request->get('companies');
        $selectedCompany = $company[0];
        $dateString = $request->get('invoice_date');
        $date = strtotime($dateString);
        $invoiceDate = date('Y-m-d', $date);
        $instrument = $request->get('instruments');
        $selectedInstrument = $instrument[0];


        $invoice = Invoice::find($id);

        $invoice->company_id = $selectedCompany;
        $invoice->invoice_nr = $request->get('invoice_nr');
        $invoice->invoice_date = $invoiceDate;
        $invoice->payment_instrument_id = $selectedInstrument;
        $invoice->total = $request->get('total');

        $invoice->save();

        return redirect(route('invoice_details', ['id' => $invoice->id]));
    }

    // brisanje racuna - soft delete
    public function deleteInvoice($invoiceId)
    {
        $invoice = Invoice::find($invoiceId);
        if (count($invoice->files) > 0) {
            return redirect(route('invoice_details', ['id' => $invoice->id]));

        } else {
            $invoice->deleted = true;
            $invoice->save();

            return redirect(route('invoices'));

        }


    }


}
