@extends('layouts.app')

@section('content')
<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{asset('admin/img/images/books3.jpg')}}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{asset('admin/img/images/books3.jpg')}}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{asset('admin/img/images/books3.jpg')}}" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
      </div>
    </div>
  </section>
  <div class="container">
    @foreach ($categories as $category)
        <a class="btn btn-secondary my-1" href="{{route('product.list',$category->slug)}}">{{$category->name}}</a>
    @endforeach
    <h3>Products</h3>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @forelse ($products as $product)
        <div class="col-md-4">
            <div class="card shadow-sm">
                <a href="{{route('frontProduct.show',$product->slug)}}"><img src="{{Storage::url($product->image)}}" alt="not available" height="100%" width="100%"></a>
            <div class="card-body">
            <p class="card-text text-justify" >Rating</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a class="btn btn-sm btn-outline-secondary" href="{{route('frontProduct.show',$product->slug)}}">View</a>
                <a class="btn btn-sm btn-outline-secondary">Add to cart</a>
              </div>
              <small class="text-muted">£{{$product->price}}</small>
            </div>
          </div>
        </div>
    </div>
    @empty
      {{ ('No product found') }}
    @endforelse
    </div>
    <br>
    <hr>
    <h4>You may also like</h4>
<div class="row">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <div class="row">
                @foreach ($watchProducts as $product)
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <img src="{{Storage::url($product->image)}}" alt="not available" height="100%" width="100%">
                        <div class="card-body">
                        <p class="card-text text-justify" >Rating</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <a class="btn btn-sm btn-outline-secondary" href="{{route('frontProduct.show',$product->slug)}}">View</a>
                            <a  class="btn btn-sm btn-outline-secondary">Add to cart</a>
                          </div>
                          <small class="text-muted">£{{$product->price}}</small>
                        </div>
                      </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="carousel-item ">
            <div class="row">
                @foreach ($watchProducts2 as $product)
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <img src="{{Storage::url($product->image)}}" alt="not available" height="50" width="50">
                        <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <a class="btn btn-sm btn-outline-secondary" href="{{route('frontProduct.show',$product->slug)}}">View</a>
                            <button  class="btn btn-sm btn-outline-secondary">Add to cart</button>
                          </div>
                          <small class="text-muted">£{{$product->price}}</small>
                        </div>
                      </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>

</div>

</>



@endsection
