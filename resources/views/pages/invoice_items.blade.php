@extends('base')

@section('title')
    Dodaj izdelke
@endsection

@section('page-heading')
    Dodaj izdelke in storitve na Račun {{$invoice->invoice_nr}}
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <form action="" method="post" class="form-horizontal">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="item_name" class="control-label col-sm-4">Naziv</label>
                    <div class="col-sm-8">
                        <input type="text" name="item_name" id="item_name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="units" class="control-label col-sm-4">Enota mere</label>
                    <div class="col-sm-8">
                        <select name="units[]" id="units" class="form-control">
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="quantity" class="control-label col-sm-4">Količina</label>
                    <div class="col-sm-8">
                        <input type="text" name="quantity" id="quantity" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="unit_price" class="control-label col-sm-4">Cena</label>
                    <div class="col-sm-8">
                        <input type="text" name="unit_price" id="unit_price" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="categories" class="control-label col-sm-4">Kategorija</label>
                    <div class="col-sm-8">
                        <select name="categories[]" id="categories" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-4">
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-plus"></span>
                            Dodaj Izdelek
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection