<!-- edit model -->

<div class="modal fade" id="editCustomerModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <form id="editCustomerForm" method="POST">
              @csrf
             

              <div class="modal-header">
                  <h5>Edit Customer</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <div class="modal-body">
                  
                  <input type="hidden" id="edit_id">

                  <div class="mb-3">
                      <label>Name</label>
                      <input type="text" id="edit_name" name="name" class="form-control">
                  </div>

                  <div class="mb-3">
                      <label>Mobile</label>
                      <input type="text" id="edit_mobile" name="mobile" class="form-control">
                  </div>

                  <div class="mb-3">
                      <label>Email</label>
                      <input type="email" id="edit_email" name="email" class="form-control">
                  </div>

                  <div class="mb-3">
                      <label>Address</label>
                      <textarea id="edit_address" name="address" class="form-control"></textarea>
                  </div>

              </div>

              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
              </div>

          </form>
      </div>
  </div>
</div>