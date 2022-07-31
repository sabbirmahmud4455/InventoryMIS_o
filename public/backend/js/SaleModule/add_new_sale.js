$(document).ready(function domReady() {
    // Select2
    $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });

    $('#add_sale').hide();
    // Get Item Varient Data
    $('#item_id').change(function () {
        var item_id = $(this).val();
        var variant_id = $('#item_variant');
        $('.loading').show();
        $.ajax({
            url: "{{ route('sale.item_stock_variant') }}",
            data: {
                item_id: item_id
            },
            method: 'GET',
            success: function (data) {
                $('.loading').hide();

                variant_id.html(
                    '<option value="" selected disabled>Choose Variant</option>');
                $.each(data, function (index, value) {
                    variant_id.append('<option value = "' + value.variant_id +
                        '_' + value.unit_id + '">' + value.variant_name +
                        '(' + value.unit_name + ')' + '</option>')
                });
            }
        });
    });

    // Get Avaialble Lots
    $('#item_variant').change(function () {
        const variat_unit_id = $(this).val();
        const item_id = $('#item_id').val();
        var lot_id = $('#lot_id');

        $('.loading').show();
        $.ajax({
            url: "{{ route('sale.available_lots') }}",
            data: {
                ids: variat_unit_id,
                item_id: item_id
            },
            method: 'GET',
            success: function (data) {
                $('.loading').hide();
                lot_id.html('<option value="" selected disabled>Choose Lot</option>');
                $.each(data, function (index, value) {
                    lot_id.append('<option value = "' + value.lot_id + '">' +
                        value.lot_name + '(' + value.lot_code + ')' +
                        '</option>')
                });
            }
        });
    });



    // Get Avaialble Lots
    $('#lot_id').change(function () {
        const variat_unit_id = $('#item_variant').val();
        const item_id = $('#item_id').val();
        const lot_id = $(this).val();

        var warehouse_id = $('#warehouse_id');

        $('.loading').show();
        $.ajax({
            url: "{{ route('sale.get_warehouse_stock') }}",
            data: {
                ids: variat_unit_id,
                item_id: item_id,
                lot_id: lot_id
            },
            method: 'GET',
            success: function (data) {
                $('.loading').hide();
                warehouse_id.html(
                    '<option value="" selected disabled>Choose Warehouse</option>');
                $.each(data, function (index, value) {
                    warehouse_id.append('<option value = "' + value
                        .warehouse_id + '">' + value.warehouse_name + '(' +
                        value.available_stock + ')' + '</option>')
                });
            }
        });
    });


    // Getting Customer Previous Balance
    $('#customer_id').change(function () {
        const customer_id = $(this).val();
        var previous_balance = $('#previous_balance');
        const route = "{{ route('sale.customer_previuos_balance') }}";
        console.log(route);
        return false;
        
        if (customer_id != 0) {
            $('.loading').show();
            $.ajax({
                url: route,
                data: {
                    customer_id: customer_id
                },
                method: 'GET',
                success: function (data) {
                    $('.loading').hide();
                    previous_balance.val(data.previous_balance);
                }
            });
        } else {
            previous_balance.val(0);
        }
    });


    // Add New Item
    function add_new_item(event) {
        event.preventDefault();

        const lot = $("#lot").val();
        const item_id = $("#item_id").val();
        const item_varient = $("#item_varient").val();
        const item_unit = $("#item_unit").val();
        const beg = $("#beg").val();
        const unit_price = $("#unit_price").val();
        const total_price = $("#total_price").val();
        const warehouse_id = $('#warehouse_id').val();

        const variant_name = variants.find(e => e.id == item_varient).name;
        const unit_name = units.find(e => e.id == item_unit).name;

        const item_obj = {
            "lot": lot,
            "item_id": item_id,
            "item_varient_id": item_varient,
            "item_varient_name": variant_name,
            "item_unit_id": item_unit,
            "item_unit_name": unit_name,
            "beg": beg,
            "unit_price": unit_price,
            "total_price": total_price,
            "warehouse_id": warehouse_id,
        }
        added_items.push(item_obj)
        show_items()
    }
});
