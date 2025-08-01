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

    @php
     $payment_currency=$setting_data['payment_currency'];
        $name=$data->name;
        $bannerImage=asset('front/images/internal-banner.webp');
        if($data->bannerImage){
            $bannerImage=asset($data->bannerImage);
        }
    @endphp
    <section class="page-title" style="background-image: url({{$bannerImage}});">
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
	<a href="#p-list" class="sticky main-btn book1 check">
		<span class="button-text">CHECK AVAILABILITY</span>
	</a>
@php
$total_sleep=0;
$ids=[];
     if(Request::get("Guests")){
        
        if(Request::get("adults")!=""){
            if(is_int((int)Request::get("adults"))){
                $total_sleep+=Request::get("adults");
            }
        }
        if(Request::get("child")!=""){
            if(is_int((int)Request::get("child"))){
                $total_sleep+=Request::get("child");
            }
        }
    }
    if(Request::get("start_date")){
        if(Request::get("end_date")){
            $start_date=Helper::getDateFormatData(Request::get("start_date"));
            $end_date=Helper::getDateFormatData(Request::get("end_date"));
            $new_data=(HostAwayAPI::getSearchPropertiesList($start_date,$end_date,$total_sleep));
            if($new_data['status']=="200"){
                $ids=$new_data['data'];
            }
        }
    }
    $list=App\Models\HostAway\HostAwayProperty::query();
    
    if(count($ids)>0){
        $list->whereIn("host_away_id",$ids);
    }
    if(Request::get("location_id")){
        $list->where("location_id",Request::get("location_id"));
    }
    $yes_is_pet='';
    $no_is_pet='';
    $list=$list->where("status","true")->orderBy("id","desc")->paginate(100);
@endphp
<div class="search-bar" id="p-list">
	<div class="container">
					<form method="get" action="{{ url('properties') }}">
						<div class="row">
						 <div class="col-3 md-12 sm-12 select">
								{!! Form::select("location_id",HostAwayAPI::getPropertyListDataSelect(),null,["class"=>"","placeholder"=>"Select Property","title"=>"Select Property","id"=>"loc"]) !!}
								<i class="fa-solid fa-location-dot"></i>
							</div> 
                          {{--
							<div class="col-6 col-lg md-8 icns mb-lg-0 position-relative  datepicker-section datepicker-common-2 main-check">
								<div class="row">
									<div class="check left icns mb-lg-0 position-relative datepicker-common-2">
										{!! Form::text("start_date",Request::get("start_date"),["required","autocomplete"=>"off","inputmode"=>"none","id"=>"start_date1","placeholder"=>"Check in","class"=>"form-control"]) !!}
										<i class="fa-solid fa-calendar-days"></i>
									</div>
									<div class="check right icns mb-lg-0 position-relative datepicker-common-2 check-out">
										{!! Form::text("end_date",Request::get("end_date"),["required","autocomplete"=>"off","inputmode"=>"none","id"=>"end_date1","placeholder"=>"Check Out","class"=>"  form-control lst" ]) !!}
										<i class="fa-solid fa-calendar-days"></i>
									</div>
									<div class="col-12 md-12 sm-12 datepicker-common-2 datepicker-main">
										<input type="text" id="demo171" value="" aria-label="Check-in and check-out dates" aria-describedby="demo171-input-description" readonly />
									</div>
								</div>
							</div>
							<div class="col-3 md-12 sm-12 guest">
								<input type="text" name="Guests" readonly="" value="{{ Request::get('Guests') ?? '1 Guests' }}" class="form-control gst1" id="show-target-data1" placeholder="Add guests" title="Select Guests">
								<i class="fa-solid fa-users "></i>
								<input type="hidden" value="{{ Request::get('adults') ?? '1' }}" name="adults" id="adults-data1" />
								<input type="hidden" value="{{ Request::get('child') ?? '0' }}" name="child" id="child-data1" />
								<div class="adult-popup" id="guestsss1">
									<i class="fa fa-times close12"></i>
									<div class="adult-box">
										<p id="adults-data1-show"><span>@if(Request::get('adults'))
                                                                    @if(Request::get('adults')>1)
                                                                        {{ Request::get('adults') }} Adults
                                                                    @else
                                                                        {{ Request::get('adults') }} Adult
                                                                    @endif
                                                                 @else
                                                                1 Adult
                                                                 @endif</span> 18+</p>
										<div class="adult-btn">
											<button class="button1"  type="button" onclick="functiondec1('#adults-data1','#show-target-data1','#child-data1')" value="Decrement Value">-</button>
											<button class="button11 button1" type="button"  onclick="functioninc1('#adults-data1','#show-target-data1','#child-data1')" value="Increment Value">+</button>
										</div>
									</div>
									<div class="adult-box">
										<p id="child-data1-show"><span>@if(Request::get('child'))
                                                                    @if(Request::get('child')>1)
                                                                        {{ Request::get('child') }} Children
                                                                    @else
                                                                        {{ Request::get('child') }} Child
                                                                    @endif
                                                                 @else
                                                                 Child
                                                                 @endif</span> (0-17)</p>
										<div class="adult-btn">
											<button class="button1" type="button"  onclick="functiondec1('#child-data','#show-target-data','#adults-data')" value="Decrement Value">-</button>
											<button class="button11 button1" type="button"  onclick="functioninc1('#child-data1','#show-target-data1','#adults-data1')" value="Increment Value">+</button>
										</div>
									</div>
									<button class="main-btn  close1112" type="button" onclick="">Apply</button>
								</div>
							</div>
                          --}}
							<div class="col-3 md-12 sm-12 srch-btn">
								<button type="submit" class="main-btn "><i class="fa-solid fa-magnifying-glass"></i></button>
							</div>
						</div>
					</form>
					</div>
				</div>


<section class="home-list">
	<div class="container">
		<div class="row">
		
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
    					<a href="{{ url($c->seo_url).'?'.http_build_query(request()->all()) }}" title="" data-href="{{ url($c->seo_url) }}">
    					    <img src="{{ asset($image)}}" class="img-fluid" alt="{{$c->title}}" />
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
						<a href="{{ url($c->seo_url).'?'.http_build_query(request()->all()) }}">{{$c->title}}</a>
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
						<a href="{{ url($c->seo_url).'?'.http_build_query(request()->all()) }}">Check Availability <i class="fa-solid fa-plus"></i></a>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>
@stop


@section("css")
@parent
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="{{ asset('datepicker') }}/dist/css/hotel-datepicker.css"/>
<link rel="stylesheet" href="{{ asset('front')}}/css/datepicker.css" />
<link rel="stylesheet" href="{{ asset('front')}}/css/porperty-list.css" />
<link rel="stylesheet" href="{{ asset('front')}}/css/porperty-list-responsive.css" />
@stop 
@section("js")
@parent
<script src="{{ asset('front')}}/js/properties-list.js" ></script>
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
	                        $("#demo171").val("{{ request()->start_date }} - {{ request()->end_date }}");     
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
	                                        
	                                        
	                                        $("#demo171").val("{{ request()->start_date }} - {{ request()->end_date }}")
	                                        document.getElementById("start_date1").value ="{{ request()->start_date }}";
	                                        document.getElementById("end_date1").value ="{{ request()->end_date }}";
	                                     
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
@stop