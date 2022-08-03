<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        * {
            font-family: nikosh;
        }
        body{
            font-family: nikosh;
        }
        /* table {
            border:none;
        } */
        /* table tr, table tr td{
            border:none;
        } */

        table, tr, tr{
            width: 100%;
        }

        .table,.table td, .table th, .table tr {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 3px;
            /* width:100%; */
        }

        .w-25{
            width: 25%
        }

        .lbl {
            text-align: left;
            margin-left: 4px !important;
            /* font-size: 15px !important; */
        }

        .space {
            margin-left: 6px !important;
        }

        .margin_up {
            margin-top: 0px;
            margin-left: 32% !important;
        }

        .sl-no {
            width: 15% !important;
        }

        .not-found-txt {
            color: red;
            /* font-size: 10px; */
            text-align: center;
        }

        .mrg{
            margin-left: 50% !important;
        }

    </style>
</head>

<body style="width: 90%;margin: auto;">
    <div class="card">
        <!-- Company Info Start -->
        <div class="card-header">
            <div class="col-md-6" style="text-align: center;margin-top: 14px;">
                <img src="{{ public_path("images/company_info/".$company_info->reporting_logo) }}" height="50px" width="50px">
                <br>
                <span style="font-size: 20px;font-weight: bold">{{ $company_info->name }}</span><br>
                <span style="font-size: 15px;">{{ $company_info->address }}</span><br>
                <span style="font-size: 15px;">Conatct No : {{ $company_info->phone }}, Email : {{ $company_info->email }}</span><br>
                <hr>

                <h3 style="font-size: 15px">{{ $title }}</h3>
            </div>
        </div>
        <!-- Company Info End -->

        <div class="row">
            <div class="col-md-12">
                @if ($stock_lists && count($stock_lists) > 0)
                <table class="table table-bordered table-sm table-striped dataTable dtr-inline datatable-data"
                        id="datatable">
                    <thead>
                        <tr>
                            <th>{{ __('Application.SerialNo') }}</th>
                            <th>{{ __('Item.Item') }}</th>
                            <th>{{ __('Variant.Variant') }}</th>
                            <th>{{ __('Unit.Unit') }}</th>
                            {{-- <th>{{ __('Lot.LotName') }}</th> --}}
                            <th>{{ __('Stock.AvailableStock') }}</th>
                            <th>{{ __('Application.Status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stock_lists as $key => $stock)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $stock->item_name }}</td>
                                <td>{{ $stock->variant_name }}</td>
                                <td>{{ $stock->unit_name }}</td>
                                {{-- <td>{{ $stock->lot_name }}</td> --}}
                                <td>{{ $stock->available_stock }}</td>
                                <td>
                                    @if ($stock->available_stock > 3)
                                        <span class="badge badge-success">{{ __('Stock.AvailableStock') }}</span>
                                    @elseif ($stock->available_stock > 0 && $stock->available_stock <= 3)
                                        <span class="badge badge-warning">{{ __('Stock.LowStock') }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ __('Stock.OutOfStock') }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <center>
                                        <span class="badge badge-danger">
                                            {{ __('Application.NoDataFound') }}
                                        </span>
                                    </center>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @else
                    <h4 class="text-center text-danger my-2 not-found-txt">{{ __('Application.NoDataFound') }}</h4>
                @endif

            </div>
        </div>




    </div>

    <script type="text/php">
        if ( isset($pdf) ) {
            $font = $fontMetrics->getFont("helvetica", "regular");
            $pdf->page_text(50, 816, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));
        }
    </script>

</body>
</html>

