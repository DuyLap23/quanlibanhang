@extends('client.layouts.master')
@section('content')
    <!-- breadcrumb -->
    <div class="container mt-5">
        <div class="bread-crumb mt-1.5 flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Shoping Cart
            </span>
        </div>
    </div>
    {{-- @if (session()->has('error'))
            <div class="alert alert-error">
                {{ session()->get('error') }}
            </div>
        @endif --}}

    <!-- Shoping Cart -->
    <form class="bg0 p-t-75 p-b-85">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">

                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1">Product</th>
                                    <th class="column-2">Name</th>
                                    <th class="column-3">Price</th>
                                    <th class="column-4">Quantity</th>
                                    <th class="column-5">Total</th>
                                    <th class="column-5">Delete</th>

                                </tr>
                                @if (session()->has('cart'))
                                    @foreach (session('cart') as $value)
                                        @php
                                            $total =
                                                $value['quantities'] *
                                                ($value['price_sale'] ?: $value['price_regular']);
                                        @endphp

                                        <tr class="table_row">
                                            <td class="column-1">
                                                <div class="how-itemcart1">
                                                    @php
                                                        $url = $value['img_thumbnail'];

                                                        if (!\Str::contains($url, 'http')) {
                                                            $url = Storage::url($url);
                                                        }
                                                    @endphp
                                                    <img src="{{ $url }}" alt="IMG">
                                                </div>
                                            </td>
                                            <td class="column-2"> {{ \Str::limit($value['name'], 20) }}</td>
                                            <td class="column-3">
                                                ${{ $value['price_sale'] ? number_format($value['price_sale'], 2) : number_format($value['price_regular'], 2) }}
                                            </td>
                                            <td class="column-4">
                                                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                                    </div>

                                                    <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                        name="quantities" value="{{ $value['quantities'] }}">

                                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="column-5">${{ number_format($total, 2) }} </td>
                                            <td class="column-5">
                                                Xoá
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                            </table>
                        </div>

                        <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                            <div class="flex-w flex-m m-r-20 m-tb-5">
                                {{-- <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text"
                                    name="coupon" placeholder="Coupon Code"> --}}

                                <div
                                    class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                    Apply coupon
                                </div>
                            </div>  

                            <div
                                class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                Update Cart
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Cart Totals
                        </h4>

                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
                                <span class="stext-110 cl2">
                                    Subtotal:
                                </span>
                            </div>

                            <div class="size-209">
                                <span class="mtext-110 cl2">
                                    {{ number_format($totalAmount, 2) }}
                                </span>
                            </div>
                        </div>
                        <form action="{{ route('order.save') }}" method="POST">
                            @csrf
                            <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                                <div class="size-208 w-full-ssm">
                                    <span class="stext-110 cl2">
                                        Shipment Details:
                                    </span>
                                </div>

                                <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                    <div class="p-t-15">
                                        <span class="stext-112 cl8">
                                            Fill in address information
                                        </span>
                                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">

                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text"
                                                name="user_name" placeholder="FullName /  Nickname">
                                        </div>

                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="email"
                                                name="user_email" placeholder="Email ">
                                        </div>

                                        <div class="bor8 bg0 m-b-22">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="number"
                                                name="user_phone" placeholder="Phone">
                                        </div>

                                        <div class="bor8 bg0 m-b-22">

                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text"
                                                name="user_address" placeholder="Address">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-t p-t-27 p-b-33">
                                <div class="size-208">
                                    <span class="mtext-101 cl2">
                                        Total:
                                    </span>
                                </div>

                                <div class="size-209 p-t-1">
                                    <span class="mtext-110 cl2">
                                        {{ number_format($totalAmount, 2) }}
                                    </span>
                                </div>
                            </div>


                            <button type="submit"
                                class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                Proceed to Checkout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
