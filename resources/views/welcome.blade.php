<html>

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nova Theme</title>
    <meta name="Nova theme" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <style>
        .logo-top-left {
            position: absolute;
            top: 10px;
            left: 20px;
            width: 50px; /* Adjust the width as needed */
            height: auto; /* Maintain aspect ratio */
        }

        .logo-text {
            position: absolute;
            top: 20px; /* Align vertically with the logo */
            left: 80px; /* Position next to the logo */
            color: #653504; /* Text color */
            font-size: 12px; /* Small text size */
            font-family: 'Inter', sans-serif; /* Use Inter font */
            font-weight: 700; /* Make text bold */
        }

        .logo-text span {
            display: block; /* Make each part of the text a block element */
        }

        .hero-background,
        .header-container {
            background-color: #ffffff; /* Set background to white */
        }

        .feature-icon i,
        .team-social-icon {
            font-size: 24px; /* Adjust the size as needed */
        }
    </style>

</head>

<body>

<!-- Navigation
    ================================================== -->
<div class="hero-background">
    <div>
        <img class="strips logo-top-left" src="{{ asset('img/logo_bang_bewok.png') }}">
        <span class="logo-text">
            <span>Es Coklat Roti Kukus</span>
            <span>Bang Bewok</span>
        </span>
    </div>
    <div class="container">
        <div class="header-container header">
            <a href="#email-form">
                <button class="header-btn" style="background-color: #EDCF15; color: black; font-weight: bold;">Login</button>
            </a>
        </div>
        <!--navigation-->


        <!-- Hero-Section
          ================================================== -->

        <div class="hero row">
            <div class="hero-right col-sm-6 col-sm-6">
                <h1 class="header-headline bold">
                    <span style="color: black;">Selamat Datang</span>
                    <span style="color: #EDCF15;">Sistem Inventori Manajemen Bahan Baku</span>
                    <br>
                </h1>
                <h4 class="header-running-text light" style="text-align: justify; color: #653504;"> Optimalkan pengelolaan stok bahan baku Anda dengan solusi cerdas yang memastikan ketersediaan tepat waktu dan meminimalkan risiko kehabisan produk.
                </h4>
            </div><!--hero-left-->

            <div class="col-sm-6 col-sm-6 ipad">
                <img class="ipad-screen img-responsive" src="{{ asset('img/gambar1.png') }}"/>
            </div>

        </div><!--hero-->

    </div> <!--hero-container-->

</div><!--hero-background-->


<!-- Features
  ================================================== -->

<div id="features" class="features-section">

    <div class="features-container row">

        <h2 class="features-headline light" style="font-weight: bold;">FITUR-FITUR KEUNGGULAN</h2>

        <div class="col-sm-4 feature">

            <div class="feature-icon feature-no-display">
                <i class='bx bx-devices feature-img'></i>
            </div>
            <h5 class="feature-head-text feature-no-display"> TERPUSAT </h5>
            <p class="feature-subtext light feature-no-display"> Inventori bahan baku yang terpusat </p>
        </div>

        <div class="col-sm-4 feature">
            <div class="feature-icon feature-no-display feature-display-mid">
                <i class='bx bx-time-five feature-img'></i>
            </div>
            <h5 class="feature-head-text feature-no-display feature-display-mid"> REAL-TIME </h5>
            <p class="feature-subtext light feature-no-display feature-display-mid"> Perbaruan data yang real-time </p>
        </div>

        <div class="col-sm-4 feature">
            <div class="feature-icon feature-no-display feature-display-last">
                <i class='bx bx-bell'></i>
            </div>
            <h5 class="feature-head-text feature-no-display feature-display-last"> PENGINGAT </h5>
            <p class="feature-subtext light feature-no-display feature-display-last"> Pengingat tanggal kadaluarsa produk </p>
        </div>
    </div> <!--features-container-->
</div> <!--features-section-->


<!-- White-Section
  ================================================== -->

<div class="white-section row">

    <div class="imac col-sm-6">
        <img class="imac-screen img-responsive" src="{{ asset('img/bangBewok1.jpg') }}">
    </div>
    <!--imac-->

    <div class="col-sm-6">

        <div class="white-section-text">

            <h2 class="imac-section-header light" style="font-weight: bold;">Sekilas tentang Bang Bewok</h2>

            <div class="imac-section-desc">

            <span>  Es coklat dan roti kukus bang bewok adalah produk UMKM yang berfokus pada bidang kuliner dengan menjual minuman coklat dan roti kukus dengan beragam pilihan rasa. Bang bewok dilahirkan atas dasar kecintaan 
                masyarakat sekitar terhadap minuman coklat dan makanan yang praktis dan menarik</span>
            </div>
        </div>
    </div>
</div><!--white-section-text-section--->


<!-- Team
  ================================================== -->

<div id="team" class="team">
    <h2 class="team-section-header light text-center" style="font-weight: bold;">PEMILIK DAN PENDIRI BANG BEWOK</h2>

    <div class="team-container row">


        <div class="col-sm-4 team-member">
            <img src="assets/images/cto.png">
            <div class="team-member-text">
                <h4 class="team-member-position light">PENDIRI</h4>
                <h5 class="bold">BIMO</h5>
                <p class="light">The brains behind the whole operation</p>
                <a href="http://www.twitter.com"><i class='bx bxl-twitter team-social-icon'></i></a>
                <a href="http://www.facebook.com"><i class='bx bxl-facebook-circle team-social-icon'></i></a>
                <a href="https://plus.google.com/"><i class='bx bxl-instagram team-social-icon'></i></a>
            </div>
        </div>

        <div class="col-sm-4 team-member">
            <img src="assets/images/ceo.png">
            <div class="team-member-text">
                <h4 class="team-member-position light">PEMILIK</h4>
                <h5 class="bold">BINTANG</h5>
                <p class="light">The one that puts it all together </p>
                <a href="http://www.twitter.com"><i class='bx bxl-twitter team-social-icon'></i></a>
                <a href="http://www.facebook.com"><i class='bx bxl-facebook-circle team-social-icon'></i></a>
                <a href="https://plus.google.com/"><i class='bx bxl-instagram team-social-icon'></i></a>
            </div>
        </div>

        <div class="col-sm-4 team-member">
            <img src="assets/images/cfo.png">
            <div class="team-member-text">
                <h4 class="team-member-position light">KEPALA CABANG</h4>
                <h5 class="bold">DWI</h5>
                <p class="light">The guy with his hand on the wallet</p>
                <a href="http://www.twitter.com"><i class='bx bxl-twitter team-social-icon'></i></a>
                <a href="http://www.facebook.com"><i class='bx bxl-facebook-circle team-social-icon'></i></a>
                <a href="https://plus.google.com/"><i class='bx bxl-instagram team-social-icon'></i></a>

            </div>

        </div>
        <! -- .row -->

    </div> <!--team-container--->

</div> <!--team-section--->


    <div id="newsletter-loading-div"></div>
    <!--email-form-->
</div>
<!--blue-section-->

<!-- Footer
  ================================================== -->

<div class="footer">

    <div class="container">
        <div class="row">

            <div class="col-sm-2"></div>

            <div class="col-sm-8 webscope">
                <span class="webscope-text"> Dwi Mahdini | 2023 </span>
            </div>
            <!--webscope-->
        </div>
        <!--row-->

    </div>
    <!--container-->
</div>
<!--footer-->

<script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>

<script src="{{ asset('js/scripts.js') }}"></script>

</body>

</html>