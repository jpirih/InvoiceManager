@extends('base')

@section('title')
    Sezanam vseh datotek
@endsection

@section('page-heading')
    Seznam vseh datotek
@endsection

@section('content')
    <!-- list of all uploaded files -->
    <div class="row">

        <div class="col-sm-9">
            <table class="table table-responsive table-bordered table-striped table-condensed">
                <thead>
                    <tr class="glava-tabele">
                        <th>Naziv Datoteke</th>
                        <th>Vrsta datoteke</th>
                        <th>Oznaka</th>
                        <th>Račun</th>
                        <th>Datum računa</th>
                        <th>Datum Prenosa</th>
                    </tr>
                </thead>
                <tbody class="bg-info">
                    @foreach($files as $file)
                        <tr>
                            <td><a href="{{ route('open_file', ['id' => $file->id]) }}" target="_blank">{{ $file->file_name }}</a></td>
                            <td>{{ $file->attachment->name }}</td>
                            <td>{{ $file->attachment->label }}</td>
                            @foreach($file->invoices as $invoice)
                                <td>{{ $invoice->invoice_nr }}</td>
                                <td>{{ $invoice->invoice_date->format('d.m.Y') }}</td>
                            @endforeach
                            <td>{{ $file->created_at->format('d.m.Y H:i:s') }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-3"></div>
    </div>

@endsection