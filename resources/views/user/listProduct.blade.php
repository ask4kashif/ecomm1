@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <h6>Filter</h6>
                <hr>
                <h6>By Categories</h6>
                <hr>
                <form action="{{route('product.list',$category->slug)}}" method="get" id="form">
                @forelse ($subcategories as $subcategory)
                <div class="form-check">
                    <input type="checkbox" name="subcategory[]" id=""
                        value="{{ $subcategory->id }}"
                        @if (\Request::get('subcategory'))
                            {{in_array($subcategory->id,\Request::get('subcategory')) ? 'checked = "checked" ': '' }}
                        @endif
                         class="form-check-input" autocomplete="off" /> {{ $subcategory->name }}
                </div>
                @empty
                <h5>No category Found</h5>
                @endforelse
                <hr>
                <h6>By Price</h6>
                <input type="text" name="min" id="" class="form-control" placeholder="Min Price"
                autocomplete="off" value="{{old('min')}}">
                <br>
                <input type="text" name="max" id="" class="form-control" placeholder="Max Price"
                autocomplete="off" value="{{old('max')}}">
                <hr>
                <button type="submit" class="btn btn-outline-info">Filter</button>
                <a href="{{route('product.list',$category->slug)}}" class="btn btn-outline-info">Reset</a>
            </form>
            <form action="">

            </form>
            </div>
            <div class="col-md-10">
                @include('admin.layout.flash-message')
                <h6>Products</h6>
                <hr>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @forelse ($products as $product)
                        <div class="col-md-4">
                            <div class="card shadow-sm">
                                <img src="{{Storage::url($product->image)}}" alt="not available" height="100%" width="100%">
                                <div class="card-body">
                                    <p class="card-text text-justify">{{$product->name}}</p>
                                    <p class="card-text text-justify">Rating</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-outline-secondary"
                                                href="{{ route('frontProduct.show', $product->slug) }}">View</a>
                                                <form action="{{route('cart.store')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$product->id}}">
                                                    <input type="hidden" name="name" value="{{$product->name}}">
                                                    <input type="hidden" name="price" value="{{$product->price}}">
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary">Add to cart</button>
                                                </form>

                                        </div>
                                        <small class="text-muted">£{{ $product->price }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{ 'No product found' }}
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
