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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Admin List</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>DOB</th>
                                        <th>Mobile</th>
                                        <th>Addrress</th>
                                        <th>Start date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($emp_list->count() > 0)
                                    @foreach($emp_list as $value)
                                    <tr>
                                        {{-- <td>{{$value->user_type}}</td> --}}
                                        <td>{{$value->fname}} {{$value->lname}}</td>
                                        <td>{{$value->type}}</td>
                                        <td>{{$value->dob}}</td>
                                        <td>{{$value->mobile}}</td>
                                        <td>{{$value->address}},{{$value->city}},{{$value->state}},{{$value->pincode}}
                                        </td>
                                        <td>{{$value->created_at}}</td>
                                        <td>{{$value->status}}</td>
                                        <td>{{$value->created_at}}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8">No Records Found</td>
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


</div>
<!--**********************************
        Content body end
***********************************-->

@include('layouts.footer')