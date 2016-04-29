@extends('base')

@section('title')
    Dodaj Podjetje
@endsection

@section('page-heading')
    Dodaj Podjeje - izdajatelja računa
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
        <div class="col-sm-6 col-sm-offset-3">
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
                    <label for="postal_code" class="control-label col-sm-4">Poštna številka</label>
                    <div class="col-sm-8">
                        <input type="text" name="postal_code" id="postal_code" class="form-control">
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
@endsection