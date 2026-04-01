@extends('layout.nav')
@section('content')

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Variation List</h2>
        <button class="btn btn-success btn-add" data-bs-toggle="modal" data-bs-target="#addVariationModal">
            <i class="fas fa-plus"></i> Add Variation
        </button>
    </div>

    <table class="table table-bordered table-striped table-hover" id="totalvariation">
        <thead>
            <tr>
              
                <th>Name</th>
                <th>Value</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
@include('variation.create')
@include('variation.edit')
@endsection
@push('scripts')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.getElementById('addRowBtn').addEventListener('click', function () {
        let wrapper = document.getElementById('value-wrapper');
        let row = document.createElement('div');
        row.classList.add('mb-3', 'd-flex', 'gap-2', 'value-row');
        row.innerHTML = `
            <input type="text" class="form-control" name="value[]" placeholder="Value" required>
            <button type="button" class="btn btn-danger btn-sm removeRow">X</button>
        `;
        wrapper.appendChild(row);
        // Remove row event
        row.querySelector('.removeRow').addEventListener('click', function () {
            row.remove();
        });
    });
    $(document).ready(function () {
    $('#totalvariation').DataTable({
        dom: 'Blfrtip',
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
        processing: true,
        serverSide: true,
        order: [[0, 'desc']],
        ajax: "{{ route('data_all_variations') }}",

        columns: [
            { data: 'name', name: 'name' },
            { data: 'value', name: 'value' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
   $(document).on('click', '.editVariationBtn', function () {
    let id = $(this).data('id');

    $.ajax({
        url: "/variations/" + id + "/edit",
        type: "GET",
        success: function (res) {
            $('#edit_id').val(res.id);
            $('#name').val(res.name);
            $('#editVariationForm').attr('action', '/variations/' + res.id);
            $('#value-wrappers').html('');
            res.values.forEach(function (item) {
                $('#value-wrappers').append(`
                    <div class="mb-3 d-flex gap-2 value-row">
                        <input type="text" class="form-control" name="value[]" value="${item.value}" required>
                        <button type="button" class="btn btn-danger btn-sm remove">X</button>
                    </div>
                `);
            });

            // Show modal
            $('#editVariationModal').modal('show');
        }
    });
});
// Add new value row
$('#add').on('click', function () {
    let row = `
        <div class="mb-3 d-flex gap-2 value-row">
            <input type="text" class="form-control" name="value[]" placeholder="Value" required>
            <button type="button" class="btn btn-danger btn-sm remove">X</button>
        </div>
    `;
    $('#value-wrappers').append(row);
});

// Remove value row
$(document).on('click', '.remove', function () {
    $(this).closest('.value-row').remove();
});

//delete variation

$(document).on('click', '.deleteVariationBtn', function () {
    let id = $(this).data('id');
    if (!confirm("Are you sure you want to delete this variation?")) {
        return;
    }
    $.ajax({
        url: "/variations/" + id,
        type: "DELETE",
        data: {
            "_token": "{{ csrf_token() }}"
        },
        success: function (res) {
            if (res.status === 'success') {
                $('#totalvariation').DataTable().ajax.reload();
            }
        }
    });
});

});
</script>
@endpush