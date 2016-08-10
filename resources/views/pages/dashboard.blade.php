@extends('base')

@section('title')
    Dashboard Pregled
@endsection

@section('page-heading')
    Invoice Manager Dashboard
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                <span class="glyphicon glyphicon-exclamation-sign"></span>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-9">
            <div class="col-sm-6">
                <!-- dodajanje kategorj in seznam -->
                <h2>Kategorije</h2>
                <p>
                <br>
                <div id="category_msg"></div>
                <br>
                <form action="{{route('new_category')}}" method="post" id="categoryForm" class="form-inline">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="text" name="category_name" id="category_name"  class="form-control" placeholder="Naziv kategorije">
                    <button type="submit" class="btn btn-primary">
                        <span class=" glyphicon glyphicon-plus"></span>
                        Dodaj
                    </button>
                </form>
                <hr>
                </p>
                @if(count($categories) == 0)
                    <div class="alert alert-info">
                        <p>
                            <span class="glyphicon glyphicon-info-sign"></span>
                            Trenutno ni shranjenih kateggorij  Dodaj novo
                        </p>
                    </div>
                @else
                    <table class="table table-responsive table-striped table-bordered table-condensed" id="categories">
                        <thead>
                            <tr class="glava-tabele">
                                <th>#</th>
                                <th>Kategorija</th>
                            </tr>
                        </thead>
                        <tbody class="bg-info">
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="col-sm-6">
                <!-- dodajanje instrumentov placila in seznam  -->
                <h2>Orodja za plačevanje</h2>
                <p>
                <form action="{{ route('new_instrument') }}" method="post" class="form-inline">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="text" placeholder="predračun, Kreditna kartica ..." name="instrument_name" class="form-control">
                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-plus"></span>
                        Dodaj
                    </button>
                </form>
                <hr>
                </p>
                @if(count($paymentInstruments) == 0)
                    <div class="alert alert-info">
                        <p>
                            <span class="glyphicon glyphicon-info-sign"></span>
                            Tretuno ni shranjenih orodij za plačevanje. Dodaj novega
                        </p>
                    </div>
                @else
                    <table class="table table-responsive table-bordered table-striped table-condensed">
                        <thead>
                        <tr class="glava-tabele">
                            <th>#</th>
                            <th>Plačilno sredstvo</th>
                        </tr>
                        </thead>
                        <tbody class="bg-info">
                            @foreach($paymentInstruments as $instrument)
                                <tr>
                                    <td>{{ $instrument->id }}</td>
                                    <td>{{ $instrument->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <!-- glavna navigacija desno zgoraj -->
        <div class="col-sm-3">
            <div class="list-group">
                <a href="{{route('companies')}}" class="list-group-item list-group-item-success">
                    <span class="glyphicon glyphicon-briefcase"></span>
                    Podjetja
                </a>
                <a href="{{route('invoices')}}" class="list-group-item list-group-item-info">
                    <span class="glyphicon glyphicon-list"></span>
                    Računi
                </a>
                <a href="{{ route('items') }}" class="list-group-item list-group-item-danger">
                    <span class="glyphicon glyphicon-list-alt"></span>
                    Izdelki/Storitve
                </a>
            </div>
            <!-- hitri skok linki desni stolpec pod navigacijo -->
            <h3>Hitri Skok</h3>
            <div class="list-group">
                <a href="{{ route('files_list') }}" class="list-group-item">Seznam priponk</a>
                <a href="{{ route('deleted_items') }}" class="list-group-item">Smetnjak </a>
            </div>
        </div>
    </div>
    <!-- Dodajanje novih merskih enot   -->
    <div class="row">
        <div class="col-sm-9">
            <div class="col-sm-6">
                <h3>Enote mere</h3>
                <form action="{{ route('packing_unit') }}" method="post" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="label" class="control-label col-sm-4">Oznaka</label>
                        <div class="col-sm-8">
                            <input type="text" name="label" id="label" required placeholder="kos, kg" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="unit_name" class="control-label col-sm-4">Naziv</label>
                        <div class="col-sm-8">
                            <input type="text" name="unit_name" id="unit_name" placeholder="kilogram" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                <span class="glyphicon glyphicon-plus"></span> Dodaj
                            </button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col-sm-6">
                @if(count($units) == 0)
                    <div class="alert alert-info">
                        <span class="glyphicon glyphicon-info-sign"></span>
                        Trenutno ni shranjenih podatkov o enotah mere
                    </div>
                @else
                    <table class="table table-responsive table-bordered table-condensed table-striped">
                        <thead>
                        <tr class="glava-tabele">
                            <th>Oznaka</th>
                            <th>Naziv</th>
                        </tr>
                        </thead>
                        <tbody class="bg-info">
                            @foreach($units as $unit)
                                <tr>
                                    <td>{{ $unit->label }}</td>
                                    <td>{{ $unit->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
        <div class="col-sm-3">
            <!-- prostor na desni poleg enot mere  -->
        </div>
        <!-- vrste dokumentov -->
        <div class="row">
            <div class="col-sm-9">
                <!-- obrazec za vnos vrst dokumentov   -->
                <div class="col-sm-6">
                    <h3>Vrsta dokumenta</h3>
                    <form action="{{ route('attachment_type') }}" method="post" class="form-inline">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="from-group">
                            <input type="text" name="attachment_name" placeholder="Račun" required class="form-control">
                            <input type="text" name="label" placeholder="RAC" class="form-control">
                            <button type="submit" class="btn btn-primary">
                                <span class="glyphicon glyphicon-plus"></span>
                                Dodaj
                            </button>
                        </div>
                    </form>
                    <br>
                    <table class="table-bordered table-responsive table-striped table-condensed">
                        <thead>
                        <tr class="glava-tabele">
                            <th>#</th>
                            <th>Oznaka</th>
                            <th>Vrsta Dokumenta</th>
                        </tr>
                        </thead>
                        <tbody class="bg-info">
                            @foreach($attachments as $attachment)
                                <tr>
                                    <td>{{ $attachment->id }}</td>
                                    <td>{{ $attachment->label }}</td>
                                    <td>{{ $attachment->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- szenam vseh vnesenih vrst dokumentov -->
                <div class="col-sm-6"></div>
            </div>
            <div class="col-sm-3">
                <!-- Prazen prostor na desni poleg tabele vrste dokumentrov -->
            </div>
        </div>
    </div>
@endsection

<!-- javascript -->
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script>
    $(document).ready(function () {

        var name = $('#category_name').val();
        $('#categoryForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '{{route('new_category')}}',
                dataType: 'JSON',
                data: {
                    _token: $('input[name=_token]').val(),
                    category_name: $('input[name=category_name]').val()
                },
                success: function (response) {
                   $('#category_msg').addClass('alert').addClass('alert-success').append(response['msg']);
                    $('#categories').append(
                            '<tr>'
                            +'<td>' + response['category_id'] +'</td>'
                            +'<td>'+ $('input[name=category_name]').val() + '</td>'
                            +'</tr>'
                    )
                }
            });
        });


    });

</script>