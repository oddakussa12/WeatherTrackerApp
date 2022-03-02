@include('/modals/addCityModal')
@include('/modals/deleteModal')

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
          <div class="row" style="padding-bottom:10px;">
            <div class="col-sm-6">
                <h4 class="card-title">Cities</h4>
            </div>
            <div class="col-sm-6" style="text-align:right;">
                <button class="btn btn-outline-primary" id="addCity">New city</button>
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
                                <button type="button" id="deleteCity" class="btn btn-outline-danger">
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

<!-- script to add new city -->
<script>
    $(document).ready(function(){
        $('#addCity').click(function(){
          $('#createCityModal').modal('show');
        });
        $('#createTagForm').on('submit', function(event){
          event.preventDefault();
          if($('#createTagBtn').val() == 'Create'){
              $.ajax({
                url:"{{ route('city.store') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $('#createTagBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#createTagBtn').html('Create'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#create_tag_form_result').html(html);
                    }
                    if(data.success){
                        $('#createCityModal').modal('hide');
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('cities')}}',
                                cache: false,
                                type:'GET',
                                beforeSend: function()
                                {  
                                    $("#loading-overlay").show();
                                },
                                success:function(data){
                                    $("#odda").html(data);
                                    $("#loading-overlay").hide();
                                }
                            });
                        }
                    }
                },
              })
            }
        });
    });
</script>

<!-- script to delete a city -->
<script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function deleteCity(id,token){
            $.ajax({
                url:"{{route('city.delete')}}",
                method:'DELETE',
                data:{id:id,_token:token},
                beforeSend: function()
                {   
                    $('#deleteModal').modal('hide');
                },
                success:function(data){
                    setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('cities')}}',
                                cache: false,
                                type:'GET',
                                beforeSend: function()
                                {  
                                    $("#loading-overlay").show();
                                },
                                success:function(data){
                                    $("#odda").html(data);
                                    $("#loading-overlay").hide();
                                }
                        });
                    }
                }
            });
        }
        $('body').on('click','#deleteCity',function(e){
            e.preventDefault();
            $('#deleteModal').modal('show');

            var $tr =$(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            // console.log(data);
            $('#deleteitemid').val(data[0]);
            $('#deleteitemname').html('"'+data[1]+'"');
        });
        // when delete button is clicked from delete confirmation modal 
        $('#delete_form').on('submit',function(e){
            e.preventDefault();
            var id = $('#deleteitemid').val();
            deleteCity(id,token);
        });
    });
</script>