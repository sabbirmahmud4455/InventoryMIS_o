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
                            <h3>150</h3>

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
                            <h3>44</h3>

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

<!-- Current Stock Status -->
<script>
    var options = {
          series: [{
          data: [21, 22, 10, 28, 16, 21, 13, 30, 16, 21, 13, 30]
        }],
          chart: {
          height: 350,
          type: 'bar',
          events: {
            click: function(chart, w, e) {
              // console.log(chart, w, e)
            }
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
          categories: [
            ['John', 'Doe'],
            ['Joe', 'Smith'],
            ['Jake', 'Williams'],
            'Amber',
            ['Peter', 'Brown'],
            ['Mary', 'Evans'],
            ['David', 'Wilson'],
            ['Lily', 'Roberts'],
            ['Peter', 'Brown'],
            ['Mary', 'Evans'],
            ['David', 'Wilson'],
            ['Lily', 'Roberts'],
          ],
          labels: {
            style: {
              fontSize: '12px'
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#current-stock-status"), options);
        chart.render();
</script>

<!-- This Month Sale Status -->
<script>
    var options = {
          series: [{
          name: 'Sales',
          data: [4, 3, 10, 9, 29, 19, 22, 9, 12, 7, 19, 5, 13, 9, 17, 2, 7, 5]
        }],
          chart: {
          height: 350,
          type: 'line',
        },
        forecastDataPoints: {
          count: 7
        },
        stroke: {
          width: 5,
          curve: 'smooth'
        },
        xaxis: {
          type: 'datetime',
          categories: ['1/11/2000', '2/11/2000', '3/11/2000', '4/11/2000', '5/11/2000', '6/11/2000', '7/11/2000', '8/11/2000', '9/11/2000', '10/11/2000', '11/11/2000', '12/11/2000', '1/11/2001', '2/11/2001', '3/11/2001','4/11/2001' ,'5/11/2001' ,'6/11/2001'],
          tickAmount: 10,
          labels: {
            formatter: function(value, timestamp, opts) {
              return opts.dateFormatter(new Date(timestamp), 'dd MMM')
            }
          }
        },
        title: {
          text: 'Forecast',
          align: 'left',
          style: {
            fontSize: "16px",
            color: '#666'
          }
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'dark',
            gradientToColors: [ '#FDD835'],
            shadeIntensity: 1,
            type: 'horizontal',
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100, 100, 100]
          },
        },
        yaxis: {
          min: -10,
          max: 40
        }
        };

        var chart = new ApexCharts(document.querySelector("#this-month-sale-status"), options);
        chart.render();
</script>
@endsection
