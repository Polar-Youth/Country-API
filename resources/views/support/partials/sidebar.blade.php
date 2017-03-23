<div class="well well-sm"> {{-- Search --}}
    <form method="get" action="{{ route('support.search') }}">
        <div class="input-group">
            <input type="text" name="term" class="form-control" placeholder="Search">
            <div class="input-group-btn">
                <button class="btn btn-danger" type="submit">
                    <span class="fa fa-search" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </form>
</div> {{-- End search --}}

<div class="panel panel-default">
    <div class="panel-heading">
        <span class="fa fa-tags" aria-hidden="true"></span> Categories
    </div>

    @if ((int) count(\App\Categories::all()) === 0)
        <div class="panel-body">
            <i>(There are no categories found)</i>
        </div>
    @else
        <div class="list-group">
            @foreach (\App\Categories::all() as $tag)
                {{-- TODO: Implement category overview. --}}
                <a href="" class="list-group-item">
                    <span class="fa fa-asterisk" aria-hidden="true"></span> {{ $tag->name }}
                </a>
            @endforeach
        </div>
    @endif
</div>