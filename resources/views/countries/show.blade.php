@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">General Information:</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <dl class="dl-horizontal">
                                    <dt>Country name:</dt>
                                    <dd>
                                        <img style="height: 12px; width:15px;" src="{{ asset('images/' . $country->iso_alpha_2 . '.svg') }}" alt="{{ $country->name }}">
                                        {{ $country->name }}
                                    </dd>

                                    <dt>ISO Alpha-2:</dt>
                                    <dd>{{ strtoupper($country->iso_alpha_2) }}</dd>

                                    <dt>ISO Alpha-3:</dt>
                                    <dd>{{ strtoupper($country->iso_alpha_3) }}</dd>
                                </dl>

                                <dl style="margin-top: 10px;" class="dl-horizontal">
                                    <dt>Capital:</dt>
                                    <dd>{{ (! empty($country->capital)) ? $country->capital : 'Not given' }}</dd>

                                    <dt>Continent:</dt> 
                                    <dd>{{ (! empty($country->continent->name)) ? $country->continent->name : 'Not given' }}<dd>
                                </dl>
                            </div>

                            <div class="col-md-6">
                                <dl class="dl-horizontal">
                                    <dt>@lang('country.grades-north'):</dt>
                                    <dd><code>{{ (! empty($country->north_num)) ? $country->north_num : 'Not given' }}</code></dd>

                                    <dt>@lang('country.grades-east'):</dt>
                                    <dd><code>{{ (! empty($country->east_num)) ? $country->east_num : 'Not given' }}</code><dd>

                                    <dt>Graden Zuid:</dt>  
                                    <dd><code>{{ (! empty($country->south_num)) ? $country->south_num  : 'Not given'}}</code></dd>

                                    <dt>Graden West:</dt>  
                                    <dd><code>{{ (! empty($country->west_num)) ? $country->west_num : 'Not Given' }}</code></dd>
                                </dl>
                            </div>
                       </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Borders:
                        <a href="#" data-toggle="modal" data-target="#addBorder" class="label label-success pull-right">Add border</a>
                    </div>

                    <div class="panel-body">
                        @if ((int) count($country->borders) === 0) {{--  There are no borders found for the country. --}}
                            <div class="alert alert-info" role="alert">
                                <strong><span class="fa fa-info-circle" aria-hidden="true"></span></strong>
                                There are no borders for this country in the system.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ISO code:</th>
                                            <th>Name:</th>
                                            <th>Capital:</th>
                                            <th>Continent:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($country->borders as $border)
                                            <tr>
                                                <td><strong>#{{ $border->id }}</strong></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Divisions:
                        <a href="#" data-toggle="modal" data-target="#addDivision" class="label label-success pull-right">Add division</a>
                    </div>

                    <div class="panel-body">
                        @if ('' === '') {{-- There are no divisions found for the country. --}}
                            <div class="alert alert-info" role="alert">
                                <strong><span class="fa fa-info-circle" aria-hidden="true"></span> Info:</strong>
                                There are no divisions found in the system.
                            </div>
                        @else
                            <div class="table-responsive">
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('countries.partial.modal-create-border')   {{-- Include the border create modal. --}}
    @include('countries.partial.modal-create-division') {{-- Include the division create modal. --}}
@endsection
