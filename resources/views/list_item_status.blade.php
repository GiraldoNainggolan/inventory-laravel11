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
                <h4 class="card-title">Stock List</h4>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>HSN</th>
                                    <th>MRP</th>
                                    <th>PURCHASE PRICE</th>
                                    <th>SALE PRICE</th>
                                    <th>AVAILABLE STOCK</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($list_item_status->count() > 0)
                                @foreach($list_item_status as $value)
                                <tr>
                                    {{-- <td>{{$value->user_type}}</td> --}}
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->item_name}}</td>
                                    <td>{{$value->item_hsn}}</td>
                                    <td>{{$value->item_mrp}}</td>
                                    <td>{{$value->item_purchase}}</td>
                                    <td>{{$value->item_sale}}</td>
                                    <td>{{$value->item_stock}}</td>
                                    @if($value->item_status == 1)
                                    <td>
                                        <a href="list_item_status_change/{{$value->id}}/{{$value->item_status}}"
                                            class="btn btn-success btn-sm toastsDefaultSuccess">Active</a>
                                    </td>
                                    @elseif($value->item_status == 0)
                                    <td>
                                        <a href="list_item_status_change/{{$value->id}}/{{$value->item_status}}"
                                            class="btn btn-danger btn-sm toastsDefaultSuccess">Suspended</a>
                                    </td>
                                    @else
                                    <td>
                                        <a href="list_item_status_change/{{$value->id}}/{{$value->item_status}}"
                                            class="btn btn-warning btn-sm toastsDefaultSuccess">Unknown</a>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach @else
                                <tr>
                                    <td colspan="5">No Records Found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
        Content body end
***********************************-->

@include('layouts.footer')