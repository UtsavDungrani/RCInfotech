<footer class="footer_style_2">
    <div class="container-fuild">
        <div class="row">
            <div style="width: 500px;">
                <div style="width: 100%">
                    <iframe width="100%" height="650" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                        src="about:blank"
                        data-src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d472.0673927927595!2d72.11304969999999!3d21.760874899999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395f50f3945bcedb%3A0xbd03f1f2080a40c7!2sRIGHTS%20COMPUTER!5e0!3m2!1sen!2sin!4v1711384511011!5m2!1sen!2sin"
                        loading="lazy" title="RCInfotech Location"></iframe>
                </div>
            </div>
            <div class="footer_blog">
                <div class="row">
                    <div class="col-md-6">
                        <div class="main-heading left_text">
                            <h2>Social media</h2>
                        </div>
                        <!-- <p>Tincidunt elit magnis nulla facilisis. Dolor sagittis maecenas. Sapien nunc amet ultrices, dolores sit ipsum velit purus aliquet, massa fringilla leo orci.</p> -->
                        <ul class="social_icons">
                            <li class="social-icon in"><a href="#" aria-label="Instagram"><i
                                        class="fa-brands fa-instagram" aria-hidden="true"></i></a></li>
                            <li class="social-icon in"><a href="#" aria-label="LinkedIn"><i
                                        class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a></li>
                            <li class="social-icon tw"><a href="#" aria-label="Twitter"><i
                                        class="fa-brands fa-x-twitter" aria-hidden="true"></i></a></li>
                            <li class="social-icon fb"><a href="#" aria-label="Facebook"><i
                                        class="fa-brands fa-facebook-f" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="main-heading left_text">
                            <h2>Additional links</h2>
                        </div>
                        <ul class="footer-menu">
                            <li><a href="about_us.php"><i class="fa fa-angle-right" aria-hidden="true"></i> About us</a>
                            </li>
                            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Terms and
                                    conditions</a></li>
                            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Privacy policy</a></li>
                            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> News</a></li>
                            <li><a href="contact.php"><i class="fa fa-angle-right" aria-hidden="true"></i> Contact
                                    us</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="main-heading left_text">
                            <h2>Services</h2>
                        </div>
                        <ul class="footer-menu">
                            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Data recovery</a></li>
                            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Computer repair</a>
                            </li>
                            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Mobile service</a></li>
                            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Network solutions</a>
                            </li>
                            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Technical support</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="main-heading left_text">
                            <h2>Contact us</h2>
                        </div>
                        <p>F-9, Pramukhdarshan complex, Desai nagar, Bhavnagar, Gujarat 364003<br>
                            <span style="font-size:18px;"><a href="tel:+917878114066">+91 7878114066</a></span>
                        </p>
                        <div class="footer_mail-section">
                            <form>
                                <fieldset>
                                    <div class="field">
                                        <input placeholder="Email" type="email" required>
                                        <button class="button_custom" type="submit"><i class="fa fa-envelope"
                                                aria-hidden="true"></i></button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cprt">
                <p>RCInfotech © Copyrights 2024 Design by RCInfotech</p>
            </div>
        </div>
    </div>
</footer>

<script>
    // Lazy load the map when it comes into view
    document.addEventListener('DOMContentLoaded', function () {
        const mapFrame = document.querySelector('iframe[data-src]');
        if (mapFrame) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        mapFrame.src = mapFrame.dataset.src;
                        observer.unobserve(mapFrame);
                    }
                });
            });
            observer.observe(mapFrame);
        }
    });
</script>