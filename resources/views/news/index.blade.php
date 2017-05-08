@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9"> {{-- Content --}}
                <div class="panel panel-default">
                    <div class="panel-body"> {{-- Content body --}}
                    </div> {{-- /Content body --}}
                </div>
            </div> {{-- /Content --}}

            <div class="col-md-3"> {{-- Sidebar --}}

                <div class="well well-sm"> {{-- Search form --}}
                    <form method="get" action="">
                        <div class="input-group">
                            <input type="text" name="term" class="form-control" placeholder="Search">
                            <div class="input-group-btn">
                                <button class="btn btn-danger" type="submit">
                                    <span class="fa fa-search" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div> {{-- /Search form --}}

                <div class="panel panel-default"> {{-- Categories --}}
                    <div class="panel-heading"><span class="fa fa-tags" aria-hidden="true"></span> Categorieen</div>

                    <div class="panel-body">
                        @if ((int) count($categories) === 0)
                            <small><i>(There are no categories found.)</i></small>
                        @else
                            @foreach ($categories as $category)
                                <a href="{{ route('category.show', ['tagId' => $category->id]) }}" class="label label-danger">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div> {{-- /Categeories --}}

            </div> {{-- /Sidebar --}}
        </div>
    </div>
@endsection