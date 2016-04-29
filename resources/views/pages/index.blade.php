@extends('base')

@section('title')
    Dobrodošli
@endsection

@section('page-heading')
    Invoice Manager
@endsection

@section('content')
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                O aplikaciji
            </div>
            <div class="panel-body">
                <h3>Namen</h3>
                <p>
                    Glavni namenj je organizirati elektronski arhiv vseh prejetih računov in sledenje
                    izdatkov kategorizairanje računv lažje iskanje in pregled
                </p>
                <p>
                    <a href="{{ route('invoices') }}" role="button" class="btn btn-primary">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        Naprej
                    </a>
                </p>
            </div>

        </div>
    </div>
@endsection