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
    <div class="container-fluid">
        <div class="col-lg-4 ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Import Item</h4>
                    <hr>
                    <form action="{{url('import')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="excel_file" required>
                        <button type="submit" class="btn btn-primary ">Import</button>
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