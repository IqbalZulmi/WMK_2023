<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sports Camp</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('landing_assets/img/favicon.ico') }}" rel="icon">
  <link href="{{ asset('landing_assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('landing_assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('landing_assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landing_assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('landing_assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landing_assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landing_assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('landing_assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('landing_assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Vesperr
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/vesperr-free-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1>
            <a href="{{ route('landingPage') }}" class="d-flex justify-content-center align-items-center">
                <img src="{{ asset('assets/img/icon-2.png') }}" alt="">
                <span class="d-block" style="color: #BCD8A6">
                    Sportscamp
                </span>
            </a>
        </h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="landing_assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
          <li><a class="nav-link scrollto" href="#about">Tentang</a></li>
          <li><a class="nav-link scrollto" href="#services">Layanan</a></li>
          <li><a class="nav-link scrollto " href="#fitur">Fitur</a></li>
          <li><a class="nav-link scrollto" href="#team">Tim</a></li>
          <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
          <li><a class="getstarted scrollto" href="{{ route('loginPage') }}">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1 class="typing" data-aos="fade-up">Kontrol lapanganmu melalui SportsCamp</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">Lihat jadwal, Pesan, dan Main!!</h2>
          <div data-aos="fade-up" data-aos-delay="800">
            <a href="#about" class="btn-get-started scrollto">Tentang Kami</a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
          <img src="landing_assets/img/hero-img.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>SportsCamp</h2>
        </div>

        <div class="row content">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
            <p>
              Aplikasi pemesanan lapangan yang terintegrasi dengan berbagai penyedia lapangan. Memudahkan anda dalam mencari lapangan, melihat jadwal lapangan, memesan lapangan.
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Lapangan Badminton</li>
              <li><i class="ri-check-double-line"></i> Lapangan Futsal</li>
              <li><i class="ri-check-double-line"></i> Lapangan Mini-Soccer</li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <p>
              Sports Camp adalah sebuah aplikasi yang memudahkan para olahragawan untuk mencari, melihat jadwal, dan memesan lapangan sesuai keinginan mereka.
              Tujuan utama pembangunan aplikasi ini adalah untuk mempersingkat waktu dan aksi yang dibutuhkan olahragawan dalam menyewa sarana dan prasana olahraga mereka.
            </p>
            <a href="#" class="btn-learn-more">Selebihnya</a>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Target kami</h2>
        </div>

        <div class="row">
          <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-xl-start" data-aos="fade-right" data-aos-delay="150">
            <img src="landing_assets/img/counts-img.svg" alt="" class="img-fluid">
          </div>

          <div class="col-xl-7 d-flex align-items-stretch pt-4 pt-xl-0" data-aos="fade-left" data-aos-delay="300">
            <div class="content d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-md-6 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="bi bi-emoji-smile"></i>
                    <p><strong>Kepuasan pelanggan</strong> menjadi alasan utama kami untuk terus berinovasi dan berkreasi.</p>
                  </div>
                </div>

                <div class="col-md-6 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="bi bi-input-cursor"></i>
                    <p><strong>Penyediaan lapangan</strong> menjadi semakin luas.</p>
                  </div>
                </div>

                <div class="col-md-6 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="bi bi-clock"></i>
                    <p><strong>Waktu</strong> booking yang dipersingkat.</p>
                  </div>
                </div>

                <div class="col-md-6 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="bi bi-receipt-cutoff"></i>
                    <p><strong>Laporan</strong> yang di sederhanakan untuk mempermudah para penyedia lapangan melakukan recapitulasi</p>
                  </div>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Layanan</h2>
          <p>Aplikasi ini akan melayani anda dibagian</p>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="bx bx-football"></i></div>
              <h4 class="title"><a href="">Pemesanan lapangan</a></h4>
              <p class="description">Memberikan solusi pemesanan lapangan dengan cara modern dan terbaru.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="bx bx-info-circle"></i></div>
              <h4 class="title"><a href="">Informasi lapangan secara real-time</a></h4>
              <p class="description">Memberikan informasi lapangan yang ingin dikunjungi secara langsung dan real-time.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon"><i class="bx bx-cog"></i></div>
              <h4 class="title"><a href="">Aturan antrian</a></h4>
              <p class="description">Algoritma antrian yang cukup membantu aturan dalam memesan, membayar, menunggu.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="bx bx-dollar-circle"></i></div>
              <h4 class="title"><a href="">Pembayaran</a></h4>
              <p class="description">Pembayaran yang langsung dilakukan untuk kepastian pemesanan juga diperlukan.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container">

        <div class="section-title" id="fitur" data-aos="fade-up">
          <h2>Fitur</h2>
          <p>Fitur yang tersediadi aplikasi kami</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="300">
          <div class="col-lg-3 col-md-4">
            <div class="icon-box">
              <i class="ri-home-gear-fill" style="color: #ffbb2c;"></i>
              <h3><a href="">Menyewa Lapangan</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="ri-time-fill" style="color: #5578ff;"></i>
              <h3><a href="">Melihat Jadwal</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="ri-money-dollar-circle-line" style="color: #e80368;"></i>
              <h3><a href="">Pembayaran</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-lg-0">
            <div class="icon-box">
              <i class="ri-information-fill" style="color: #e361ff;"></i>
              <h3><a href="">Informasi Lapangan</a></h3>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Features Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Tim</h2>
          <p>Orang yang bertanggung jawab atas kesuksesan dan keberhasilan aplikasi ini</p>
        </div>

        <div class="row justify-content-center">

          <div class="col-lg-2 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div class="member-img">
                <img src="landing_assets/img/team/team-1.jpeg" class="img-fluid" alt="">
                <div class="social">
                  <a href="https://instagram.com/marsandrafadilla?igshid=ZXhrNWgzc252cG5u"><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-x-lg"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Marsandra Fadilla</h4>
                <span>Team Leader</span>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="200">
              <div class="member-img">
                <img src="landing_assets/img/team/team-2.jpeg" class="img-fluid" alt="">
                <div class="social">
                  <a href="https://instagram.com/hadiannelvie?igshid=ZG5hbjQzbjRrcW1m"><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-x-lg"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Hadian Nelvi</h4>
                <span>General Affair</span>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="300">
              <div class="member-img">
                <img src="landing_assets/img/team/team-3.jpeg" class="img-fluid" alt="">
                <div class="social">
                  <a href="https://instagram.com/raffi07h?igshid=azZ3b2d6dGxrenJt"><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-x-lg"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Ahmad Raffi</h4>
                <span>General Affair</span>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="400">
              <div class="member-img">
                <img src="landing_assets/img/team/team-4.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href="https://instagram.com/iqbal_zulmii?igshid=MXRhOXNuZHczaDFz"><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-x-lg"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>A. Iqbal Zummi</h4>
                <span>Financial Department</span>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="400">
              <div class="member-img">
                <img src="landing_assets/img/team/team-5.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href="https://instagram.com/rayyan.ksy?igshid=MW9iM3Z1c3YweTdjdg=="><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-x-lg"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Rayyan Kaisar</h4>
                <span>Marketing Department</span>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Team Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Frequently Asked Questions</h2>
        </div>

        <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-5">
            <i class="ri-question-line"></i>
            <h4>Apa itu SportsCamp?</h4>
          </div>
          <div class="col-lg-7">
            <p>
              Sportscamp adalah Aplikasi Pemesanan Lapangan Olahraga berbasis mobile yang bertujuan untuk mengubah cara pengguna memesan dan mengelola lapangan olahraga. Aplikasi ini dirancang untuk memudahkan pengguna dalam mencari, memesan, dan mengelola lapangan olahraga secara efisien dan praktis.
            </p>
          </div>
        </div><!-- End F.A.Q Item-->

        <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
          <div class="col-lg-5">
            <i class="ri-question-line"></i>
            <h4>Apa latar belakang dari pembentukan SportsCamp?</h4>
          </div>
          <div class="col-lg-7">
            <p>
              Dalam beberapa tahun terakhir, minat masyarakat terhadap olahraga terus meningkat, yang dimana kebutuhan akan fasilitas lapangan olahraga juga semakin bertambah. Di sisi lain, perkembangan teknologi telah mengubah cara kita berinteraksi salah satunya menciptakan peluang besar untuk mengintegrasikan teknologi ini dalam dunia olahraga khususnya dalam pemesanan lapangan olahraga.
            </p>
          </div>
        </div><!-- End F.A.Q Item-->

        <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
          <div class="col-lg-5">
            <i class="ri-question-line"></i>
            <h4>Kenapa harus menggunakan SportsCamp?</h4>
          </div>
          <div class="col-lg-7">
            <p>
              Karena dengan menggunakan SportsCamp akan mengurangi waktu dan aksi yang dibutuhkan dalam memesan lapangan.
            </p>
          </div>
        </div><!-- End F.A.Q Item-->

      </div>
    </section><!-- End F.A.Q Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Contact Us</h2>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="contact-about">
              <h3>Sports Camp</h3>
              <p>Sportscamp adalah Aplikasi Pemesanan Lapangan Olahraga berbasis mobile yang bertujuan untuk mengubah cara pengguna memesan dan mengelola lapangan olahraga. Aplikasi ini dirancang untuk memudahkan pengguna dalam mencari, memesan, dan mengelola lapangan olahraga secara efisien dan praktis.</p>
              <div class="social-links">
                <a href="https://instagram.com/sportscamp.id?igshid=bDl2bnoxZG1ldHg1" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="twitter"><i class="bi bi-x-lg"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
            <div class="info">
              <div>
                <i class="ri-map-pin-line"></i>
                <p>Batam<br>Kepulauan Riau, Indonesia</p>
              </div>

              <div>
                <i class="ri-mail-send-line"></i>
                <p>sportscampid@gmail.com</p>
              </div>

              <div>
                <i class="ri-phone-line"></i>
                <p>+62 858-3796-7247</p>
              </div>

            </div>
          </div>

          <div class="col-lg-5 col-md-12" data-aos="fade-up" data-aos-delay="300">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="col-lg-6 text-lg-left text-center">
          <div class="copyright">
            &copy; Copyright <strong>SportsCamp</strong>. All Rights Reserved
          </div>
          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/vesperr-free-bootstrap-template/ -->
            Designed by <a href="https://instagram.com/sportscamp.id?igshid=bDl2bnoxZG1ldHg1">GTS Team</a>
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('landing_assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('landing_assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('landing_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('landing_assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('landing_assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('landing_assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('landing_assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="<https://unpkg.com/typeit@@{TYPEIT_VERSION}/dist/index.umd.js>"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('landing_assets/js/main.js') }}"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      new TypeIt(".type", {
        strings: ["This is my string!"],
      }).go();
    });
  </script>

</body>

</html>
