@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div style="margin-top: -20px;" class='page-header'> {{-- Page header --}}
                            <div class='btn-toolbar pull-right'>
                                <div class='btn-group'>
                                    <a href="{{ route('support.create') }}" class="btn btn-default btn-sm">
                                        <span class="fa fa-plus" aria-hidden="true"></span> New thread
                                    </a>
                                </div>
                            </div>
                            <h2>Support Questions</h2>
                        </div> {{-- End page header --}}

                        <p>
                            <span style="margin-right: 10px;">Showing:</span>
                            <a href="{{ route('support.group', ['selector' => 'all']) }}" class="btn btn-xs @if ($selector === 'all') active @endif btn-info">
                                All
                            </a>
                            <a href="{{ route('support.group', ['selector' => 'open']) }}" class="btn btn-xs @if ($selector === 'open') active @endif btn-info">
                                Open
                            </a>
                            <a href="{{ route('support.group', ['selector' => 'solved']) }}" class="btn btn-xs @if ($selector === 'solved') active @endif btn-info">
                                Solved
                            </a>
                            <a href="{{ route('support.group', ['selector' => 'closed']) }}" class="btn btn-xs @if ($selector === 'closed') active @endif btn-info">
                                Closed
                            </a>
                        </p>

                        {{-- Content --}}
                            @if ((int) count($items) > 0)
                                @foreach ($items as $item)
                                    <div class="well well-sm" style="margin-bottom: 5px;">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="img-rounded user-avatar media-object" src="..." alt="{{ $item->author->name }}">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">{{ $item->title }} <small class="pull-right text-success">Solved!</small></h4>
                                                <i><small>Posted by {{ $item->author->name }} - {{ $item->created_at->diffForHumans() }}</small></i>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                {{-- TODO: implement info alert --}}
                            @endif
                        {{-- /Page content --}}
                    </div>
                </div>
            </div>

            <div class="col-sm-3"> {{-- Sidebar --}}
                @include('support.partials.sidebar')
            </div> {{-- End sidebar --}}

        </div>
    </div>
@endsection