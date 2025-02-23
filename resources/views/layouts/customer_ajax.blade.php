<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $('.customer-rowid').on('click', function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        $.ajax({
            url: "{{url('get_customer')}}",
            type: "POST",
            data: {
                id: id,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (response) {
                $('#customer_name_view').text(response.customer.customer.customer_name);
                $('#customer_mobile_view').text(response.customer.customer.customer_mobile);
                $('#customer_address_view').text(response.customer.customer.customer_address);

                $('#data-customer_id').empty();

                var editButton = $('<button/>', {
                    type: 'button',
                    class: 'btn btn-primary bd-example-modal-lg-edit-customer',
                    'data-toggle': 'modal',
                    'data-target': '#bd-example-modal-lg-edit-customer',
                    'data-customer_id': response.customer.customer.id, 
                    text: 'Edit'
                });

                $('#data-customer_id').append(editButton);


                var tableBody = $('#transactionsTable tbody');
                    tableBody.empty(); 
                    var hasData = false;

                    $.each(response.sale_list.sale, function(index, item) {
                        var row = `
                            <tr>
                                <td>Sale</td>
                                <td>${item.sale_bill}</td>
                                <td>${item.customer_name}</td>
                                <td>${item.sale_date}</td>
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
                alert('Failed to fetch customer details. Please try again.');
            }
        });
    });
});

</script>
<script>
    $(document).ready(function () {
        $(document).on('click','.bd-example-modal-lg-edit-customer',function(){
            var customer_id =  $(this).data('customer_id');
            // alert(customer_id);
            
            $('#data-bd-example-modal-lg-edit-customer').modal('show');

            $.ajax({
                url: "{{url('edit_customer')}}",
                type: "POST",
                data: {
                    id: customer_id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    $('#customer_name_edit').val(response.customer.customer_name);
                    $('#customer_mobile_edit').val(response.customer.customer_mobile);
                    $('#customer_address_edit').val(response.customer.customer_address);
                    $('#customer_id_edit').val(response.customer.id);
                }
            });
    });
});      
</script>