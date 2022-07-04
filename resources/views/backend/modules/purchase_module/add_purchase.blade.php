@extends("backend.template.layout")

@section('per_page_css')
<link href="{{ asset('backend/css/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/form-select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2-materialize.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2.min.css') }}" rel="stylesheet">
@endsection

@section('body-content')
<div class="content-wrapper" style="min-height: 147px;">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                {{ __('Application.Dashboard') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('purchase.index') }}">
                                {{ __('Purchase.AllPurchase') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="#">
                                {{ __('Purchase.AddNewPurchase') }}
                            </a>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline table-responsive">
                        <div class="card-header">
                            <h6>{{ __('Purchase.AddNewPurchase') }}</h6>
                        </div>
                        <div class="card-body">

                            <form onsubmit="add_new_item(event)" action="" method="get">

                                {{-- Item Adding Start --}}
                                <div class="row">

                                     {{-- Supplier Name --}}
                                     <div class="col-md-3">
                                        <label>{{ __('Supplier.SupplierName') }}</label>
                                        <select required name="supplier_id" id="supplier" class="form-control form-control-sm select2">
                                            <option value="" selected disabled>{{ __('Application.Select') }} {{ __('Supplier.Supplier') }}</option>
                                            @forelse ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                            @empty

                                            @endforelse
                                        </select>
                                    </div>

                                    {{-- Lot --}}
                                    <div class="col-md-3">
                                        <label>{{ __('Lot.Lot') }}</label>
                                        <select required class="form-control form-control-sm select2" name="lot_id" id="lot">
                                            <option value="" selected disabled>Select Lot</option>
                                            <option id="new_lot_store" class=" d-none" value="AddNewLot">{{ __('Lot.LotAdd') }}</option>
                                            @foreach ($lots as $lot)
                                                <option value="{{ $lot->id }}">{{ $lot->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    {{-- Item Name --}}
                                    <div class="col-md-3">
                                        <label>{{ __('Item.Item') }}</label>
                                        <select required name="item_id" class="form-control form-control-sm select2" id="item_id">
                                            <option selected value="">{{ __('Item.SelectItem') }}</option>
                                            @forelse ($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @empty

                                            @endforelse
                                        </select>
                                    </div>

                                    {{-- Item Varient --}}
                                    <div class="col-md-1">
                                        <label>{{ __('Item.ItemVariant') }}</label>
                                        <select required name="item_varient" class="form-control form-control-sm select2" id="item_varient">
                                            <option selected disabled>{{ __('variant.SelectVarient') }}</option>
                                        </select>
                                    </div>

                                    {{-- Unit --}}

                                    <div class="col-md-2">
                                        <label>{{ __('Unit.Unit') }}</label>
                                        <select name="item_unit" class="form-control form-control-sm select2" id="item_unit">
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Item Weight --}}
                                    <div class="col-md-3">
                                        <label>{{ __('Purchase.Beg') }}</label>
                                        <input required type="text" class="form-control form-control-sm" onchange="total_price_calculation()" id="beg" name="beg">
                                    </div>

                                    {{-- Item Price --}}
                                    <div class="col-md-3">
                                        <label>{{ __('Purchase.Price') }}</label>
                                        <input required type="text" class="form-control form-control-sm" onchange="total_price_calculation()" id="unit_price" name="unit_price">
                                    </div>

                                    {{-- Total Price --}}
                                    <div class="col-md-3">
                                        <label>{{ __('Purchase.TotalPrice') }}</label>
                                        <input readonly type="text" class="form-control form-control-sm" id="total_price" value="" name="total_price">
                                    </div>

                                    {{-- Add Button --}}
                                    <div class="col-md-3">
                                        <button class="btn btn-info mt-4 btn-sm">{{ __('Application.Add') }}</button>
                                    </div>
                                </div>
                                {{-- Item Adding End --}}
                                <br>

                                <div class="row">
                                    {{-- Added Item List Start --}}
                                    <div class="col-md-9 bg card">
                                        <span style="margin-top: 8px;"></span>
                                        <table width="100%" class="table table-sm table-bordered">
                                            <thead>
                                                <th>{{ __('Application.SerialNo') }}</th>
                                                <th>{{ __('Item.Item') }}</th>
                                                <th>{{ __('Purchase.Beg') }}</th>
                                                <th>{{ __('Purchase.Weight') }}</th>
                                                <th>{{ __('Purchase.Price') }}</th>
                                                <th>{{ __('Purchase.TotalPrice') }}</th>
                                                <th>{{ __('Application.Delete') }}</th>
                                            </thead>

                                            <tbody id="added_items_list">



                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- Added Item List End --}}

                                    {{-- Sub Total Information Start --}}
                                    <div class="col-md-3 bg card">
                                        <span style="margin-top: 8px;"></span>

                                        <label>{{ __('Purchase.TotalPrice') }}</label>
                                        <input type="text" class="form-control form-control-sm" id="purchase_total_price">

                                        <label>{{ __('Purchase.PreviousBalance') }}</label>
                                        <input type="text" class="form-control form-control-sm" value="0" id="previous_balance">

                                        <label>{{ __('Purchase.InTotalAmount') }}</label>
                                        <input type="text" class="form-control form-control-sm" id="previous_in_total_amount">

                                        <label>{{ __('Purchase.DepositeAmount') }}</label>
                                        <input type="text" class="form-control form-control-sm" id="previous_deposite_amount" onkeyup="due_amount_calculation()">

                                        <label>{{ __('Purchase.DueAmount') }}</label>
                                        <input type="text" class="form-control form-control-sm" readonly id="previous_due_amount">

                                        <label>{{ __('Purchase.PaymentBy') }}</label>
                                        <select name="payment_by" class="form-control form-control-sm">
                                            <option value="CASH">{{ __('Purchase.Cash') }}</option>
                                            <option value="CASH">{{ __('Purchase.Bank') }}</option>
                                        </select>

                                        <button class="btn btn-success btn-sm mt-3 ">
                                            {{ __('Application.Add') }}
                                        </button>

                                        <span style="margin-bottom: 8px;"></span>
                                    </div>
                                    {{-- Sub Total Information End --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

{{-- Lot Add Modal Start --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Lot.AddNewLot') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="ajax-form" method="post" action="{{ route('lot.store') }}">
                    @csrf

                    <div class="row">

                        <!-- name -->
                        <div class="col-md-12 col-12 form-group">
                            <label for="name">{{ __('Lot.LotName') }}</label><span class="require-span">*</span>
                            <input type="text" class="form-control" name="lot_name" required>
                        </div>

                        <div class="col-md-12 form-group text-right">
                            <button type="submit" class="btn btn-outline-dark">
                                {{ __('Application.Add') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Application.Close') }}</button>
            </div>

        </div>
    </div>
</div>
{{-- Lot Add Modal End --}}

@endsection

@section('per_page_js')


<script>

    let added_items = [];
    const items = {!! json_encode($items) !!};

    // Get lot Data
    function get_lot(){
        $.ajax({
            url: "{{ route('lot.get-lots') }}",
            method: 'GET',
            success: function(data){
                $('#lot').html(`<option value="" selected>Select Lot</option> <option id="new_lot_store" value="AddNewLot">{{ __('Lot.LotAdd') }}</option>`);
                $.each(data, function(index, value){
                    $('#lot').append(`<option value="${ value.id}">${value.name}</option>`)
                });
            }
        });
    }

    function due_amount_calculation(){
        const previous_deposite_amount = $('#previous_deposite_amount').val();
        const previous_in_total_amount = $("#previous_in_total_amount").val();
        $("#previous_due_amount").val(parseFloat(previous_in_total_amount ? previous_in_total_amount : 0) - parseFloat(previous_deposite_amount ? previous_deposite_amount : 0))
    }


        // Get Item Varient Data
        $('#item_id').change(function () {
            var $id = $(this).val();
            var varient_id = $('#item_varient');
            $.ajax({
                url: "{{ route('purchase.item_varients') }}",
                data:{
                    item_id: $id
                },
                method: 'GET',
                success: function(data){
                    varient_id.html('<option selected disabled>Choose Varient</option>');
                    $.each(data, function(index, value){
                        varient_id.append('<option value = "'+ value.variant.id +'">'+ value.variant.name +'</option>')
                    });
                }
            });
        });

        // Get Item Varient Data
        $('#supplier').change(function () {
            var $id = $(this).val();
            $.ajax({
                url: "{{ route('supplier.show-details') }}",
                data:{
                    id: $id
                },
                method: 'GET',
                success: function(data){
                    const sum_in = data.transactions.reduce((accumulator, object) => {
                        return accumulator + object.cash_in;
                    }, 0);

                    const sum_out = data.transactions.reduce((accumulator, object) => {
                        return accumulator + object.cash_out;
                    }, 0);

                    const purchase_total_price = $('#purchase_total_price').val();

                    $("#previous_balance").val(sum_in - sum_out)

                    $("#previous_in_total_amount").val((sum_in - sum_out) + parseFloat(purchase_total_price))

                    due_amount_calculation()
                }
            });
        });

    $(document).ready(function(){
        $('#lot').change(function(){
            var newLot = $(this).val();
            if(newLot == 'AddNewLot') {
                $('#myModal').modal('show');

            }
        });
    });

    function total_price_calculation() {
       let total_price = $("#total_price");
       const unit_price_val = $("#unit_price").val();
       const beg_val = $("#beg").val();
       if (unit_price_val && beg_val) {
        total_price.val(unit_price_val * beg_val)
       }
    }

    function add_new_item(event) {
        event.preventDefault();

        const lot = $("#lot").val();
        const item_id = $("#item_id").val();
        const item_varient = $("#item_varient").val();
        const item_unit = $("#item_unit").val();
        const beg = $("#beg").val();
        const unit_price = $("#unit_price").val();
        const total_price = $("#total_price").val();

        const item_obj = {
            "lot": lot,
            "item_id": item_id,
            "item_varient": item_varient,
            "item_unit": item_unit,
            "beg": beg,
            "unit_price": unit_price,
            "total_price": total_price,
        }
        added_items.push(item_obj)
        show_items()
    }

    function show_items() {

        $("#added_items_list").html('');

        let total_amount = 0;

        added_items.forEach((element, index) => {

            total_amount += parseFloat(element.total_price);

            const item_name = items.find(e => e.id == element.item_id).name;

            $("#added_items_list").append(`
                <tr>
                    <td>${index + 1}</td>
                    <td>${item_name}</td>
                    <td>${element.beg}</td>
                    <td>২৫</td>
                    <td>${element.unit_price}</td>
                    <td>${element.total_price}</td>
                    <td>
                        <button type="button" onclick="remove_item(${index})" class="btn btn-danger btn-sm">X</button>
                    </td>
                </tr>
            `)
        });

        $('#purchase_total_price').val(total_amount);
        const previous_balance = $("#previous_balance").val()

        $('#previous_in_total_amount').val(total_amount + parseFloat(previous_balance));
        due_amount_calculation()
    }

    function remove_item(index){
        added_items.splice(index, 1)
        show_items()
    }

    show_items()

    // function matchStart(params, data) {
    //     // If there are no search terms, return all of the data
    //     if ($.trim(params.term) === '') {
    //         return data;
    //     }

    //     // Skip if there is no 'children' property
    //     if (typeof data.children === 'undefined') {
    //         $('#new_lot_store').removeClass("d-none");
    //         return null;
    //     } else {
    //         $('#new_lot_store').addClass("d-none");
    //     }

    //     // `data.children` contains the actual options that we are matching against
    //     var filteredChildren = [];
    //     $.each(data.children, function (idx, child) {
    //         if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
    //         filteredChildren.push(child);
    //         }
    //     });

    //     // If we matched any of the timezone group's children, then set the matched children on the group
    //     // and return the group object
    //     if (filteredChildren.length) {
    //         var modifiedData = $.extend({}, data, true);
    //         modifiedData.children = filteredChildren;

    //         // You can return modified objects from here
    //         // This includes matching the `children` how you want in nested data sets
    //         return modifiedData;
    //     }

    //     // Return `null` if the term should not be displayed
    //     return null;
    // }

</script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('backend/js/custom-script.min.js') }}"></script>
<script src="{{  asset('backend/js/ajax_form_submit.js') }}"></script>
<script src="{{ asset('backend/js/select2/form-select2.min.js') }}"></script>
<script src="{{ asset('backend/js/select2/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function domReady() {
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%',
            // matcher: matchStart
        });
    });
</script>

@endsection
