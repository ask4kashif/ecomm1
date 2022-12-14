@extends('admin.layout.app')


@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">DataTables</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active" aria-current="page">DataTables</li>
      </ol>
    </div>

    <!-- Row -->
    <div class="row">
      <!-- Datatables -->
      <div class="col-lg-12">
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
          </div>
          <div class="table-responsive p-3">
            <table class="table align-items-center table-flush" id="dataTable">
              <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>slug</th>
                    <th>image</th>
                    <th>price</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>slug</th>
                  <th>image</th>
                  <th>price</th>
                  <th>Category</th>
                  <th>Subcategory</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </tfoot>
              <tbody>
                  @forelse ($products as $product)
                <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->slug}}</td>
                        <td><img src="{{Storage::url($product->image)}}" alt="not available" height="50" width="50"></td>
                        {{-- <td><img src="{{$product->image}}" alt="not available" height="50" width="50"></td> --}}
                        <td>{{$product->price}}</td>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->subcategory->name}}</td>
                        <td><a class="btn btn-outline-info" href="{{route('product.edit',$product->slug)}}">Edit</a></td>
                        <td><form action="{{route('product.destroy',$product->slug)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure ?')">Delete</button>
                        </form></td>
                    @empty
                        {{('Empty NO record')}}
                    @endforelse
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
    </div>
  </div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>
@endpush
