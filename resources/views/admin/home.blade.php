@extends('layouts.layout')

@section('content')
<section class="dashboard-counts section-padding">
    <div class="container-fluid">
      <div class="row">
        <!-- Count item widget-->
        <div class="col-xl-2 col-md-4 col-6">
          <div class="wrapper count-title d-flex">
            <div class="icon"><i class="icon-user"></i></div>
            <div class="name"><strong class="text-uppercase">Total Siswa</strong><span>Semua kelas</span>
              <div class="count-number">{{$total_student}}</div>
            </div>
          </div>
        </div>
        <!-- Count item widget-->
        <div class="col-xl-2 col-md-4 col-6">
            <div class="wrapper count-title d-flex">
              <div class="icon"><i class="icon-user"></i></div>
              <div class="name"><strong class="text-uppercase">Siswa Laki-laki</strong><span>Semua kelas</span>
                <div class="count-number">{{$total_boy}}</div>
              </div>
            </div>
          </div>
        <!-- Count item widget-->
        <div class="col-xl-2 col-md-4 col-6">
            <div class="wrapper count-title d-flex">
              <div class="icon"><i class="icon-user"></i></div>
              <div class="name"><strong class="text-uppercase">Siswa Perempuan</strong><span>Semua kelas</span>
                <div class="count-number">{{$total_girl}}</div>
              </div>
            </div>
          </div>
        <!-- Count item widget-->
        <div class="col-xl-2 col-md-4 col-6">
          <div class="wrapper count-title d-flex">
            <div class="icon"><i class="icon-list-1"></i></div>
            <div class="name"><strong class="text-uppercase">Tidak Diketahui</strong><span>Tidak Diketahui</span>
              <div class="count-number">0</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Header Section-->
  <section class="dashboard-header section-padding">
    <div class="container-fluid">
      <div class="row d-flex align-items-md-stretch">

        <!-- Line Chart -->
        <div class="col-lg-6 col-md-12 flex-lg-last flex-md-first align-self-baseline">
            <div class="card sales-report">
              <h2 class="display h4">Grafik Tinggi Badan Siswa</h2>
              <p>Laki-laki dan Perempuan</p>
              <div class="line-chart">
                <canvas id="lineCahrt"></canvas>
              </div>
            </div>
          </div>
        <!-- Pie Chart-->
        <div class="col-lg-3 col-md-6">
          <div class="card project-progress">
            <h2 class="display h4">Project Beta progress</h2>
            <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            <div class="pie-chart">
              <canvas id="pieChart" width="300" height="300"> </canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Statistics Section-->
  <section class="statistics">
    <div class="container-fluid">
      <div class="row d-flex">
        <div class="col-lg-4">
          <!-- Income-->
          <div class="card income text-center">
            <div class="icon"><i class="icon-line-chart"></i></div>
            <div class="number">126,418</div><strong class="text-primary">All Income</strong>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <!-- Monthly Usage-->
          <div class="card data-usage">
            <h2 class="display h4">Monthly Usage</h2>
            <div class="row d-flex align-items-center">
              <div class="col-sm-6">
                <div id="progress-circle" class="d-flex align-items-center justify-content-center"></div>
              </div>
              <div class="col-sm-6"><strong class="text-primary">80.56 Gb</strong><small>Current Plan</small><span>100 Gb Monthly</span></div>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <!-- User Actibity-->
          <div class="card user-activity">
            <h2 class="display h4">User Activity</h2>
            <div class="number">210</div>
            <h3 class="h4 display">Social Users</h3>
            <div class="progress">
              <div role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar bg-primary"></div>
            </div>
            <div class="page-statistics d-flex justify-content-between">
              <div class="page-statistics-left"><span>Pages Visits</span><strong>230</strong></div>
              <div class="page-statistics-right"><span>New Visits</span><strong>73.4%</strong></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
<script src="{{asset('template/vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('template/js/charts-home.js')}}"></script>
<script src="{{asset('template/js/home-premium.js')}}"> </script>
@endsection


