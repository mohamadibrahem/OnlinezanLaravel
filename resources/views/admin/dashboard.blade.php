@extends('admin.layouts.main')
@section('content')
  @section('title') {{"Dashboard"}} @endsection

  <div class="row wow fadeIn">

    <!--Grid column-->
    <div class="col-md-9 mb-4">

      <!--Card-->
      <div class="card">

        <!--Card content-->
        <div class="card-body">

          <canvas id="myChart"></canvas>

        </div>

      </div>
      <!--/.Card-->

    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-md-3 mb-4">

      <!--Card-->
      <div class="card mb-4">

        <!-- Card header -->
        <div class="card-header text-center">
          Pie chart
        </div>

        <!--Card content-->
        <div class="card-body">

          <canvas id="pieChart"></canvas>

        </div>

      </div>
      <!--/.Card-->

      <!--Card-->
      <div class="card mb-4">

        <!--Card content-->
        <div class="card-body">

          <!-- List group links -->
          <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action waves-effect">Sales
              <span class="badge badge-success badge-pill pull-right">22%
                <i class="fas fa-arrow-up ml-1"></i>
              </span>
            </a>
            <a class="list-group-item list-group-item-action waves-effect">Traffic
              <span class="badge badge-danger badge-pill pull-right">5%
                <i class="fas fa-arrow-down ml-1"></i>
              </span>
            </a>
            <a class="list-group-item list-group-item-action waves-effect">Orders
              <span class="badge badge-primary badge-pill pull-right">14</span>
            </a>
            <a class="list-group-item list-group-item-action waves-effect">Issues
              <span class="badge badge-primary badge-pill pull-right">123</span>
            </a>
            <a class="list-group-item list-group-item-action waves-effect">Messages
              <span class="badge badge-primary badge-pill pull-right">8</span>
            </a>
          </div>
          <!-- List group links -->

        </div>

      </div>
      <!--/.Card-->

    </div>
    <!--Grid column-->

  </div>
  <!--Grid row-->

  <!--Grid row-->
  <div class="row wow fadeIn">

    <!--Grid column-->
    <div class="col-md-6 mb-4">

      <!--Card-->
      <div class="card">

        <!--Card content-->
        <div class="card-body">

          <!-- Table  -->
          <table class="table table-hover">
            <!-- Table head -->
            <thead class="blue-grey lighten-4">
              <tr>
                <th>#</th>
                <th>Lorem</th>
                <th>Ipsum</th>
                <th>Dolor</th>
              </tr>
            </thead>
            <!-- Table head -->

            <!-- Table body -->
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Cell 1</td>
                <td>Cell 2</td>
                <td>Cell 3</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Cell 4</td>
                <td>Cell 5</td>
                <td>Cell 6</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Cell 7</td>
                <td>Cell 8</td>
                <td>Cell 9</td>
              </tr>
            </tbody>
            <!-- Table body -->
          </table>
          <!-- Table  -->

        </div>

      </div>
      <!--/.Card-->

    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-md-6 mb-4">

      <!--Card-->
      <div class="card">

        <!--Card content-->
        <div class="card-body">

          <!-- Table  -->
          <table class="table table-hover">
            <!-- Table head -->
            <thead class="blue lighten-4">
              <tr>
                <th>#</th>
                <th>Lorem</th>
                <th>Ipsum</th>
                <th>Dolor</th>
              </tr>
            </thead>
            <!-- Table head -->

            <!-- Table body -->
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Cell 1</td>
                <td>Cell 2</td>
                <td>Cell 3</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Cell 4</td>
                <td>Cell 5</td>
                <td>Cell 6</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Cell 7</td>
                <td>Cell 8</td>
                <td>Cell 9</td>
              </tr>
            </tbody>
            <!-- Table body -->
          </table>
          <!-- Table  -->

        </div>

      </div>
      <!--/.Card-->

    </div>
    <!--Grid column-->

  </div>
  <!--Grid row-->

  <!--Grid row-->
  <div class="row wow fadeIn">

    <!--Grid column-->
    <div class="col-lg-6 col-md-6 mb-4">

      <!--Card-->
      <div class="card">

        <!-- Card header -->
        <div class="card-header">Line chart</div>

        <!--Card content-->
        <div class="card-body">

          <canvas id="lineChart"></canvas>

        </div>

      </div>
      <!--/.Card-->

    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-lg-6 col-md-6 mb-4">

      <!--Card-->
      <div class="card">

        <!-- Card header -->
        <div class="card-header">Radar Chart</div>

        <!--Card content-->
        <div class="card-body">

          <canvas id="radarChart"></canvas>

        </div>

      </div>
      <!--/.Card-->

    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-lg-6 col-md-6 mb-4">

      <!--Card-->
      <div class="card">

        <!-- Card header -->
        <div class="card-header">Doughnut Chart</div>

        <!--Card content-->
        <div class="card-body">

          <canvas id="doughnutChart"></canvas>

        </div>

      </div>
      <!--/.Card-->

    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-lg-6 col-md-6 mb-4">

      <!--Card-->
      <div class="card">

        <!-- Card header -->
        <div class="card-header">Horizontal Bar Chart</div>

        <!--Card content-->
        <div class="card-body">

          <canvas id="horizontalBar"></canvas>

        </div>

      </div>
      <!--/.Card-->

    </div>
    <!--Grid column-->
  </div>
  <!--Grid row-->

  <!--Grid row-->
  <div class="row wow fadeIn">

    <!--Grid column-->
    <div class="col-md-6 mb-4">

      <!--Card-->
      <div class="card">

        <!-- Card header -->
        <div class="card-header">Google map</div>

        <!--Card content-->
        <div class="card-body">
          <!--Google map-->
          <div id="map-container-google-2" class="z-depth-1-half map-container" style="height: 500px">
            <iframe src="https://maps.google.com/maps?q=chicago&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
            style="border:0" allowfullscreen></iframe>
          </div>

          <!--Google Maps-->

        </div>

      </div>
      <!--/.Card-->

    </div>



</div>
<!--Main layout-->
@endsection
