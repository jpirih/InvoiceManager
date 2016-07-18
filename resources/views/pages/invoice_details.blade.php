@extends('base')

@section('title')
    Podrobnosti računa
@endsection
<!-- main title -->
@section('page-heading')
    Račun številka {{ $invoice->invoice_nr }}
@endsection
<!-- session messages - ni v uporabi -->
@section('content')
    @if(session('status'))
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="alert alert-success">
                    <span class="glyphicon glyphicon-ok"></span> {{ session('status') }}
                </div>
            </div>
        </div>
        </div>
    @endif
    <!-- company data -->
    <div class="row">
        <div class="col-sm-6">
            <div class="bg-info">
                <h2>Podatki o Izdajatelju</h2>
                <hr>
                <h3>{{$invoice->company->name}}</h3>
                    {{ $invoice->company->full_name }} <br>
                    {{ $invoice->company->address }}, {{ $invoice->company->postal_code }} {{ $invoice->company->city }}<br>
                    {{ $invoice->company->country }}
                <hr>
                <p>
                    <a href="{{route('edit_company', ['id'=> $invoice->company->id])}}" class="btn btn-primary">
                        <span class="glyphicon glyphicon-pencil"></span>
                        Uredi podatke
                    </a>
                    <a href="{{ route('company_details', ['id'=> $invoice->company->id]) }}" class="btn btn-primary">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        Podrobnosti
                    </a>
                </p>
            </div>
        </div>
        <!-- invoice data -->
        <div class="col-sm-6">
           <div class="data-bg">
               <h2>Podatki o računu</h2>
               <hr>
               <h3> Račun: {{ $invoice->invoice_nr }}</h3>
               <span class="krepko">Datum: </span> {{ $invoice->invoice_date->format('d.m.Y') }}<br>
               <span class="krepko">Kraj: </span> {{ $invoice->company->city }}<br>
               <br>
               <a href="{{ route('edit_invoice', ['id' => $invoice->id]) }}" class="btn btn-primary">
                   <span class="glyphicon glyphicon-pencil"></span>
                   Uredi podatke
               </a>
               <hr>
               <h3>Znesek: {{ $invoice->total }} €</h3>
               <br>
           </div>
            <br>
            <!-- attachments -->
            <div class="well">
                <h2>
                    Priponke <span class="glyphicon glyphicon-paperclip"></span>
                    <a href="{{ route('add_file', ['id' => $invoice->id]) }}" class="pull-right btn btn-primary">
                        <span class=" glyphicon glyphicon-plus"></span> Dodaj priponko
                    </a>
                </h2>

                <div class="panel-group">
                    @foreach($invoice->files as $file)
                        <div class="panel panel-info">
                            <div class="panel-heading">
                               <h3 class="panel-title">
                                   <a href="#{{ $file->id }}" data-toggle="collapse">{{ $file->file_name }}</a>
                               </h3>
                            </div>
                            <div id="{{ $file->id }}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <h4>Podrobnosti</h4>
                                    <span class="krepko">Vrsta dokumenta: </span> {{ $file->attachment->name }} <br>
                                    <span class="krepko">Tip datoteke: </span> {{ $file->file_type }} <br>
                                    <span class="krepko">Velikost: </span> {{ (float)$file->file_size /1000 }} kB

                                </div>
                                <div class="panel-footer">
                                    <a href="{{route('open_file', ['id' => $file->id])}}" target="_blank" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-open"></span>
                                        Odpri
                                    </a>
                                    <a href="{{route('get_file', ['id' => $file->id])}}" class="btn btn-success">
                                        <span class="glyphicon glyphicon-save"></span>
                                        Shrani
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    <br>
    <!-- navigation buttons row  -->
    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('invoices') }}" class="btn btn-danger">
                <span class="glyphicon glyphicon-chevron-left"></span>
                Nazaj
            </a>
            <a href="{{ route('new_item', ['id' => $invoice->id]) }}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Dodaj izdelek
            </a>
        </div>
    </div>
    <br>
    <!-- invoice items  -->
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