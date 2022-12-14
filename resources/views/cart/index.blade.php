@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('admin.layout.flash-message')
                @if (Cart::count() > 0)
                    <h6>{{ Cart::count() }} item(s) in the cart</h6>
                    <table class="table ">
                        <tbody>
                            {{-- {{dd(Cart::content())}} --}}
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>Name</td>
                                    <td>Price</td>
                                    <td>Qty</td>
                                    <td class="text-end">Action</td>
                                    <td></td>

                                </tr>
                            </thead>
                            @foreach (Cart::content() as $item)
                                <tr>
                                    <td><a href={{ route('frontProduct.show', $item->model->slug) }}><img
                                                src="{{ Storage::url($item->model->image) }}" alt="Not available"
                                                height="80" width="80"></a></td>
                                    <td>{{ $item->name }}</td>
                                    <td><select name="quantity" id="quantity" class="quantity" data-id="{{$item->rowId}}">
                                            @for ($i=1;$i<=5;$i++)
                                                <option {{$item->qty==$i?'selected':''}}>{{$i}}</option>
                                            @endfor
                                        </select></td>
                                    <td>£ {{ ($item->subtotal()) }}</td>
                                    <td>
                                        <form action="{{ route('cart.destroy', $item->rowId) }}" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="Submit" class="btn btn-outline-secondary"
                                                onclick="return confirm('Are you sure?')">Remove</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.switchToSaveForLater', $item->rowId) }}" method="post">
                                            @csrf

                                            <button type="Submit" class="btn btn-outline-secondary"
                                                onclick="return confirm('Are you sure?')">Save for Later</button>
                                        </form>
                                    </td>
                                </tr>
                        </tbody>
                @endforeach
                </table>
            @else
                <h6>{{ 'No items in the cart' }}</h6>
                <a href="{{ route('welcome') }}" class="btn btn-outline-secondary">Continue Shopping</a>
                @endif
                <div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-md-9">
                @if (Cart::count() > 0)
                    <p class="text-center">Subtotal : £ {{ Cart::subtotal() }}</p>
                    <p class="text-center">Tax : £ {{ Cart::tax() }}</p>
                    <p class="text-center">Total : £ {{ Cart::total() }}</p>
                    <a href="{{ route('checkout') }}" class="btn btn-outline-secondary float-start">Proceed to Check
                        out</a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if (Cart::instance('saveForLater')->count() > 0)
                    <h6>{{ Cart::instance('saveForLater')->count() }} item(s) in your save list</h6>
                    <table class="table ">
                        <tbody>
                            {{-- {{dd(Cart::content())}} --}}
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>Name</td>
                                    <td>Price</td>
                                    <td>Qty</td>
                                    <td class="text-end">Action</td>
                                    <td></td>

                                </tr>
                            </thead>
                            @foreach (Cart::instance('saveForLater')->content() as $item)
                                <tr>
                                    <td><a href={{ route('frontProduct.show', $item->model->slug) }}><img
                                                src="{{ Storage::url($item->model->image) }}" alt="Not available"
                                                height="80" width="80"></a></td>
                                    <td>{{ $item->name }}</td>
                                    <td>£ {{ $item->price }}</td>
                                    <td>1</td>
                                    <td>
                                        <form action="{{ route('cart.moveToCartDelete', $item->rowId) }}" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="Submit" class="btn btn-outline-secondary"
                                                onclick="return confirm('Are you sure?')">Remove</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.moveToCart', $item->rowId) }}" method="post">
                                            @csrf

                                            <button type="Submit" class="btn btn-outline-secondary"
                                                onclick="return confirm('Are you sure?')">Move to cart</button>
                                        </form>
                                    </td>
                                </tr>
                        </tbody>
                @endforeach
                </table>
            @else
                <h6>{{ 'No items in your save list' }}</h6>
                @endif
                <div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        (function() {
            const classname = document.querySelectorAll('.quantity');

            Array.from(classname).forEach(function(element) {
                element.addEventListener('change', function() {
                    const id= element.getAttribute('data-id');
                    axios.patch(`/cart/${id}`, {
                            quantity:this.value
                        })
                        .then(function(response) {
                            console.log(response);
                            window.location.href='{{route('cart.index')}}'
                        })
                        .catch(function(error) {
                            console.log(error);
                            window.location.href='{{route('cart.index')}}'
                        });
                });
            });
        })();
    </script>
@endpush
