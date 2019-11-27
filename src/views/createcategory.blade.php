@extends('gallery::layout.app')
@section('content')
<link rel="stylesheet" href="{{URL::asset('css/bootstrap-datetimepicker.min.css')}}">
@php date_default_timezone_set('Asia/Kolkata'); @endphp
<input type="hidden" value="{{date("Y-m-d h:i A")}}" id="today">
<div class="row" style="overflow-x:hidden; margin:0; margin-top:3%;">
  <div class="col-md-4"></div>
  <div class="col-md-4">
    <div class="card" style="background-color: #45a3d6;">
      <div class="card-body" style="color:#fff;">
        <h4 class="card-title">@if(isset($category)) Edit Category @else Create Category @endif</h4>
        <form
          action="@if(isset($category)) {{route('category.update', ['category'=>$category->id])}} @else {{route('category.store')}} @endif"
          method="POST" enctype="multipart/form-data">
          @csrf
          @if(isset($category))
          @method('PUT')
          @endif
          <div class="form-group">
            <label for="name">Category Name:</label>
            <input type="text" class="form-control" id="cat_name" placeholder="Enter category Name" name="name"
              value="@if(isset($category)){{$category->name}} @endif">
          </div>
          <div class="form-group">
            <label for="image">Cover Image:</label>
            @if(isset($category)) <img src="{{\Storage::url($category->cover_image)}}" style="width:150px; height:100px; margin-bottom:5px;"> @endif
            <input type="file" class="form-control" id="cover_image" name="cover_image" style="padding: 3px;">
          </div>
          <div class="alert alert-danger">Note* 
            <ul>
              <li>The size of image should be less than 2MB.</li>
              <li>The ideal maximum dimensions of image are 344 x 258px.</li>
              <li>File type should be jpeg,jpg,png, and gif.</li>
            </ul>
          </div>
          @if (isset($category))
          <div class="form-group">
            <label for="newwv">Date:</label>
          <input type='text' class="form-control" id='date1' name="date" value="{{$category->date}}" />
        </div> 
          @else
          <div class="form-group">
            <label for="newwv">Date:</label>
            <input type='text' class="form-control" id='date' name="date" />
        </div> 
          @endif
          
          <div>
            <button type="submit" class="btn"
              style="background: #FF8F8C; border: 1px solid #FF8F8C;color: #fff; float: right; font-weight:500;">@if(isset($category)) Update @else Submit @endif</button>
          </div>
        </form>
      </div>
    </div>

  </div>
  <div class="col-md-4"></div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
<script src="{{URL::asset('js/datetimepicker.js')}}"></script>
<script type="text/javascript">
    $(function () {
        var todaydate = $('#today').val(); 
        $('#date').val(todaydate);
        $('#date').click(function(){ 
            $(this).datetimepicker().datetimepicker('show') ;
        });
        $('#date1').click(function(){ 
            $(this).datetimepicker().datetimepicker('show') ;
        });
                                         
                                      });
</script>
@endsection
