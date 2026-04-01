<div class="row"  id="variation_section">
    <div class="col-md-3">
        <label class="form-label">Variation Name:</label>
        <select class="form-select" name="variation_name" id="variation_name">
            <option>Please Select</option>
            @foreach($variations as $variation)
                <option value="{{ $variation->id }}">{{ $variation->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="row">
        <table>
            <tr>
                <th>Variation Value:</th>
                <th>MRP:</th>
                <th>Unit Price:</th>
                <th>Margin:</th>
                <th>Sale Price:</th>
                <th></th>
            </tr>
            <tbody id="variation_table_body">
            </tbody>
            <!-- <tr>
                <td>
                </td>
                <td>
                <input type="text" class="form-control" name="mrp" id="mrp" placeholder="Enter MRP"></td>
                <td>
                <input type="text" class="form-control" name="unit_price" id="unit_price" placeholder="Enter Unit Price">
                </td>
                <td>
               <input type="text" class="form-control" name="margin" id="margin" placeholder="Enter Margin">
                </td>
                <td>
                 <input type="text" class="form-control" name="sale_price" id="sale_price" placeholder="Enter Sale Price">
                </td>
                <td>
                  <button type="button" class="btn btn-danger">-</button>
                </td>

            </tr> -->
          
        </table>
         

    </div>
</div>