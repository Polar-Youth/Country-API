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
                                    <dt>Country name:</dt> <dd>{{ $country->name }}</dd>
                                    <dt>ISO Alpha-2:</dt> <dd>{{ $country->iso_alpha_2 }}</dd>
                                    <dt>ISO Alpha-3:</dt> <dd>{{ $country->iso_alpha_3 }}</dd>
                                </dl>

                                <dl style="margin-top: 10px;" class="dl-horizontal">
                                    <dt>Capital:</dt>   <dd>{{ $country->capital }}</dd>
                                    <dt>Continent:</dt> <dd>{{ $country->continent->name }}<dd>
                                </dl>
                            </div>

                            <div class="col-md-6">
                                <dl class="dl-horizontal">
                                    <dt>Graden Noord:</dt> <dd><code>Blade</code></dd>
                                    <dt>Graden Oost:</dt>  <dd><code>bladbla</code><dd>
                                    <dt>Graden Zuid:</dt>  <dd><code>blablad</code></dd>
                                    <dt>Graden West:</dt>  <dd><code>Nmal</code></dd>
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
                        @if ()
                        @else
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
                        @if ()
                            <div class="alert alert-info" role="alert">
                                <strong>
                                    <span class="fa fa-info-circle" aria-hidden="true"></span> Info:
                                </strong>

                                There are no divisions found in the system.
                            </div>
                        @else
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection