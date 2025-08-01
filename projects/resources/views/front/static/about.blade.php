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
$bannerImage=asset('front/images/breadcrumb.webp');
if($data->bannerImage){
$bannerImage=asset($data->bannerImage);
}
@endphp
@include("front.layouts.banner")
<!-- Guests section start -->
<section class="about_section section-b-space">
    <div class="container">
                <div class="about_img" data-aos="fade-up" data-aos-duration="1500">
                    <div class="side-effect"><span></span></div>
                    <img src="{{ asset($data->about_image1)}}" class="img-fluid" alt="">
                </div>
                <div class="about_content" data-aos="fade-up" data-aos-duration="1500">
                       
                        {!! $data->mediumDescription !!}
                </div>
    </div>
</section>
@stop
@section("css")
@parent
<link rel="stylesheet" href="{{ asset('front')}}/css/about.css" />
<link rel="stylesheet" href="{{ asset('front')}}/css/about-responsive.css" />
@stop 
@section("js")
@parent
<script src="{{ asset('front')}}/js/about.js" ></script>
@stop