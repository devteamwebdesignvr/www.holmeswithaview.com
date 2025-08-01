<?php $__env->startSection("title",$data->meta_title); ?>
<?php $__env->startSection("keywords",$data->meta_keywords); ?>
<?php $__env->startSection("description",$data->meta_description); ?>
<?php $__env->startSection("logo",$data->image); ?>
<?php $__env->startSection("header-section"); ?>
<?php echo $data->header_section; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("footer-section"); ?>
<?php echo $data->footer_section; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("container"); ?>
<?php $payment_currency=ModelHelper::getDataFromSetting('payment_currency');?>
<style>
	.readMore a{
	color:white;
	}
</style>
<!-- Banner slider -->
<section class="banner-wrapper p-0">
	<div class="video-sec">
	<video src="<?php echo asset($setting_data['home_video']); ?>" loop="" muted="" autoplay="" playsinline id="mob" class="mob__video"></video>
	<button onclick="playVideo()" id="play">
	<i class="fa-solid fa-play"></i>
	</button>
	<button onclick="pauseVideo()" id="pause">
	<i class="fa-solid fa-pause"></i>
	</button>
	<!--<img src="img/banner.webp" alt="" class="img-fluid bane" style="height: 100%;">-->
	<div class="video-cont">
		<div class="container">
			<?php echo $setting_data['home-video-text']; ?>

			<div class="search-bar">
					<form method="get" action="<?php echo e(url('properties')); ?>">
						<div class="row">
						<div class="col-3 md-12 sm-12 select">
								<?php echo Form::select("location_id",HostAwayAPI::getPropertyListDataSelect(),null,["class"=>"","placeholder"=>"Select Property","title"=>"Select Property","id"=>"loc"]); ?>

								<i class="fa-solid fa-location-dot"></i>
							</div> 
                          
							<div class="col-3 md-12 sm-12 srch-btn">
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
					<img src="<?php echo e(asset($data->about_image1)); ?>" class="img-fluid" alt="">
				</div>
			</div>
			<div class="col-lg-6" data-aos="fade-up" data-aos-duration="1500">
				<div class="about_content">
					<div>
						<h5><?php echo $data->shortDescription; ?></h5>
						<?php echo $data->mediumDescription; ?>

						<div class="about_bottom">
							<a href="<?php echo e(url('about-us')); ?>" class="main-btn">View more</a>
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
			<span><img src="<?php echo e(asset('front')); ?>/images/separator.png" alt=""></span>			
		</div>
		<div class="row">
			<?php
			$list=App\Models\HostAway\HostAwayProperty::query();
			$list=$list->where("is_home","true")->where("status","true")->orderBy("id","desc")->get();
			?>
			<?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col-4 col-md-4 col-sm-12 prop-card" data-aos="fade-up" data-aos-duration="1500">
				<div class="pro-img">
						<?php
			    $images=[];
			    foreach(json_decode($c->listingImages,true) as $c1){
			        $images[$c1['sortOrder']]=$c1;
			    }
			
			?>
			<?php  $i=1; ?>
					<?php if($c->feature_image): ?>
    					<?php $image=$c->feature_image;?>
    				<?php else: ?>
    					<?php if($c->listingImages): ?>
        					<?php $io=0; ?>
        					<?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            					<?php if($i==1): ?>
            					    <?php $image=$c1['url']; break;?>
            					<?php else: ?>
            					<?php endif; ?>
            					<?php $i++;?>
        					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
    					<?php endif; ?>
    				<?php endif; ?>
					<?php if($image): ?>
					<a href="<?php echo e(url($c->seo_url)); ?>">
					<img src="<?php echo e(asset($image)); ?>" class="img-fluid" alt="<?php echo e($c->title); ?>">
					</a>
					<?php endif; ?>
					 <?php
                  	$price=$c->price;
                  	$ar1=App\Models\HostAway\HostAwayDate::where("single_date",date('Y-m-d'))->where("hostaway_id",$c->host_away_id)->first();
                  if($ar1){
                  	$price=$ar1->price;
                  }
          
                  ?>
					<?php if($price): ?>
					<div class="view">
						<h5><span>
							<?php echo e($payment_currency); ?>  <?php echo e($price); ?>

							</span> / Night
						</h5>
					</div>
					<?php endif; ?>
				</div>
				<div class="pro-cont">
					<div class="adr-rev">
					<?php if($c->address): ?>
					<p class="adr "><i class="fa-solid fa-location-dot"></i><?php echo e($c->address); ?></p>
					<?php endif; ?>
					<p class="rating">
						<?php echo e(number_format((App\Models\HostAway\HostAwayReview::where(["listingMapId"=>$c->host_away_id,"type"=>"guest-to-host","status"=>"published"])->whereNotNull("publicReview")->avg("rating")/2),2)); ?> <span><i class="fa-solid fa-star"></i></span>
					</p>
					</div>
					<h3 class="title">
						<a href="<?php echo e(url($c->seo_url)); ?>"><?php echo e($c->title); ?></a>
					</h3>
					<p class="descp"><?php echo e(Str::limit($c->homeawayPropertyDescription,250)); ?></p>
					<div class="amn">
						<ul class="first">
							<?php if($c->personCapacity): ?>
							<li><i class="fa-solid fa-user"></i> <?php echo e($c->personCapacity); ?> Guests </li>
							<?php endif; ?>
							<?php if($c->bedsNumber): ?>
							<li><i class="fa-solid fa-bed"></i>  <?php echo e($c->bedsNumber); ?> Beds </li>
							<?php endif; ?>
							<?php if($c->bathroomsNumber): ?>
							<li><i class="fa-solid fa-bath"></i> <?php echo e($c->bathroomsNumber); ?> Baths </li>
							<?php endif; ?>
						</ul>
					</div>
					<div class="prop-view-btn">
						<a href="<?php echo e(url($c->seo_url)); ?>">Check Availability <i class="fa-solid fa-plus"></i></a>
					</div>
				</div>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
</section>
<!-- cta -->
<section class="cta" style="background-image:url(<?php echo e(asset($data->strip_image)); ?>)">
	<div class="container">
		<div class="content">
			<div class="head-sec" data-aos="fade-up" data-aos-duration="1500">
				<h2><?php echo $data->strip_title; ?></h2>
			</div>
			<p data-aos="fade-up" data-aos-duration="1500"><?php echo $data->strip_desction; ?></p>
			<a href="<?php echo e(url('properties')); ?>" class="main-btn" data-aos="zoom-in" data-aos-duration="1500"> Plan Your Trip</a>
		</div>
	</div>
</section>
<section class="about-owner">
	<div class="container">
		<div class="row">
			<div class="col-6 col-md-6 col-sm-12 img">
				<div class="abt-owner">
					<div class="abt-img">
						<img src="<?php echo e(asset($data->owner_image)); ?>" class="img-fluid" alt="">
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
				<?php echo $data->longDescription; ?>

				<div class="abt-detail">
					<div class="call-us">
						<div class="icon-area">
							<i class="fa-solid fa-phone"></i>
						</div>
						<div class="call-area">
							Phone:
							<a href="tel:<?php echo $setting_data['mobile'] ?? '#'; ?>"><?php echo $setting_data['mobile'] ?? '#'; ?></a>
						</div>
					</div>
					<div class="email-us">
						<div class="icon-area">
							<i class="fa-regular fa-envelope"></i>
						</div>
						<div class="call-area">
							Email:
							<a href="mailto:<?php echo $setting_data['email'] ?? '#'; ?>"><?php echo $setting_data['email'] ?? '#'; ?></a>
						</div>
					</div>
				</div>
				<a href="<?php echo e(url('about-owner')); ?>" class="main-btn">View More</a>
			</div>
		</div>
	</div>
</section>
<?php if(App\Models\Testimonial::where("status","true")->count()>0): ?>
<!--Testimonial section-->
<section class="testimonial " style="background-image:url(<?php echo e(asset($data->about_image2)); ?>)">
	<div class="overlay"></div>
	<div class="container">
		<div class="head-sec" data-aos="zoom-in" data-aos-duration="1500">
			<p>What our happy client says</p>
			<h2>Testimonials</h2>
		</div>
		<div class="testy">
			<div class="owl-carousel" id="test-slider">
				<?php $__currentLoopData = App\Models\Testimonial::where("status","true")->orderBy("id","desc")->take(6)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="item single-testimonial">
					<p><?php echo e($c->message); ?></p>
					<div class="client-info">
					    <?php if($c->image): ?>
						<div class="client-video">
							<img src="<?php echo e(asset($c->image)); ?>" class="img-fluid" alt="User">
						</div>
						<?php endif; ?>
						<div class="client-details">
							<h3><?php echo e($c->name); ?></h3>
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
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- about end -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection("css"); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('datepicker')); ?>/dist/css/hotel-datepicker.css"/>
<link rel="stylesheet" href="<?php echo e(asset('front')); ?>/css/datepicker.css" />
<link rel="stylesheet" href="<?php echo e(asset('front')); ?>/css/home.css" />
<link rel="stylesheet" href="<?php echo e(asset('front')); ?>/css/home-responsive.css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection("js"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
  
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/holmeswithaview/htdocs/www.holmeswithaview.com/projects/resources/views/front/static/home.blade.php ENDPATH**/ ?>