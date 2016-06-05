@extends('base')

@section('title')
    Dodaj Račun
@endsection

@section('page-heading')
    Dodaj račun
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="companies" class="control-label col-sm-4">
                        Izdajatelj Računa
                    </label>
                    <div class="col-sm-8">
                        <select name="companies[]" id="companies" class="form-control">
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="invoice_nr" class="control-label col-sm-4">Številka Računa</label>
                    <div class="col-sm-8">
                        <input type="text" name="invoice_nr" id="invoice_nr" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="invoice_date" class="control-label col-sm-4">Datum Računa</label>
                    <div class="col-sm-8">
                        <input type="date" name="invoice_date" id="invoice_date" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="instruments" class="control-label col-sm-4">Način Plačila</label>
                    <div class="col-sm-8">
                        <select name="instruments[]" id="instruments" class="form-control">
                            @foreach($instruments as $instrument)
                                <option value="{{ $instrument->id }}"> {{ $instrument->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="form-group">
                    <label for="total" class="control-label col-sm-4">Znesek</label>
                    <div class="col-sm-8">
                        <input type="text" name="total" id="total" class="form-control">
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
                            Dodaj Račun
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection