 <div class="loader-head " id="sygnius-loader">
    <div class="loader">
    	 <img src="<?php echo e(asset($setting_data['header_logo'] ?? 'front/images/logo.png')); ?>" alt="<?php echo e($setting_data['website'] ?? 'VR'); ?>" class="img-fluid logo-loader">
    	 <p class="logo-text">Holmes With A View</p>
    	<img src="<?php echo e(asset('front')); ?>/images/scroll-loader1.gif" alt="">
    	<p>Please wait..</p>
    </div>
</div>
<header class="desk-nav">
        <div class="top-header">
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <a href="<?php echo e(url('/')); ?>">
						<img src="<?php echo e(asset($setting_data['header_logo'] ?? 'front/images/logo.png')); ?>" alt="Logo" class="img-fluid">
						</a>
                    </div>
                    <div class="col-8 search-baar d-none">
                        <?php if(Request::segment(1)=="" || Request::segment("1")=="properties"): ?>
                        <div class="search-bar">
					<form method="get" action="<?php echo e(url('properties')); ?>">
						<div class="row">
						<div class="col-3 md-12 sm-12 select">
						    <label>Where</label>
								<?php echo Form::select("location_id",ModelHelper::getLocationSelectList(),Request::get("location_id"),["class"=>"","placeholder"=>"Select Location","title"=>"Select Location","id"=>"loc"]); ?>

								
							</div> 
							<div class="col-5 col-lg md-8 icns mb-lg-0 position-relative  datepicker-section datepicker-common-2 main-check">
								<div class="row">
									<div class="check left icns mb-lg-0 position-relative datepicker-common-2">
									    <label>Check in</label>
										<?php echo Form::text("start_date",Request::get("start_date"),["required","autocomplete"=>"off","inputmode"=>"none","id"=>"start_date","placeholder"=>"Add dates","class"=>"form-control"]); ?>

									
									</div>
									<div class="check right icns mb-lg-0 position-relative datepicker-common-2 check-out">
									     <label>Check out</label>
										<?php echo Form::text("end_date",Request::get("end_date"),["required","autocomplete"=>"off","inputmode"=>"none","id"=>"end_date","placeholder"=>"Add dates","class"=>"  form-control lst" ]); ?>

										
									</div>
									<div class="col-12 md-12 sm-12 datepicker-common-2 datepicker-main">
										<input type="text" id="demo17" value="" aria-label="Check-in and check-out dates" aria-describedby="demo17-input-description" readonly />
									</div>
								</div>
							</div>
							<div class="col-3 md-12 sm-12 guest">
							     <label>Who</label>
								<input type="text" name="Guests" readonly="" value="<?php echo e(Request::get('Guests') ?? '1 Guests'); ?>" class="form-control gst" id="show-target-data" placeholder="Add guests" title="Select Guests">
							
									<input type="hidden" value="<?php echo e(Request::get('adults') ?? '1'); ?>" name="adults" id="adults-data" />
								<input type="hidden" value="<?php echo e(Request::get('child') ?? '0'); ?>" name="child" id="child-data" />
								<div class="adult-popup" id="guestsss">
									<i class="fa fa-times close1"></i>
									<div class="adult-box">
										<p id="adults-data-show"><span><?php if(Request::get('adults')): ?>
                                                                    <?php if(Request::get('adults')>1): ?>
                                                                        <?php echo e(Request::get('adults')); ?> Adults
                                                                    <?php else: ?>
                                                                        <?php echo e(Request::get('adults')); ?> Adult
                                                                    <?php endif; ?>
                                                                 <?php else: ?>
                                                                1 Adult
                                                                 <?php endif; ?></span> 18+</p>
										<div class="adult-btn">
											<button class="button1"  type="button" onclick="functiondec('#adults-data','#show-target-data','#child-data')" value="Decrement Value">-</button>
											<button class="button11 button1" type="button"  onclick="functioninc('#adults-data','#show-target-data','#child-data')" value="Increment Value">+</button>
										</div>
									</div>
									<div class="adult-box">
										<p id="child-data-show"><span><?php if(Request::get('child')): ?>
                                                                    <?php if(Request::get('child')>1): ?>
                                                                        <?php echo e(Request::get('child')); ?> Children
                                                                    <?php else: ?>
                                                                        <?php echo e(Request::get('child')); ?> Child
                                                                    <?php endif; ?>
                                                                 <?php else: ?>
                                                                 Child
                                                                 <?php endif; ?></span> (0-17)</p>
										<div class="adult-btn">
											<button class="button1" type="button"  onclick="functiondec('#child-data','#show-target-data','#adults-data')" value="Decrement Value">-</button>
											<button class="button11 button1" type="button"  onclick="functioninc('#child-data','#show-target-data','#adults-data')" value="Increment Value">+</button>
										</div>
									</div>
									<button class="main-btn  close111" type="button" onclick="">Apply</button>
								</div>
							</div>
							<div class="col-1 md-12 sm-12 srch-btn">
								<button type="submit" class="main-btn "><i class="fa-solid fa-magnifying-glass"></i></button>
							</div>
						</div>
					</form>
				</div>
				<?php endif; ?>
                    </div>
                    <div class="col-10">
                        	<nav class="navbar navbar-expand-lg">
						<div class="navbar-collapse" id="main_nav">
							<ul class="navbar-nav">
								<li><a href="<?php echo e(url('/')); ?>" class="active">Home</a></li>
                    <li><a href="<?php echo e(url('about-us')); ?>"> About Us</a></li>
                    <li><a href="<?php echo e(url('about-owner')); ?>">About Owner</a></li>
                    <li><a href="<?php echo e(url('properties')); ?>">Vacation Rentals</a></li>
                  
                      <li class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Attractions</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                                    <?php $__currentLoopData = App\Models\AttractionCategory::orderBy("id","desc")->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a class="dropdown-item"  href="<?php echo e(url('attractions/category/'.$c->seo_url)); ?>"><?php echo e($c->name); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li>
                    <li><a href="<?php echo e(url('contact-us')); ?>">Contact Us</a></li>
							</ul>
						</div>
					</nav>
                </div>
            </div>
        </div>
       
    </header>



<header class="page-header mob">
	<div class="container">
		<div class="row">
			<a href="<?php echo e(url('/')); ?>" class="logo">
			<img src="<?php echo e(asset($setting_data['header_logo'] ?? 'front/images/logo.png')); ?>" alt="Logo" class="img-fluid">
			</a>
			<div class="menu-toggle1" id="menu-toggle1"><i class="fa fa-bars"></i></div>
			<div class="menu-bar-in" id="tag1">
				<div class="mobile-nav">
					<div class="mobile-menu-logo">
						<a href="<?php echo e(url('/')); ?>" class="logo">
						<img src="<?php echo e(asset($setting_data['header_logo'] ?? 'front/images/logo.png')); ?>" alt="Logo" class="img-fluid">
						</a>
						<span id="close-menu"><i class="fa fa-times" id="close-menu1"></i></span>
					</div>
					<nav class="navbar navbar-expand-lg">
						<div class="navbar-collapse" id="main_nav">
							<ul class="navbar-nav">
								<li><a href="<?php echo e(url('/')); ?>" class="active">Home</a></li>
                    <li><a href="<?php echo e(url('about-us')); ?>"> About Us</a></li>
                    <li><a href="<?php echo e(url('about-owner')); ?>">About Owner</a></li>
                    <li><a href="<?php echo e(url('properties')); ?>">Vacation Rentals</a></li>
                  
                      <li class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Attractions</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                                    <?php $__currentLoopData = App\Models\AttractionCategory::orderBy("id","desc")->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a class="dropdown-item"  href="<?php echo e(url('attractions/category/'.$c->seo_url)); ?>"><?php echo e($c->name); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li>
                    <li><a href="<?php echo e(url('contact-us')); ?>">Contact Us</a></li>
							</ul>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</div>
</header>
<?php /**PATH /home/holmeswithaview/htdocs/www.holmeswithaview.com/projects/resources/views/front/layouts/header.blade.php ENDPATH**/ ?>