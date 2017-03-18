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
                                    <dd>{{ $country->name }}</dd>

                                    <dt>ISO Alpha-2:</dt>
                                    <dd>{{ $country->iso_alpha_2 }}</dd>

                                    <dt>ISO Alpha-3:</dt>
                                    <dd>{{ $country->iso_alpha_3 }}</dd>
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
                                    <dt>Graden Noord:</dt> 
                                    <dd><code>{{ (! empty($country->north_num)) ? $data->north_num : 'Not given' }}</code></dd>

                                    <dt>Graden Oost:</dt>  
                                    <dd><code>{{ (! empty($country->east_num)) ? $data->east_num : 'Not given' }}</code><dd>

                                    <dt>Graden Zuid:</dt>  
                                    <dd><code>{{ (! empty($country->south_num)) ? $data->south_num  : 'Not given'}}</code></dd>

                                    <dt>Graden West:</dt>  
                                    <dd><code>{{ (! empty($country->west_num)) ? $data->west_num : 'Not Given' }}</code></dd>
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
                        <a href="" class="label label-success pull-right">Add border</a>
                    </div>

                    <div class="panel-body">
                        @if ('' === '') {{--  There are no borders found for the country. --}}

                        @else
                            <div class="table-responsive">
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Divisions:
                        <a href="" class="label label-success pull-right">Add division</a>
                    </div>

                    <div class="panel-body">
                        @if ('' === '') {{-- There are no divisions found for the country. --}}
                            <div class="alert alert-info" role="alert">
                                <strong>
                                    <span class="fa fa-info-circle" aria-hidden="true"></span> Info:
                                </strong>

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
