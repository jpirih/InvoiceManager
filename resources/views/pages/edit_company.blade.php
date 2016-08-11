@extends('base')

@section('title')
    Uredi podatke {{ $company->name }}
@endsection

@section('page-heading')
    Uredi podatke o {{ $company->name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="form-bg">
                <h2>Urejanje podatkov</h2>
                <hr>
                <!-- obrazec za urejanje podatkov o podjetju -->
                <form action="" method="post" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="name" class="control-label col-sm-4">Naziv</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" id="name" value="{{ $company->name }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="full_name" class="control-label col-sm-4">Polno ime </label>
                        <div class="col-sm-8">
                            <input type="text" name="full_name" id="full_name" value="{{ $company->full_name }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label col-sm-4">Naslov</label>
                        <div class="col-sm-8">
                            <input type="text" name="address" id="address" value="{{ $company->address }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="postal_code" class="control-label col-sm-4">Poštna številka</label>
                        <div class="col-sm-8">
                            <input type="text" name="postal_code" id="postal_code" value="{{ $company->postal_code }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city" class="control-label col-sm-4">Kraj</label>
                        <div class="col-sm-8">
                            <input type="text" name="city" id="city" value="{{ $company->city }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="country" class="control-label col-sm-4">Država</label>
                        <div class="col-sm-8">
                            <input type="text" name="country" id="country" value="{{ $company->country }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="url" class="control-label col-sm-4">Url</label>
                        <div class="col-sm-8">
                            <input type="text" name="url" id="url" value="{{ $company->url }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="company_logo" class="control-label col-sm-4">Logo url</label>
                        <div class="col-sm-8">
                            <input type="text" name="company_logo" id="company_logo" value="{{ $company->company_logo }}" class="form-control">
                        </div>
                    </div>
                    <!-- gumbi -->
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
                    V Obrazcu na levi strani so že izpolnjeni podatki  trenutni podatki o podjetju.
                    Če jih želiš spremeniti samo spremeni vrednosti v vnosnih poljih in pritisni gumb shrani shrani
                    spremembe.
                </p>
                <p>
                    Pazi pri vnosu url naslovov za linke do spletnih strani in slik. Obvezno mora biti cel link
                    od začetka do konca. Pri url za logo. mora biti url slike.
                </p>
            </div>
        </div>
    </div>

@endsection