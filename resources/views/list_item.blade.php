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

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-md-3">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4><span class="text-body">Item List</span></h4>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target=".bd-example-modal-lg">Add Item</button>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <input type="text" id="itemSearch" class="form-control" placeholder="Search Item...">
                        </div>
                        <hr>
                        <div class="item-list activity " id="activity">
                            <table id="itemTable" class="table table-bordered table-hover verticle-middle">

                                <tbody>
                                    <tr>
                                        <th>Item</th>
                                        <th>Qty</th>
                                    </tr>
                                    @if($list_item->count() > 0)
                                    @foreach($list_item as $value)
                                    <tr class="item-rowid" data-id="{{ $value->id }}"
                                        data-name="{{ $value->item_name }}">
                                        <td>
                                            {{-- <a id="get_data">{{$value->item_name}}</a> --}}
                                            <a href="#" id="item-link" data-id="{{ $value->id }}"
                                                data-name="{{ $value->item_name }}">{{ $value->item_name
                                                }}</a>
                                        </td>
                                        <td>{{ $value->item_stock}}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Main Content -->
                    <div class="col-md-9 item-details">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4><span id="item_name_view">{{ $list_item[0]->item_name }}</span></h4>
                            <div id="data-item_id"></div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p>Sale Price: <span class="text-success" id="item_sale_view">₹ {{
                                        $list_item[0]->item_sale
                                        }}</span></p>
                                <p>Purchase Price: <span class="text-success" id="item_purchase_view">₹ {{
                                        $list_item[0]->item_purchase }}</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p>Stock Quantity:<span class="text-danger" id="item_stock_view"> {{
                                        $list_item[0]->item_stock }}</span> </p>
                                <p>Stock Value: <span class="text-success" id="item_stockvalue_view">0</span></p>
                            </div>
                        </div>
                        <hr>

                        <!-- Transactions Table -->
                        <h5>Transactions</h5>

                        <div class="transaction-list ">
                            <table id="transactionsTable" class="table table-bordered verticle-middle">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Invoice/Ref. No</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Quantity</th>
                                        <th>Price/Unit</th>
                                        <th>Amount</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    {{--
                                    <!-- Rows will be appended here by the script -->
                                    <td><a href="/sale/${item.id}/edit" class="btn btn-warning btn-sm">Edit</a></td>
                                    --}}
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
        Content body end
***********************************-->

@include('layouts.modal')
@include('layouts.ajax')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
    $('#itemSearch').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        
        $('#itemTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});

</script>
@include('layouts.js')
<script>
    $('.activity').slimscroll({
    position: "right",
    size: "5px",
    height: "390px",
    color: "transparent"
});
</script>
@include('layouts.foot')