<div class="modal fade" id="editCategoryModal{{ $row->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('category.update', $row->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="inputName5" class="form-label">Name Category</label>
                        <input type="text" class="form-control" id="inputName5" name="name"
                            value="{{ $row->name }}">
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="inputImage" class="form-label">Image Category</label>
                            <input class="form-control" type="file" id="inputImage" name="image">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
