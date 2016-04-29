@extends('base')

@section('title')
    Izdelki v kategoriji {{ $category->name }}
@endsection

@section('page-heading')
    Vsi izdelki in storitve v kategoriji {{ $category->name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-9">
            @if(count($category->items) == 0)
                <div class="alert alert-info">
                    <span class="glyphicon glyphicon-info-sign"></span>
                    V tej kategoriji trenutno ni nobenega izdelka oziroma storitve
                </div>

            @else
                <table class="table-responsive table-condensed table-bordered table-striped">
                    <thead>
                    <tr class="glava-tabele">
                        <th>Naziv</th>
                        <th>Količina</th>
                        <th>Enota mere</th>
                        <th>Cena</th>
                        <th>Podjetje</th>
                        <th>Datum nakupa</th>
                    </tr>
                    </thead>
                    <tbody class="bg-re</th>
                        <th>Cena</th>
                        <th>Podjetje</th>
                        <th>Datum nakupa</th>
                    </tr>info">
                        @foreach($category->items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->unit->name }}</td>
                                <td>{{ $item->unit_price }}</td>
                                <td>{{$item->invoice->company->name}}</td>
                                <td>{{ $item->invoice->invoice_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="col-sm-3">
            <h3>Navigacija</h3>
            <br>
            <div class="list-group">
                <a href="{{ route('invoices') }}" class="list-group-item list-group-item-success">
                    <span class="glyphicon glyphicon-list"></span> Računi Pregled
                </a>
                <a href="{{ route('companies') }}" class="list-group-item list-group-item-info">
                    <span class=" glyphicon glyphicon-briefcase"></span> Podjetja
                </a>
                <a href="{{ route('items') }}" class="list-group-item list-group-item-warning">
                    <span class=" glyphicon glyphicon-list-alt"></span> Izdelki in storitve
                </a>
                <a href="{{route('dashboard')}}" class=" list-group-item list-group-item-danger">
                    <span class="glyphicon glyphicon-dashboard"></span> Dashboard
                </a>
            </div>
            <h3>Kategorije</h3>
            <br>
            <div class="list-group">
                @foreach($categories as $category)
                    <a href="{{ route('category_items', ['id' => $category->id]) }}" class="list-group-item list-group-item-default">{{ $category->name }}</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection