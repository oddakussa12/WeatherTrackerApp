<div  class="modal fade" id="createCityModal"   tabindex="-1" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#006699;">
        <h5 class="modal-title" style="color:white;">Create new city</h5>
        <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <!-- below span hold form validation messages -->
      <span id="create_tag_form_result"></span>
      <form id="createTagForm" method="POST">
            @csrf
            <div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">City id</label>
                    <div class="col-sm-8">
                        <input type = "number" name="city_id" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="City id..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">City name</label>
                    <div class="col-sm-8">
                        <input type = "text" name="city_name" class="form-control" style="margin-top:5px;border-radius:5px;padding:5px;"placeholder="City name..."/>
                    </div>
                </div>
            </div>
            <div style="text-align:right;margin-top:10px;">
                <button type="button" style="width:80px;" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" id="createTagBtn" style="width:80px;" class="btn btn-primary btn-sm" value="Create">Create</button>
            </div>
        </form>
        
      </div>
    </div>
  </div>
</div>

