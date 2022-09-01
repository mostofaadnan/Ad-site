<div class="modal fade" id="featuremodal" tabindex="-1" aria-labelledby="featuremodal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Feature</h5>
                <button type="button" class="btn-close model-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputPassword2" class=" col-form-label">Day</label>
                    <input type="text" class="form-control" id="total_day" name="categorytitle" placeholder="Total Day">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword2" class="col-form-label">Amount</label>
                    <input type="text"  class="form-control" id="amount" placeholder="amount">
                </div>
                <div class="form-group mb-3">
                    <label for="exampleInputPassword2" class="col-form-label">Status</label>
                    <select name="status" class="form-control" id="status">
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary model-close" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="featuredatainsert" class="btn btn-primary" id="dataupdate">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>