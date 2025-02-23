@include('layouts.header')
<!-- CSS Start-->
@include('layouts.css')
<link href="{{asset('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

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

    <div class="container-fluid">
        <div class="col-lg-8 ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">New Item</h4>
                    <hr>
                    <form class="form-group" name="emp_registration" id="emp_registration" action="{{url('add_item')}}"
                        method="POST">
                        {{ csrf_field() }}
                        {{ csrf_field() }}
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
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Name</label>
                                <input type="text" class="form-control input-default" name="item_name" id="item_name"
                                    placeholder="Item Name *" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>HSN</label>
                                <input type="text" class="form-control input-default" name="item_hsn" id="item_hsn"
                                    placeholder="Item HSN *" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Unit</label>
                                <select class="form-control" id="item_unit" name="item_unit" required>
                                    <option value="">Select Unit</option>
                                    <option value="nos">NOS</option>
                                    <option value="kg">KG</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label>Desc</label>
                                <input type="text" class="form-control input-default" name="item_desc" id="item_desc"
                                    placeholder="Item Desc" required>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>MRP</label>
                                <input type="text" class="form-control input-default" name="item_mrp" id="item_mrp"
                                    placeholder="MRP" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Purchase Price</label>
                                <input type="text" class="form-control input-default" name="item_purchase"
                                    id="item_purchase" placeholder="Purchase Price *" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Sale Price</label>
                                <input type="text" class="form-control input-default" name="item_sale" id="item_sale"
                                    placeholder="Sale Price *" required>
                            </div>
                        </div>
                        <hr>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Opening Stock</label>
                                <input type="number" class="form-control input-default" name="item_opening_stock"
                                    id="item_opening_stock" placeholder="Opening Stock" pattern="[0-9]{4}" readonly>
                            </div>

                        </div>


                        <button type="submit" class="btn btn-dark float-right">Save</button>
                    </form>

                </div>
            </div>
        </div>

    </div>


</div>
<!--**********************************
        Content body end
***********************************-->

@include('layouts.footer')