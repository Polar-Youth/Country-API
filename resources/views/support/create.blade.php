@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">{{-- Content --}}
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div style="margin-top: -20px;" class='page-header'> {{-- Page header --}}
                            <h2>Create new thread</h2>
                        </div> {{-- End page header --}}

                        {{-- Page content --}}
                            <form action="{{ route('support.store') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="author_id" value="{{ auth()->user()->id }}">

                                <div class="form-group">
                                    <label for="subject">Subject: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="subject" placeholder="Subject">
                                </div>

                                <div class="form-group">
                                    <label for="Thread">Thread: <span class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="10" id="thread" name="post" placeholder="Thead"></textarea>
                                    <span class="help-block">
                                        <span class="label label-info"><span class="fa fa-info" aria-hidden="true"></span> Info:</span>
                                        <a href="">
                                            Learn how to style your thread.
                                        </a>
                                    </span>
                                </div>

                                <h4>Describe your question by selecting tags.</h4>

                                <div class="form-group">
                                    <div class="checkbox">
                                        @foreach ($categories as $tag)
                                            <label style="padding-right: 8px;">
                                                <input name="tags[]" type="checkbox"> {{ $tag->name }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-success" type="submit">
                                        Create
                                    </button>
                                </div>
                            </form>
                        {{-- End Page content --}}
                    </div>
                </div>
            </div> {{-- End content --}}

            <div class="col-md-3"> {{-- Sidebar --}}
                @include('support.partials.sidebar')
            </div> {{-- End sidebar --}}
        </div>
    </div>
@endsection