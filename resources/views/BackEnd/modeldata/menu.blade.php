<div class="modal fade" id="menumodal" tabindex="-1" aria-labelledby="subcategorymodel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Menu</h5>
                <button type="button" class="btn-close model-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputPassword2" class="col-form-label">Menu Name</label>
                    <input type="text" class="form-control" id="menu_title"  placeholder="Menu Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword2" class="col-form-label">Page</label>
                    <select id="page_id" name="page_id" class="form-control">
                    </select>
                </div>
                <div class="form-group">
                    <label for="Menutype">Menu Type</label>
                    <select name="" id="menu_types" class="form-control">
                        <option value="1">Header</option>
                        <option value="2">Footer</option>
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary model-close" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="menuinsert" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function Category() {
    $.ajax({
        type: 'get',
        url: "{{ route('page.getlist') }}",
        dataType: "JSON",
        success: function(data) {
            $("#page_id").empty();
            $("#page_id").append('<option value="">Select</option>');
            data.forEach(function(value) {
                $("#page_id").append('<option value="' + value.id + '">' +
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
