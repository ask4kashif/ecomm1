@extends('admin.layout.app')
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      {{-- <h1 class="h3 mb-0 text-gray-800"></h1> --}}
      {{-- <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('category.index')}}">Category</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
      </ol> --}}
    </div>
    <div class="row">
      <div class="col-lg-12">
        <!-- Form Basic -->
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
          </div>
          <div class="card-body">
            <form action="{{route('subcategory.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Enter Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name')
                        is-invalid
                    @enderror" placeholder="Enter Name" value="{{old('name')}}">
                    @error('name')
                        <strong style="color: red">{{$message}}</strong>
                    @enderror
                </div>
                <div class="form-group">
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
                <button type="submit" class="btn btn-primary" >Submit</button>
            </form>
        </div>
        </div>
      </div>
    </div>
</div>

@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$( '#single-select-field' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
} );
</script>
@endpush
