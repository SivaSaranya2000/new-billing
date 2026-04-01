<!-- edit model -->

<div class="modal fade" id="editBrandModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <form id="editBrandForm" method="POST">
              @csrf
            
              <div class="modal-header">
                  <h5>Edit Brand Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <div class="modal-body">
                  <input type="hidden" id="edit_id">
                  <div class="mb-3">
                      <label>Brand Name : <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="brand" id="brand" placeholder="Enter Brand Name" required />
                  </div>
                   <div class="mb-3">
                      <label>Brand Code</label>
                   <input type="text" class="form-control" name="brand_code" id="brand_code" placeholder="Enter Brand Code" />
                </div>
                <div class="mb-3">
                      <label>Description</label>
                   <input type="text" class="form-control" name="description" id="description" placeholder="Enter Description" />
                </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
              </div>
          </form>
      </div>
  </div>
</div>