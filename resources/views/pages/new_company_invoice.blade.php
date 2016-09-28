@extends('base')

@section('javascript')
    <script type="text/javascript" src="/js/new_company_invoice_logic.js"></script>
@endsection

@section('title')
    Dodaj Račun
@endsection

@section('page-heading')
    Dodaj račun
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div id="fcSelectErr"></div>
        </div>
        <br>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-bg">
                <h2>Vnesi podatke o računu </h2>
                <hr>
                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="company" class="control-label col-sm-4">
                            Izdajatelj Računa
                        </label>
                        <div class="col-sm-8">
                            <input type="hidden" id="companyId" value="{{ $company->id }}">
                            <input type="text" name="company" id="company" value="{{$company->name}}" class="form-control" disabled>
                        </div>
                    </div>
                    <div id="foreign_invoice">
                        <div class="form-group">
                            <label for="foreign_company" class="control-label col-sm-4">Spletna trgovina</label>
                            <div class="col-sm-8">
                                <select name="foreignCompanies[]" id="foreign_company" class="form-control">
                                    <option value="0">Izberi spletno trgovino</option>
                                    @foreach($foreignCompanies as $foreignCompany)
                                        <option value="{{ $foreignCompany->id }}">{{ $foreignCompany->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="country" class="control-label col-sm-4">Država</label>
                            <div class="col-sm-6">
                                <input type="text" name="country" id="country" class="form-control" >
                            </div>
                            <div class="col-sm-2">
                                <input type="text" name="country_code" id="country_code" class="form-control">
                            </div>
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
                            <input type="text" name="invoice_date" id="invoice_date" class="form-control">
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
                        <div class="col-sm-8 col-sm-offset-4">
                            <button type="submit" class="btn btn-success" id="addInvoiceBtn">
                                <span class="glyphicon glyphicon-plus"></span>
                                Dodaj Račun
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
                    <span class="krepko"> Izdajaltelj računa: </span> Izberi izdajalteja računa izmed podjjetji na seznam.
                    Če želenega podjetja še ni na seznamu ga dodaj s klikom na gumb Podjetja na osnovni strani.
                </p>
                <p>
                    <span class="krepko">Številka računa:</span>  Prepiši številko računa točno tako kot je napisana
                    na računu.
                </p>
                <p>
                    <span class="krepko">Datum Računa:</span> Poglej datum na računu in izberi pravilen datum na koledarju.
                </p>
                <p>
                    <span class="krepko">Način plačila:</span> Izberi način na katerega je bil račun plačan iz seznama,
                    če ustreznega načina plačila še ni na seznamu ga dodaj z klikom na uporabniško ime in v
                    meniju izberi  <span class="krepko">Dashboard</span> in dodaj način plačila.
                </p>
                <p>
                    <span class="krepko">Znesek:</span>  Vpiši celoten znesek računa skupaj z DDV.
                    <span class="krepko">Obvezno</span> vnesi decimalno piko ne vejice.
                </p>
                <hr>
                <a href="{{route('invoices')}}" class="btn btn-danger">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    Nazaj
                </a>
            </div>
        </div>
    </div>
@endsection
<!-- scipt -->

