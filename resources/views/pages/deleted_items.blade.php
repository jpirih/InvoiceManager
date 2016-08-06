@extends('base')

@section('title')
    Označeno za brisanje pregled
@endsection

@section('page-heading')
    Pregled vseh zadev označenih za Brisanje
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-9">
            <h2>Seznam računov označenih za Brisanje </h2>
            <br>
            @if(count($deletedInvoices) == 0)
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="alert alert-info">
                        <span class="glyphicon glyphicon-info-sign"></span>
                        Trentuno ni nobenega računa, ki bi bil označen za brisanje
                    </div>
                </div>
            @else
                <table class="table table-responsive table-striped table-bordered table-condensed">
                    <thead>
                        <tr class="glava-tabele">
                            <th>Izbrisano dne</th>
                            <th>Številka računa</th>
                            <th>Datum računa</th>
                            <th>Znesek</th>
                            <th>Možnosti</th>
                        </tr>
                    </thead>
                    <tbody class="bg-info">
                        @foreach($deletedInvoices as $invoice)
                            <tr>
                                <td>{{ $invoice->updated_at->format('d.m.Y@H:i:s') }}</td>
                                <td>{{ $invoice->invoice_nr }}</td>
                                <td>{{ $invoice->invoice_date->format('d.m.Y') }}</td>
                                <td>{{ $invoice->total }}</td>
                                <td>
                                    <form action="{{route('restore_invoice',['id'=>$invoice->id])}}" method="post" class="form-inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token()}}">
                                        <button type="submit" class="btn btn-info">
                                            <span class="glyphicon glyphicon-refresh"></span>
                                        </button>
                                        <a href="#" role="button" data-toggle="modal" data-target="#deleteModal{{ $invoice->id }}" class="btn btn-danger">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="col-sm-3">
            <div class="list-group">
                <a href="{{route('companies')}}" class="list-group-item list-group-item-success">
                    <span class="glyphicon glyphicon-briefcase"></span>
                    Podjetja
                </a>
                <a href="{{route('invoices')}}" class="list-group-item list-group-item-info">
                    <span class="glyphicon glyphicon-list"></span>
                    Računi
                </a>
                <a href="{{ route('items') }}" class="list-group-item list-group-item-danger">
                    <span class="glyphicon glyphicon-list-alt"></span>
                    Izdelki/Storitve
                </a>
            </div>
        </div>
    </div>
@endsection

@foreach($deletedInvoices as $invoice)
<!--  delete modal -->
<div class="modal fade" id="deleteModal{{ $invoice->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel">Dokončno Brisanje Računa</h3>
            </div>
            <div class="modal-body">
                <h4>številka {{ $invoice->invoice_nr }}</h4>
                <p>
                    <span class="krepko">Datum računa: </span> {{ $invoice->invoice_date->format('d.m.y')}} <br>
                    <span class="krepko"> Izdajaltelj: </span> {{ $invoice->company->name }} <br>
                    <span class="krepko">Znesek: </span> {{ $invoice->total }}
                </p>
                <hr>
                <h4>Izbrisane bodo tudi vse postavke</h4>
                <table class="table table-bordered table-responsive table-striped table-condensed">
                    <thead>
                        <tr class="glava-tabele">
                            <th>Naziv</th>
                            <th>Količina</th>
                            <th>EM</th>
                            <th>PC</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice->items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->unit->name }}</td>
                                <td>{{ $item->unit_price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <form action="{{ route('delete_invoice', ['id' => $invoice->id]) }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-success">Da</button>
                </form>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Ne</button>

            </div>
        </div>
    </div>
</div>
@endforeach
