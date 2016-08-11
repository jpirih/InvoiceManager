@extends('base')

@section('title')
    Uredi podatke računa
@endsection

@section('page-heading')
    Uredi podatke računa številka {{ $invoice->invoice_nr }}
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="form-bg">
                <h2>Urejanje podatkov računa</h2>
                <hr>
                <form action="" method="post" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="companies" class="control-label col-sm-4">
                            Izdajatelj Računa
                        </label>
                        <div class="col-sm-8">
                            <input type="text" disabled value="{{ $invoice->company->name }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="invoice_nr" class="control-label col-sm-4">Številka Računa</label>
                        <div class="col-sm-8">
                            <input type="text" name="invoice_nr" id="invoice_nr" value="{{ $invoice->invoice_nr }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="invoice_date" class="control-label col-sm-4">Datum Računa</label>
                        <div class="col-sm-8">
                            <input type="date" name="invoice_date" id="invoice_date" value="{{ $invoice->invoice_date }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="instruments" class="control-label col-sm-4">Način Plačila</label>
                        <div class="col-sm-8">
                            <input type="text" disabled value="{{ $invoice->payment_instrument->name }}" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="total" class="control-label col-sm-4">Znesek</label>
                        <div class="col-sm-8">
                            <input type="text" name="total" id="total" value="{{ $invoice->total }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-save"></span>
                                Shrani spremembe
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="data-bg">
                <h2>Navodila</h2>
                <hr>
                <p>
                    V Obrazcu na levi strani so že vpini trenutni podatki o računu,
                    če bi radi spremenil katerga od podatkov vpiši drugo vrednost v vnosno polje v obrazcu
                    in pritisni gumb shrani spremembe.
                </p>
                <p>
                    Pri vnosu zneske pazi obvezno vnesi decimalno piko ne vejice!
                </p>
                <p>
                    Izdajatelja računa in načina plačila trenutno še ni možno spremijati.
                </p>
                <hr>
                <a href="{{route('invoice_details', ['id' => $invoice->id])}}" class="btn btn-danger">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    Nazaja
                </a>
            </div>
        </div>
    </div>


@endsection