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
                            <th> <span class="glyphicon glyphicon-cog"></span></th>
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
                                <td><a href="#" role="button" data-toggle="modal" data-target="#delModal{{ $invoice->id }}" class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span></a></td>
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

@foreach($invoices as $invoice)
    <!--  delete modal -->
    <div class="modal fade" id="delModal{{ $invoice->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel">Potrditev brisanja računa</h3>
                </div>
                <div class="modal-body">
                    <h4>številka {{ $invoice->invoice_nr }}</h4>
                    <p>
                        <span class="krepko">Datum računa: </span> {{ $invoice->invoice_date->format('d.m.y')}} <br>
                        <span class="krepko"> Izdajaltelj: </span> {{ $invoice->company->name }} <br>
                        <span class="krepko">Znesek: </span> {{ $invoice->total }}
                    </p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('invoice_to_trash', ['id' => $invoice->id]) }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-success">Da</button>
                    </form>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Ne</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
