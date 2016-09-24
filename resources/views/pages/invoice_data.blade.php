@extends('base')

@section('title')
    Podatki o Računu
@endsection

@section('page-heading')
    Podatki o računu
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 form-bg">
            <h3>Račun številka: {{ $invoice->invoice_nr }}</h3>
            <br>
            @if($invoice->company_id !== 999999)
                <p>
                    <span class="krepko">Izdajaltelj: </span> {{ $invoice->company->name }} <br>
                    <span class="krepko">Kraj in Datum: </span> {{ $invoice->company->city }}, {{ $invoice->invoice_date->format('d.m.Y') }}

                </p>
            @else
                <p>
                    <span class="krepko">Izdajaltelj: </span> {{ $foreignInvoices[0]->foreignCompany->name }} <br>
                    <span class="krepko">Kraj in Datum: </span> {{ $foreignInvoices[0]->country }}, {{ $invoice->invoice_date->format('d.m.Y') }}

                </p>
            @endif
            <h4> Znesek {{ $invoice->total }} EUR  </h4>
            <hr>
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="data:image/png;base64,{{ base64_encode($code)}}" alt="" class="img img-responsive sredinsko">
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection