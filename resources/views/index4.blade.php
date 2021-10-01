@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">กราฟแสดงข้อมูลบุคลากรสายวิชาการตามคุณวุฒิ</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">กราฟแสดงข้อมูลบุคลากรสายวิชาการตามคุณวุฒิ</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-12">

            <div class="form-group">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('index4')}}">
                            <input type="hidden"
                                   name="search"
                                   value="1">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="number"
                                               min="2560"
                                               max="{{\Carbon\Carbon::now()->addYears(543)->format('Y')}}"
                                               value="{{request()->get('start_year')}}"
                                               placeholder="ปีเริ่มต้น"
                                               class="form-control"
                                               name="start_year">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="number"
                                               value="{{request()->get('end_year')}}"
                                               placeholder="ปีสิ้นสุด"
                                               class="form-control"
                                               min="2560"
                                               max="{{\Carbon\Carbon::now()->addYears(543)->format('Y')}}"
                                               name="end_year">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <button class="btn btn-primary">ค้นหา</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(request()->get('search'))
            <div class="col-xl-12">
                <div class="row">


                    {{--                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">--}}
                    {{--                    <div class="card mb-3">--}}
                    {{--                        <div class="card-header">--}}
                    {{--                            <h3><i class="fa fa-line-chart"></i> กราฟแสดงข้อมูลบุคลากรสายวิชาการตามคุณวุฒิ</h3>--}}
                    {{--                        </div>--}}

                    {{--                        <div class="card-body">--}}
                    {{--                            <canvas id="comboBarLineChart2"></canvas>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>--}}
                    {{--                    </div><!-- end card-->--}}
                    {{--                </div>--}}

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3><i class="fa fa-line-chart"></i> กราฟแสดงข้อมูลบุคลากรสายวิชาการตามคุณวุฒิ</h3>
                            </div>

                            <div class="card-body">
                                <canvas id="comboLineChart2"></canvas>
                            </div>
                            {{--                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>--}}
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        ปี/ตำแหน่ง
                                    </th>
                                    @foreach($years as $i=> $year)
                                        <th class="text-center">
                                            {{$year}}
                                        </th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>ศาสคร์ตราจารย์</td>
                                    @foreach($years as $i=> $year)
                                        <td class="text-center">
                                            {{$data[$year]['s_doctor'] }}
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>รศ.ดร</td>
                                    @foreach($years as $i=> $year)
                                        <td class="text-center">
                                            {{$data[$year]['rs_doctor'] }}
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>ผศ.ดร</td>
                                    @foreach($years as $i=> $year)
                                        <td class="text-center">
                                            {{$data[$year]['ps_doctor'] }}
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>ผศ</td>
                                    @foreach($years as $i=> $year)
                                        <td class="text-center">
                                            {{$data[$year]['ps_master'] }}
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>ดอร์คเตอร์</td>
                                    @foreach($years as $i=> $year)
                                        <td class="text-center">
                                            {{$data[$year]['doctor'] }}
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>ปริญญาโท</td>
                                    @foreach($years as $i=> $year)
                                        <td class="text-center">
                                            {{$data[$year]['master'] }}
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>
                                        รวม
                                    </th>
                                    @foreach($years as $i=> $year)
                                        <th class="text-center">
                                            {{ $data[$year]['s_doctor'] + $data[$year]['rs_doctor'] + $data[$year]['ps_doctor'] + $data[$year]['ps_master'] + $data[$year]['doctor'] + $data[$year]['master'] }}
                                        </th>
                                    @endforeach
                                </tr>
                                </tbody>
                            </table>
                        </div><!-- end card-->
                    </div>


                    {{--                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">--}}
                    {{--                    <div class="card mb-3">--}}
                    {{--                        <div class="card-header">--}}
                    {{--                            <h3><i class="fa fa-bar-chart-o"></i> Colour Analytics</h3>--}}
                    {{--                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus non luctus metus. Vivamus fermentum ultricies orci sit amet sollicitudin.--}}
                    {{--                        </div>--}}

                    {{--                        <div class="card-body">--}}
                    {{--                            <canvas id="pieChart"></canvas>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>--}}
                    {{--                    </div><!-- end card-->--}}
                    {{--                </div>--}}

                    {{--                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">--}}
                    {{--                    <div class="card mb-3">--}}
                    {{--                        <div class="card-header">--}}
                    {{--                            <h3><i class="fa fa-bar-chart-o"></i> Colour Analytics 2</h3>--}}
                    {{--                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus non luctus metus. Vivamus fermentum ultricies orci sit amet sollicitudin.--}}
                    {{--                        </div>--}}

                    {{--                        <div class="card-body">--}}
                    {{--                            <canvas id="doughnutChart"></canvas>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>--}}
                    {{--                    </div><!-- end card-->--}}
                    {{--                </div>--}}

                </div>
            </div>
        @endif
    </div>
    {{--    <div class="row">--}}
    {{--        <div class="col-xl-12">--}}
    {{--            <div class="breadcrumb-holder">--}}
    {{--                <h1 class="main-title float-left">Dashboard</h1>--}}
    {{--                <ol class="breadcrumb float-right">--}}
    {{--                    <li class="breadcrumb-item">Home</li>--}}
    {{--                    <li class="breadcrumb-item active">Dashboard</li>--}}
    {{--                </ol>--}}
    {{--                <div class="clearfix"></div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    <!-- end row -->--}}

    {{--    <div class="alert alert-danger" role="alert">--}}
    {{--        <h4 class="alert-heading">Info!</h4>--}}
    {{--        <p>Do you want custom development to integrate this theme in your project? Or add new features? Contact us on <a target="_blank" href="https://www.pikeadmin.com"><b>Pike Admin Website</b></a></p>--}}
    {{--        <p>Or try our PRO version: <b>Save over 50 hours of development with our Pro Framework: Registration / Login / Users Management, CMS, Front-End Template (who will load contend added in admin area and saved in MySQL database), Contact Messages Management, manage Website Settings and many more, at an incredible price!</b></p>--}}
    {{--        <p>Read more about all PRO features here: <a target="_blank" href="https://www.pikeadmin.com/pike-admin-pro"><b>Pike Admin PRO features</b></a></p>--}}
    {{--    </div>--}}

    {{--    <div class="row">--}}
    {{--        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">--}}
    {{--            <div class="card-box noradius noborder bg-default">--}}
    {{--                <i class="fa fa-file-text-o float-right text-white"></i>--}}
    {{--                <h6 class="text-white text-uppercase m-b-20">Orders</h6>--}}
    {{--                <h1 class="m-b-20 text-white counter">1,587</h1>--}}
    {{--                <span class="text-white">15 New Orders</span>--}}
    {{--            </div>--}}
    {{--        </div>--}}

    {{--        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">--}}
    {{--            <div class="card-box noradius noborder bg-warning">--}}
    {{--                <i class="fa fa-bar-chart float-right text-white"></i>--}}
    {{--                <h6 class="text-white text-uppercase m-b-20">Visitors</h6>--}}
    {{--                <h1 class="m-b-20 text-white counter">250</h1>--}}
    {{--                <span class="text-white">Bounce rate: 25%</span>--}}
    {{--            </div>--}}
    {{--        </div>--}}

    {{--        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">--}}
    {{--            <div class="card-box noradius noborder bg-info">--}}
    {{--                <i class="fa fa-user-o float-right text-white"></i>--}}
    {{--                <h6 class="text-white text-uppercase m-b-20">Users</h6>--}}
    {{--                <h1 class="m-b-20 text-white counter">120</h1>--}}
    {{--                <span class="text-white">25 New Users</span>--}}
    {{--            </div>--}}
    {{--        </div>--}}

    {{--        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">--}}
    {{--            <div class="card-box noradius noborder bg-danger">--}}
    {{--                <i class="fa fa-bell-o float-right text-white"></i>--}}
    {{--                <h6 class="text-white text-uppercase m-b-20">Alerts</h6>--}}
    {{--                <h1 class="m-b-20 text-white counter">58</h1>--}}
    {{--                <span class="text-white">5 New Alerts</span>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    <!-- end row -->--}}



    {{--    <div class="row">--}}

    {{--        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">--}}
    {{--            <div class="card mb-3">--}}
    {{--                <div class="card-header">--}}
    {{--                    <h3><i class="fa fa-line-chart"></i> Items Sold Amount</h3>--}}
    {{--                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus non luctus metus. Vivamus fermentum ultricies orci sit amet sollicitudin.--}}
    {{--                </div>--}}

    {{--                <div class="card-body">--}}
    {{--                    <canvas id="lineChart"></canvas>--}}
    {{--                </div>--}}
    {{--                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>--}}
    {{--            </div><!-- end card-->--}}
    {{--        </div>--}}

    {{--        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">--}}
    {{--            <div class="card mb-3">--}}
    {{--                <div class="card-header">--}}
    {{--                    <h3><i class="fa fa-bar-chart-o"></i> Colour Analytics</h3>--}}
    {{--                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus non luctus metus. Vivamus fermentum ultricies orci sit amet sollicitudin.--}}
    {{--                </div>--}}

    {{--                <div class="card-body">--}}
    {{--                    <canvas id="pieChart"></canvas>--}}
    {{--                </div>--}}
    {{--                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>--}}
    {{--            </div><!-- end card-->--}}
    {{--        </div>--}}

    {{--        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">--}}
    {{--            <div class="card mb-3">--}}
    {{--                <div class="card-header">--}}
    {{--                    <h3><i class="fa fa-bar-chart-o"></i> Colour Analytics 2</h3>--}}
    {{--                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus non luctus metus. Vivamus fermentum ultricies orci sit amet sollicitudin.--}}
    {{--                </div>--}}

    {{--                <div class="card-body">--}}
    {{--                    <canvas id="doughnutChart"></canvas>--}}
    {{--                </div>--}}
    {{--                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>--}}
    {{--            </div><!-- end card-->--}}
    {{--        </div>--}}

    {{--    </div>--}}
    {{--    <!-- end row -->--}}


    {{--    <div class="row">--}}

    {{--        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">--}}
    {{--            <div class="card mb-3">--}}
    {{--                <div class="card-header">--}}
    {{--                    <h3><i class="fa fa-users"></i> Staff details</h3>--}}
    {{--                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus non luctus metus. Vivamus fermentum ultricies orci sit amet sollicitudin.--}}
    {{--                </div>--}}

    {{--                <div class="card-body">--}}

    {{--                    <table id="example1" class="table table-bordered table-responsive-xl table-hover display">--}}
    {{--                        <thead>--}}
    {{--                        <tr>--}}
    {{--                            <th>Name</th>--}}
    {{--                            <th>Position</th>--}}
    {{--                            <th>Office</th>--}}
    {{--                            <th>Age</th>--}}
    {{--                            <th>Start date</th>--}}
    {{--                            <th>Salary</th>--}}
    {{--                        </tr>--}}
    {{--                        </thead>--}}
    {{--                        <tbody>--}}
    {{--                        <tr>--}}
    {{--                            <td>Tiger Nixon</td>--}}
    {{--                            <td>System Architect</td>--}}
    {{--                            <td>Edinburgh</td>--}}
    {{--                            <td>61</td>--}}
    {{--                            <td>2011/04/25</td>--}}
    {{--                            <td>$320,800</td>--}}
    {{--                        </tr>--}}
    {{--                        <tr>--}}
    {{--                            <td>Garrett Winters</td>--}}
    {{--                            <td>Accountant</td>--}}
    {{--                            <td>Tokyo</td>--}}
    {{--                            <td>63</td>--}}
    {{--                            <td>2011/07/25</td>--}}
    {{--                            <td>$170,750</td>--}}
    {{--                        </tr>--}}
    {{--                        <tr>--}}
    {{--                            <td>Ashton Cox</td>--}}
    {{--                            <td>Junior Technical Author</td>--}}
    {{--                            <td>San Francisco</td>--}}
    {{--                            <td>66</td>--}}
    {{--                            <td>2009/01/12</td>--}}
    {{--                            <td>$86,000</td>--}}
    {{--                        </tr>--}}
    {{--                        <tr>--}}
    {{--                            <td>Cedric Kelly</td>--}}
    {{--                            <td>Senior Javascript Developer</td>--}}
    {{--                            <td>Edinburgh</td>--}}
    {{--                            <td>22</td>--}}
    {{--                            <td>2012/03/29</td>--}}
    {{--                            <td>$433,060</td>--}}
    {{--                        </tr>--}}
    {{--                        <tr>--}}
    {{--                            <td>Airi Satou</td>--}}
    {{--                            <td>Accountant</td>--}}
    {{--                            <td>Tokyo</td>--}}
    {{--                            <td>33</td>--}}
    {{--                            <td>2008/11/28</td>--}}
    {{--                            <td>$162,700</td>--}}
    {{--                        </tr>--}}
    {{--                        <tr>--}}
    {{--                            <td>Brielle Williamson</td>--}}
    {{--                            <td>Integration Specialist</td>--}}
    {{--                            <td>New York</td>--}}
    {{--                            <td>61</td>--}}
    {{--                            <td>2012/12/02</td>--}}
    {{--                            <td>$372,000</td>--}}
    {{--                        </tr>--}}
    {{--                        <tr>--}}
    {{--                            <td>Herrod Chandler</td>--}}
    {{--                            <td>Sales Assistant</td>--}}
    {{--                            <td>San Francisco</td>--}}
    {{--                            <td>59</td>--}}
    {{--                            <td>2012/08/06</td>--}}
    {{--                            <td>$137,500</td>--}}
    {{--                        </tr>--}}
    {{--                        <tr>--}}
    {{--                            <td>Rhona Davidson</td>--}}
    {{--                            <td>Integration Specialist</td>--}}
    {{--                            <td>Tokyo</td>--}}
    {{--                            <td>55</td>--}}
    {{--                            <td>2010/10/14</td>--}}
    {{--                            <td>$327,900</td>--}}
    {{--                        </tr>--}}
    {{--                        <tr>--}}
    {{--                            <td>Colleen Hurst</td>--}}
    {{--                            <td>Javascript Developer</td>--}}
    {{--                            <td>San Francisco</td>--}}
    {{--                            <td>39</td>--}}
    {{--                            <td>2009/09/15</td>--}}
    {{--                            <td>$205,500</td>--}}
    {{--                        </tr>--}}
    {{--                        <tr>--}}
    {{--                            <td>Sonya Frost</td>--}}
    {{--                            <td>Software Engineer</td>--}}
    {{--                            <td>Edinburgh</td>--}}
    {{--                            <td>23</td>--}}
    {{--                            <td>2008/12/13</td>--}}
    {{--                            <td>$103,600</td>--}}
    {{--                        </tr>--}}
    {{--                        <tr>--}}
    {{--                            <td>Jena Gaines</td>--}}
    {{--                            <td>Office Manager</td>--}}
    {{--                            <td>London</td>--}}
    {{--                            <td>30</td>--}}
    {{--                            <td>2008/12/19</td>--}}
    {{--                            <td>$90,560</td>--}}
    {{--                        </tr>--}}
    {{--                        <tr>--}}
    {{--                            <td>Quinn Flynn</td>--}}
    {{--                            <td>Support Lead</td>--}}
    {{--                            <td>Edinburgh</td>--}}
    {{--                            <td>22</td>--}}
    {{--                            <td>2013/03/03</td>--}}
    {{--                            <td>$342,000</td>--}}
    {{--                        </tr>--}}
    {{--                        <tr>--}}
    {{--                            <td>Fiona Green</td>--}}
    {{--                            <td>Chief Operating Officer (COO)</td>--}}
    {{--                            <td>San Francisco</td>--}}
    {{--                            <td>48</td>--}}
    {{--                            <td>2010/03/11</td>--}}
    {{--                            <td>$850,000</td>--}}
    {{--                        </tr>--}}
    {{--                        <tr>--}}
    {{--                            <td>Shou Itou</td>--}}
    {{--                            <td>Regional Marketing</td>--}}
    {{--                            <td>Tokyo</td>--}}
    {{--                            <td>20</td>--}}
    {{--                            <td>2011/08/14</td>--}}
    {{--                            <td>$163,000</td>--}}
    {{--                        </tr>--}}
    {{--                        <tr>--}}
    {{--                            <td>Jonas Alexander</td>--}}
    {{--                            <td>Developer</td>--}}
    {{--                            <td>San Francisco</td>--}}
    {{--                            <td>30</td>--}}
    {{--                            <td>2010/07/14</td>--}}
    {{--                            <td>$86,500</td>--}}
    {{--                        </tr>--}}
    {{--                        <tr>--}}
    {{--                            <td>Shad Decker</td>--}}
    {{--                            <td>Regional Director</td>--}}
    {{--                            <td>Edinburgh</td>--}}
    {{--                            <td>51</td>--}}
    {{--                            <td>2008/11/13</td>--}}
    {{--                            <td>$183,000</td>--}}
    {{--                        </tr>--}}
    {{--                        <tr>--}}
    {{--                            <td>Michael Bruce</td>--}}
    {{--                            <td>Javascript Developer</td>--}}
    {{--                            <td>Singapore</td>--}}
    {{--                            <td>29</td>--}}
    {{--                            <td>2011/06/27</td>--}}
    {{--                            <td>$183,000</td>--}}
    {{--                        </tr>--}}
    {{--                        <tr>--}}
    {{--                            <td>Donna Snider</td>--}}
    {{--                            <td>Customer Support</td>--}}
    {{--                            <td>New York</td>--}}
    {{--                            <td>27</td>--}}
    {{--                            <td>2011/01/25</td>--}}
    {{--                            <td>$112,000</td>--}}
    {{--                        </tr>--}}
    {{--                        </tbody>--}}
    {{--                    </table>--}}

    {{--                </div>--}}
    {{--            </div><!-- end card-->--}}
    {{--        </div>--}}


    {{--        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-3">--}}
    {{--            <div class="card mb-3">--}}
    {{--                <div class="card-header">--}}
    {{--                    <h3><i class="fa fa-star-o"></i> Tasks progress</h3>--}}
    {{--                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.--}}
    {{--                </div>--}}

    {{--                <div class="card-body">--}}
    {{--                    <p class="font-600 m-b-5">Task 1 <span class="text-primary pull-right"><b>95%</b></span></p>--}}
    {{--                    <div class="progress">--}}
    {{--                        <div class="progress-bar progress-bar-striped progress-xs bg-primary" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="95"></div>--}}
    {{--                    </div>--}}

    {{--                    <div class="m-b-20"></div>--}}

    {{--                    <p class="font-600 m-b-5">Task 2 <span class="text-primary pull-right"><b>88%</b></span></p>--}}
    {{--                    <div class="progress">--}}
    {{--                        <div class="progress-bar progress-bar-striped progress-xs bg-primary" role="progressbar" style="width: 88%" aria-valuenow="88" aria-valuemin="0" aria-valuemax="88"></div>--}}
    {{--                    </div>--}}

    {{--                    <div class="m-b-20"></div>--}}

    {{--                    <p class="font-600 m-b-5">Task 3 <span class="text-info pull-right"><b>75%</b></span></p>--}}
    {{--                    <div class="progress">--}}
    {{--                        <div class="progress-bar progress-bar-striped progress-xs bg-info" role="progressbar" style="width: 78%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="75"></div>--}}
    {{--                    </div>--}}

    {{--                    <div class="m-b-20"></div>--}}

    {{--                    <p class="font-600 m-b-5">Task 4 <span class="text-info pull-right"><b>70%</b></span></p>--}}
    {{--                    <div class="progress">--}}
    {{--                        <div class="progress-bar progress-bar-striped progress-xs bg-info" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="70"></div>--}}
    {{--                    </div>--}}

    {{--                    <div class="m-b-20"></div>--}}

    {{--                    <p class="font-600 m-b-5">Task 5 <span class="text-warning pull-right"><b>68%</b></span></p>--}}
    {{--                    <div class="progress">--}}
    {{--                        <div class="progress-bar progress-bar-striped progress-xs bg-warning" role="progressbar" style="width: 68%" aria-valuenow="68" aria-valuemin="0" aria-valuemax="68"></div>--}}
    {{--                    </div>--}}

    {{--                    <div class="m-b-20"></div>--}}

    {{--                    <p class="font-600 m-b-5">Task 6 <span class="text-warning pull-right"><b>65%</b></span></p>--}}
    {{--                    <div class="progress">--}}
    {{--                        <div class="progress-bar progress-bar-striped progress-xs bg-warning" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="65"></div>--}}
    {{--                    </div>--}}

    {{--                    <div class="m-b-20"></div>--}}

    {{--                    <p class="font-600 m-b-5">Task 7 <span class="text-danger pull-right"><b>55%</b></span></p>--}}
    {{--                    <div class="progress">--}}
    {{--                        <div class="progress-bar progress-bar-striped progress-xs bg-danger" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="55"></div>--}}
    {{--                    </div>--}}

    {{--                    <div class="m-b-20"></div>--}}

    {{--                    <p class="font-600 m-b-5">Task 8 <span class="text-danger pull-right"><b>40%</b></span></p>--}}
    {{--                    <div class="progress">--}}
    {{--                        <div class="progress-bar progress-bar-striped progress-xs bg-danger" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="card-footer small text-muted">Updated today at 11:59 PM</div>--}}
    {{--            </div><!-- end card-->--}}
    {{--        </div>--}}


    {{--        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-3">--}}
    {{--            <div class="card mb-3">--}}
    {{--                <div class="card-header">--}}
    {{--                    <h3><i class="fa fa-envelope-o"></i> Latest messages</h3>--}}
    {{--                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.--}}
    {{--                </div>--}}

    {{--                <div class="card-body">--}}

    {{--                    <div class="widget-messages nicescroll" style="height: 400px;">--}}
    {{--                        <a href="#">--}}
    {{--                            <div class="message-item">--}}
    {{--                                <div class="message-user-img"><img src="assets/images/avatars/avatar2.png" class="avatar-circle" alt=""></div>--}}
    {{--                                <p class="message-item-user">John Doe</p>--}}
    {{--                                <p class="message-item-msg">Hello. I want to buy your product</p>--}}
    {{--                                <p class="message-item-date">11:50 PM</p>--}}
    {{--                            </div>--}}
    {{--                        </a>--}}
    {{--                        <a href="#">--}}
    {{--                            <div class="message-item">--}}
    {{--                                <div class="message-user-img"><img src="assets/images/avatars/avatar5.png" class="avatar-circle" alt=""></div>--}}
    {{--                                <p class="message-item-user">Ashton Cox</p>--}}
    {{--                                <p class="message-item-msg">Great job for this task</p>--}}
    {{--                                <p class="message-item-date">14:25 PM</p>--}}
    {{--                            </div>--}}
    {{--                        </a>--}}
    {{--                        <a href="#">--}}
    {{--                            <div class="message-item">--}}
    {{--                                <div class="message-user-img"><img src="assets/images/avatars/avatar6.png" class="avatar-circle" alt=""></div>--}}
    {{--                                <p class="message-item-user">Colleen Hurst</p>--}}
    {{--                                <p class="message-item-msg">I have a new project for you</p>--}}
    {{--                                <p class="message-item-date">13:20 PM</p>--}}
    {{--                            </div>--}}
    {{--                        </a>--}}
    {{--                        <a href="#">--}}
    {{--                            <div class="message-item">--}}
    {{--                                <div class="message-user-img"><img src="assets/images/avatars/avatar10.png" class="avatar-circle" alt=""></div>--}}
    {{--                                <p class="message-item-user">Fiona Green</p>--}}
    {{--                                <p class="message-item-msg">Nice to meet you</p>--}}
    {{--                                <p class="message-item-date">15:45 PM</p>--}}
    {{--                            </div>--}}
    {{--                        </a>--}}
    {{--                        <a href="#">--}}
    {{--                            <div class="message-item">--}}
    {{--                                <div class="message-user-img"><img src="assets/images/avatars/avatar2.png" class="avatar-circle" alt=""></div>--}}
    {{--                                <p class="message-item-user">Donna Snider</p>--}}
    {{--                                <p class="message-item-msg">I have a new project for you</p>--}}
    {{--                                <p class="message-item-date">15:45 AM</p>--}}
    {{--                            </div>--}}
    {{--                        </a>--}}
    {{--                        <a href="#">--}}
    {{--                            <div class="message-item">--}}
    {{--                                <div class="message-user-img"><img src="assets/images/avatars/avatar5.png" class="avatar-circle" alt=""></div>--}}
    {{--                                <p class="message-item-user">Garrett Winters</p>--}}
    {{--                                <p class="message-item-msg">I have a new project for you</p>--}}
    {{--                                <p class="message-item-date">15:45 AM</p>--}}
    {{--                            </div>--}}
    {{--                        </a>--}}
    {{--                        <a href="#">--}}
    {{--                            <div class="message-item">--}}
    {{--                                <div class="message-user-img"><img src="assets/images/avatars/avatar6.png" class="avatar-circle" alt=""></div>--}}
    {{--                                <p class="message-item-user">Herrod Chandler</p>--}}
    {{--                                <p class="message-item-msg">Hello! I'm available for this job</p>--}}
    {{--                                <p class="message-item-date">15:45 AM</p>--}}
    {{--                            </div>--}}
    {{--                        </a>--}}
    {{--                        <a href="#">--}}
    {{--                            <div class="message-item">--}}
    {{--                                <div class="message-user-img"><img src="assets/images/avatars/avatar10.png" class="avatar-circle" alt=""></div>--}}
    {{--                                <p class="message-item-user">Jena Gaines</p>--}}
    {{--                                <p class="message-item-msg">I have a new project for you</p>--}}
    {{--                                <p class="message-item-date">15:45 AM</p>--}}
    {{--                            </div>--}}
    {{--                        </a>--}}
    {{--                        <a href="#">--}}
    {{--                            <div class="message-item">--}}
    {{--                                <div class="message-user-img"><img src="assets/images/avatars/avatar2.png" class="avatar-circle" alt=""></div>--}}
    {{--                                <p class="message-item-user">Airi Satou</p>--}}
    {{--                                <p class="message-item-msg">I have a new project for you</p>--}}
    {{--                                <p class="message-item-date">15:45 AM</p>--}}
    {{--                            </div>--}}
    {{--                        </a>--}}
    {{--                        <a href="#">--}}
    {{--                            <div class="message-item">--}}
    {{--                                <div class="message-user-img"><img src="assets/images/avatars/avatar10.png" class="avatar-circle" alt=""></div>--}}
    {{--                                <p class="message-item-user">Brielle Williamson</p>--}}
    {{--                                <p class="message-item-msg">I have a new project for you</p>--}}
    {{--                                <p class="message-item-date">15:45 AM</p>--}}
    {{--                            </div>--}}
    {{--                        </a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="card-footer small text-muted">Updated today at 11:59 PM</div>--}}
    {{--            </div><!-- end card-->--}}
    {{--        </div>--}}
    {{--    </div>--}}

@endsection


@section('script')
    <script>
        // var ctx1 = document.getElementById("comboBarLineChart2").getContext('2d');
        // var comboBarLineChart1 = new Chart(ctx1, {
        //     type: 'bar',
        //     data: {
        //         labels: ["2560", "2561", "2562", "2563", "2564"],
        //         datasets: [
        //             // {
        //             // type: 'line',
        //             // label: 'Dataset 1',
        //             // borderColor: '#484c4f',
        //             // borderWidth: 3,
        //             // fill: false,
        //             // data: [12, 19, 3, 5, 2, 3, 13, 17, 11, 8, 11, 9],
        //             // },
        //             {
        //                 type: 'bar',
        //                 label: 'ป.เอก',
        //                 backgroundColor: '#FF6B8A',
        //                 data: [10, 11, 7, 5, 3],
        //                 borderColor: 'white',
        //                 borderWidth: 0
        //             }, {
        //                 type: 'bar',
        //                 label: 'ป.โท',
        //                 backgroundColor: '#059BFF',
        //                 data: [10, 11, 7, 5, 1],
        //             }, {
        //                 type: 'bar',
        //                 label: 'ผศ.ดร.',
        //                 backgroundColor: '#484c4f',
        //                 data: [10, 11, 7, 5, 4],
        //             }, {
        //                 type: 'bar',
        //                 label: 'รศ.ดร.',
        //                 backgroundColor: '#EBEFF3',
        //                 data: [10, 11, 7, 5, 9],
        //             }
        //         ],
        //         borderWidth: 1
        //     },
        //     options: {
        //         scales: {
        //             yAxes: [{
        //                 ticks: {
        //                     beginAtZero: true
        //                 }
        //             }]
        //         }
        //     }
        // });

        var years = [parseInt("{{$years[0]-1}}")];
        var doctor = [null];
        var master = [null];
        var ps_doctor = [null];
        var ps_master = [null];
        var rs_doctor = [null];
        var s_doctor = [null];

        @foreach($years as $i => $year)
        years.push("{{$year}}")
        @if($data[$year]['s_doctor'])
        s_doctor.push(parseInt("{{$data[$year]['s_doctor']}}"))
        @else
        s_doctor.push(0)
        @endif

        @if($data[$year]['rs_doctor'])
        rs_doctor.push(parseInt("{{$data[$year]['rs_doctor']}}"))
        @else
        rs_doctor.push(0)
        @endif

        @if($data[$year]['ps_doctor'])
        ps_doctor.push(parseInt("{{$data[$year]['ps_doctor']}}"))
        @else
        ps_doctor.push(0)
        @endif

        @if($data[$year]['ps_master'])
        ps_master.push(parseInt("{{$data[$year]['ps_master']}}"))
        @else
        ps_master.push(0)
        @endif

        @if($data[$year]['doctor'])
        doctor.push(parseInt("{{$data[$year]['doctor']}}"))
        @else
        doctor.push(0)
        @endif

        @if($data[$year]['master'])
        master.push(parseInt("{{$data[$year]['master']}}"))
        @else
        master.push(0)
        @endif
        @endforeach

        var y = parseInt(years[years.length - 1]) + 1;

        years.push(y)
        doctor.push(null);
        master.push(null);
        ps_doctor.push(null);
        ps_master.push(null);
        rs_doctor.push(null);
        s_doctor.push(null);

        var ctx2 = document.getElementById("comboLineChart2").getContext('2d');
        var comboBarLineChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: years,
                datasets: [

                    {
                        type: 'line',
                        label: 'ศาสตราจารย์',
                        borderColor: '#FF00FF',
                        borderWidth: 3,
                        fill: false,
                        data: s_doctor,
                    },
                    {
                        type: 'line',
                        label: 'รองศาสตราจารย์ ดร.',
                        borderColor: '#00FF00',
                        borderWidth: 3,
                        fill: false,
                        data: rs_doctor,
                    },
                    {
                        type: 'line',
                        label: 'ผู้ช่วยศาสตราจารย์ ดร.',
                        borderColor: '#484c4f',
                        borderWidth: 3,
                        fill: false,
                        data: ps_doctor,
                    },

                    {
                        type: 'line',
                        label: 'ผู้ช่วยศาสตราจารย์',
                        borderColor: '#FF0000',
                        borderWidth: 3,
                        fill: false,
                        data: ps_master,
                    },
                    {
                        type: 'line',
                        label: 'ปริญญาเอก',
                        borderColor: '#059BFF',
                        borderWidth: 3,
                        fill: false,
                        data: doctor,
                    },
                    {
                        type: 'line',
                        label: 'ปริญญาโท',
                        borderColor: '#0000FF',
                        borderWidth: 3,
                        fill: false,
                        data: master,
                    },
                    // {
                    //     type: 'bar',
                    //     label: '',
                    //     borderColor: '#FFFFFF',
                    //     borderWidth: 1,
                    //     fill: false,
                    //     data: ps_master,
                    // },
                ],
                borderWidth: 1
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // // comboBarLineChart
        // var ctx2 = document.getElementById("comboBarLineChart").getContext('2d');
        // var comboBarLineChart = new Chart(ctx2, {
        //     type: 'bar',
        //     data: {
        //         labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        //         datasets: [{
        //             type: 'line',
        //             label: 'Dataset 1',
        //             borderColor: '#484c4f',
        //             borderWidth: 3,
        //             fill: false,
        //             data: [12, 19, 3, 5, 2, 3, 13, 17, 11, 8, 11, 9],
        //         }, {
        //             type: 'bar',
        //             label: 'Dataset 2',
        //             backgroundColor: '#FF6B8A',
        //             data: [10, 11, 7, 5, 9, 13, 10, 16, 7, 8, 12, 5],
        //             borderColor: 'white',
        //             borderWidth: 0
        //         }, {
        //             type: 'bar',
        //             label: 'Dataset 3',
        //             backgroundColor: '#059BFF',
        //             data: [10, 11, 7, 5, 9, 13, 10, 16, 7, 8, 12, 5],
        //         }],
        //         borderWidth: 1
        //     },
        //     options: {
        //         scales: {
        //             yAxes: [{
        //                 ticks: {
        //                     beginAtZero:true
        //                 }
        //             }]
        //         }
        //     }
        // });

    </script>
@endsection
