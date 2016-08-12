@extends('base')

@section('title')
    Dodaj izdelke
@endsection

@section('page-heading')
    Uredi podatke o izdelku {{$item->name}}
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="form-bg">
                <h2>Urejanje podatkov izdelka / storitve </h2>
                <hr>
                <form action="" method="post" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="item_name" class="control-label col-sm-4">Naziv</label>
                        <div class="col-sm-8">
                            <input type="text" name="item_name" id="item_name" value="{{$item->name}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="units" class="control-label col-sm-4">Enota mere</label>
                        <div class="col-sm-8">
                            <select name="units[]" id="units" class="form-control">
                                <option value="{{$item->unit_id}}" selected>{{ $item->unit->name }}</option>
                                @foreach($units as $unit)
                                    <option value="{{$unit->id}}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="control-label col-sm-4">Količina</label>
                        <div class="col-sm-8">
                            <input type="text" name="quantity" id="quantity" class="form-control" value="{{$item->quantity }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="unit_price" class="control-label col-sm-4">Cena</label>
                        <div class="col-sm-8">
                            <input type="text" name="unit_price" id="unit_price" class="form-control" value="{{$item->unit_price}}">
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
                    <span class="krepko">Naziv:</span> Vipiši naziv izdelka oziroam storitve kot je na rčaunu
                    oziroma tako da boš vedel za kaj se gre.
                </p>
                <p>
                    <span class="krepko">Enota mere:</span> Izberi enoto meri  s seznama. Če primernew enote mere
                    še ni  na seznamu jo dodaj s klikom na uporabniško ime desno zgoraj. Izberi Dashboard.
                    in dodaj enoto mere.
                </p>
                <p>
                    <span class="krepko">Količina</span> Vnesi količino, če ni celo število uporabi decimalno piko
                    ne vejice.
                </p>
                <p>
                    <span class="krepko">Cena:</span> vnesi prodajno ceno na enoto mere skupaj z DDV.
                    Obvezno uporabi decimalno piko ne vejice.
                </p>
                <p>
                    <span class="krepko">Kategorija:</span> Kategorije trenutno ni mogoče urejati.
                </p>
                <hr>
                <a href="{{route('invoice_details', ['id' => $item->invoice_id])}}" class="btn btn-danger">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    Nazaj
                </a>
            </div>
        </div>
    </div>
@endsection

