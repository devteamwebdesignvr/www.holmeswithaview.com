
<footer>
    <div class="footer_overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 first">
                <div class="footer_box">
                    <div class="footer_logo">
                        <img src="{{ asset($setting_data['footer_logo'] ?? 'front/images/logo.png') }}" alt="Logo" class="img-fluid">
                    </div>
                    <p class="abt">{{ $setting_data['about'] }}</p>
                    
                </div>
            </div>
            <div class="col-md-4 quick">
                <div class="footer_box">
                    <div class="footer_links">
                        <h4>Quick Links</h4>
                        <ul class="footer_link">
                            <li><a href="{{ url('/') }}"><i class="fa-solid fa-angles-right"></i> Home</a></li>
                            <li><a href="{{ url('about-us') }}"><i class="fa-solid fa-angles-right"></i> About Us</a></li>
                            <li><a href="{{ url('about-owner') }}"><i class="fa-solid fa-angles-right"></i> About Owner</a></li>
                            <li><a href="{{ url('properties') }}"><i class="fa-solid fa-angles-right"></i> Vacation Rentals</a></li>
                            
                            <li><a href="{{ url('attractions') }}"><i class="fa-solid fa-angles-right"></i> Attractions</a></li>
                            <li><a href="{{ url('privacy-policy') }}"><i class="fa-solid fa-angles-right"></i> Privacy Policy</a></li>
                            <li><a href="{{ url('terms-and-conditions') }}"><i class="fa-solid fa-angles-right"></i> Terms & Conditions</a></li>
                       
                            <li><a href="{{ url('contact-us') }}"><i class="fa-solid fa-angles-right"></i> Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 contact">
                <div class="footer_box">
                    <div class="footer_links">
                        <h4>Contact Details</h4>
                        <ul class="footer_link">
                            <li><i class="fa-solid fa-location-dot"></i> {!! $setting_data['address'] !!}</li>
                            <li><a href="tel:{!! $setting_data['mobile']!!}"><i class="fa-solid fa-phone"></i> {!! $setting_data['mobile']!!}</a></li>
                            <li><a href="mailto:{!! $setting_data['email'] !!}"><i class="fa-solid fa-envelope"></i> {!! $setting_data['email'] !!}
                                </a>
                            </li>
                        </ul>
                        <div class="footer-social">
                        <ul>
                            <li><span>Follow Us:</span></li>
                            <li>
                                <a href="{{ $setting_data['facebook'] }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="{{ $setting_data['instagram'] }}" target="_blank"><i class="fab fa-instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 newsletter">
                <div class="footer_box">
                    <div class="footer_links">
                        <h4>Subscribe</h4>
                        <div class="news">
                            <p>Subscribe to our newsletter for regular updates on our seasonal promotions, offers & lots more.</p>
                            <div class="newsletter-form">
                                {!! Form::open(["route"=>"newsletterPost","class"=>"newsletter-data newsLetterForm"]) !!}
                                    <div class="news-gorm-group">
                                        <input type="emil" name="email" required="" placeholder="Your Email..">
                                        <i class="fa-solid fa-paper-plane"></i>
                                        <button type="submit">Submit</button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left_copyright">
                        <p>{!! $setting_data['copyright'] !!}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right_copyright">
                        <p>Designed &amp; Developed by <a href="https://www.webdesignvr.com/" target="_blank"><img src="https://www.alohaniulani.com/front/images/footer_1.webp"></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
@include("front.layouts.js")
@yield("js")