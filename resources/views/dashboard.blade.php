@extends('layouts.master')
@section('title', "Dashboard")
@section('dashboard', "active")
@section('specific-css')
{{-- <link rel="stylesheet" href="{{ asset('asset/vendor/libs/apex-charts/apex-charts.css')}}" /> --}}
<style>
  .tab-pane ul,
  .handlers-container {
    max-height: 25vw;
  }

  .dashboard {
    cursor: pointer;
  }
</style>
@endsection
@section('main_content')

<div class="row">
  <!-- Total Revenue -->
  <div class="col-md-12">

    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="card dashboard">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <h5 class="mb-0">Patient</h5>
              <!-- <span class="badge bg-label-info rounded-pill">Year 2022</span> -->
            </div>
            <h3 class="card-title mb-2">{{$user}}</h3>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card dashboard">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <h5 class="mb-0">Appointment</h5>
              <!-- <span class="badge bg-label-info rounded-pill">Year 2022</span> -->
            </div>
            <h3 class="card-title mb-2">{{$appointments}}</h3>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card dashboard">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <h5 class="mb-0">Doctors</h5>
            </div>
            <h3 class="card-title mb-2">{{$doctors}}</h3>
          </div>
        </div>
      </div>

    </div>

    <!-- contents -->
    <div class="row">
      <!-- Monthly patient -->
      <div class="col-md-6 mb-4">
        <div class="card dashboard">
          <div class="card-header bg-primary">
            <h5 class="semi-bold text-white m-0">Monthly Patient</h5>
          </div>
          <div class="card-body">
            <div id="patientChart" style="min-height: 200px;"></div>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="card dashboard">
          <div class="card-header bg-primary">
            <h5 class="semi-bold text-white m-0">Services Created This Week</h5>
          </div>
          <div class="card-body">
            <canvas id="servicePieChart" style="min-height: 200px;"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div id="weeklyServiceCounts" style="display: none;">
      @foreach($weeklyServiceCounts as $serviceCount)
      <div data-week="{{ $serviceCount->year }}-W{{ $serviceCount->week }}" data-count="{{ $serviceCount->count }}" data-name="{{ $serviceCount->service_name }}"></div>
      @endforeach
    </div>
    @endsection

    @section('specific-js')
    <script src="{{ asset('custom/js/dashboard.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var weeklyServiceCountsDiv = document.getElementById('weeklyServiceCounts');
        var serviceDivs = weeklyServiceCountsDiv.getElementsByTagName('div');

        var weeklyServiceCounts = {};

        for (var i = 0; i < serviceDivs.length; i++) {
          var week = serviceDivs[i].getAttribute('data-week');
          var count = parseInt(serviceDivs[i].getAttribute('data-count'));
          var name = serviceDivs[i].getAttribute('data-name').toUpperCase();

          if (weeklyServiceCounts.hasOwnProperty(week)) {
            weeklyServiceCounts[week].count += count;
          } else {
            weeklyServiceCounts[week] = {
              count: count,
              name: name
            };
          }
        }

        var serviceLabels = Object.keys(weeklyServiceCounts).map(function(week) {
          return weeklyServiceCounts[week].name + ' - ' + week;
        });
        var serviceData = Object.values(weeklyServiceCounts);


        var backgroundColors = serviceLabels.map(function(label) {
          var serviceName = label.split(' - ')[0];
          switch (serviceName) {
            case 'CBC':
              return 'yellow';
            case 'CHOLESTEROL':
              return 'blue';
            case 'URICACID':
              return 'green';
            case 'URINALYSIS':
              return 'red';
            case 'ESR':
              return 'orange';
            case 'FBS':
              return 'brown';
            case 'PREGNANCYTEST':
              return 'pink';
            default:
              return 'orange';
          }
        });


        var servicesCtx = document.getElementById('servicePieChart').getContext('2d');
        var servicesChart = new Chart(servicesCtx, {
          type: 'pie',
          data: {
            labels: serviceLabels,
            datasets: [{
              label: 'Services Data',
              data: serviceData.map(function(service) {
                return service.count;
              }),
              backgroundColor: backgroundColors,
              borderColor: backgroundColors,
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      });
    </script>

    @endsection