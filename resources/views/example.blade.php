<!DOCTYPE html>
<html>

<head>
    <title>Stock Details</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }

        .table-bordered {
            width: 100%;
            border-collapse: collapse;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .table-bordered th {
            background-color: #f2f2f2;
        }

        .card-title {
            text-align: center;
            margin-bottom: 20px;
            /* Optional: Adds space below the title */
        }
    </style>
</head>

<body>
    <h1 class="card-title">Stock Details</h1>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Stock List & Value</h4>
                <div class="table-responsive">
                    <table class="table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($list_item->count() > 0)
                            @foreach($list_item as $value)
                            <tr>
                                {{-- <td>{{$value->user_type}}</td> --}}
                                <td>{{$value->item_name}}</td>
                                <td>{{$value->item_stock}}</td>
                                <td>{{$value->item_purchase}}</td>
                                <td>{{$value->item_stock * $value->item_purchase}}</td>
                            </tr>
                            @endforeach @else
                            <tr>
                                <td colspan="4">No Records Found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- <p>Generated on {{ $date }}</p> --}}
    <p>This is an example of a PDF generated in Laravel.</p>

</body>

</html>