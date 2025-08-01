@extends("front.layouts.master")
@section("title",$data->meta_title)
@section("keywords",$data->meta_keywords)
@section("description",$data->meta_description)

@section("container")

    @php
        $name=$data->name;
        $bannerImage=asset('front/images/internal-banner.webp');
        $payment_currency= $setting_data['payment_currency'];
    @endphp
	<!-- start banner sec -->
    

    <section class="page-title d-none" style="background-image: url({{$bannerImage}});">
        <div class="auto-container">
            <h1 data-aos="zoom-in" data-aos-duration="1500" class="aos-init aos-animate">{{$name}}</h1>
            <div class="checklist">
                <p>
                    <a href="{{url('/')}}" class="text"><span>Home</span></a>
                    <a class="g-transparent-a">{{$name}}</a>
                </p>
            </div>
        </div>
    </section>

	<!-- start about section -->
        
      <!-- About Section -->
 
      <section class="About-sec d-none">

        <div class="container">

            <div class="row">

                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                        <tr>
                            <td align="left" valign="top">
                            <h4 style="font-size: 17px; color: #222; font-weight: 600">Hey {{$booking['name']}},</h4>

                            <p style=" font-size: 15px; color: #454545; line-height: 24px; font-weight: 400; margin: 0 0 15px 0; text-align: left">Congratulations, Your booking is confirmed. You will receive an email with further details.</p>
                            
                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <th colspan="2" align="center" style="padding: 10px;" valign="top"><strong>Property Detail </strong></th>
                                    </tr>

                                    <tr>
                                        <td align="right" style="padding: 10px;" valign="top"><strong>Property Name :</strong></td>
                                        <td align="left" style="padding: 10px;" valign="top">{{$property->name }}</td>
                                    </tr>
                                </tbody>
                            </table>


                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <th colspan="2" align="center" style="padding: 10px;" valign="top"><strong>Payment Detail </strong></th>
                                </tr>

                                <tr>
                                    <td align="right" style="padding: 10px;" valign="top"><strong>Amount :</strong></td>
                                    <td align="left" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{$payment->amount }}</td>
                                </tr>
                                <tr>
                                    <td align="right" style="padding: 10px;" valign="top"><strong>Payment Mode :</strong></td>
                                    <td align="left" style="padding: 10px;" valign="top">{{$payment->type }}</td>
                                </tr>
                                <tr>
                                    <td align="right" style="padding: 10px;" valign="top"><strong>Tran ID :</strong></td>
                                    <td align="left" style="padding: 10px;" valign="top">{{$payment->tran_id }}</td>
                                </tr>
                                @if($payment->balance_transaction)
                                <tr>
                                    <td align="right" style="padding: 10px;" valign="top"><strong>Balance transaction ID:</strong></td>
                                    <td align="left" style="padding: 10px;" valign="top">{{$payment->balance_transaction }}</td>
                                </tr>
                                @endif
                                @if($payment->receipt_url)
                                <tr>
                                    <td align="right" style="padding: 10px;" valign="top"><strong>Receipt:</strong></td>
                                    <td align="left" style="padding: 10px;" valign="top"><a href="{{$payment->receipt_url }}">View Receipt</a></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        
                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <th colspan="5" align="center" style="padding: 10px;" valign="top"><strong>Booking Detail </strong></th>
                                    </tr>

                                    <tr>
                                        <th align="left" style="padding: 10px;" valign="top"><strong>Checkin :</strong></th>
                                        <th align="left" style="padding: 10px;" valign="top"><strong>Checkout :</strong></th>
                                        <th align="left" style="padding: 10px;" valign="top"><strong>Total Guest :</strong></th>
                                        <th align="left" style="padding: 10px;" valign="top"><strong>Total Night :</strong></th>
                                        <th align="right" style="padding: 10px;" valign="top"><strong>Gross Amount :</strong></th>
                                        
                                    </tr>
                                    <tr>
                                        <td align="left" style="padding: 10px;" valign="top">{{$booking['checkin'] }}</td>
                                        <td align="left" style="padding: 10px;" valign="top">{{$booking['checkout'] }}</td>
                                        <td align="left" style="padding: 10px;" valign="top">{{$booking['total_guests'] }} ({{$booking['adults']}} Adults, {{$booking['child']}} Child)</td>
                                        <td align="left" style="padding: 10px;" valign="top">{{$booking['total_night'] }}</td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($booking['gross_amount'],2) }}</td>
                                    </tr>
                                    	 @php
                                        $main_data=(json_decode($booking['amount_data'],true));
                                    @endphp
                                            @foreach($main_data['data']['components'] as $c)
                                                @if($c['isIncludedInTotalPrice']==1)
                                                    @if($c['name']!="baseRate")
                                                    <tr>
                                                       <td colspan="4">{{$c['title']}}</td>
                                                       <td align="right">{!! $payment_currency !!}{{number_format($c['total'],2)}}</td>
                                                   </tr>
                                                   @endif
                                               @endif
                                           @endforeach
                                           <tr>
                                               <td colspan="4">Total Price <span style="color:green;">(Paid)</span></td>
                                               <td align="right">{!! $payment_currency !!}{{number_format($main_data['data']['totalPrice'],2)}}</td>
                                           </tr>

                                           @foreach($main_data['data']['components'] as $c)
                                                @if($c['isIncludedInTotalPrice']==0)
                                                <tr>
                                                   <td colspan="4">{{$c['title']}} <sub>(Not Include)</sub></td>
                                                   <td align="right">{!! $payment_currency !!}{{number_format($c['total'],2)}}</td>
                                               </tr>
                                               @endif
                                           @endforeach




                                </tbody>
                            </table>
                            </td>
                        </tr>
                    </tbody>
                </table>




            </div>

        </div>

    </section>
<section class="payments-details">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 payment-side">
                <div class="payment-bar">
                    <div class="payment-head">
                        <h4>You're all set for {{$property->name }}</h4>
                        <p>Congratulations, Your booking is confirmed. You will receive an email with further details.</p>
                    </div>
                    <div class="payment-slider owl-carousel" id="payment-slide">
                        @php  $i=1; @endphp
                        @if($property->listingImages)
                             @php $io=0; @endphp
                             @foreach(json_decode($property->listingImages,true) as $c1)
                                @if($i==10)
                                    @break
                                @endif
                                <div class="item">
                                    <img src="{{asset($c1['url'])}}" alt="{{$c1['caption']}}"  title="{{$c1['caption']}}" />
                                </div>
                               @php $i++; @endphp
                            @endforeach
                        @endif
                    </div>
                    <div class="check-details">
                        <ul>
                            <li>
                                <p>Check-in:</p>
                                <span> {{date('F jS, Y',strtotime($booking['checkin']))}}</span>
                            </li>
                            <li>
                                <p>Check-out:</p>
                                <span> {{date('F jS, Y',strtotime($booking['checkout']))}}</span>
                            </li>
                        </ul>
                        <ul>
                            <li><p>Guests:</p>
                                <span>{{$booking['total_guests'] }} ({{$booking['adults']}} Adults, {{$booking['child']}} Child)</span>
                            </li>
                            <li>
                                <p>Nights:</p>
                                <span>{{$booking['total_night'] }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="price-details"> 
                        <div class="price-area">
                          
                 
                         	@php
                                $main_data=(json_decode($booking['amount_data'],true));
                            @endphp
                            @foreach($main_data['data']['components'] as $c)
                                @if($c['isIncludedInTotalPrice']==1)
                                    @if($c['name']!="baseRate")
                                       <div class="prc fees">
                                        <p class="value">
                                            <span>{{$c['title']}}</span>
                                        </p>
                                        <p class="amt">{!! $payment_currency !!}{{number_format($c['total'],2)}}</p>
                                    </div>
                                    @else
                                    <div class="prc fees">
                                        <p class="value">
                                            <span>{!! $payment_currency !!}{{ number_format($c['total']/$booking['total_night'],2)  }} x {{ $booking['total_night'] }} Nights</span>
                                        </p>
                                        <p class="amt">{!! $payment_currency !!}{{number_format($c['total'],2)}}</p>
                                    </div>
                                   @endif
                               @endif
                           @endforeach
                   
                 
                        </div>
                        <div class="total-amt">
                            <p class="value">Total <span style="color:green;">(Paid)</span></p>
                            <p class="total">{!! $payment_currency !!}{{number_format($main_data['data']['totalPrice'],2)}}</p>
                        </div>
                        <div class="price-area">
                            @foreach($main_data['data']['components'] as $c)
                                @if($c['isIncludedInTotalPrice']==0)
                                <div class="prc fees">
                                    <p class="value">
                                        <span>{{$c['title']}} </span> <sub>&nbsp;&nbsp;&nbsp; Paid via Guest Portal</sub>
                                    </p>
                                    <p class="amt">{!! $payment_currency !!}{{number_format($c['total'],2)}}</p>
                                </div>
                               @endif
                           @endforeach
                        </div>
                        <div class="payment-details">
                            <h5>Payment Details</h5>
                            <div class="prc fees">
                                <p class="value">
                                    <span>Amount</span>
                                </p>
                                <p class="amt">{!! $payment_currency !!}{{$payment->amount }}</p>
                            </div>
                            <div class="prc fees">
                                <p class="value">
                                    <span>Payment Mode</span>
                                </p>
                                <p class="amt">Credit Card</p>
                            </div>
                            <div class="prc fees">
                                <p class="value">
                                    <span>Tran ID</span>
                                </p>
                                <p class="amt">{{$payment->tran_id }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8 payment-map">
                @if($property->map)
                    <iframe src="{!! $property->map !!}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                @else
                  
                @endif
            </div>
        </div>
    </div>
</section>
    

@stop
@section("css")
@parent
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
<link rel="stylesheet" href="{{ asset('front')}}/css/payment.css" />
<link rel="stylesheet" href="{{ asset('front')}}/css/payment-responsive.css" />
@stop
@section("js")
@parent
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('front')}}/js/payment.js"></script>
@stop