@extends('base')

@section('title')
    Dodaj Podjetje
@endsection

@section('page-heading')
    Dodaj Podjetje - izdajatelja računa
@endsection

@section('content')
    <!-- error messages -->
    @if (count($errors) > 0)
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                <span class="glyphicon glyphicon-exclamation-sign"></span>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-6">
            <div class="form-bg">
                <h2>Vnesi podatke o podjetju</h2>
                <hr>
                <!-- dodaj novo podjetje vnosni obrazec  -->
                <form action="" method="post" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="name" class="control-label col-sm-4">Naziv</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="full_name" class="control-label col-sm-4">Polno ime </label>
                        <div class="col-sm-8">
                            <input type="text" name="full_name" id="full_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label col-sm-4">Naslov</label>
                        <div class="col-sm-8">
                            <input type="text" name="address" id="address" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="zip_codes" class="control-label col-sm-4">Poštna številka</label>
                        <div class="col-sm-8">
                            <select name="zip_codes[]" id="zip_codes" class="form-control">
                                @foreach($zipCodes as $code)
                                        <option value="{{ $code['postal_code'] }}">
                                            {{ $code['postal_code']}} {{$code['city']}}
                                            @if($code['company'] !== "")
                                                ({{$code['company']}})
                                            @endif
                                        </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city" class="control-label col-sm-4">Kraj</label>
                        <div class="col-sm-8">
                            <input type="text" name="city" id="city" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="country" class="control-label col-sm-4">Država</label>
                        <div class="col-sm-8">
                            <input type="text" name="country" id="country" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="url" class="control-label col-sm-4">Url</label>
                        <div class="col-sm-8">
                            <input type="text" name="url" id="url" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="company_logo" class="control-label col-sm-4">Logo url</label>
                        <div class="col-sm-8">
                            <input type="text" name="company_logo" id="company_logo" class="form-control">
                        </div>
                    </div>
                    <!-- gumbi -->
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-plus"></span>
                                Dodaj podjetje
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
                    <span class="krepko">Naziv:</span> Vpiši skrajšano firmo podjetja oziroma
                    ime spletne trgovine.
                </p>
                <p>
                    <span class="krepko">Polno ime:</span> Vpiši Polno ime podjetja celotno firmo.
                </p>
                <p>
                    <span class="krepko">Naslov:</span> Vpiši naslov podjetja Ulica in hišna številka.
                </p>
                <p>
                    <span class="krepko">Poštna številka:</span> Vpiši poštno številko.
                </p>
                <p>
                    <span class="krepko">Kraj</span> Vpiši kraj pošte.
                </p>
                <p>
                    <span class="krepko">Džava:</span> Vpiši državo.
                </p>
                <p>
                    <span class="krepko">Url:</span> Vpiši spletno stran podjetja.
                </p>
                <p>
                    <span class="krepko">Logo url:</span> Vnesi url logotgipa podjetja. Obvezno cel url do slike.
                    Ker se potem uporablja za prikazovanje slike (logotipa).
                </p>
            </div>
        </div>
    </div>
@endsection