@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {{-- Search form --}}
                            <form action="" class="form-inline pull-left">
                                {{ csrf_field() }}

                                <input type="text" class="form-control" placeholder="search term" name="term">
                                <button class="btn btn-success" type="submit">
                                    <span class="fa fa-search" aria-hidden="true"></span> Search
                                </button>
                            </form>
                        {{-- /Search form --}}

                        {{-- Create button --}}
                            <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal">
                                <span class="fa fa-plus" aria-hidden="true"></span> Create country
                            </button>
                        {{-- /Create button --}}
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="nav nav-tabs" role="tablist"> {{-- Navigation --}}
                            <li role="presentation" class="active">
                                <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                                    <span class="fa fa-flag" aria-hidden="true"></span> Countries
                                </a>
                            </li>

                            <li role="presentation">
                                <a href="#waiting" aria-controls="waiting" role="tab" data-toggle="tab">
                                    <span class="fa fa-flask" aria-hidden="true"></span> Addition
                                    <span class="badge" style="margin-left: 3px;">0</span>
                                </a>
                            </li>

                            <li role="presentation">
                                <a href="#changes" aria-controls="changes" role="tab" data-toggle="tab">
                                    <span class="fa fa-pencil-square" aria-hidden="true"></span> Waiting changes
                                    <span class="badge" style="margin-left: 3px;">0</span>
                                </a>
                            </li>
                        </ul> {{-- /Navigation --}}

                        <div class="tab-content"> {{-- Tab content --}}
                            <div role="tabpanel" class="tab-pane active" id="home" style="padding-top: 10px;"> {{-- Country tab --}}
                                @if ((int) count($countries) === 0)
                                    <div class="alert alert-info" role="alert">
                                        <strong><span class="fa fa-info-circle" aria-hidden="true"></span> Info:</strong>
                                        There are no countries in the system. If you are a volunteer u can create one.
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-hover table-condensed">
                                            <thead>
                                                <tr>
                                                    <th>#</th> {{-- Used to place the flag. --}}
                                                    <th>Name:</th>
                                                    <th>ISO 3661: (alpha-2)</th>
                                                    <th>ISO 3661: (alpha-3)</th>
                                                   <th>Capital:</th>
                                                    <th colspan="2">Continent:</th> {{-- Colspan 2 needed because the functions will embed in this. --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($countries as $country)
                                                    <tr>
                                                        <td><code>#{{ $country->id }}</code></td>
                                                        <td>
                                                            <img style="vertical-align: middle; height: 13px; margin-right: 5px;" src="{{ asset('images/flags/BE.png') }}" alt="{{ $country->name }}">
                                                            <a href="{{ route('country.show', ['articleId' => $country->id]) }}">{{ $country->name }}</a>
                                                        </td>
                                                        <td>{{ $country->iso_alpha_2 }}</td>
                                                        <td>{{ $country->iso_alpha_3 }}</td>
                                                        <td>{{ $country->capital }}</td>
                                                        <td>{{ $country->continent->name }}</td>

                                                        <td> {{-- Functions --}}
                                                            <a class="label label-warning" href="">Aanpassen</a>
                                                            <a class="label label-success" href="">Verwijder</a>
                                                        </td> {{-- /Functions --}}
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div> {{-- /Country tab --}}

                            <div> {{-- Additions tab --}}
                            </div> {{-- /Additions tabs --}}

                            <div> {{-- Changes tab --}}
                            </div> {{-- /Changes tab --}}

                        </div> {{-- /Tab content --}}

                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('countries.partial.modal-create') {{-- The country create modal. --}}
@endsection