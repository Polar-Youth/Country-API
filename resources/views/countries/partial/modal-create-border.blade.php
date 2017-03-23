<div class="modal fade" id="addBorder" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add new border for {{ $country->name }}</h4>
            </div>
            <div class="modal-body">
                <form action="" class="form-horizontal" id="border">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="country" class="control-label col-sm-3">
                            Country <span class="text-danger">*</span>
                        </label>

                        <div class="col-md-9">
                            <select name="country" id="country" class="form-control">
                                <option value="">-- Select the border country --</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"> {{ $country->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" form="border" type="submit">
                    <span class="fa fa-check" aria-hidden="true"></span> Create
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <span class="fa fa-close" aria-hidden="true"></span> Close
                </button>
            </div>
        </div>

    </div>
</div>