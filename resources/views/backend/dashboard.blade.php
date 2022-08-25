@extends("backend.template.layout")

@section('per_page_css')
@endsection

@section('body-content')
<div class="content-wrapper" style="min-height: 147px;">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item active">

                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $total_purchase[0]->total_amount ? number_format($total_purchase[0]->total_amount,0) : '0' }}
                            </h3>

                            <p> {{ __('Dashboard.TodayPurchaseAmount') }} </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-exchange" aria-hidden="true"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>
                            <p>{{ __('Dashboard.TodayPurchaseQnty') }}</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-balance-scale" aria-hidden="true"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $total_sale[0]->total_amount ? number_format($total_sale[0]->total_amount,0) : '0' }}
                            </h3>

                            <p>{{ __('Dashboard.TodaySaleAmount') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>{{ __('Dashboard.TodaySaleQnty') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Customer & Supplier Status Start -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>
                                <center>
                                    {{ __('Dashboard.CustomerStatus') }}
                                </center>
                            </strong>
                        </div>

                        <div class="card-body table-responsive">
                            <table class="table table-sm table-bordered table-striped">
                                <thead>
                                    <th>{{ __('Dashboard.CustomerStatus') }}</th>
                                    <th>{{ __('Dashboard.NumberOfCustomer') }}</th>
                                    <th>{{ __('Dashboard.ThisMonth') }}</th>
                                    <th>{{ __('Dashboard.LastMonth') }}</th>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>{{ __('Dashboard.OldCustomer') }}</td>
                                        <td>10</td>
                                        <td>10,02541</td>
                                        <td>100025</td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('Dashboard.NewCustomer') }}</td>
                                        <td>10</td>
                                        <td>10,02541</td>
                                        <td>100025</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>
                                <center>
                                    {{ __('Dashboard.SupplierStatus') }}
                                </center>
                            </strong>
                        </div>

                        <div class="card-body table-responsive">
                            <table class="table table-sm table-bordered table-striped">
                                <thead>
                                    <th>{{ __('Dashboard.SupplierStatus') }}</th>
                                    <th>{{ __('Dashboard.NumberOfSupplier') }}</th>
                                    <th>{{ __('Dashboard.ThisMonth') }}</th>
                                    <th>{{ __('Dashboard.LastMonth') }}</th>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>{{ __('Dashboard.OldSupplier') }}</td>
                                        <td>10</td>
                                        <td>10,02541</td>
                                        <td>100025</td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('Dashboard.NewSupplier') }}</td>
                                        <td>10</td>
                                        <td>10,02541</td>
                                        <td>100025</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Customer & Supplier Status End -->

            <!-- Customer & Supplier Status PIE Chart Start -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>
                                <center>
                                    {{ __('Dashboard.CustomerStatus') }}
                                </center>
                            </strong>
                        </div>

                        <div class="card-body table-responsive">
                            <div id="customer-status-pie"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>
                                <center>
                                    {{ __('Dashboard.SupplierStatus') }}
                                </center>
                            </strong>
                        </div>

                        <div class="card-body table-responsive">
                            <div id="supplier-status-pie"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Customer & Supplier Status PIE Chart End -->

            <!-- Current Stock Staus Start -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>
                                <center>
                                    {{ __('Dashboard.CurrentStockStatus') }}
                                </center>
                            </strong>
                        </div>

                        <div class="card-body table-responsive">
                            <div id="current-stock-status"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Current Stock Staus End -->

            <!-- This Month Sale Staus Start -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>
                                <center>
                                    {{ __('Dashboard.ThisMonthSaleStatus') }}
                                </center>
                            </strong>
                        </div>

                        <div class="card-body table-responsive">
                            <div id="this-month-sale-status"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- This Month Sale Staus End -->

        </div>
    </section>
</div>
@endsection

@section('per_page_js')
{{-- Apex Chart CDN --}}
<script src="{{ asset('backend/js/apax-chart.js') }}"></script>

<script>
    // Declear Stock List Variable
    var availbaleStockValue = [];
    var itemName = [];

    // Declear This Month Sales Variable
    var saleAmount = [];
    var saleDate = [];

    $(document).ready(function () {
        GetDashboardData();
    });

    function GetDashboardData() {
        $('.loading').show();
        $.ajax({
            url: "{{ route('dashboard.get_dashboard_data') }}",
            method: 'GET',
            success: function (data) {
                $('.loading').hide();
                if (data.stock_list) {
                    for (let i = 0; i < data.stock_list.length; i++) {
                        availbaleStockValue.push(data.stock_list[i].available_stock);
                        itemName.push(data.stock_list[i].item_name + '(' + data.stock_list[i].variant_name +
                            ' ' + data.stock_list[i].unit_name + ')');
                    }
                }

                if (data.this_month_sales) {
                    for (let i = 0; i < data.this_month_sales.length; i++) {
                        saleDate.push(data.this_month_sales[i].date);
                        saleAmount.push(data.this_month_sales[i].sale_amount);
                    }
                }

                StockList(availbaleStockValue, itemName);
                ThisMonthSales(saleAmount, saleDate);
            }
        });
    }


    function StockList(stockData, ItemName) {
        var options = {
            series: [{
                data: stockData
            }],
            chart: {
                height: 350,
                type: 'bar',
                events: {
                    click: function (chart, w, e) {}
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true,
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            xaxis: {
                categories: ItemName,
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#current-stock-status"),
            options);
        chart.render();
    }


    function ThisMonthSales(Amount, DateOfSale) {
        var options = {
            series: [{
                name: "Desktops",
                data: Amount
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Product Trends by Month',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: DateOfSale,
            }
        };

        var chart = new ApexCharts(document.querySelector("#this-month-sale-status"), options);
        chart.render();
    }

</script>


<!-- Customer Status PIE Chart -->
<script>
    var options = {
        series: [44, 55, 48, 30],
        chart: {
            width: 380,
            type: 'pie',
        },
        labels: ['Old Customer', 'New Customer', 'This Month', 'Last Month'],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#customer-status-pie"), options);
    chart.render();

</script>

<!-- Supplier Status PIE Chart -->
<script>
    var options = {
        series: [44, 55, 35, 48],
        chart: {
            width: 380,
            type: 'pie',
        },
        labels: ['Old Supplier', 'New Supplier', 'This Month', 'Last Month'],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#supplier-status-pie"), options);
    chart.render();

</script>


<!-- This Month Sale Status -->
<script>


</script>
@endsection
