@extends('admin.layout.app')
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"></h1>
      {{-- <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('category.index')}}">Category</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
      </ol> --}}
    </div>
    <div class="row">
      <div class="col-lg-12">
        <!-- Form Basic -->
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Create Product</h6>
          </div>
          <div class="card-body">
            <form method="POST" action="{{route("product.store")}}" enctype="multipart/form-data">
                @csrf
              <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" class="@error('name') is-invalid @enderror form-control" placeholder="Enter Name" value="{{old('name')}}"
                    @error('name')
                        <strong style="color: red">{{$message}}</strong>
                    @enderror
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea id="summernote" class="form-control @error('description') is-invalid @enderror" name="description" cols="30" rows="10" placeholder="Enter description">{{ old ('description') }}</textarea>
                @error('description')
                <strong style="color: red">{{$message}}</strong>
                @enderror
              </div>
              <div class="form-group">
                <label for="additional_info">Additional Information</label>
                <textarea id="summernote1" class="form-control @error('additional_info') is-invalid @enderror" name="additional_info" cols="30" rows="10" placeholder="Enter additional_info">{{ old ('additional_info') }}</textarea>
                @error('additional_info')
                <strong style="color: red">{{$message}}</strong>
                @enderror
              </div>
              <div class="form-group">
                <label for="price">Price (£)</label>
                <input id="price" type="text" name="price" class="@error('price') is-invalid @enderror form-control" placeholder="Enter Name" value="{{old('price')}}"
                    @error('price')
                        <strong style="color: red">{{$message}}</strong>
                    @enderror
              </div>
              <div class="form-group">
                <label for="Image">Choose Image</label>
                  <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input form-control @error('image') is-invalid @enderror ">
                      <label class="custom-file-label" for="image">Choose file</label>
                      @error('image')
                      <strong style="color: red">{{$message}}</strong>
                    @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="category_id">Choose Category</label>
                    <select class="form-select @error('category_id')
                        is-invalid
                    @enderror" id="single-select-field" data-placeholder="Choose one thing" name="category_id">
                        <option></option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                        @error('category_id')
                        <strong style="color: red">{{$message}}</strong>
                        @enderror
                    </select>
                </div>
                <div class="form-group">
                    <label for="subcategory_id">Choose sub category</label>
                    <select class="form-select" id="single-select-field" data-placeholder="Choose one thing" name="subcategory_id">
                        <option value="0">-- Select Sub Category --</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        </div>
      </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

$( '#single-select-field' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
} );
</script>
<script>
   $(document).ready(function() {
  $('#summernote').summernote();
});
  </script>
  <script>
    $(document).ready(function() {
   $('#summernote1').summernote();
 });
   </script>

   <script>
    $('document').ready(function(){
        $('select[name="category_id"]').change(function(){
            var id=$(this).val();

            if(id){
                $.ajax({
                url:'/admin/loadSubCategories/'+id,
                type:'get',
                dataType:'json',
                success:function (data) {
                    $('select[name="subcategory_id"]').empty();
                    $.each(data,function(key,value){
                        $('select[name="subcategory_id"]').append('<option value="'+ key +'">'+value+'</option>');
                    });

                }
             })
            }
        });
    });

   </script>
@endpush
