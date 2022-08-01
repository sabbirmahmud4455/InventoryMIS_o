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
                @if ($unit_wise_item_group && count($unit_wise_item_group) > 0)
                    <table class="table table-sm table-bordered text-center">
                        <thead>
                            <tr>
                                {{-- <th>{{ __('Application.SerialNo') }}</th> --}}
                                <th>{{ __('Unit.Unit') }}</th>
                                <th>{{ __('Item.Item') }}</th>
                                <th>{{ __('Application.Date') }}</th>
                                <th>{{ __('Report.InQuantity') }}</th>
                                {{-- <th>Out Quantity</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_row = 0;
                                $total_quantity = 0;
                            @endphp
                            @foreach ($unit_wise_item_group as $key => $unit_wise_items)

                                @foreach ($unit_wise_items->groupBY('item_id') as $unit_wise_item)
                                    @php
                                        $total_row += count($unit_wise_item) +1;
                                    @endphp
                                @endforeach
                                
                                <tr>
                                    <td rowspan="{{ $total_row + 1 }}" style="text-align: center">{{ $unit_wise_items[0]->unit->name }}</td>
                                    
                                    @foreach ($unit_wise_items->groupBY('item_id') as $unit_wise_item)
                                        <tr>
                                            <td rowspan="{{ count($unit_wise_item) + 1 }}" style="text-align: center">{{ $unit_wise_item[0]->item->name }}</td>
                                            @foreach ($unit_wise_item as $item)
                                                <tr>
                                                    <td style="text-align: center">{{ \Carbon\Carbon::Parse($item->created_at)->format('d-M-Y') }}</td>
                                                    <td style="text-align: center">{{ $item->in_quantity }}</td>
                                                    {{-- <td>{{ $item->out_quantity }}</td> --}}
                                                </tr>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tr>
                            @endforeach
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

