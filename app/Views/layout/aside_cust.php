<aside id="colorlib-aside" role="complementary" class="border js-fullheight">
    <h1 id="colorlib-logo""><a href=" <?php echo base_url("/home"); ?>">Sinar Terang</a></h1>
    <nav id="colorlib-main-menu" role="navigation">
        <ul>
            <li id="home"><a href="<?php echo base_url("/home"); ?>">Home</a></li>
            <li id="product"><a href="<?php echo base_url("/product"); ?>">Products</a></li>
            <li id="about"><a href="<?php echo base_url("/about"); ?>">About</a></li>
            <li id="services"><a href="<?php echo base_url("/services"); ?>">Services</a></li>
            <li id="blog"><a href="<?php echo base_url("/blog"); ?>">Blog</a></li>
            <li id="contact"><a href="<?php echo base_url("/contact"); ?>">Contact</a></li>
            <li id="login"><a href="<?php echo base_url("/login/customer"); ?>">Log In</a></li>
        </ul>
    </nav>

    <div class="colorlib-footer">
        <ul>
            <li><a href="#"><i class="icon-facebook2"></i></a></li>
            <li><a href="#"><i class="icon-twitter2"></i></a></li>
            <li><a href="#"><i class="icon-instagram"></i></a></li>
        </ul>
    </div>
</aside>

<script src="<?php echo base_url(); ?>/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        let current = window.location.href;
        if (current.includes('/home')) {
            document.getElementById("home").className = "colorlib-active";
        }
        if (current.includes('/product')) {
            document.getElementById("product").className = "colorlib-active";
        }
        if (current.includes('/about')) {
            document.getElementById("about").className = "colorlib-active";
        }
        if (current.includes('/services')) {
            document.getElementById("services").className = "colorlib-active";
        }
        if (current.includes('/blog')) {
            document.getElementById("blog").className = "colorlib-active";
        }
        if (current.includes('/contact')) {
            document.getElementById("contact").className = "colorlib-active";
        }
    });
</script>