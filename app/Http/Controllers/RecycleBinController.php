<?php

namespace App\Http\Controllers;

use App\File;
use App\Invoice;
use App\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Routing\Route;

class RecycleBinController extends Controller
{
    // list of all elements
    public function overview()
    {
        $deletedInvoices = Invoice::where('deleted', '=', true)->get();
        $files = File::all();
        foreach ($deletedInvoices as $invoice)
        {
            $invoice->invoice_date = Carbon::createFromTimestamp(strtotime($invoice->invoice_date));
        }

        return view('pages.deleted_items', ['deletedInvoices' => $deletedInvoices, 'files' => $files]);
    }

    //restore invoice
    public function restoreInvoice($invoiceId)
    {
        $invoice = Invoice::find($invoiceId);
        $invoice->deleted = false;
        $invoice->save();

        return redirect(route('invoices'));
    }

    // delete invoice and Items on this invoice
    public function deleteInvoice($invoiceID)
    {
        $invoice = Invoice::find($invoiceID);
        $invoice->delete();
        $invoiceItems = Item::where('invoice_id', '=', $invoiceID) ->get();

        foreach ($invoiceItems as $item)
        {
            $item->categories()->detach($item->category_id);
            $item->delete();
    }

        return redirect(route('deleted_items'));
    }

    // delete unlinked flies
    public function deleteUnlinkedFile($fileId)
    {
        $file = File::find($fileId);
        unlink(public_path('/uploads/'.$file->file_name));
        $file->delete();

        return redirect()->back();

    }


}
