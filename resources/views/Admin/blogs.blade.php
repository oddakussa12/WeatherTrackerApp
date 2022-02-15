@include('/modals/addBlogModal')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
      <div class="row" style="padding-bottom:10px;">
              <div class="col-sm-4">
              <h4 class="card-title text-primary">Blogs</h4>
              </div>
              <div class="col-sm-4">
              </div>
              <div class="col-sm-4" style="text-align:right;">
              <button type="button" class="btn btn-inverse-primary btn-fw" id="addBlog">Add blog</button>
              </div>
        </div>
        <div class="table-responsive table-condensed">
          <table class="table table-hover" id="datatable">
            <thead>
              <tr>
                <th> Title En </th>
                <th> Title Am </th>
                <th> Body En</th>
                <th> Body Am</th>
                <th> Posted at</th>
                <th> Actions</th>
              </tr>
            </thead>
            <tbody>
    
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>


<!-- script for the ck editor -->

<script>
    //  text area on editBlog modal with id editoredit  
    ClassicEditor
        .create( document.querySelector( '#textam' ) )
        .catch( error => {
            // console.error( error );
        } );
</script>
<script>
    //  text area on editBlog modal with id editoredit  
    ClassicEditor
        .create( document.querySelector( '#texten' ) )
        .catch( error => {
            // console.error( error );
        } );
</script>

<!-- script for ajax loading unapproved questions -->
<script>
    $(document).ready( function () {
        $('#datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('api.blogs') }}",
            "columns": [
                { "data": "title" },
                { "data": "title_am" },
                { "data": "description" },
                { "data": "description_am" },
                { "data": "created_at" },
                {data: 'action', name: 'action', orderable: false, searchable: false},
                
            ]
        });
    });
</script>

<!-- script to create new blog -->
<script>
    $(document).ready(function(){
        $('#addBlog').click(function(){
          $('#createBlogModal').modal('show');
        });
        $('#createBlogForm').on('submit', function(event){
          event.preventDefault();
          if($('#createBlogBtn').val() == 'Post'){
              $.ajax({
                url:"{{ route('blog.store') }}",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend: function()
                {
                    $('#createBlogBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');                            
                },
                success:function(data){
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger alert-block" style="padding:2px;">';
                        for(var count = 0; count<data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#createBlogBtn').html('Post'); 
                        // render error or success message in html variable to span element with id value form_result
                        $('#create_blog_form_result').html(html);
                    }
                    if(data.success){
                        $('#createBlogModal').modal('hide');
                        setTimeout(function() { odda(); }, 500);
                        function odda(){
                            $.ajax({
                                url:'{{route('blogs')}}',
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