
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
        $name=$data->name;
        $bannerImage=asset('front/images/internal-banner.webp');
        if($data->bannerImage){
            $bannerImage=asset($data->bannerImage);
        }
    ?>
<?php echo $__env->make("front.layouts.banner", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


  <?php
  $list=App\Models\Attraction::where("category_id",$data->id)->orderBy("id","desc")->paginate(10);
  ?>
  <?php if(count($list)>0): ?>
    <section class="summary-section">
        <div class="container"> 
           <?php $i=1; ?>
              <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($i%2==0): ?>
            <div class="row position-relative" id="a1">
                <div class="col-lg-7 col-md-12 col-sm-12 position-relative">
                    <div class="inner-column" >
                        <?php if($c->image): ?>
                        <div class="image">
                            <img src="<?php echo e(asset($c->image)); ?>" alt="<?php echo e($c->name); ?>"  class="attachment-full size-full aos-init aos-animate" loading="lazy" >
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 position-relative right-contentss">
                    <div class="inner-column-content  parent-class">
                        <h3><a href="<?php echo e(url('attractions/detail/'.$c->seo_url)); ?>"><?php echo e($c->name); ?></a></h3>
                        <div class="line"></div>
                        <p class="target-class"><?php echo e($c->description); ?></p>
                        <a class="main-btn mr"><span class="readmore">Readmore</span></a>
                    </div>
                </div>
                <div class="dot">
                  <img src="<?php echo e(asset('front')); ?>/img/dot-shape.png">
                </div>
            </div>
            <?php else: ?>
            <div class="row position-relative" id="a1">
                <div class="col-lg-7 order-lg-2 col-md-12 col-sm-12 position-relative">
                    <div class="inner-column" >
                        <div class="image">
                            <img src="<?php echo e(asset($c->image)); ?>" alt="<?php echo e($c->name); ?>"  class="attachment-full size-full aos-init aos-animate" loading="lazy" >
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 order-lg-1 col-md-12 col-sm-12 position-relative right-contentss">
                    <div class="inner-column-content parent-class">
                        <h3 ><a href="<?php echo e(url('attractions/detail/'.$c->seo_url)); ?>"><?php echo e($c->name); ?></a></h3>
                        <div class="line"></div>
                        <p  class="target-class" ><?php echo e($c->description); ?></p>
                        <a class="main-btn mr"><span class="readmore">Readmore</span></a>
                    </div>
                </div>
                <div class="dot">
                  <img src="<?php echo e(asset('front')); ?>/img/dot-shape.png">
                </div>
            </div>


               <?php endif; ?>
            <?php $i++; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="row align-items-center">
               <?php echo e($list->links()); ?>

            </div>
        </div>
</section>

<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("css"); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('front')); ?>/css/attractions.css" />
<link rel="stylesheet" href="<?php echo e(asset('front')); ?>/css/attractions-responsive.css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection("js"); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('js'); ?>
<script>

  $(document).ready(function(){
        $(".target-class").each(function(){
            var a=$(this).height();
             if(a < 280){
                $(this).parents(".parent-class").find(".mr").css("display", "none");
            }
            else{
                $(this).parents(".parent-class").find(".mr").css("display", "block");
                $(this).css("height", "280px");
            }
        })
        
     var a = $(".target-class").height();
   
  });

    $(document).on("click",".readmore",function(){
        that=$(this);
        that.removeClass("readmore").addClass("readless").html("Read Less");
        that.parents(".parent-class").find(".target-class").css({"height": "auto"});
    });
    $(document).on("click",".readless",function(){
        that=$(this);
        that.removeClass("readless").addClass("readmore").html("Read More");
        that.parents(".parent-class").find(".target-class").css({"height": "280px"});
    });
    
   


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/holmeswithaview/htdocs/www.holmeswithaview.com/projects/resources/views/front/attractions/category.blade.php ENDPATH**/ ?>