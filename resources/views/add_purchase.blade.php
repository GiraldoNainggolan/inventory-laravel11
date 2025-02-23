@include('layouts.header')
<!-- CSS Start-->
@include('layouts.css')

@include('layouts.top_navbar')
@include('layouts.left_sidebar')
<!--**********************************
         Content body start
***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
            </ol>
        </div>
    </div>
    @if (Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
    @endif
    @if (Session::has('fail'))
    <div class="alert alert-danger">
        {{Session::get('fail')}}
    </div>
    @endif
    <div class="col-lg-12">
        <div class="card">
            <form name="add_purchase" id="add_purchase" class="form-horizontal" method="Post"
                action="{{ url('add_purchase') }}" enctype="multipart/form-data" autocomplete="on">
                {{ csrf_field() }}
                <div class="card-body" style="text-transform:uppercase">
                    <h4 class="card-title">Purchase</h4>
                    <hr>

                    <div class="basic-form form-group row">
                        <div class="col-sm-2 pb-2">
                            <label for="vendor_name">Vendor :</label>
                            <select class="form-control" id="vendor_id" name="vendor_id" required>
                                <option value="">Select Vendor</option>
                                @if($vendor->count() > 0)
                                @foreach($vendor as $value)
                                <option value="{{$value->id}}">{{$value->vendor_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-2 pb-2">
                            <label for="vendor_mobile">Mobile :</label>
                            <input type="text" class="form-control" name="vendor_mobile" id="vendor_mobile"
                                placeholder="Mobile" required>
                            <input type="hidden" class="form-control" name="vendor_name" id="vendor_name"
                                placeholder="Mobile" required>
                        </div>
                        <div class="col-sm-2 pb-2">
                            <label for="vendor_gstin">GSTIN :</label>
                            <input type="text" class="form-control" name="vendor_gstin" id="vendor_gstin"
                                placeholder="GSTIN" required>
                        </div>
                    </div>
                    <div class="basic-form form-group row">
                        <div class="col-sm-2 pb-2">
                            <label for="purchase_bill">Bill No :</label>
                            <input type="text" class="form-control" id="purchase_bill" name="purchase_bill"
                                placeholder="Bill Number *" required style="text-transform:uppercase">
                        </div>
                        <div class="col-sm-2 pb-2">
                            <label for="purchase_date">Bill Date :</label>
                            <input type="date" class="form-control mydatepicker" name="purchase_date" id="purchase_date"
                                placeholder="date" required>
                        </div>
                    </div>
                    <hr>
                    <div class="basic-form">
                        <table class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th class="col-sm-1 pb-2">#</th>
                                    <th class="col-sm-2 pb-2">ITEM</th>
                                    <th class="col-sm-1 pb-2">HSN</th>
                                    <th class="col-sm-1 pb-2">MRP</th>
                                    <th class="col-sm-1 pb-2">QTY</th>
                                    <th class="col-sm-1 pb-2">PRICE</th>
                                    <th class="col-sm-1 pb-2">AMOUNT</th>
                                    <th class="col-sm-1 pb-2"></th>
                                </tr>
                            </thead>
                            <tbody id="itemTableBody">
                                <tr rowid='1'>
                                    <td class="col-sm-1 pb-2">1</td>
                                    <td class="col-sm-2 pb-2">
                                        <select class="item_id select2 form-control form-control-sm" name="item_id[]"
                                            id="item_id" data-placeholder="" style="width: 100%;">
                                            <option></option>
                                            @if($item->count() > 0)
                                            @foreach($item as $value)
                                            <option value="{{$value->id}}">{{$value->item_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </td>
                                    <td class="col-sm-1 pb-2 "><input type="number" name="item_hsn[]" id="item_hsn"
                                            class="form-control form-control-sm item_hsn" min="0" placeholder="HSN">
                                        <input type="hidden" name="item_name[]" id="item_name"
                                            class="form-control form-control-sm item_name">
                                    </td>
                                    <td class="col-sm-1 pb-2 "><input type="number" name="item_mrp[]" id="item_mrp"
                                            class="form-control form-control-sm item_mrp" min="0" placeholder="MRP">
                                    </td>
                                    <td class="col-sm-1 pb-2"><input type="number" name="item_qty[]" id="item_qty"
                                            class="form-control form-control-sm item_qty" min="0" placeholder="Qty">
                                    </td>
                                    <td class="col-sm-1 pb-2"><input type="number"
                                            class="form-control form-control-sm item_purchase" name="item_purchase[]"
                                            id="item_purchase" min="0" placeholder="Price">
                                    </td>
                                    <td class="col-sm-1 pb-2"><input type="number" name="item_amount[]"
                                            class="form-control form-control-sm item_amount" min="0"
                                            placeholder="Amount" readonly>
                                    </td>
                                    <td class="col-sm-1 pb-2"><i class="remove-row far fa-trash-alt "></i></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><button id="addRowButton" class="btn btn-primary">Add Row</button></td>
                                    <td colspan="5" class="text-right">TOTAL</td>
                                    <td><input type="number" class="form-control form-control-sm item_totalAmount"
                                            name="item_totalAmount" id="item_totalAmount" placeholder="Total" readonly>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



</div>
<!--**********************************
        Content body end
***********************************-->
@include('layouts.ajax')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let rowIndex = document.querySelectorAll('#itemTableBody tr').length; 

        document.querySelector('#addRowButton').addEventListener('click', function(e) {
            e.preventDefault();

            const container = document.getElementById('itemTableBody');
            const firstRow = container.querySelector('tr');
            const newRow = firstRow.cloneNode(true);

            newRow.querySelectorAll('input').forEach(input => {
                input.value = '';
                input.removeAttribute('id');
            });

            newRow.querySelectorAll('select').forEach(select => {
                select.selectedIndex = 0; 
                select.removeAttribute('id');
            });

            newRow.querySelector('td:first-child').innerText = ++rowIndex;

            container.appendChild(newRow);
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-row')) {
                e.preventDefault();

                const row = e.target.closest('tr');
                const container = document.getElementById('itemTableBody');

                if (container.querySelectorAll('tr').length > 1) {
                    row.remove();

                    const rows = container.querySelectorAll('tr');
                    rowIndex = rows.length; 

                    rows.forEach((row, index) => {
                        row.querySelector('td:first-child').innerText = index + 1;
                    });
                } else {
                    alert("At least one row is required.");
                }
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
    function updateTotalAmount() {
        let total = 0;
        $('.item_amount').each(function() {
            let amount = parseFloat($(this).val());
            amount = isNaN(amount) ? 0 : amount;
            total += amount;
        });
        $('#item_totalAmount').val(total.toFixed(2)); 
    }

    $('#itemTableBody').on('input', '.item_qty', function() {
        var currentRow = $(this).closest('tr'); 
        var qty = parseFloat($(this).val()); 
        var price = parseFloat(currentRow.find('.item_purchase').val()); 

        qty = isNaN(qty) ? 0 : qty;
        price = isNaN(price) ? 0 : price;

        var amount = qty * price; 
        currentRow.find('.item_amount').val(amount.toFixed(2)); 

        updateTotalAmount(); 
    });

    $('#itemTableBody').on('input', '.item_purchase', function() {
        var currentRow = $(this).closest('tr'); 
        var qty = parseFloat(currentRow.find('.item_qty').val());  
        var price = parseFloat($(this).val());  

        qty = isNaN(qty) ? 0 : qty;
        price = isNaN(price) ? 0 : price;

        var amount = qty * price;  
        currentRow.find('.item_amount').val(amount.toFixed(2));  

        updateTotalAmount();  
    });

     $('#itemTableBody').on('input', '.item_amount', function() {
        updateTotalAmount();  
    });

     $('#itemTableBody').on('click', '.remove-row', function() {
        $(this).closest('tr').remove();  
        updateTotalAmount();  
    });
});

</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('purchase_date').setAttribute('value', today);
    });
</script>

@include('layouts.footer')