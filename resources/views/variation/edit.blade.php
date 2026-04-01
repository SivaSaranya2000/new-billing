<!-- Edit Variation Modal -->
<div class="modal fade" id="editVariationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <form id="editVariationForm" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit Variation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label>Variation Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <!-- Value rows -->
                    <div id="value-wrappers"></div>
                    <!-- Add new row button -->
                    <button type="button" id="add" class="btn btn-success btn-sm mt-2"> + </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Update Variation</button>
                </div>

            </form>

        </div>
    </div>
</div>
