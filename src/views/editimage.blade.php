@extends('gallery::layout.app')
@section('content')
{{-- {{dd($image)}} --}}
<div class="row" style="overflow-x:hidden; margin:0; margin-top:3%;">
  <div class="col-md-4"></div>
  <div class="col-md-4">
    <div class="card" style="background-color: #45a3d6;">
      <div class="card-body" style="color:#fff;">
        <h4 class="card-title">Edit Image</h4>
        <form action="{{route('image.update', ['image'=>$image->id])}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="category">Category:</label>
            <select name="cat_id" class="form-control" id="cat_id">
              <option>Choose Category</option>
              @foreach ($cat as $cats)

              <option value="{{$cats->id}}">{{$cats->name}}</option>
              @endforeach


            </select>

          </div>
          <div class="form-group">
            <label for="image">Image:</label>
            <img src="{{\Storage::url($image->image)}}" alt="" width="150px" height="100px">
            <input type="file" class="form-control" id="image" name="image" style="padding: 3px; margin-top:5px;">
          </div>
          <div class="alert alert-danger">Note* 
            <ul>
              <li>The size of image should be less than 2MB.</li>
              <li>The ideal maximum dimensions of image are 344 x 258px.</li>
              <li>File type should be jpeg,jpg,png, and gif.</li>
            </ul>
          </div>
          <div>
            <button type="submit" class="btn"
              style="background: #FF8F8C; border: 1px solid #FF8F8C;color: #fff; float: right; font-weight:500;">Update</button>
          </div>
        </form>
      </div>
    </div>

  </div>
  <div class="col-md-4"></div>
</div>

<script>
  $(function(){
              var cat = {{$image->cat_id}};
              $('#cat_id').val(cat);
          })
</script>
@endsection