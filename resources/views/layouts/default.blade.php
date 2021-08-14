<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{env('APP_NAME')}}</title>
    <meta name="description" content="Free Bootstrap 4 Admin Theme | Pike Admin">
    <meta name="author" content="Pike Web Development - https://www.pikephp.com">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Font Awesome CSS -->
    <link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Custom CSS -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />

    <!-- BEGIN CSS for this page -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
    <!-- END CSS for this page -->

    @yield('style')
</head>

<body class="adminbody">

<div id="main">

    <!-- top bar navigation -->
    @include('components.navigation')
    <!-- End Navigation -->


    <!-- Left Sidebar -->
    @include('components.sidebar')
    <!-- End Sidebar -->


    <div class="content-page">

        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- END container-fluid -->
        </div>
        <!-- END content -->

    </div>
    <!-- END content-page -->

    @include('components.footer')

</div>
<!-- END main -->

<script src="{{asset('assets/js/modernizr.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/moment.min.js')}}"></script>

<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

<script src="{{asset('assets/js/detect.js')}}"></script>
<script src="{{asset('assets/js/fastclick.js')}}"></script>
<script src="{{asset('assets/js/jquery.blockUI.js')}}"></script>
<script src="{{asset('assets/js/jquery.nicescroll.js')}}"></script>

<!-- App js -->
<script src="{{asset('assets/js/pikeadmin.js')}}"></script>

<!-- BEGIN Java Script for this page -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<!-- Counter-Up-->
<script src="{{asset('assets/plugins/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/plugins/counterup/jquery.counterup.min.js')}}"></script>

<script>
    $(document).ready(function() {
        // data-tables
        $('#example1').DataTable();

        // counter-up
        $('.counter').counterUp({
            delay: 10,
            time: 600
        });
    } );
</script>

<script>






    var ctx3 = document.getElementById("doughnutChart").getContext('2d');
    var doughnutChart = new Chart(ctx3, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                label: 'Dataset 1'
            }],
            labels: [
                "Red",
                "Orange",
                "Yellow",
                "Green",
                "Blue"
            ]
        },
        options: {
            responsive: true
        }

    });
</script>
<!-- END Java Script for this page -->
<!-- App js -->
<script src="{{asset('assets/js/pikeadmin.js')}}"></script>

<!-- BEGIN Java Script for this page -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>


    // comboBarLineChart
    var ctx2 = document.getElementById("comboBarLineChart").getContext('2d');
    var comboBarLineChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ["ปริญาเอก", "ปริญาโท", "ปริญาตรี", "ม.3 ม.6 ปวช ปวส"],
            datasets: [{
                // type: 'line',
                // label: 'Dataset 1',
                // borderColor: '#484c4f',
                // borderWidth: 3,
                // fill: false,
                // data: [12, 19, 3, 5, 2, 3, 13, 17, 11, 8, 11, 9],
            }, {
                type: 'bar',
                label: 'Dataset 2',
                backgroundColor: '#FF6B8A',
                data: [10, 11, 7, 5, 9, 13, 10, 16, 7, 8, 12, 5],
                borderColor: 'white',
                borderWidth: 0
            }, {
                type: 'bar',
                label: 'Dataset 3',
                backgroundColor: '#059BFF',
                data: [10, 11, 7, 5, 9, 13, 10, 16, 7, 8, 12, 5],
            }],
            borderWidth: 1
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });

    // pieChart
    var ctx3 = document.getElementById("pieChart").getContext('2d');
    var pieChart = new Chart(ctx3, {
        type: 'pie',
        data: {
            datasets: [{
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                label: 'Dataset 1'
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: 'right',
            }
        }

    });

    // doughnutChart
    var ctx4 = document.getElementById("doughnutChart").getContext('2d');
    var doughnutChart = new Chart(ctx4, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                label: 'Dataset 1'
            }],
            labels: [
                "Red",
                "Orange",
                "Yellow",
                "Green",
                "Blue"
            ]
        },
        options: {
            responsive: true
        }

    });

    // radarChart
    var ctx5 = document.getElementById("radarChart").getContext('2d');
    var doughnutChart = new Chart(ctx5, {
        type: 'radar',
        data: {
            labels: [["Eating", "Dinner"], ["Drinking", "Water"], "Sleeping", ["Designing", "Graphics"], "Coding", "Running"],
            datasets: [{
                label: "My First dataset",
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255,99,132,1)',
                pointBackgroundColor: 'red',
                data: [12, 19, 13, 11, 19, 17]
            }, {
                label: "My Second dataset",
                backgroundColor: 'rgba(250, 80, 112, 0.3)',
                borderColor: 'rgba(54, 162, 235, 1)',
                pointBackgroundColor: 'blue',
                data: [15, 12, 14, 15, 9, 11]
            },]
        },
        options: {
            responsive: true
        }

    });

    // polarAreaChart
    var ctx6 = document.getElementById("polarAreaChart").getContext('2d');
    var doughnutChart = new Chart(ctx6, {
        type: 'polarArea',
        data: {
            labels: ["Red","Green","Yellow","Grey","Blue"],
            datasets: [{
                label: "My First Dataset",
                data: [11,16,7,3,14],
                backgroundColor: ["rgb(255, 99, 132)","rgb(75, 192, 192)","rgb(255, 205, 86)","rgb(201, 203, 207)","rgb(54, 162, 235)"]
            }]
        }

    });
</script>

@yield('script')
<!-- END Java Script for this page -->
</body>
</html>
