@extends('layouts.customer')
@section('content')



<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>

        @if ($carts != null)
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($carts->cartdetails as $cartdetail)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img width="50" height="50"
                                    src="{{ $cartdetail->produk->img_url != null ? Storage::url($cartdetail->produk->img_url) : 'http://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png' }}"
                                    alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $cartdetail->produk->nama }}</a></h4>
                            <p>{{ $cartdetail->produk->kategori->nama }}</p>
                        </td>
                        <td class="cart_price">
                            <p>@uang($cartdetail->produk->harga_jual)</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href="{{ url('tambahqty', $cartdetail->id) }}"> + </a>
                                <form action="{{ url('check') }}" method="post">
                                    @method('POST')
                                    @csrf
                                    <input disabled min="1" class="cart_quantity_input" type="number" autocomplete="off"
                                        size="2" name="qty" value="{{ old('qty', $cartdetail->qty) }}">
                                </form>
                                <a class="cart_quantity_down" href="{{ url('kurangqty', $cartdetail->id) }}"> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">@uang($cartdetail->subharga)</p>
                        </td>
                        <td class="cart_delete">
                            <a href="{{ url('deletecart', $cartdetail->id) }}" class="btn cart_quantity_delete"><i
                                    class="fa fa-times"></i>
                            </a>

                            {{-- <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a> --}}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td>Tidak ada produk di keranjang</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>c
        @else
        <h4>Belum ada produk di keranjang belanja</h4>
        @endif
    </div>
</section>

{{-- <section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your
                delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>@uang($carts->subtotal)</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>$61</span></li>
                    </ul>
                    <a class="btn btn-default update" href="">Update</a>
                    <a class="btn btn-default check_out" href="">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<section id="do_action">
    <div class="container">
        <div class="row">
            <div class="col-sm-7"></div>
            <div class="col-sm-5 ">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>@uang($subtotal)</span></li>
                    </ul>
                    <div class="container">
                        @if ($carts == null)
                        <a style="padding: 15px" class="btn btn-lg check_out " href="/">Cari produk</a>
                        @elseif ($cartdetail == null)
                        <a style="padding: 15px" class="btn btn-lg check_out " href="/">Cari produk</a>
                        @elseif ($cartdetail != null)
                        <a style="padding: 15px" class="btn btn-lg check_out " href="{{ url('check') }}">Check Out</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    <br>
    <br>
</section>



@endsection
