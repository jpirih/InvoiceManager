@extends('base')

@section('title')
    Podrobnosti računa
@endsection

@section('page-heading')
    Račun številka {{ $invoice->invoice_nr }}
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="bg-info">
                <h2>Podatki o Izdajatelju</h2>
                <hr>
                <h3>{{$invoice->company->name}}</h3>
                    {{ $invoice->company->full_name }} <br>
                    {{ $invoice->company->address }}, {{ $invoice->company->postal_code }} {{ $invoice->company->city }}<br>
                    {{ $invoice->company->country }}
            </div>
        </div>
        <div class="col-sm-6">
           <div class="data-bg">
               <h2>Podatki o računu</h2>
               <hr>
               <h3> Račun: {{ $invoice->invoice_nr }}</h3>
               <span class="krepko">Datum: </span> {{ $invoice->invoice_date->format('d.m.Y') }}<br>
               <span class="krepko">Kraj: </span> {{ $invoice->company->city }}<br>
               <br>
           </div>

        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('new_item', ['id' => $invoice->id]) }}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Dodaj izdelek
            </a>
        </div>
    </div>
    <br>
    <div class="row">
        @if(count($items) == 0)
            <div class="col-sm-6 col-sm-offset-3">
                <div class="alert alert-info">
                    <p>
                        <span class=" glyphicon glyphicon-info-sign"></span>
                        Na tem računu trenutno ni nobenega izdelka vnesi izdelek, ki je bil
                        zaračunan na tem računu
                    </p>
                </div>
            </div>
        @else
            <div class="col-sm-12">
                <table class="table table-responsive table-bordered table condensed table-striped">
                    <thead>
                        <tr class="glava-tabele">
                            <th># id</th>
                            <th>Naziv</th>
                            <th>Količina</th>
                            <th>Enota Mere</th>
                            <th>Cena</th>
                            <th>Kategorija</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->unit->label }}</td>
                                <td>{{ $item->unit_price }}</td>
                                @foreach($item->categories as $category)
                                    <td>{{$category->name}}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection