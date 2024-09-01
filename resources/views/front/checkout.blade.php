@extends('front.fixe')
@section('titre', 'Paiement')
@section('body')

<div class="offcanvas-overlay"></div>

<!-- Page Title/Header Start -->
<div class="page-title-section section" data-bg-image="/assets/images/bg/page-title-1.webp">
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="page-title">
                    <h1 class="title">
                        Paiement
                    </h1>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                Accueil
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Paiement
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Page Title/Header End -->

<!-- Checkout Section Start -->
<div class="section section-padding">
    <div class="container">
        <div class="section-title2">
            <h2 class="title">Détails de facturation</h2>
        </div>
        <form action="#" class="checkout-form learts-mb-50">
            <div class="row">
                <div class="col-md-4 col-12 learts-mb-20">
                    <label for="bdFirstName">FIrst Name <abbr class="required">*</abbr></label>
                    <input type="text" id="bdFirstName">
                </div>
                <div class="col-md-4 col-12 learts-mb-20">
                    <label for="bdLastName">Last Name <abbr class="required">*</abbr></label>
                    <input type="text" id="bdLastName">
                </div>
                <div class="col-md-4 col-12 learts-mb-20">
                    <label for="bdAddress1">Street address <abbr class="required">*</abbr></label>
                    <input type="text" id="bdAddress1" placeholder="House number and street name">
                </div>
                <div class="col-12 col-md-4 learts-mb-20">
                    <label for="bdTownOrCity">Town / City <abbr class="required">*</abbr></label>
                    <input type="text" id="bdTownOrCity">
                </div>
                <div class="col-12 col-md-4 learts-mb-20">
                    <label for="bdDistrict">District <abbr class="required">*</abbr></label>
                    <select id="bdDistrict" class="select2-basic">
                        <option value="">Select an option…</option>
                        <option value="BD-05">Bagerhat</option>
                        <option value="BD-01">Bandarban</option>
                        <option value="BD-02">Barguna</option>
                        <option value="BD-06">Barishal</option>
                        <option value="BD-07">Bhola</option>
                        <option value="BD-03">Bogura</option>
                        <option value="BD-04">Brahmanbaria</option>
                        <option value="BD-09">Chandpur</option>
                        <option value="BD-10">Chattogram</option>
                        <option value="BD-12">Chuadanga</option>
                        <option value="BD-11">Cox's Bazar</option>
                        <option value="BD-08">Cumilla</option>
                        <option value="BD-13">Dhaka</option>
                        <option value="BD-14">Dinajpur</option>
                        <option value="BD-15">Faridpur </option>
                        <option value="BD-16">Feni</option>
                        <option value="BD-19">Gaibandha</option>
                        <option value="BD-18">Gazipur</option>
                        <option value="BD-17">Gopalganj</option>
                        <option value="BD-20">Habiganj</option>
                        <option value="BD-21">Jamalpur</option>
                        <option value="BD-22">Jashore</option>
                        <option value="BD-25">Jhalokati</option>
                        <option value="BD-23">Jhenaidah</option>
                        <option value="BD-24">Joypurhat</option>
                        <option value="BD-29">Khagrachhari</option>
                        <option value="BD-27">Khulna</option>
                        <option value="BD-26">Kishoreganj</option>
                        <option value="BD-28">Kurigram</option>
                        <option value="BD-30">Kushtia</option>
                        <option value="BD-31">Lakshmipur</option>
                        <option value="BD-32">Lalmonirhat</option>
                        <option value="BD-36">Madaripur</option>
                        <option value="BD-37">Magura</option>
                        <option value="BD-33">Manikganj </option>
                        <option value="BD-39">Meherpur</option>
                        <option value="BD-38">Moulvibazar</option>
                        <option value="BD-35">Munshiganj</option>
                        <option value="BD-34">Mymensingh</option>
                        <option value="BD-48">Naogaon</option>
                        <option value="BD-43">Narail</option>
                        <option value="BD-40">Narayanganj</option>
                        <option value="BD-42">Narsingdi</option>
                        <option value="BD-44">Natore</option>
                        <option value="BD-45">Nawabganj</option>
                        <option value="BD-41">Netrakona</option>
                        <option value="BD-46">Nilphamari</option>
                        <option value="BD-47">Noakhali</option>
                        <option value="BD-49">Pabna</option>
                        <option value="BD-52">Panchagarh</option>
                        <option value="BD-51">Patuakhali</option>
                        <option value="BD-50">Pirojpur</option>
                        <option value="BD-53">Rajbari</option>
                        <option value="BD-54">Rajshahi</option>
                        <option value="BD-56">Rangamati</option>
                        <option value="BD-55">Rangpur</option>
                        <option value="BD-58">Satkhira</option>
                        <option value="BD-62">Shariatpur</option>
                        <option value="BD-57">Sherpur</option>
                        <option value="BD-59">Sirajganj</option>
                        <option value="BD-61">Sunamganj</option>
                        <option value="BD-60">Sylhet</option>
                        <option value="BD-63">Tangail</option>
                        <option value="BD-64">Thakurgaon</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 learts-mb-20">
                    <label for="bdPostcode">Postcode / ZIP (optional)</label>
                    <input type="text" id="bdPostcode">
                </div>
                <div class="col-md-4 col-12  learts-mb-20">
                    <label for="bdEmail">Email address <abbr class="required">*</abbr></label>
                    <input type="text" id="bdEmail">
                </div>
                <div class="col-md-4 col-12 learts-mb-30">
                    <label for="bdPhone">Phone <abbr class="required">*</abbr></label>
                    <input type="text" id="bdPhone">
                </div>
                <div class="col-12 learts-mb-40">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Create an account?</label>
                    </div>
                </div>
            </div>
        </form>
        <div class="section-title2 text-center">
            <h2 class="title">Votre commande</h2>
        </div>
        <div class="row learts-mb-n30">
            <div class="col-lg-6 order-lg-2 learts-mb-30">
                <div class="order-review">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="name">Produits</th>
                                <th class="total">Sous-total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="name">Walnut Cutting Board&nbsp; <strong class="quantity">×&nbsp;1</strong></td>
                                <td class="total"><span>£100.00</span></td>
                            </tr>
                            <tr>
                                <td class="name">Pizza Plate Tray&nbsp; <strong class="quantity">×&nbsp;1</strong></td>
                                <td class="total"><span>£22.00</span></td>
                            </tr>
                            <tr>
                                <td class="name">Minimalist Ceramic Pot - Pearl river, Large&nbsp; <strong class="quantity">×&nbsp;1</strong></td>
                                <td class="total"><span>£120.00</span></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="subtotal">
                                <th>Sous-total</th>
                                <td><span>£242.00</span></td>
                            </tr>
                            <tr class="total">
                                <th>Total</th>
                                <td><strong><span>£242.00</span></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-lg-6 order-lg-1 learts-mb-30">
                <div class="order-payment">
                    <div class="payment-method">
                        <div class="accordion" id="paymentMethod">
                            <div class="card active">
                                <div class="card-header">
                                    <button data-bs-toggle="collapse" data-bs-target="#cashkPayments">Cash on delivery </button>
                                </div>
                                <div id="cashkPayments" class="collapse" data-bs-parent="#paymentMethod">
                                    <div class="card-body">
                                        <p>Pay with cash upon delivery.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <p class="payment-note">
                            Vos données personnelles seront utilisées pour traiter votre commande, soutenir votre expérience sur ce site Web et à d'autres fins décrites dans notre politique de confidentialité.
                        </p>
                        <button class="btn btn-dark btn-outline-hover-dark">
                            passer commande
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Checkout Section End -->

@endsection