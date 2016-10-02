@extends('base')

@section('title')
    Tuje spletne trgovine
@endsection

@section('javascript')
    <script src="/js/foreign-companies-logic.js" type="text/javascript"></script>
@endsection

@section('page-heading')
    Tuje spletne trgovine
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="row col-sm-6 col-sm-offset-3">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
<div class="row">
    <div class="col-sm-6">
        <div class="form-bg" id="newForeignCompany">
            <h3>Dodaj spletno trgovino</h3>
            <br>
            @include('includes.new_fc_form')
        </div>

        <div class="form-bg" id="editForeignCompany">
            <h3>Uredi Podatke
                <span class="pull-right">
                    <button type="button" id="cancel" class="btn btn-danger">
                        <span class="glyphicon glyphicon-remove"></span>
                        Prekliči
                    </button>
                </span>
            </h3>
            <br>
            @include('includes.edit_fc_form')
        </div>
        <br>
        <div class="well">
            <a href="{{ route('companies') }}" class="btn btn-danger">
                <span class="glyphicon glyphicon-chevron-left"></span>
                Nazaj
            </a>
        </div>
    </div>
    <div class="col-sm-6">
        @if(count($foreignCompanies) == 0)
            <div class="well">
                <div class="alert alert-info">
                    <span class="glyphicon glyphicon-info-sign"></span>
                    V bazi trenutno ni shranjenih podatkov o  tujih spletnih trgovinah
                </div>
            </div>
        @else
            <div class="well">
                @foreach($foreignCompanies as $company)
                    <div class="media">
                        <div class="media-left media-middle col-sm-5">
                            <a href="{{ $company->url }}" target="_blank">
                                <img src="{{ $company->logo  }}" alt="logo" class="media-object img img-rounded img-responsive logo">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $company->name }}</h4>
                            <br>
                            @if(count($company->foreignInvoices) == 0)
                                <div class="alert alert-info">
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                    Trentuno še ni statistike za to Spletno trgovino
                                </div>
                            @else
                                <span class="krepko">Število nakupov: </span> {{ count($company->foreignInvoices) }}

                            @endif
                            <hr>
                            <a href="{{ route('fc_details', ['id' => $company->id]) }}" class="btn btn-primary">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                Podrobnosti
                            </a>
                            <button type="button" class="edit btn btn-info" id="{{ $company->id }}">
                                <span class="glyphicon glyphicon-pencil"></span>
                                Uredi
                            </button>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>

        @endif
    </div>
</div>

@endsection