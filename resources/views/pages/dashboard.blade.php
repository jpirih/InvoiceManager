@extends('base')

@section('title')
    Dashboard Pregled
@endsection

@section('page-heading')
    Invoice Manager Dashboard
@endsection

@section('content')
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
        <div class="col-sm-9">
            <div class="col-sm-6">
                <!-- dodajanje kategorj in seznam -->
                <h2>Kategorije</h2>
                <p>
                <form action="{{route('new_category')}}" method="post" class="form-inline">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="text" name="category_name" class="form-control" placeholder="Naziv kategorije">
                    <button type="submit" class="btn btn-primary">
                        <span class=" glyphicon glyphicon-plus"></span>
                        Dodaj
                    </button>
                </form>
                <hr>
                </p>
                @if(count($categories) == 0)
                    <div class="alert alert-info">
                        <p>
                            <span class="glyphicon glyphicon-info-sign"></span>
                            Trenutno ni shranjenih kateggorij  Dodaj novo
                        </p>
                    </div>
                @else
                    <table class="table table-responsive table-striped table-bordered table-condensed">
                        <thead>
                            <tr class="glava-tabele">
                                <th>#</th>
                                <th>Kategorija</th>
                            </tr>
                        </thead>
                        <tbody class="bg-info">
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="col-sm-6">
                <!-- dodajanje instrumentov placila in seznam  -->
                <h2>Orodja za plačevanje</h2>
                <p>
                <form action="{{ route('new_instrument') }}" method="post" class="form-inline">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="text" placeholder="predračun, Kreditna kartica ..." name="instrument_name" class="form-control">
                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-plus"></span>
                        Dodaj
                    </button>
                </form>
                <hr>
                </p>
                @if(count($paymentInstruments) == 0)
                    <div class="alert alert-info">
                        <p>
                            <span class="glyphicon glyphicon-info-sign"></span>
                            Tretuno ni shranjenih orodij za plačevanje. Dodaj novega
                        </p>
                    </div>
                @else
                    <table class="table table-responsive table-bordered table-striped table-condensed">
                        <thead>
                        <tr class="glava-tabele">
                            <th>#</th>
                            <th>Plačilno sredstvo</th>
                        </tr>
                        </thead>
                        <tbody class="bg-info">
                            @foreach($paymentInstruments as $instrument)
                                <tr>
                                    <td>{{ $instrument->id }}</td>
                                    <td>{{ $instrument->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
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
    <div class="row">
        <div class="col-sm-9">
            <div class="col-sm-6">
                <h3>Enote mere</h3>
                <form action="{{ route('packing_unit') }}" method="post" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="label" class="control-label col-sm-4">Oznaka</label>
                        <div class="col-sm-8">
                            <input type="text" name="label" id="label" required placeholder="kos, kg" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="unit_name" class="control-label col-sm-4">Naziv</label>
                        <div class="col-sm-8">
                            <input type="text" name="unit_name" id="unit_name" placeholder="kilogram" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                <span class="glyphicon glyphicon-plus"></span> Dodaj
                            </button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col-sm-6">
                @if(count($units) == 0)
                    <div class="alert alert-info">
                        <span class="glyphicon glyphicon-info-sign"></span>
                        Trenutno ni shranjenih podatkov o enotah mere
                    </div>
                @else
                    <table class="table table-responsive table-bordered table-condensed table-striped">
                        <thead>
                        <tr class="glava-tabele">
                            <th>Oznaka</th>
                            <th>Naziv</th>
                        </tr>
                        </thead>
                        <tbody class="bg-info">
                            @foreach($units as $unit)
                                <tr>
                                    <td>{{ $unit->label }}</td>
                                    <td>{{ $unit->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
@endsection