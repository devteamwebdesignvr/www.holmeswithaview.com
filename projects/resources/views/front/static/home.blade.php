@extends("front.layouts.master")
@section("title",$data->meta_title)
@section("keywords",$data->meta_keywords)
@section("description",$data->meta_description)
@section("logo",$data->image)
@section("header-section")
{!! $data->header_section !!}
@stop
@section("footer-section")
{!! $data->footer_section !!}
@stop
@section("container")
@php $payment_currency=ModelHelper::getDataFromSetting('payment_currency');@endphp
<style>
	.readMore a{
	color:white;
	}
</style>
<!-- Banner slider -->
<section class="banner-wrapper p-0">
	<div class="video-sec">
	<video src="{!! asset($setting_data['home_video']) !!}" loop="" muted="" autoplay="" playsinline id="mob" class="mob__video"></video>
	<button onclick="playVideo()" id="play">
	<i class="fa-solid fa-play"></i>
	</button>
	<button onclick="pauseVideo()" id="pause">
	<i class="fa-solid fa-pause"></i>
	</button>
	<!--<img src="img/banner.webp" alt="" class="img-fluid bane" style="height: 100%;">-->
	<div class="video-cont">
		<div class="container">
			{!! $setting_data['home-video-text'] !!}
			<div class="search-bar">
					<form method="get" action="{{ url('properties') }}">
						<div class="row">
						<div class="col-3 md-12 sm-12 select">
    {!! Form::select(
        "location_id",
        HostAwayAPI::getPropertyListDataSelect(),
        null,
        [
            "class" => "",
            "placeholder" => "Select Property",
            "title" => "Select Property",
            "id" => "loc",
            "onchange" => "this.form.submit()"
        ]
    ) !!}
    <i class="fa-solid fa-location-dot"></i>
</div>
 
                          {{--
							<div class="col-6 col-lg md-8 icns mb-lg-0 position-relative  datepicker-section datepicker-common-2 main-check">
								<div class="row">
									<div class="check left icns mb-lg-0 position-relative datepicker-common-2">
										{!! Form::text("start_date",null,["required","autocomplete"=>"off","inputmode"=>"none","id"=>"start_date1","placeholder"=>"Check in","class"=>"form-control"]) !!}
										<i class="fa-solid fa-calendar-days"></i>
									</div>
									<div class="check right icns mb-lg-0 position-relative datepicker-common-2 check-out">
										{!! Form::text("end_date",null,["required","autocomplete"=>"off","inputmode"=>"none","id"=>"end_date1","placeholder"=>"Check Out","class"=>"  form-control lst" ]) !!}
										<i class="fa-solid fa-calendar-days"></i>
									</div>
									<div class="col-12 md-12 sm-12 datepicker-common-2 datepicker-main">
										<input type="text" id="demo171" value="" aria-label="Check-in and check-out dates" aria-describedby="demo171-input-description" readonly />
									</div>
								</div>
							</div>
							<div class="col-3 md-12 sm-12 guest">
								<input type="text" name="Guests" readonly="" value="1 Guests" class="form-control gst1" id="show-target-data1" placeholder="Add guests" title="Select Guests">
								<i class="fa-solid fa-users "></i>
								<input type="hidden" value="1" name="adults" id="adults-data1" />
								<input type="hidden" value="0" name="child" id="child-data1" />
								<div class="adult-popup" id="guestsss1">
									<i class="fa fa-times close12"></i>
									<div class="adult-box">
										<p id="adults-data1-show"><span>1 Adult</span> </p>
										<div class="adult-btn">
											<button class="button1"  type="button" onclick="functiondec1('#adults-data1','#show-target-data1','#child-data1')" value="Decrement Value">-</button>
											<button class="button11 button1" type="button"  onclick="functioninc1('#adults-data1','#show-target-data1','#child-data1')" value="Increment Value">+</button>
										</div>
									</div>
									<div class="adult-box">
										<p id="child-data1-show"><span>Children</span> (0-17)</p>
										<div class="adult-btn">
											<button class="button1" type="button"  onclick="functiondec1('#child-data1','#show-target-data1','#adults-data1')" value="Decrement Value">-</button>
											<button class="button11 button1" type="button"  onclick="functioninc1('#child-data1','#show-target-data1','#adults-data1')" value="Increment Value">+</button>
										</div>
									</div>
									<button class="main-btn  close1112" type="button" onclick="">Apply</button>
								</div>
							</div>
                          --}}
							<div class="col-3 md-12 sm-12 srch-btn d-none">
								<button type="submit" class="main-btn "><i class="fa-solid fa-magnifying-glass"></i></button>
							</div>
						</div>
					</form>
				</div>
		</div>
		<div class="scroll">
			<a href="#abt">
				<div class="chevron"></div>
				<div class="chevron"></div>
				<div class="chevron"></div>
				<span class="text">Scroll down</span>
			</a>
		</div>
	</div>
</section>
<!-- about us  -->
<section class="about_section section-b-space">
	<div class="container">
		<div class="row">
			<div class="col-lg-6" data-aos="fade-up" data-aos-duration="1500">
				<div class="about_img">
					<div class="side-effect"><span></span></div>
					<img src="{{ asset($data->about_image1)}}" class="img-fluid" alt="">
				</div>
			</div>
			<div class="col-lg-6" data-aos="fade-up" data-aos-duration="1500">
				<div class="about_content">
					<div>
						<h5>{!! $data->shortDescription !!}</h5>
						{!! $data->mediumDescription !!}
						<div class="about_bottom">
							<a href="{{ url('about-us') }}" class="main-btn">View more</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Properties section start -->
<section class="home-list">
	<div class="container">
		<div class="how-we-value-heading">
			<h6>Trips, experiences, and places. All in one service.</h6>
			<h2>Most Popular Tours</h2>
			<span><img src="{{ asset('front')}}/images/separator.png" alt=""></span>			
		</div>
		<div class="row">
			@php
			$list=App\Models\HostAway\HostAwayProperty::query();
			$list=$list->where("is_home","true")->where("status","true")->orderBy("id","desc")->get();
			@endphp
			@foreach($list as $c)
			<div class="col-4 col-md-4 col-sm-12 prop-card" data-aos="fade-up" data-aos-duration="1500">
				<div class="pro-img">
						@php
			    $images=[];
			    foreach(json_decode($c->listingImages,true) as $c1){
			        $images[$c1['sortOrder']]=$c1;
			    }
			
			@endphp
			@php  $i=1; @endphp
					@if($c->feature_image)
    					@php $image=$c->feature_image;@endphp
    				@else
    					@if($c->listingImages)
        					@php $io=0; @endphp
        					@foreach($images as $c1)
            					@if($i==1)
            					    @php $image=$c1['url']; break;@endphp
            					@else
            					@endif
            					@php $i++;@endphp
        					@endforeach 
    					@endif
    				@endif
					@if($image)
					<a href="{{ url($c->seo_url) }}">
					<img src="{{ asset($image)}}" class="img-fluid" alt="{{$c->title}}">
					</a>
					@endif
					 @php
                  	$price=$c->price;
                  	$ar1=App\Models\HostAway\HostAwayDate::where("single_date",date('Y-m-d'))->where("hostaway_id",$c->host_away_id)->first();
                  if($ar1){
                  	$price=$ar1->price;
                  }
          
                  @endphp
					@if($price)
					<div class="view">
						<h5><span>
							{{ $payment_currency }}  {{$price}}
							</span> / Night
						</h5>
					</div>
					@endif
				</div>
				<div class="pro-cont">
					<div class="adr-rev">
					@if($c->address)
					<p class="adr "><i class="fa-solid fa-location-dot"></i>{{$c->address}}</p>
					@endif
					<p class="rating">
						{{number_format((App\Models\HostAway\HostAwayReview::where(["listingMapId"=>$c->host_away_id,"type"=>"guest-to-host","status"=>"published"])->whereNotNull("publicReview")->avg("rating")/2),2)}} <span><i class="fa-solid fa-star"></i></span>
					</p>
					</div>
					<h3 class="title">
						<a href="{{ url($c->seo_url) }}">{{$c->title}}</a>
					</h3>
					<p class="descp">{{ Str::limit($c->homeawayPropertyDescription,250) }}</p>
					<div class="amn">
						<ul class="first">
							@if($c->personCapacity)
							<li><i class="fa-solid fa-user"></i> {{$c->personCapacity}} Guests </li>
							@endif
							@if($c->bedsNumber)
							<li><i class="fa-solid fa-bed"></i>  {{$c->bedsNumber}} Beds </li>
							@endif
							@if($c->bathroomsNumber)
							<li><i class="fa-solid fa-bath"></i> {{$c->bathroomsNumber}} Baths </li>
							@endif
						</ul>
					</div>
					<div class="prop-view-btn">
						<a href="{{ url($c->seo_url) }}">Check Availability <i class="fa-solid fa-plus"></i></a>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>
<!-- cta -->
<section class="cta" style="background-image:url({{ asset($data->strip_image) }})">
	<div class="container">
		<div class="content">
			<div class="head-sec" data-aos="fade-up" data-aos-duration="1500">
				<h2>{!! $data->strip_title !!}</h2>
			</div>
			<p data-aos="fade-up" data-aos-duration="1500">{!! $data->strip_desction !!}</p>
			<a href="{{ url('properties') }}" class="main-btn" data-aos="zoom-in" data-aos-duration="1500"> Plan Your Trip</a>
		</div>
	</div>
</section>
<section class="about-owner">
	<div class="container">
		<div class="row">
			<div class="col-6 col-md-6 col-sm-12 img">
				<div class="abt-owner">
					<div class="abt-img">
						<img src="{{ asset($data->owner_image)}}" class="img-fluid" alt="">
					</div>
					<div class="svg-img">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 540 540">
							<style type="text/css">
								.st0{fill-rule:evenodd;clip-rule:evenodd;}
							</style>
							<path class="rhea_mask" d="M0 0v540h540V0H0zM268.5 538C121.3 538 2 418 2 270S121.3 2 268.5 2c72.6 0 38 76.3 56.5 141.3 20.3 71.1 193.5 112.6 199 183.3C535.4 474.2 415.7 538 268.5 538zM522.4 192.1c-42.3 17.4-113.7 5.9-147.8-45.4 -15.8-23.8-16.7-60.2-15.6-81.1 1.3-23.2 13.3-42.4 35.5-51.4C416.3 5.4 434.6 1.8 462 10c27 8.1 38.4 43.6 41.6 80.9C508.8 151.2 564.4 174.9 522.4 192.1z"></path>
						</svg>
					</div>
				</div>
			</div>
			<div class="col-6 col-md-6 col-sm-12 cont">
				{!! $data->longDescription !!}
				<div class="abt-detail">
					<div class="call-us">
						<div class="icon-area">
							<i class="fa-solid fa-phone"></i>
						</div>
						<div class="call-area">
							Phone:
							<a href="tel:{!! $setting_data['mobile'] ?? '#' !!}">{!! $setting_data['mobile'] ?? '#' !!}</a>
						</div>
					</div>
					<div class="email-us">
						<div class="icon-area">
							<i class="fa-regular fa-envelope"></i>
						</div>
						<div class="call-area">
							Email:
							<a href="mailto:{!! $setting_data['email'] ?? '#' !!}">{!! $setting_data['email'] ?? '#' !!}</a>
						</div>
					</div>
				</div>
				<a href="{{ url('about-owner') }}" class="main-btn">View More</a>
			</div>
		</div>
	</div>
</section>
@if(App\Models\Testimonial::where("status","true")->count()>0)
<!--Testimonial section-->
<section class="testimonial " style="background-image:url({{ asset($data->about_image2) }})">
	<div class="overlay"></div>
	<div class="container">
		<div class="head-sec" data-aos="zoom-in" data-aos-duration="1500">
			<p>What our happy client says</p>
			<h2>Testimonials</h2>
		</div>
		<div class="testy">
			<div class="owl-carousel" id="test-slider">
				@foreach(App\Models\Testimonial::where("status","true")->orderBy("id","desc")->take(6)->get() as $c)
				<div class="item single-testimonial">
					<p>{{$c->message}}</p>
					<div class="client-info">
					    @if($c->image)
						<div class="client-video">
							<img src="{{ asset($c->image)}}" class="img-fluid" alt="User">
						</div>
						@endif
						<div class="client-details">
							<h3>{{$c->name}}</h3>
                          <ul>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                          </ul>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</section>
@endif

<!-- about end -->
@stop
@section("css")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="{{ asset('datepicker') }}/dist/css/hotel-datepicker.css"/>
<link rel="stylesheet" href="{{ asset('front')}}/css/datepicker.css" />
<link rel="stylesheet" href="{{ asset('front')}}/css/home.css" />
<link rel="stylesheet" href="{{ asset('front')}}/css/home-responsive.css" />
@stop
@section("js")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
  {{--
   $(document).ready(function(){
      $(".gst1").click(function(){
        $("#guestsss1").css("display", "block");
      });
       $(".close12").click(function(){
        $("#guestsss1").css("display", "none");
      });
       $(".close1112").click(function(){
        $("#guestsss1").css("display", "none");
      });
    });
	function functiondec($getter_setter,$show,$cal){
	    val=parseInt($($getter_setter).val());
	    if($getter_setter=="#adults-data"){
            if(val>1){
                val=val-1;
            }
        }else{
             if(val>0){
                val=val-1;
            }
        }
	    $($getter_setter).val(val);
	    person1=val;
	    person2=parseInt($($cal).val());
	    $show_data=person1+person2;
	    $show_actual_data=$show_data+" Guests";
	    if($getter_setter=="#adults-data"){
	        $($getter_setter+'-show').html(val +" Adults");
	        if(val<=1){
	           $($getter_setter+'-show').html(val +" Adult"); 
	        }
	    }else{
	         $($getter_setter+'-show').html(val +" Children");
	        if(val<=1){
	           $($getter_setter+'-show').html(val +" Child"); 
	        }
	    }
	    $($show).val($show_actual_data);
	}
	function functioninc($getter_setter,$show,$cal){
	    val=parseInt($($getter_setter).val());
	    
	        val=val+1;
	  
	    $($getter_setter).val(val);
	    person1=val;
	    person2=parseInt($($cal).val());
	    $show_data=person1+person2;
	    $show_actual_data=$show_data+" Guests";
	    $($show).val($show_actual_data);
	    if($getter_setter=="#adults-data"){
	        $($getter_setter+'-show').html(val +" Adults");
	        if(val<=1){
	           $($getter_setter+'-show').html(val +" Adult"); 
	        }
	    }else{
	         $($getter_setter+'-show').html(val +" Children");
	        if(val<=1){
	           $($getter_setter+'-show').html(val +" Child"); 
	        }
	    }
	}
	
	
	function functiondec1($getter_setter,$show,$cal){
	    val=parseInt($($getter_setter).val());
	    if($getter_setter=="#adults-data1"){
            if(val>1){
                val=val-1;
            }
        }else{
             if(val>0){
                val=val-1;
            }
        }
	    $($getter_setter).val(val);
	    person1=val;
	    person2=parseInt($($cal).val());
	    $show_data=person1+person2;
	    $show_actual_data=$show_data+" Guests";
	    if($getter_setter=="#adults-data1"){
	        $($getter_setter+'-show').html(val +" Adults");
	        if(val<=1){
	           $($getter_setter+'-show').html(val +" Adult"); 
	        }
	    }else{
	         $($getter_setter+'-show').html(val +" Children");
	        if(val<=1){
	           $($getter_setter+'-show').html(val +" Child"); 
	        }
	    }
	    $($show).val($show_actual_data);
	}
	function functioninc1($getter_setter,$show,$cal){
	    val=parseInt($($getter_setter).val());
	    
	        val=val+1;
	  
	    $($getter_setter).val(val);
	    person1=val;
	    person2=parseInt($($cal).val());
	    $show_data=person1+person2;
	    $show_actual_data=$show_data+" Guests";
	    $($show).val($show_actual_data);
	    if($getter_setter=="#adults-data1"){
	        $($getter_setter+'-show').html(val +" Adults");
	        if(val<=1){
	           $($getter_setter+'-show').html(val +" Adult"); 
	        }
	    }else{
	         $($getter_setter+'-show').html(val +" Children");
	        if(val<=1){
	           $($getter_setter+'-show').html(val +" Child"); 
	        }
	    }
	}
</script>
<script src="{{ asset('datepicker') }}/node_modules/fecha/dist/fecha.min.js"></script>
<script src="{{ asset('datepicker') }}/dist/js/hotel-datepicker.js"></script>
<script>
	@php
	    $new_data_blocked=LiveCart::iCalDataCheckInCheckOutCheckinCheckout(0);
	    $checkin=json_encode($new_data_blocked['checkin']);
	    $checkout=json_encode($new_data_blocked['checkout']);
	    $blocked=json_encode($new_data_blocked['blocked']);
	
	@endphp
	    
	      var checkin = <?php echo $checkin;  ?>;
	    var checkout = <?php echo ($checkout);  ?>;
	    var blocked= <?php echo ($blocked);  ?>;
	    
	    
	        
	    function clearDataForm(){
	        $("#start_date").val('');
	        $("#end_date").val('');
	        $("#start_date1").val('');
	        $("#end_date1").val('');
	  
	    }
	            (function () {
	                @if(Request::get("start_date"))
	                    @if(Request::get("end_date"))
	                        $("#demo17").val("{{ request()->start_date }} - {{ request()->end_date }}");     
	                    @endif
	                @endif
	                abc=document.getElementById("demo17");
	                var demo17 = new HotelDatepicker(
	                    abc,
	                    {
	                        @if($checkin)
	                        noCheckInDates: checkin,
	                        @endif
	                        @if($checkout)
	                        noCheckOutDates: checkout,
	                        @endif
	                        @if($blocked)
	                         disabledDates: blocked,
	                        @endif
	                        onDayClick: function() {
	                             d = new Date();
	                                d.setTime(demo17.start);
	                                document.getElementById("start_date").value = getDateData(d);
	                                d = new Date();
	                                console.log(demo17.end)
	                                if(Number.isNaN(demo17.end)){
	                                    document.getElementById("end_date").value = '';
	                                }else{
	                                     d.setTime(demo17.end);
	                                    document.getElementById("end_date").value = getDateData(d);
	                                   // ajaxCallingData();
	                                }
	                        },
	                        clearButton:function(){
	                            return true;
	                        }
	                    }
	                );
	                abc1=document.getElementById("demo171");
	                var demo171 = new HotelDatepicker(
	                    abc1,
	                    {
	                        @if($checkin)
	                        noCheckInDates: checkin,
	                        @endif
	                        @if($checkout)
	                        noCheckOutDates: checkout,
	                        @endif
	                        @if($blocked)
	                         disabledDates: blocked,
	                        @endif
	                        onDayClick: function() {
	                             d = new Date();
	                                d.setTime(demo171.start);
	                                document.getElementById("start_date1").value = getDateData(d);
	                                d = new Date();
	                                console.log(demo171.end)
	                                if(Number.isNaN(demo171.end)){
	                                    document.getElementById("end_date1").value = '';
	                                }else{
	                                     d.setTime(demo171.end);
	                                    document.getElementById("end_date1").value = getDateData(d);
	                                   // ajaxCallingData();
	                                }
	                        },
	                        clearButton:function(){
	                            return true;
	                        }
	                    }
	                );
	                
	                        @if(Request::get("start_date"))
	                            @if(Request::get("end_date"))
	                                setTimeout(function(){
	                                        $("#demo17").val("{{ request()->start_date }} - {{ request()->end_date }}")
	                                        document.getElementById("start_date").value ="{{ request()->start_date }}";
	                                        document.getElementById("end_date").value ="{{ request()->end_date }}";
	                                     
	                                    },1000);
	                            
	                            @endif
	                        @endif
	              
	            })();
	
	            $(document).on("click","#clear",function(){
	                $("#clear-demo17").click();
	            })
	            x=document.getElementById("month-2-demo17");
	            x.querySelector(".datepicker__month-button--next").addEventListener("click", function(){
	                y=document.getElementById("month-1-demo17");
	                y.querySelector(".datepicker__month-button--next").click();
	            })  ;
	
	
	            x=document.getElementById("month-1-demo17");
	            x.querySelector(".datepicker__month-button--prev").addEventListener("click", function(){
	                y=document.getElementById("month-2-demo17");
	                y.querySelector(".datepicker__month-button--prev").click();
	            })  ;
	
	
	
	          function getDateData(objectDate){
	
	            let day = objectDate.getDate();
	            //console.log(day); // 23
	
	            let month = objectDate.getMonth()+1;
	            //console.log(month + 1); // 8
	
	            let year = objectDate.getFullYear();
	           // console.log(year); // 2022
	
	
	            if (day < 10) {
	                day = '0' + day;
	            }
	
	            if (month < 10) {
	                month = `0${month}`;
	            }
	            format1 = `${month}-${day}-${year}`;
	            return  format1 ;
	            console.log(format1); // 07/23/2022
	          }  
  --}}
</script>
<script>
	$(document).on("click",".view-more",function(){
	    that=$(this);
	     that.parents(".parent-class").find(".view-more").css({"display": "none"});
	      that.parents(".parent-class").find(".view-less").css({"display": "block"});
	    that.parents(".parent-class").find(".readMore_review").css({"height": "auto"});
	});
	$(document).on("click",".view-less",function(){
	    that=$(this);
	     that.parents(".parent-class").find(".view-more").css({"display": "block"});
	      that.parents(".parent-class").find(".view-less").css({"display": "none"});
	    that.parents(".parent-class").find(".readMore_review").css({"height": "78px"});
	});
	
	$(document).ready(function(){
	    $(".readMore_review").each(function(){
	        var a=$(this).height();
	         if(a < 78){
	            $(this).parents(".parent-class").find(".view-more").css("display", "none");
	        }
	        else{
	            $(this).parents(".parent-class").find(".view-more").css("display", "block");
	            $(this).css("height", "78px");
	        }
	    })
	    
	 var a = $(".readMore_review").height();
	
	});
	
	
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const locationSelect = document.getElementById('loc');

    locationSelect.addEventListener('change', function () {
        if (this.value !== '') {
            this.form.submit();
        }
    });
});
</script>
@stop