@extends('admin.layout.app')


@section('content')
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a class="mb-0 text-gray-800 btn btn-outline-light" href="{{route('category.create')}}">Create Category</a>

            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">All Category</li>
            </ol>
          </div>
          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                        <td>{{$category->name}}</td>
                        <td>{{$category->slug}}</td>
                        <td><img src="{{Storage::url($category->image)}}" alt="Not available" height="60px" width="50px"></td>
                        {{-- <td><img src="{{$category->image}}" alt="Not available" srcset="" height="50" width="50"></td> --}}
                        <td><a href="{{route('category.edit',$category->slug)}}" class="btn btn-outline-info">Edit</a></td>
                        <td>
                            <form action="{{route('category.destroy',$category->slug)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure ?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        {{('No record found')}}
                    @endforelse
                </tbody>
            </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->

          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>

        </div>
@endsection
