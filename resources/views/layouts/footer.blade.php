<footer class="footer-section">
    <div class="container">

        <div class="row gy-4">

            <div class="col-lg-4 col-md-6">

                <h3 class="footer-logo">
                    <i class="fa-solid fa-plane-departure"></i>
                    Travely
                </h3>

                <p>
                    Discover amazing destinations, explore beautiful places
                    and make unforgettable memories with Travely.
                </p>

                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>

            </div>

            <div class="col-lg-2 col-md-6">

                <h5>Quick Links</h5>

                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/destinations') }}">Destinations</a></li>
                    <li><a href="{{ url('/hotels') }}">Hotels</a></li>
                    <li><a href="{{ url('/packages') }}">Packages</a></li>
                </ul>

            </div>

            <div class="col-lg-3 col-md-6">

                <h5>Support</h5>

                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>

            </div>

            <div class="col-lg-3 col-md-6">

                <h5>Contact</h5>

                <p><i class="fa-solid fa-envelope"></i> info@travely.com</p>
                <p><i class="fa-solid fa-phone"></i> +91 98765 43210</p>
                <p><i class="fa-solid fa-location-dot"></i> Punjab, India</p>

            </div>

        </div>

        <hr>

        <div class="text-center copyright">
            <p>© {{ date('Y') }} Travely. All Rights Reserved.</p>
        </div>

    </div>
</footer>