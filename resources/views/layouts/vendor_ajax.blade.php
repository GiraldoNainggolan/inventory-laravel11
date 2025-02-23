<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $('.vendor-rowid').on('click', function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        $.ajax({
            url: "{{url('get_vendor')}}",
            type: "POST",
            data: {
                id: id,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (response) {
                $('#vendor_name_view').text(response.vendor.vendor.vendor_name);
                $('#vendor_mobile_view').text(response.vendor.vendor.vendor_mobile);
                $('#vendor_gstin_view').text(response.vendor.vendor.vendor_gstin);
                $('#vendor_email_view').text(response.vendor.vendor.vendor_email);
                $('#vendor_address_view').text(response.vendor.vendor.vendor_address);

                $('#data-vendor_id').empty();

                var editButton = $('<button/>', {
                    type: 'button',
                    class: 'btn btn-primary bd-example-modal-lg-edit-vendor',
                    'data-toggle': 'modal',
                    'data-target': '#bd-example-modal-lg-edit-vendor',
                    'data-vendor_id': response.vendor.vendor.id,  
                    text: 'Edit'
                });

                $('#data-vendor_id').append(editButton);

                var tableBody = $('#transactionsTable tbody');
                    tableBody.empty(); 

                    var hasData = false;

                    $.each(response.purchase_list.purchase, function(index, item) {
                        var row = `
                            <tr>
                                <td>Purchase</td>
                                <td>${item.purchase_bill}</td>
                                <td>${item.vendor_name}</td>
                                <td>${item.purchase_date}</td>

                                <td>₹ ${parseFloat(item.total_amount).toFixed(2)}</td>
                                <td><a href="/purchase/${item.id}/edit" class="btn btn-warning btn-sm">Edit</a></td>
                            </tr>
                        `;
                        tableBody.append(row); 
                        hasData = true;
                    });

                if (!hasData) {
                        tableBody.append('<tr><td colspan="8" class="text-center">No data available</td></tr>');
                    }
   
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
                alert('Failed to fetch vendor details. Please try again.');
            }
        });
    });
});
</script>
<script>
    $(document).ready(function () {
        $(document).on('click','.bd-example-modal-lg-edit-vendor',function(){
            var vendor_id =  $(this).data('vendor_id');
            // alert(vendor_id);
            
            $('#data-bd-example-modal-lg-edit-vendor').modal('show');

            $.ajax({
                url: "{{url('edit_vendor')}}",
                type: "POST",
                data: {
                    id: vendor_id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    $('#vendor_name_edit').val(response.vendor.vendor_name);
                    $('#vendor_mobile_edit').val(response.vendor.vendor_mobile);
                    $('#vendor_gstin_edit').val(response.vendor.vendor_gstin);
                    $('#vendor_email_edit').val(response.vendor.vendor_email);
                    $('#vendor_address_edit').val(response.vendor.vendor_address);
                    $('#vendor_id_edit').val(response.vendor.id);
                }
            });
    });
});      
</script>