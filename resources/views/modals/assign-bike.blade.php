<div class="modal fade" id="AssignBike" tabindex="-1" role="dialog" aria-labelledby="branchModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="uil uil-university"></i> Assign Bike</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('rider.asign-bike') }}" method="post">

                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}" />
                    <div class="form-group row mb-3">
                        <label for="branchCode" class="col-3 col-form-label">Assign Bike </label>
                        <div class="col-9">
                            <select name="court_division" id="branch" class="form-control id=" branchCode"
                                custom-select" required>
                                <option value="">-- Select Case Category --</option>
                                @foreach ($bikes as $bike)
                                <option value="{{ $bike->id }}">{{ $bike->model }} {{ $bike->plate_number }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="uil-location-arrow"></i> Submit</button>
                </form>

                </form>
            </div>
        </div>
    </div>
</div>