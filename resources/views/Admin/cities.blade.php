<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
          <div class="row" style="padding-bottom:10px;">
            <div class="col-sm-6">
                <h4 class="card-title">Cities</h4>
            </div>
            <div class="col-sm-6" style="text-align:right;">
                <button class="btn btn-outline-primary" id="addforumcategory">New city</button>
            </div>
          </div>
          @if(!$cities->isEmpty())
        <div class="table-responsive admincards" style="height:200px;overflow-y:auto;">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Lat</th>
                <th>Long</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach($cities as $city)
                    <tr>
                        <td>{{$city->city_id}}</td>
                        <td>{{$city->city_name}}</td>
                        <td>{{$city->lat}}</td>
                        <td>{{$city->long}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-outline-primary">
                                    <i class="mdi mdi-lead-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    
                
            </tbody>
          </table>
        </div>
        @else
        <div class="text-center">
            <p class="text-danger">No cities in the databasek.</p>
        </div>      
        @endif
      </div>
    </div>
  </div>
</div>