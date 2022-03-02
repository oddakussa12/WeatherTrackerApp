<style>
  .card-statistics:hover{
    background-color:#33b2ff;
    color:white;
  }
</style>
<div class="row">
  @if(!$cities->isEmpty())
  @foreach($cities as $city)
  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card" style="cursor:pointer;">
      <div class="card card-statistics">
        <div class="card-body">
          <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
            <div class="float-left">
              <i class="mdi mdi-square-inc-cash text-success icon-lg"></i>
            </div>
            <div class="float-right">
              <!-- <p class="mb-0 text-right">Total Earnings</p> -->
              <div class="fluid-container">
                <h3 class="font-weight-medium text-right mb-0">{{$city->city_name}}</h3>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">Weather: {{$city->weather}}</p>
              <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">Feels like: {{$city->feels_like}}</p>
            </div>
            <div class="col-sm-6">
              <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">Temp(C): {{$city->temprature}}</p>
              <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">Humidity: {{$city->humidity}}</p>

            </div>
          </div>
        </div>
      </div>
  </div>
  @endforeach
  @else
  <div class="col-sm-12 text-center">
      <h5 class="text-danger">No cities found in the database.</h5>
  </div>
  @endif
</div>
