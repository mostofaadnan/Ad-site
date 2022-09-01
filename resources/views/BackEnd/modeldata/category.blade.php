<div class="modal fade" id="categorymodel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                <button type="button" class="model-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <div class="form-group">
                            <label for="exampleInputPassword2" class=" col-form-label">Name</label>
                            <input type="text" class="form-control" id="categorytitle" name="categorytitle"
                                placeholder="Name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="postType">Post Type</label>
                            <select name="post_type" id="post_type" class="form-control">
                                <option value="1">Default</option>
                                <option value="2">Custom</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="custom-field form-inline" style="display:none;">
                    <div class="mt-1 mb-1" style="border-top:1px #ccc solid; border-bottom:1px #ccc solid;">
                        <h5>Custom Field</h5>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="field Name">Field Label</label>
                                <input type="text" id="field_label" class="form-control" placeholder="Field Label">
                            </div>
                            <div class="col-sm-3">
                                <label for="field name">Field Name</label>
                                <input type="text" id="field_name" class="form-control" placeholder="Field Name">
                            </div>
                            <div class="col-sm-2">
                                <label for="field name">Field Type</label>
                                <select name="" id="field_type" class="form-control">
                                    <option value="text">Text</option>
                                    <option value="email">Email</option>
                                    <option value="textarea">Text Area</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label for="field name">Require</label>
                                <select name="" id="field_type" class="form-control">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <label for="action">Action</label><br>
                                <button class="btn btn-sm btn-info" id="add_btn">Add</button>
                            </div>
                            <div class="col-sm-12 mt-3">
                                <table class="table table-striped table-bordered data-table">
                                    <thead>
                                        <tr>
                                            <th>#Sl No</th>
                                            <th>Field Label</th>
                                            <th>Field Name</th>
                                            <th>Field Type</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablebody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="free_post">Total Free Post</label>
                        <input type="text" id="total_free_post" class="form-control">
                    </div>
                    <div class="col-sm-6">
                        <label for="free post publish day">Free Post Publish day</label>
                        <input type="text" name="" id="free_post_publish_day" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="from-group">
                            <label for="perpost charge">Premimum Post Charge</label>
                            <input type="text" name="" id="per_post_charge" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="free post publish day">Premimu Post Publish day</label>
                        <input type="text" name="" id="premimum_publish_day" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputPassword2" class="col-form-label">Adult Content</label>
                            <select name="adult_content" class="form-control" id="adult_content">
                                <option value="0">None</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputPassword2" class="col-form-label">Status</label>
                            <select name="status" class="form-control" id="categorystatus">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary model-close" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="categorydatainsert" class="btn btn-primary" id="dataupdate">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>