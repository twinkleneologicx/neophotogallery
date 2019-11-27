@extends('gallery::layout.app')
@section('content')
<style>
  .catpopup{
    font-size: 12px;
  }
</style>
<input type="hidden" id="catcount" value="{{count($cat)}}">
<div class="row" style="overflow-x:hidden; margin:0; margin-top:3%;">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <div class="card" style="background-color: #45a3d6;">
            <div class="card-body" style="color:#fff;">
              <h4 class="card-title">Add Image</h4>
              <form action="{{route('image.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="category">Category:</label>
                      <select name="cat_id" class="form-control">
                          <option value="0">Choose Category</option>
                          @foreach ($cat as $cats)
                      <option value="{{$cats->id}}">{{$cats->name}}</option>
                          @endforeach
                            
                           
                          </select>
                   
                    </div>
                    <div class="form-group">
                      <label for="image">Image:</label>
                      <input type="file" multiple class="form-control" id="image"  name="images[]" style="padding: 3px;">
                   
                    </div>
                    <div class="alert alert-danger">Note* 
                        <ul>
                          <li>Multiple images can be added.</li>
                          <li>The size of images should be less than 2MB.</li>
                          <li>The ideal maximum dimensions of images are 344 x 258px.</li>
                          <li>File type should be jpeg,jpg,png, and gif.</li>
                        </ul>
                      </div>
                    <div>
                            <button type="submit" class="btn"
                              style="background: #FF8F8C; border: 1px solid #FF8F8C;color: #fff; float: right; font-weight:500;">Submit</button>
                          </div>
                  </form>
            </div>
          </div>
      
        </div>
        <div class="col-md-4"></div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
  $(document).ready(function(){
    var catcount = parseInt($('#catcount').val()); 
    if(!catcount){
      Swal.fire({
                title: 'Atleast one category of images should be added before adding images.',
                type: "warning",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK",
                customClass: {
                    popup: 'catpopup'
                  }
            }).then((result) => {
                  if (result.value) {
                    window.location.replace("/category");
                  }
                })
           
    }
  });
</script>
@endsection
