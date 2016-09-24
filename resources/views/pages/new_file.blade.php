@extends('base')

@section('title')
    Add new file attachment
@endsection

@section('page-heading')
    Dodaj priponko računu št.: {{$invoice->invoice_nr}}
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
           <div class="form-bg">
               <h2>Dodaj priponko</h2>
               <br>
               <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   <div class="form-group">
                       <label for="attachments" class="control-label col-sm-4">Vrsta datoteke</label>
                       <div class="col-sm-8">
                           <select name="attachments[]" id="attachments" class="form-control">
                               @foreach($attachments as $attachment)
                                   <option value="{{ $attachment->id }}">{{ $attachment->name }}</option>
                               @endforeach
                           </select>
                       </div>
                   </div>
                   <div class="form-group">
                       <label for="file" class="control-label col-sm-4">Datoteka</label>
                       <div class="col-sm-8">
                           <input type="file" name="file" id="file" class="form-control">
                       </div>
                   </div>
                   <div class="form-group">
                       <div class="col-sm-8 col-sm-offset-4">
                           <button type="submit" class="btn btn-success">
                               <span class="glyphicon glyphicon-plus"></span>
                               Pripni datoterko
                           </button>
                       </div>
                   </div>
               </form>
           </div>

        </div>
        <div class="col-sm-6 ">
            <!-- podatki o računu  -->
            <div class="data-bg">
                <h2>Podatki o računu </h2>
                @if($invoice->company_id !== 999999)
                    <p>
                        <span class="krepko">Izdajatelj računa:</span> {{ $invoice->company->name }} <br>
                        <span class="krepko">Kraj in datum:</span> {{ $invoice->company->city }}, {{ $invoice->invoice_date->format('d.m.Y') }}<br>
                        <span class="krepko">Znesek:</span> {{ $invoice->total }} EUR
                    </p>
                @else
                    <p>
                        <span class="krepko">Izdajatelj računa:</span> {{ $foreignInvoices[0]->foreignCompany->name }} <br>
                        <span class="krepko">Kraj in datum:</span> {{ $foreignInvoices[0]->country }}, {{ $invoice->invoice_date->format('d.m.Y') }}<br>
                        <span class="krepko">Znesek:</span> {{ $invoice->total }} EUR
                    </p>
                @endif
            </div>
            <hr>
            <a href="{{route('invoice_details', ['id' => $invoice->id])}}" class="btn btn-danger">
                <span class="glyphicon glyphicon-chevron-left"></span>
                Nazaj
            </a>

        </div>
    </div>
@endsection