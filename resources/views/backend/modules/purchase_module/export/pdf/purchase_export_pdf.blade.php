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
            <div class="col-md-12 table-responsive">
                <table class="table table-sm table-bordered">
                    <tr>
                        <th>{{ __('Supplier.SupplierName') }}</th>
                        <td>{{ $purchase->supplier->name }}</td>

                        <th>{{ __('Supplier.SupplierPhone') }}</th>
                        <td>{{ $purchase->supplier->contact_no }}</td>

                    </tr>

                    <tr>
                        <th>{{ __('Application.Date') }}</th>
                        <td>{{ Carbon\Carbon::parse($purchase->date)->toFormattedDateString() }}</td>

                        <th>{{ __('Purchase.TotalAmount') }}</th>
                        <td>{{ $purchase->total_amount }}</td>
                    </tr>
                </table>
            </div>

            {{-- Purchase Details Information --}}
            <div class="col-md-12 table-responsive" style="margin-top: 5px;">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>{{ __('Application.SerialNo') }}</th>
                            <th>{{ __('Lot.LotName') }}</th>
                            <th>{{ __('Item.Item') }}</th>
                            <th>{{ __('Purchase.Weight') }}</th>
                            <th>{{ __('Unit.Unit') }}</th>
                            <th>{{ __('Purchase.Beg') }}</th>
                            <th>{{ __('Purchase.Price') }}</th>
                            <th>{{ __('Purchase.TotalPrice') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($purchase_details as $key => $detail)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $detail->lot->name }}</td>
                                <td>{{ $detail->item->name }}</td>
                                <td>{{ $detail->variant->name }}</td>
                                <td>{{ $detail->unit->name }}</td>
                                <td>{{ $detail->total_price / $detail->unit_price }}</td>
                                <td>{{ $detail->unit_price }}</td>
                                <td>{{ $detail->total_price }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td>
                                    <span class="badge badge-danger">No Data Found!!</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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

