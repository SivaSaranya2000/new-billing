<!-- edit model -->

<div class="modal fade" id="editUnitModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <form id="editUnitForm" method="POST">
              @csrf
            
              <div class="modal-header">
                  <h5>Edit Unit Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <div class="modal-body">
                  <input type="hidden" id="edit_id">
                  <div class="mb-3">
                      <label>Name</label>
                      <input type="text" class="form-control" name="unit" id="unit" placeholder="Enter Unit Name (e.g., kg, pcs)" required />
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