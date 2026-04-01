<!-- Modal for Adding Variation -->
<div class="modal fade" id="addVariationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('variations.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Add Variation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Variation Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div id="value-wrapper">
                        <div class="mb-3 d-flex gap-2 value-row">
                            <input type="text" class="form-control" name="value[]" placeholder="Value" required>
                             <button type="button" id="addRowBtn" class="btn btn-success btn-sm mt-2">
                        + 
                    </button>
                        </div>
                    </div>

                   

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save Variation</button>
                </div>

            </form>
        </div>
    </div>
</div>

