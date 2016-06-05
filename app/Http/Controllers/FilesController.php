<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\File;
use App\Http\Requests\SaveFileRequest;
use App\Invoice;
use Carbon\Carbon;


use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

class FilesController extends Controller
{
    // seznam vseh shranjenih datotek 
    public function filesList()
    {
        $files = File::all();
        $files = $files->sortBy('created_at');
        
        return view('pages.files', ['files' => $files]);
    }
    
    // add new file obrazec za hranjevanje nove datoteke 
    public function addFile($invoiceId)
    {
        $attachments = Attachment::all();
        $invoice = Invoice::find($invoiceId);
        $invoice->invoice_date = Carbon::createFromTimestamp(strtotime($invoice->invoice_date));
        
        return view('pages.new_file', ['attachments' => $attachments, 'invoice' => $invoice]);
    }

    // save file to database and conect to invoice 
    public function saveFile(SaveFileRequest $request, $invoiceId)
    {
        $invoice = Invoice::find($invoiceId);
        
        $attachment = $request->get('attachments');
        $attachment_id = $attachment[0];
        $file = $request->file('file');
        $dat = Attachment::find($attachment_id);

        $f = new File;

        $fileName = $dat->label.'_'.$invoice->invoice_nr.'.'.$file->getClientOriginalExtension();
        $filePath = $file->move(base_path().'/public/uploads/', $fileName);
        $fileSize = $file->getClientSize();
        $fileType = $file->getClientOriginalExtension();
        $f->attachment_id = $attachment_id;
        $f->file_name = $fileName;
        $f->file_size = $fileSize;
        $f->file_type = $fileType;
        $f->file_path = $filePath;

        $f->save();
        //shranjevanje podatkov v povezovalno tabelo files_invoices
        $f->invoices()->attach($invoice->id);

        return redirect(route('invoice_details', ['id' => $invoice->id]));
        
    }

    //odpiranje in shranjevanje PDF priponk
    public function getFile($fileId)
    {
        $data = File::find($fileId);
        $file = public_path().'/uploads/'.$data->file_name;

        $headers = array(
            'Content-Type: application/pdf'
        );

        return response()->download($file, $data->file_name.'.pdf', $headers);

    }
}
