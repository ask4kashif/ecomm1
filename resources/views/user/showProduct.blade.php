@extends('layouts.app')
@section('title','Show Product')
@section('content')
    <div class="container">
        <div class="row my-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{Storage::url($product->image)}}" alt="" srcset="" height="500" width="500" class="img-thumbnail">
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{$product->category->name}}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <h6>£{{$product->price}}</h6>
                        <p class="font-weight-bold"><u>Description</u></p>
                        <p class="card-text">{!! $product->description !!}</p>
                        <p class="font-weight-bold"><u>Additional Information</u></p>
                        <p class="card-text">{!! $product->additional_info !!}</p>
                    </div>
                    <div class="card-footer">
                        <a href="" class="btn btn-outline-info">Add to card</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h5>You may also like</h5>
            @foreach($productFromSameCategories as $product)
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <img src="{{Storage::url($product->image)}}" alt="not available" height="100%" width="100%"></td>
                    <div class="card-body">
                        <p>Rating</p>
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
@endsection
