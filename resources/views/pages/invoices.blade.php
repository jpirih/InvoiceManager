@extends('base')

@section('javascript')
    <script src="/js/invoices-logic.js" type="text/javascript"></script>
@endsection

@section('title')
    Pregled Računov
@endsection

@section('page-heading')
    Pregled računov
@endsection

@section('content')

    <!-- messages errors success messages other -->
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
                <div id="infoMessage"></div>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group btn-group-lg">
                <button class="btn btn-success"data-toggle="collapse" data-target="#all_invoices" data-parent="#data" aria-expanded="false">
                    Vsi Računi
                </button>
                @foreach($years as $year)
                    <button class="btn btn-success" data-toggle="collapse" data-target="#invoices{{$year}}" data-parent="#data" aria-expanded="false">
                        Računi - {{$year}}
                    </button>
                @endforeach
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <!-- vsebina sezam vseh računov -->
        <div class="col-sm-9" id="data">
            @if(count($invoices) == 0)
                <div class="alert alert-info">
                    <p>
                        <span class="glyphicon glyphicon-info-sign"></span>
                        Trentuno v bazi ni podatkov o računih Klikni dodaj račun za dodajanje novega
                        računa
                    </p>
                </div>
            @else
                <div class="panel panel-default collapse" id="all_invoices">
                    <div class="panel-body">
                        <h2>Seznam vseh računov</h2>
                        <br>
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

                    </div>
                </div>
                @foreach($years as $year)
                    <div class="panel panel-default panel-collapse collapse-in" id="invoices{{$year}}">
                        <div class="panel-body">
                            <h2>Seznam računov v letu {{ $year }}</h2>
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
                                    @if($invoice->invoice_date->format("Y") == $year)
                                        <tr>
                                            <td><a href="{{ route('invoice_details', ['id'=> $invoice->id]) }}">{{ $invoice->invoice_nr }}</a></td>
                                            <td>{{ $invoice->invoice_date->format('d.m.Y') }}</td>
                                            <td>{{ $invoice->company->name }}</td>
                                            <td>{{ $invoice->payment_instrument->name }}</td>
                                            <td>{{ $invoice->total }}</td>
                                            <td><a href="#" role="button" data-toggle="modal" data-target="#delModal{{ $invoice->id }}" class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span></a></td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                @endforeach
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
                <a href="{{ route('items') }}" class="list-group-item list-group-item-warning">
                    <span class=" glyphicon glyphicon-list-alt"></span> Izdelki in storitve
                </a>
            </div>
            <br>
            <div class="well">
                <h3>Račun številka:</h3>
                <form action="{{ route('search_invoice') }}" method="get" class="form-inline">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <input type="text" name="invoice_nr_search" id="invoiceNrSearch" class="form-control">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"></span>
                        Go
                    </button>

                </form>
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
                    <hr>
                    <div class="well">
                        <span class="glyphicon glyphicon-alert"></span>
                        Preden lahko izbirišeš račun moraš izbiristati vse pripete datoteke.
                        Če je računu pripeta kakšna datoteka boš prevserjen na podrobnosti računa,
                        kjer lahko izbrišeš priponke. potem se vrni nazaj in izbriši račun.
                    </div>
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
