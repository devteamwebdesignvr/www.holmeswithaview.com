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

    <?php
     $payment_currency=$setting_data['payment_currency'];
        $name=$data->name;
        $bannerImage=asset('front/images/internal-banner.webp');
        if($data->bannerImage){
            $bannerImage=asset($data->bannerImage);
        }
    ?>
    <section class="page-title" style="background-image: url(<?php echo e($bannerImage); ?>);">
        <div class="auto-container">
            <h1 data-aos="zoom-in" data-aos-duration="1500" class="aos-init aos-animate"><?php echo e($name); ?></h1>
            <div class="checklist">
                <p>
                    <a href="<?php echo e(url('/')); ?>" class="text"><span>Home</span></a>
                    <a class="g-transparent-a"><?php echo e($name); ?></a>
                </p>
            </div>
        </div>
    </section>
	<a href="#p-list" class="sticky main-btn book1 check">
		<span class="button-text">CHECK AVAILABILITY</span>
	</a>
<?php
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
?>
<div class="search-bar" id="p-list">
	<div class="container">
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


<section class="home-list">
	<div class="container">
		<div class="row">
		
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
    					<a href="<?php echo e(url($c->seo_url).'?'.http_build_query(request()->all())); ?>" title="" data-href="<?php echo e(url($c->seo_url)); ?>">
    					    <img src="<?php echo e(asset($image)); ?>" class="img-fluid" alt="<?php echo e($c->title); ?>" />
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
						<a href="<?php echo e(url($c->seo_url).'?'.http_build_query(request()->all())); ?>"><?php echo e($c->title); ?></a>
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
						<a href="<?php echo e(url($c->seo_url).'?'.http_build_query(request()->all())); ?>">Check Availability <i class="fa-solid fa-plus"></i></a>
					</div>
				</div>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection("css"); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('css'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('datepicker')); ?>/dist/css/hotel-datepicker.css"/>
<link rel="stylesheet" href="<?php echo e(asset('front')); ?>/css/datepicker.css" />
<link rel="stylesheet" href="<?php echo e(asset('front')); ?>/css/porperty-list.css" />
<link rel="stylesheet" href="<?php echo e(asset('front')); ?>/css/porperty-list-responsive.css" />
<?php $__env->stopSection(); ?> 
<?php $__env->startSection("js"); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('js'); ?>
<script src="<?php echo e(asset('front')); ?>/js/properties-list.js" ></script>
<script>
  
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/holmeswithaview/htdocs/www.holmeswithaview.com/projects/resources/views/front/static/property-list.blade.php ENDPATH**/ ?>