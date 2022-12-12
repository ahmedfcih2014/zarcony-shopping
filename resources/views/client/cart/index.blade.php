@extends('client.layout.base')

@section('content')
    <main>
        @include('client.layout.intro-section')
        <div class="album bg-light py-5">
            <div class="container">
                <div class="text-center mb-3 h5"> {{ __('words.cart') }} </div>
                <div class="text-center mt-5">
                    @foreach($cart->items ?? [] as $item)
                        <div class="d-flex justify-content-between mb-2">
                            <p>
                                ({{ $item->quantity }} X {{ $item->product->price }} USD) |

                                {{ $item->product->title }}
                            </p>
                            <form method="post" action="{{ route('client.cart.remove-item') }}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                <button class="btn btn-light">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
                <form class="d-flex flex-column mt-5"
                      method="POST"
                      action="{{ route('client.cart.checkout') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">{{ __('words.address-line') }}</label>
                        <input type="text" name="address_line"
                               value="{{ old("address_line") }}"
                               class="form-control @error('address_line') is-invalid @enderror"
                               placeholder="...">
                        @error('address_line')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('words.mobile') }}</label>
                        <input type="text" name="mobile"
                               value="{{ old("mobile") }}"
                               class="form-control @error('mobile') is-invalid @enderror"
                               placeholder="...">
                        @error('mobile')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('words.payment') }}</label>
                        <select class="form-select @error('payment_id') is-invalid @enderror"
                                name="payment_id">
                            <option> {{ __("words.select-payment") }} </option>
                            @foreach($paymentMethods as $payment)
                                <option {{ old('payment_id') == $payment->id ? "selected" : "" }}
                                        value="{{ $payment->id }}"> {{ $payment->name }} </option>
                            @endforeach
                        </select>
                        @error('payment_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-dark mb-3">
                        {{ __('words.paid', ['amount' => $cart?->items?->sum(function ($i) {return $i->quantity * $i->product->price;})]) }}
                    </button>
                </form>
            </div>
        </div>
    </main>
@endsection
