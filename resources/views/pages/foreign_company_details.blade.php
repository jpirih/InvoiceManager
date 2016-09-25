@extends('base')

@section('title')
    Foreign company details
@endsection

@section('page-heading')
    {{ $foreignCompany->name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-3">
            <div class="thumbnail">
                <img src="{{ $foreignCompany->logo }}" alt="fc_log" class="img img-responsive img-rounded img-thumbnail">
                <div class="caption">
                    <h3>{{ $foreignCompany->name }}</h3>
                    <p>
                        <a href="{{ $foreignCompany->url }}">{{ $foreignCompany->url }}</a>
                    </p>
                    <h3>Statistika</h3>
                    <p>
                        <span class="krepko">Število nakupov: </span> {{ count($foreignCompany->foreignInvoices) }} <br>
                        <span class="krepko">Vrednost nakov: </span> {{ $companyTotal }} EUR
                    </p>
                    <p>
                        <a href="{{ route('foreign_companies') }}" class="btn btn-danger">
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
                    <h3>Pregled računov</h3>
                    @if(count($foreignCompany->foreignInvoices) == 0)
                        <div class="alert alert-info">
                            <span class="glyphicon glyphicon-info-sign"></span>
                            Trenutno v bazi ni shranjenih računov za nakupe v tej Trgovini.
                        </div>
                    @else
                       <table class=" table table-responsive table-bordered table-striped">
                           <thead>
                            <tr class="glava-tabele">
                                <th>Številka Računa</th>
                                <th>Datum nakupa</th>
                                <th>Država</th>
                                <th>Znesek</th>
                            </tr>
                           </thead>
                           <tbody class="bg-info">
                            @foreach($foreignCompany->foreignInvoices as $invoice)
                                <tr>
                                    <td><a href="{{ route('invoice_details', ['id' => $invoice->invoice->id]) }}">{{ $invoice->invoice->invoice_nr }}</a></td>
                                    <td>{{ $invoice->invoice->invoice_date->format('d.m.Y') }}</td>
                                    <td>
                                        {{ $invoice->country_code }} - {{ $invoice->country }}
                                    </td>
                                    <td>{{ $invoice->invoice->total }}</td>
                                </tr>
                            @endforeach
                           </tbody>
                       </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection