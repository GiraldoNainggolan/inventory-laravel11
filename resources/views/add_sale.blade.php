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
            <form name="add_sale" id="add_sale" class="form-horizontal" method="Post" action="{{ url('add_sale') }}"
                enctype="multipart/form-data" autocomplete="on">
                {{ csrf_field() }}
                <div class="card-body" style="text-transform:uppercase">
                    <h4 class="card-title">Sale</h4>
                    <hr>

                    <div class="basic-form form-group row">
                        <div class="col-sm-2 pb-2">
                            <label for="customer_name">Customer :</label>
                            <select class="form-control" id="customer_id" name="customer_id" required>
                                <option value="">Select Customer</option>
                                @if($customer->count() > 0)
                                @foreach($customer as $value)
                                <option value="{{$value->id}}">{{$value->customer_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-2 pb-2">
                            <label for="customer_mobile">Mobile :</label>
                            <input type="text" class="form-control" name="customer_mobile" id="customer_mobile"
                                placeholder="Mobile" required>
                            <input type="hidden" class="form-control" name="customer_name" id="customer_name" required>
                        </div>
                    </div>
                    <div class="basic-form form-group row">
                        <div class="col-sm-2 pb-2">
                            <label for="sale_bill">Bill No :</label>
                            <input type="text" class="form-control" id="sale_bill" name="sale_bill"
                                placeholder="Bill Number *" value="{{ $nextBillNumber }}" readonly
                                style="text-transform:uppercase">
                        </div>
                        <div class="col-sm-2 pb-2">
                            <label for="sale_date">Bill Date :</label>
                            <input type="date" class="form-control mydatepicker" name="sale_date" id="sale_date"
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
                                        <input type="hidden" name="item_stock[]" id="item_stock"
                                            class="form-control form-control-sm item_stock" min="0" placeholder="Qty">
                                    </td>
                                    <td class="col-sm-1 pb-2"><input type="number"
                                            class="form-control form-control-sm item_sale" name="item_sale[]"
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
{{-- @include('layouts.ajax') --}}
@include('layouts.sale_script')



@include('layouts.footer')