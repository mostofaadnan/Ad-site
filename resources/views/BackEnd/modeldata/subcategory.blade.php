<div class="modal fade" id="subcategorymodel" tabindex="-1" aria-labelledby="subcategorymodel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Subcatgory</h5>
                <button type="button" class="btn-close model-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputPassword2" class="col-form-label">Name</label>
                    <input type="text" class="form-control" id="subctitle" name="title" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword2" class="col-form-label">Category</label>
                    <select id="subccategoryid" name="categoryid" class="form-control">
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword2" class="col-form-label">Description</label>
                    <textarea name="description" class="form-control" id="subcdescription" cols="30" rows="6"
                        placeholder="@lang('home.description')"> </textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleInputPassword2" class="col-form-label">Status</label>
                    <select name="subcstatus" class="form-control" id="subcstatus">
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary model-close" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="subcdatainsert" class="btn btn-primary" id="dataupdate">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function Category() {
    $.ajax({
        type: 'get',
        url: "{{ route('category.getlist') }}",
        dataType: "JSON",
        success: function(data) {
            $("#subccategoryid").empty();
            $("#subccategoryid").append('<option value="">Select</option>');
            data.forEach(function(value) {
                $("#subccategoryid").append('<option value="' + value.id + '">' +
                    value.title + '</option>');
            })
        },
        error: function(data) {
            console.log(data);
        }
    });
}
window.onload = Category();
</script>