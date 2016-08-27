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
                <!-- search -->
                <div class="col-sm-6">
                    <form action="{{route('item_search')}}"  method="get" id="search_items" class="form-inline">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Find item by name" name="search_input"  required="search_input">
                            <button type="submit" class="btn btn-success" id="item_search" >
                                <span class="glyphicon glyphicon-search"></span> Go
                            </button>
                        </div>
                    </form>
                    <!-- end of search form -->
                    <br>
                    <div class="col-sm-12" id="search_results"></div>
                </div>
                <!-- table all items  -->
                <table class="table table-responsive table-condensed table-bordered table-striped">
                    <thead>
                    <tr class="glava-tabele">
                        <th>Izdelek Storitev</th>
                        <th>Enota mere</th>
                        <th>Datum nakupa</th>
                        <th>Količina</th>
                        <th>Cena</th>
                        <th>Vrednost</th>
                        <th>Kategorija</th>
                    </tr>
                    </thead>
                    <tbody class="bg-info">
                        @foreach($items as $item)
                            <tr>
                                <td><a href="{{ route('edit_item', ['id' => $item->id]) }}">{{ $item->name }}</a></td>
                                <td>{{ $item->unit->label }}</td>
                                <td>{{ $item->invoice->invoice_date->format('d.m.Y') }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->unit_price }}</td>
                                <td>Vrednost</td>
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
@section('script')
    <script src="/js/items-search-logic.js" type="text/javascript"></script>
@endsection