@extends('base')

@section('title')
    Podjetja - Pregled
@endsection

@section('page-heading')
    Seznam Podjetji
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-9">
            @if(count($companies)== 0)
                <div class="alert alert-info">
                    <p>
                        <span class="glyphicon glyphicon-info-sign"></span>
                        Trentno v bazi ni shranjenih podatkov o podjetjih
                    </p>
                </div>
            @else
                <div class="bg-info">
                    @foreach($companies as $company)
                        <div class="media">
                            <div class="media-left media-middle">
                                <a href="#">
                                    <img src="{{$company->company_logo }}" alt="logo" class="media-object img img-rounded logo">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{ $company->name }}</h4>
                                <p>
                                    <span class="krepko">{{ $company->full_name }}</span> <br>
                                    {{$company->address }} <br>
                                    {{ $company->postal_code }} {{ $company->city }} <br>
                                    {{ $company->country }}
                                </p>
                                <p>
                                    <a href="{{$company->url}}" target="_blank" class="btn btn-success">
                                        <span class="glyphicon glyphicon-log-in"></span> Obišči trgovino
                                    </a>
                                </p>
                                <hr>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="col-sm-3">
            <div class="list-group">
                <a href="{{ route('new_company') }}" class="list-group-item list-group-item-success">
                    <span class="glyphicon glyphicon-plus"></span> Dodaj Podjetje
                </a>
                <a href="{{ route('invoices') }}" class="list-group-item list-group-item-info">
                    <span class="glyphicon glyphicon-list"></span> Računi Pregled
                </a>
                <a href="{{ route('dashboard') }}" class=" list-group-item list-group-item-danger">
                     <span class="glyphicon glyphicon-dashboard"></span> Dashboard
                </a>
            </div>
        </div>
    </div>
@endsection