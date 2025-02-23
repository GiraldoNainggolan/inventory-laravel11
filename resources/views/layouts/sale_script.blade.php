<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

                if (container.querySelectorAll('tr').length >1) {
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
        var price = parseFloat(currentRow.find('.item_sale').val()); 
        var stock = parseFloat(currentRow.find('.item_stock').val()); 

        qty = isNaN(qty) ? 0 : qty;
        price = isNaN(price) ? 0 : price;

        if (qty > stock) {
            alert('Quantity entered exceeds available stock! Available stock: ' + stock);
            $(this).val(''); 
            currentRow.find('.item_amount').val('0.00'); 
        } else {
            var amount = qty * price; 
            currentRow.find('.item_amount').val(amount.toFixed(2)); 
        }

        updateTotalAmount(); 
    });

    $('#itemTableBody').on('input', '.item_sale', function() {
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
    $(document).ready(function () {
        $('#customer_id').on('change', function () {
            var id = this.value;
            // alert(id);

            $("#customer_mobile").html('');
            $.ajax({
                url: "{{url('fetch_customer_details')}}",
                type: "POST",
                data: {
                    id: id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (response) {
                    $('#customer_mobile').val(response.customer.customer_mobile);
                    $('#customer_name').val(response.customer.customer_name);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
            $('#itemTableBody').on('change', '.item_id', function () {
            var id = this.value;
            var currentRow = $(this).closest('tr');
            // alert(id);

            $.ajax({
                url: "{{url('fetch_item_details')}}",
                type: "POST",
                data: {
                    id: id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (response) {
                        console.log(response);
                    
                    currentRow.find('.item_hsn').val(response.item.item_hsn);
                    currentRow.find('.item_mrp').val(response.item.item_mrp);
                    currentRow.find('.item_sale').val(response.item.item_sale);
                    currentRow.find('.item_stock').val(response.item.item_stock);
                    currentRow.find('.item_name').val(response.item.item_name);
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('sale_date').setAttribute('value', today);
    });
</script>