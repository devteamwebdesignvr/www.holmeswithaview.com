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
        $name=$data->name;
        $bannerImage=asset('front/images/internal-banner.webp');
        if($data->bannerImage){
            $bannerImage=asset($data->bannerImage);
        }
    @endphp
    <!-- start banner sec -->
 
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
@php
    $list=App\Models\Property::query();
    $list->where("location_id",$data->id);
    $list->where("status","true");
    $list=$list->orderBy("id","desc")->paginate(10);
@endphp


<section class="property-list-sec">
    <div class="container">
        <div class="row">
            <div class="col-12 ">
                <div class="property-list-box">
                    @foreach($list as $c)
                    <div class="property-lt-box">
                        <div class="pro-list-left">
                            <div class="pro-img-part">
                                @if($c->feature_image)
                                <img src="{{asset($c->feature_image)}}" alt="{{$c->name}}" class="img=fluid"/>
                                @endif
                            </div>
                            <div class="about-pro-list">
                                <div class="pro-list-details">
                                    <div class="vacation-content pro-list-name">
                                        <h3>{{$c->name}}</h3>
                                        @if($c->address)
                                        <h4><i class="fa fa-map-marker" aria-hidden="true"></i> {{$c->address}}</h4>
                                        @endif
                                    </div>
                                    <div class="pro-list-dec">
                                        <p>{{$c->description}}</p>
                                        @if($c->sleeps)
                                        <p class="adult"><i class="fa-solid fa-users"></i> {{$c->sleeps}} Sleeps</p>
                                        @endif
                                        @if($c->bedroom)
                                        <p class="pool"><i class="fa-solid fa-bed"></i> {{$c->bedroom}} Bedrooms</p>
                                        @endif
                                        @if($c->bathroom)
                                        <p class="bed"><i class="fa-solid fa-bath pe-1"></i> {{$c->bathroom}} Baths</p>
                                        @endif
                                        @if($c->area)
                                        <p class="size"><i class="fa-solid fa-maximize pe-2"></i> Size {{$c->area}} Sqft</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="pro-list-btn-sec">
                                    @if($c->price)
                                    <div class="pro-rates">
                                        <p>Price starts at:</p>
                                        <p class="pro-list-price">
                                            <span class="doller">{!! $setting_data['payment_currency'] !!}</span><span>{{$c->price}}</span> / Night
                                        </p>
                                    </div>
                                    @endif
                                    <div class="pro-list-btns">
                                        <a href="{{ url('properties/detail/'.$c->seo_url) }}" class="book-btn-pro-list">Reserve Now</a>
                                        <a href="{{ url('properties/detail/'.$c->seo_url) }}" class="details-btn-pro-list">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 ">
                {{$list->links()}}
            </div>
        </div>
    </div>
</section>
    


    

@stop