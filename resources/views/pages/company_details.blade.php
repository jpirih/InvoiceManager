@extends('base')

@section('title')
    Podjetje {{ $company->name }}
@endsection

@section('page-heading')
    {{ $company->name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-3">
            <div class="thumbnail">
                <img src="{{ $company->company_logo }}" alt="logo" class="logo img-responsive img-rounded img img-thumbnail">
                <div class="caption">
                    <h3>{{ $company->full_name }}</h3>
                    <p>
                        {{ $company->address }}, {{ $company->postal_code }} {{ $company->city }} <br>
                        {{ $company->country }}
                    </p>
                    <p>
                        <a href="{{ $company->url }}" target="_blank">{{ $company->url }}</a>
                    </p>
                    <p>
                        <a href="{{ route('edit_company', ['id' => $company->id]) }}" class="btn btn-primary">
                            <span class="glyphicon glyphicon-pencil"></span>
                            Uredi podatke
                        </a>
                        <a href="{{ route('companies') }}" class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            Nazaj
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Pregled računov <span class="pull-right"> <a href="{{route('new_company_invoice', ['id' => $company->id])}}" class="btn btn-success">
                                <span class="glyphicon glyphicon-plus"></span>
                                Dodaj Račun
                            </a></span></h3> <br>
                    @if(count($company->invoices)> 0)

                        <table class="table table-responsive table-bordered table-condensed table-striped">
                            <thead>
                                <tr class="glava-tabele">
                                    <th>Številka Računa</th>
                                    <th>Datum</th>
                                    <th>Znesek</th>
                                </tr>
                            </thead>
                            <tbody class="bg-info">
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td><a href="{{route('invoice_details', ['id' => $invoice->id])}}">{{ $invoice->invoice_nr }}</a></td>
                                        <td>{{ $invoice->invoice_date->format('d.m.Y') }}</td>
                                        <td>{{ $invoice->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            <span class="glyphicon glyphicon-info-sign"></span>
                            Trenutno ni shranjenih računov tega podjetja
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection