<div class="modal fade" id="adbannermodal" tabindex="-1" aria-labelledby="adbannermodal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Ad Banner</h5>
                <button type="button" class="btn-close model-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('adbanners.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="form-group mb-3">
                        <label for="exampleInputPassword2" class="col-form-label">Type</label>
                        <select name="type" class="form-control" id="type">
                            <option value="1">Adsense</option>
                            <option value="2">Custom</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2" class="col-form-label">Ad Title</label>
                        <input type="text" class="form-control" id="add_title" name="add_title" placeholder="Title">
                    </div>
                    <div class="custom" style="display:none;">
                        <div class="form-group">
                            <label for="exampleInputPassword2" class="col-form-label">Link</label>
                            <input type="text" class="form-control" name="link">
                        </div>
                        <div class="from-group mb-3">
                            <label for="exampleInputPassword2" class="col-form-label">Image</label>
                            <input type="file" name="image">
                        </div>
                    </div>
                    <div class="adsense">
                        <div class="form-group">
                            <label for="exampleInputPassword2" class="col-form-label">Source</label>
                            <textarea name="source" class="form-control" id="source" name="" cols="30" rows="6"
                                placeholder="Source"> </textarea>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputPassword2" class="col-form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
            <div class="modal-footer">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary model-close" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#type").on('change', function() {
       
        var type=$(this).val();
        if(type=="1"){
            $(".custom").hide(); 
            $(".adsense").show();
        }else{
            $(".custom").show(); 
            $(".adsense").hide();
        }
    })
</script>