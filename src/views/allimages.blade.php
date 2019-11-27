@extends('gallery::layout.app')
@section('content')
<style>
    .deletepopup{
        font-size: 12px;
    }
</style>
<link rel="stylesheet" href="{{URL::asset('css/lightbox.min.css')}}">
{{-- {{dd($data)}} --}}
<div class="row" style="overflow-x:hidden; margin:3% 0;">
    <div class="col-md-1"></div>
    <div class="col-md-11">
        <h3>{{$data->name}}</h3>
    </div>
</div>
@if (count($data->descimages))
<div class="row" style="overflow-x:hidden; margin:0;">
    @php
    $i=1;
    @endphp
    @foreach ($data->descimages as $item)
    @if ($i>4)
    @php
    $i=1;
    @endphp
</div>
<div class="row" style="overflow-x:hidden; margin:0; margin-top: 35px;">
    @endif
    <div class="col-md-3">
        <a class="example-image-link" href="{{\Storage::url($item->image)}}" data-lightbox="example-set"><img
                class="example-image img img-responsive"
                style="min-width: 250px; max-width: 250px; min-height: 250px; max-height: 250px; object-fit: cover;"
                src="{{\Storage::url($item->image)}}" alt="" /></a> <br>
        <a href="/image/{{$item->id}}/edit"><i class="fa fa-pencil" aria-hidden="true"></i></a> &nbsp; <a
            style="color:#007bff; cursor:pointer;" data-id="{{$item->id}}" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
    </div>
    @php
    $i++;
    @endphp
    @endforeach
</div>
@else
<div style="width:80%; margin:0 auto; text-align:center;">
    <p class="alert alert-danger">No images</p>
</div>
@endif
<script src="{{URL::asset('js/lightbox-plus-jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(function(){
        $('.delete').each(function(){
            $(this).click(function(){
                var id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Are you sure you want to delete this image?',
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
                        window.location.href = "/image/destroy/" + id;
                        Swal.fire(
                        {
                            title: "The image has been deleted!",
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