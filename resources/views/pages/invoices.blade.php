@extends('base')

@section('title')
    Pregled Računov
@endsection

@section('page-heading')
    Seznam vseh računov
@endsection

@section('content')
    <div class="row">
        <!-- vsebina sezam vseh računov -->
        <div class="col-sm-9">
            @if(count($invoices) == 0)
                <div class="alert alert-info">
                    <p>
                        <span class="glyphicon glyphicon-info-sign"></span>
                        Trentuno v bazi ni podatkov o računih Klikni dodaj račun za dodajanje novega
                        računa
                    </p>
                </div>
            @else
                <table class="table table-responsive table-bordered table-condensed table-striped">
                    <thead>
                        <tr class="glava-tabele">
                            <th>Številka računa</th>
                            <th>Datum</th>
                            <th>Izdajatelj</th>
                            <th>Način plačila</th>
                            <th>Znesek</th>
                        </tr>
                    </thead>
                    <tbody class="bg-info">
                        @foreach($invoices as $invoice)
                            <tr>
                                <td><a href="{{ route('invoice_details', ['id'=> $invoice->id]) }}">{{ $invoice->invoice_nr }}</a></td>
                                <td>{{ $invoice->invoice_date->format('d.m.Y') }}</td>
                                <td>{{ $invoice->company->name }}</td>
                                <td>{{ $invoice->payment_instrument->name }}</td>
                                <td>{{ $invoice->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <!-- desni stolpec navigacija  -->
        <div class="col-sm-3">
            <div class="list-group">
                <a href="{{ route('new_invoice') }}" class="list-group-item list-group-item-success">
                    <span class="glyphicon glyphicon-plus"></span> Dodaj račun
                </a>
                <a href="{{ route('companies') }}" class="list-group-item list-group-item-info">
                    <span class=" glyphicon glyphicon-briefcase"></span> Podjetja
                </a>
                <a href="{{route('dashboard')}}" class=" list-group-item list-group-item-danger">
                    <span class="glyphicon glyphicon-dashboard"></span> Dashboard
                </a>
            </div>
        </div>
    </div>
@endsection