@extends('gallery::layout.app')
@section('content')
<style>
    .deletepopup{
        font-size: 12px;
    }
</style>
{{-- {{dd($data)}} --}}
<div class="row" style="overflow-x:hidden; margin:0;">
  <div class="col-md-1"></div>
  <div class="col-md-11">
    <h2>Gallery</h2>
  </div>
</div>
<div class="row" style="overflow-x:hidden; margin:0; margin-top:3%;">
  <div class="col-md-1"></div>
  <div class="col-md-10">
    <div class="row" style="margin-bottom:20px;">
      <div class="col-md-1"></div>
      <div class="col-md-3">
        <a href="/category/create" class="btn btn-success">Add Image Category</a>
      </div>
      <div class="col-md-2">
        <a href="/image/create" class="btn btn-success">Add Image</a>
      </div>
      <div class="col-md-6"></div>
    </div>
    <table class="table table-striped">
      <thead style="text-align:center;">
        <tr>
          <th>S.no.</th>
          <th>Category</th>
          <th>Sub-heading</th>
          <th>Cover Image</th>
          <th>Date</th>
          <th>All Images</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody style="text-align:center;">
        @foreach ($data as $key=>$item)
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$item->name}}</td>
          <td>{{$item->subheading}}</td>
          <td> <img class="zoomhover" src="{{\Storage::url($item->cover_image)}}" alt="{{$item->name}}"
              style="min-width: 50px; max-width: 50px; min-height: 50px; max-height: 50px;"> </td>
          <td>{{date('F d, Y', strtotime($item->date))}}</td>
          <td><a href="/allimages/{{$item->id}}" class="btn btn-info">Images</a></td>
          <td> <a href="/category/{{$item->id}}/edit"><i class="fa fa-pencil" aria-hidden="true"></i></a> &nbsp; <a
               style="color:#007bff; cursor:pointer;" data-id="{{$item->id}}" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a> </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="col-md-1"></div>
</div>
<div style="float:right;">{{$data->links()}}</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(function(){
      $('table tbody tr').each(function(){
        $(this).find('.delete').click(function(){
          var id = $(this).attr('data-id');
          Swal.fire({
                    title: 'Are you sure you want to delete this category?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                    popup: 'deletepopup'
                  }
                    }).then((result) => {
                    if (result.value) {
                        window.location.href = "/category/destroy/" + id;
                        Swal.fire(
                        {
                            title: "The category has been deleted!",
                            type: "success",
                            confirmButtonColor: "#3085d6",
                            customClass: {
                                popup: 'deletepopup'
                              }
                        }
                    );
                    }
                    })
        });
      });
    });
</script>

@endsection