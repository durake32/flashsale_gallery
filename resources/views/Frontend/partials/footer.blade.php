<!-- Site footer -->
<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-6">
                <p class="footer-text">Download App:</p>
                <div class="flex flex-row items-center  app">
                    <a href=" https://onelink.to/8bm923" target=" https://onelink.to/8bm923" class="mr-2 mr-0 ">
                        <img src="<?php echo e(asset('Asset/Uploads/Static/dailomaaQr.jpg')); ?>" alt="Play Store"
                            class="mb-2" loading="lazy">
                    </a>
                </div>
            </div>
            @include('Frontend.partials.Footer.links')
            @include('Frontend.partials.Footer.policies')

            <div class="col-md-1 col-1">

            </div>
            <div class="col-md-3 col-sm-4 col-6">
                <h5 class="footer-text">Contact Us</h5>
                <ul>
                    <li class="footer-text"><i class="fa fa-phone"></i> Call: {{ $settings[0]['mobile_no'] ?? '' }}
                    </li>
                    <li class="footer-text"><i class="fa fa-envelope"></i> Email: {{ $settings[0]['email'] ?? '' }}
                    </li>

                </ul>
                <h6 class="footer-text">Follow Us on:</h6>
                <div class="social-icons">

                    <a class="social-icon social-icon--facebook" target="_blank"
                        href="{{ $settings[0]['facebook'] ?? '' }}">
                        <i class="fa fa-facebook"></i>
                        <div class="tooltip">Facebook</div>
                    </a>
                    <a class="social-icon social-icon--twitter" target="_blank"
                        href="{{ $settings[0]['twitter'] ?? '' }}">
                        <i class="fa fa-twitter"></i>
                        <div class="tooltip">Twitter</div>
                    </a>
                    <a class="social-icon social-icon--instagram" target="_blank"
                        href="{{ $settings[0]['instagram'] ?? '' }}">
                        <i class="fa fa-instagram"></i>
                        <div class="tooltip">Instagram</div>
                    </a>

                    <a class="social-icon social-icon--linkedin" target="_blank"
                        href="{{ $settings[0]['linkedin'] ?? '' }}">
                        <img src="{{ asset('Asset/Uploads/Logo/tiktok.png') }}" alt="Tictok " width="23px"
                            height="23px">
                        <div class="tooltip">LinkedIn</div>
                    </a>

                </div>
            </div>
        </div>
    </div>

</footer>
<div class="copyright pt-2 pb-2">
    <div class="container">

        <div class="d-md-flex payment-img">
            <div class="mr-auto p-2 copyright-text">Copyright © <?php echo date("Y"); ?>
                Dailomaa. All Rights Reserved.</div>
            <div class="p-2">
                <img src="{{ asset('Asset/Uploads/Static/esewa.png') }}" alt="esewa">
                <img src="{{ asset('Asset/Uploads/Payment-Methods/cod.png') }}" alt="imepay">
            </div>


        </div>

    </div>
</div>
<div class="extra-footer">
    <div class="container">
        <div class="row">
            @include('Frontend.partials.Footer.sell')
            @include('Frontend.partials.Footer.shop-here')
            @include('Frontend.partials.Footer.benefits')
            @include('Frontend.partials.Footer.about')
        </div>
    </div>
</div>
