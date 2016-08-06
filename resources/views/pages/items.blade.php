@extends('base')

@section('title')
    Izdelki in Storitve
@endsection

@section('page-heading')
    Vsi Izdelki in Storitve
@endsection

@section('content')
    <div class="row">
        @if(count($items) != 0)
            <div class="col-sm-9">
                <!-- kategorije -->
                <div class="btn-group">
                    @foreach($categories as $category)
                        <a href="{{ route('category_items', ['id' => $category->id]) }}" class="btn btn-default">{{ $category->name }}</a>
                    @endforeach
                </div>
                <hr>
                <table class="table table-responsive table-condensed table-bordered table-striped">
                    <thead>
                    <tr class="glava-tabele">
                        <th>Izdelek Storitev</th>
                        <th>Enota mere</th>
                        <th>Datum nakupa</th>
                        <th>Cena</th>
                        <th>Kategorija</th>
                    </tr>
                    </thead>
                    <tbody class="bg-info">
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->unit->label }}</td>
                                <td>{{ $item->invoice->invoice_date->format('d.m.Y') }}</td>
                                <td>{{ $item->unit_price }}</td>
                                @foreach($item->categories as $category)
                                    <td>{{ $category->name }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="col-sm-6 col-sm-offset-3">
                <div class="alert alert-info">
                    <span class="glyphicon glyphicon-info-sign"></span>
                    Trentuno ni shranjenih podatkov o izdelkih Najprej
                    vnesi podatke o računu in dodaj izdelke na račun
                </div>
            </div>
        @endif
        <div class="col-sm-3">
            <div class="list-group">
                <a href="{{ route('invoices') }}" class="list-group-item list-group-item-success">
                    <span class="glyphicon glyphicon-list"></span> Računi Pregled
                </a>
                <a href="{{ route('companies') }}" class="list-group-item list-group-item-info">
                    <span class=" glyphicon glyphicon-briefcase"></span> Podjetja
                </a>
                <a href="{{route('dashboard')}}" class=" list-group-item list-group-item-danger">
                    <span class="glyphicon glyphicon-dashboard"></span> Dashboard
                </a>
            </div>

        </div>
    </div>
@endsection