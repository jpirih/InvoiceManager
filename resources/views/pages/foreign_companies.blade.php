@extends('base')

@section('title')
    Tuje spletne trgovine
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
        <div class="form-bg">
            <h3>Dodaj spletno trgovino</h3>
            <br>
            <form action="{{ route('new_fc') }}" method="post" class="form-horizontal">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="fc_name" class="control-label col-sm-4">Naziv</label>
                    <div class="col-sm-8">
                        <input type="text" name="fc_name" id="fc_name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="fc_url" class="control-label col-sm-4">Url</label>
                    <div class="col-sm-8">
                        <input type="text" name="fc_url" id="fc_url" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="fc_logo_url" class="control-label col-sm-4">Logo Url</label>
                    <div class="col-sm-8">
                        <input type="text" name="fc_logo_url" id="fc_logo_url" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <button type="reset" class="btn btn-info">
                            <span class="glyphicon glyphicon-refresh"></span>
                            Izprazni Obrazec
                        </button>
                    </div>
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-success btn-block">
                            <span class="glyphicon glyphicon-save"></span>
                            Shrani Podatke
                        </button>
                    </div>
                </div>
            </form>
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
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>

        @endif
    </div>
</div>

@endsection