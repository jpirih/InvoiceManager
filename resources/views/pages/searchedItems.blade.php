@extends('base')

@section('titler')
    Rezultati isaknje Izdelki/storitve
@endsection

@section('page-heading')
    Rezultati iskanja
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-9">

            <table class="table table-responsive table-bordered table-striped">
                <thead>
                    <tr class="glava-tabele">
                        <th>Izdelek Storitev</th>
                        <th>EM</th>
                        <th>Cena</th>
                        <th>Datum</th>
                    </tr>
                </thead>
                <tbody class="bg-info">
                @foreach($searchItems as $item)
                    <tr>
                        <td><a href="{{route('edit_item', ['id' => $item->id])}}">{{$item->name}}</a></td>
                        <td>{{ $item->unit->name }}</td>
                        <td>{{ $item->unit_price }}</td>
                        <td>{{ $item->invoice->invoice_date }}</td>
                    </tr>

                @endforeach
                </tbody>
            </table>
            <hr>
        </div>
        <div class="col-sm-3">
            <div class="well">
                <h3>Sstatistika</h3>
                <span class="krepko">Najdenih rezultatov:</span>
                {{ count($searchItems) }}
                <hr>
                <a href="{{ route('items') }}" class="btn btn-danger">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    Nazaj
                </a>
            </div>
        </div>

    </div>
@endsection