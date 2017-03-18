<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        {{-- Modal content--}}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create new country</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('country.store') }}" id="create" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="control-label col-sm-3">
                            Name: <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-9">
                            <input class="form-control" name="name" placeholder="Country name" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">
                            Continent: <span class="text-danger">*</span>
                        </label>

                        <div class="col-md-9">
                            <select name="continent" class="form-control">
                                <option value="">-- Select continent --</option>

                                @foreach ($continents as $continent)
                                    <option value="{{ $continent->id }}">{{ $continent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label col-md-3">
                            ISO 3166-1: <span class="text-danger">*</span>
                        </label>

                        <div class="col-md-3">
                            <input type="text" placeholder="Number code" name="code" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <input type="text" placeholder="alpha-2" name="iso_alpha_2" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <input type="text" placeholder="alpha-3" name="iso_alpha_3" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label col-md-3">
                            FIPS code: {{-- <span class="text-danger">*</span> --}}
                        </label>

                        <div class="col-md-9">
                            <input type="text" name="fips_code" class="form-control" placeholder="FIPS code">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="create" class="btn btn-success">
                    <span class="fa fa-check" aria-hidden="true"></span> Create
                </button>

                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <span class="fa fa-close" aria-hidden="true"></span> Close
                </button>
            </div>
        </div>

    </div>
</div>