<?php session(); ?>
<aside id="colorlib-aside" role="complementary" class="border js-fullheight">
    <h1 id="colorlib-logo""><a href=" <?php echo base_url("/home"); ?>">Sinar Terang</a></h1>
    <nav id="colorlib-main-menu" role="navigation">
        <ul>
            <li id="home"><a href="<?php echo base_url("/home"); ?>">Beranda</a></li>
            <li id="outlet"><a href="<?php echo base_url("/outlet"); ?>">Cabang</a></li>
            <li id="product"><a href="<?php echo base_url("/product"); ?>">Produk</a></li>
            <li id="about"><a href="<?php echo base_url("/about"); ?>">Tentang</a></li>
            <li id="contact"><a href="<?php echo base_url("/contact"); ?>">Hubungi Kami</a></li>
            <?php if (!isset($_SESSION['isLoggedIn'])) : ?>
                <li id="login"><a href="<?php echo base_url("/login/customer"); ?>">Log In</a></li>
            <?php elseif (isset($_SESSION['isLoggedIn'])) : ?>
                <li id="point"><a href="<?php echo base_url("/point"); ?>">Poin</a></li>
                <li id="logout"><a href="<?php echo base_url("/logout"); ?>">Keluar</a></li>
            <?php endif; ?>
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
        } else
        if (current.includes('/product')) {
            document.getElementById("product").className = "colorlib-active";
        } else
        if (current.includes('/about')) {
            document.getElementById("about").className = "colorlib-active";
        } else
        if (current.includes('/services')) {
            document.getElementById("services").className = "colorlib-active";
        } else
        if (current.includes('/outlet')) {
            document.getElementById("outlet").className = "colorlib-active";
        } else
        if (current.includes('/contact')) {
            document.getElementById("contact").className = "colorlib-active";
        } else
        if (current.includes('/point')) {
            document.getElementById("point").className = "colorlib-active";
        }

        //keep "/" the last
        else
        if (current.includes('/')) {
            document.getElementById("home").className = "colorlib-active";
        }
    });
</script>