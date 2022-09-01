<div class="modal fade" id="citymodal" tabindex="-1" aria-labelledby="citymodal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New country</h5>
                <button type="button" class="btn-close model-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="exampleInputPassword2" class=" col-form-label">Country</label>
                    <select id="country" class="form-control">
                        @foreach($Countrys as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword2" class=" col-form-label">State</label>
                    <select id="state_id" class="form-control"></select>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleInputPassword2" class=" col-form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name">
                </div>


            </div>
            <div class="modal-footer">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary model-close" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="citydatainsert" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
