@extends('base')

@section('title')
    Uredi podatke računa
@endsection

@section('page-heading')
    Uredi podatke računa številka {{ $invoice->invoice_nr }}
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
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


@endsection