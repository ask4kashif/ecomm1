@extends('admin.layout.app')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"></h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('category.index')}}">Category</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
      </ol>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <!-- Form Basic -->
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Create Category</h6>
          </div>
          <div class="card-body">
            <form method="POST" action="{{route("category.store")}}" enctype="multipart/form-data">
                @csrf
              <div class="form-group">
                <label for="category">Name</label>
                <input id="name" type="text" name="name" class="@error('name') is-invalid @enderror form-control" placeholder="Enter Name" value="{{old('name')}}"
                    @error('name')
                        <strong style="color: red">{{$message}}</strong>
                    @enderror
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" cols="30" rows="10" placeholder="Enter description">{{ old ('description') }}</textarea>
                @error('description')
                <strong style="color: red">{{$message}}</strong>
                @enderror
              </div>
              <div class="form-group">
                  <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input form-control @error('image') is-invalid @enderror ">
                      <label class="custom-file-label" for="image">Choose file</label>
                      @error('image')
                      <strong style="color: red">{{$message}}</strong>
                    @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        </div>
      </div>
    </div>
</div>
@endsection
