@extends('layouts.customer')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div>
        <!--/breadcrums-->



        <!--/checkout-options-->
        <div class="review-payment">
            <h2>Review & Payment</h2>
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
                            <p>{{ $cartdetail->qty }}</p>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">@uang($cartdetail->subharga)</p>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td>Tidak ada produk di keranjang</td>
                    </tr>
                    @endforelse
                    <tr></tr>
                    <form action="{{ url('buatpesanan') }}" method="post">
                        @csrf
                        @method('post')
                        <tr>
                            <td colspan="5">
                                <div style="margin-top: 20px" class="row">
                                    <div class="col-sm-4">
                                        <div class="shopper-info">

                                            <div class="checkout-options">
                                                <p> Informasi pembeli</p>

                                                <h3>{{ $user->name }}</h3>
                                                <br>
                                                <span>{{ $user->nohp }}</span>
                                                <br>
                                                <h5>Alamat pengiriman</h5>
                                                <span>{{ $user->provinsi }}, </span>
                                                <span>{{ $user->kota }}, </span>
                                                <span>{{ $user->kecamatan }}</span>
                                                <p>{{ $user->alamat }}</p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-4">
                                        <div class="bill-to">
                                            <p>Metode pembayaran</p>
                                            <select required name="metode">
                                                <option value="">-- Pilih --</option>
                                                <option disabled value="">----------------------------------</option>
                                                @forelse ($metodes as $metode)

                                                <option value="{{ $metode->id,$metode->metode }}">
                                                    {{ $metode->metode }} ({{ $metode->keterangan }})
                                                </option>

                                                <option disabled value="">----------------------------------</option>
                                                @empty
                                                <option>Tidak ada</option>
                                                @endforelse

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="catatan">
                                            <p>Catatan pesanan</p>
                                            <textarea name="catatan"
                                                placeholder="Catatan tentang pesanan Anda, Catatan Khusus untuk Pengiriman"
                                                rows="6"></textarea>

                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td colspan="4">&nbsp;</td>
                            <td colspan="2">
                                <table class="table table-condensed total-result">
                                    <tr>
                                        <td>Cart Sub Total</td>
                                        <td>@uang($carts->subtotal)</td>
                                    </tr>
                                    {{-- <tr>
                                        <td>Exo Tax</td>
                                        <td>$2</td>
                                    </tr>
                                    <tr class="shipping-cost">
                                        <td>Shipping Cost</td>
                                        <td>Free</td>
                                    </tr> --}}
                                    <tr>
                                        <td>Total Pembayaran</td>
                                        <td><span>@uang($carts->total_pembayaran)</span></td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <div class="konfirm">
                                    <button style="padding: 15px;" class="btn btn-block check_out " type="submit">Buat
                                        pesanan</button>
                                </div>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
        @else
        <h4>Belum ada produk di keranjang belanja</h4>
        @endif


        <br>
        <br><br><br><br>
    </div>
</section>
<!--/#cart_items-->


@endsection
