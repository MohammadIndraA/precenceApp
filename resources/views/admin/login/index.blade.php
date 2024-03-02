<!-- ========================================================= * Soft UI
Dashboard - v1.0.7 ========================================================= *
Product Page: https://www.creative-tim.com/product/soft-ui-dashboard * Copyright
2023 Creative Tim (https://www.creative-tim.com) * Licensed under MIT
(https://www.creative-tim.com/license) * Coded by Creative Tim
========================================================= * The above copyright
notice and this permission notice shall be included in all copies or substantial
portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link
                rel="apple-touch-icon"
                sizes="76x76"
                href="template/assets/img/apple-icon.png">
                <link rel="icon" type="image/png" href="template/assets/img/favicon.png">
                    <title>
                       Smart Precence
                    </title>
                    <!-- Fonts and icons -->
                    <link
                        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
                        rel="stylesheet"/>
                    <!-- Nucleo Icons -->
                    <link href="template/assets/css/nucleo-icons.css" rel="stylesheet"/>
                    <link href="template/assets/css/nucleo-svg.css" rel="stylesheet"/>
                    <!-- Font Awesome Icons -->
                    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
                    <link href="template/assets/css/nucleo-svg.css" rel="stylesheet"/>
                    <!-- CSS Files -->
                    <link
                        id="pagestyle"
                        href="template/assets/css/soft-ui-dashboard.css?v=1.0.7"
                        rel="stylesheet"/>
                    <!-- Nepcha Analytics (nepcha.com) -->
                    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with
                    GDPR, CCPA and PECR. -->
                    <script
                        defer="defer"
                        data-site="YOUR_DOMAIN_HERE"
                        src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
                </head>

                <body class="">
                    <div class="container position-sticky z-index-sticky top-0">
                        <div class="row">
                            <div class="col-12">
                                <!-- Navbar -->
                                <nav
                                    class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                                    <div class="container-fluid pe-0">
                                        <a
                                            class="navbar-brand font-weight-bolder ms-lg-0 ms-3 "
                                            href="template/pages/dashboard.html">
                                            Selamat datang di Smart Precence WEB
                                        </a>
                                        <button
                                            class="navbar-toggler shadow-none ms-2"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#navigation"
                                            aria-controls="navigation"
                                            aria-expanded="false"
                                            aria-label="Toggle navigation">
                                            <span class="navbar-toggler-icon mt-2">
                                                <span class="navbar-toggler-bar bar1"></span>
                                                <span class="navbar-toggler-bar bar2"></span>
                                                <span class="navbar-toggler-bar bar3"></span>
                                            </span>
                                        </button>
                                    </div>
                                </nav>
                                <!-- End Navbar -->
                            </div>
                        </div>
                    </div>
                    <main class="main-content  mt-0">
                        <section>
                            <div class="page-header min-vh-75">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                                            <div class="card card-plain mt-8">
                                                <div class="card-header pb-0 text-left bg-transparent">
                                                    <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                                                    <p class="mb-0">Enter your email and password to sign in</p>
                                                </div>
                                                <div class="card-body">
                                                    <form method="POST" action="" class="form-login">
                                                        @csrf
                                                        <label>Email</label>
                                                        <div class="mb-3">
                                                            <input
                                                            name="nisp"
                                                                class="form-control nisp"
                                                                placeholder="Email"
                                                                aria-label="Email"
                                                                aria-describedby="email-addon" required></div>
                                                            <label>Password</label>
                                                            <div class="mb-3">
                                                                <input
                                                                name="password"
                                                                    class="form-control password"
                                                                    placeholder="Password"
                                                                    aria-label="Password"
                                                                    aria-describedby="password-addon" required></div>
                                                                    <div class="text-center">
                                                                        <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                                                <p class="mb-4 text-sm mx-auto">
                                                                    Don't have an account?
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                                            <div
                                                                class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                                                style="background-image:url('template/assets/img/curved-images/curved6.jpg')"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </main>
                                <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS &
                                COPYRIGHT ------- -->
                                <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS &
                                COPYRIGHT ------- -->
                                <!-- Core JS Files -->
                                <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
                                <script src="template/assets/js/core/popper.min.js"></script>
                                <script src="template/assets/js/core/bootstrap.min.js"></script>
                                <script src="template/assets/js/plugins/perfect-scrollbar.min.js"></script>
                                <script src="template/assets/js/plugins/smooth-scrollbar.min.js"></script>
                                <script>
                                    var win = navigator
                                        .platform
                                        .indexOf('Win') > -1;
                                    if (win && document.querySelector('#sidenav-scrollbar')) {
                                        var options = {
                                            damping: '0.5'
                                        }
                                        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
                                    }
                                </script>
                                <!-- Github buttons -->
                                <script async="async" defer="defer" src="https://buttons.github.io/buttons.js"></script>
                                <!-- Control Center for Soft Dashboard: parallax effects, scripts for the
                                example pages etc -->
                                <script src="template/assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
                                <script>
                                    $(function(){
                                        $('.form-login').submit(function(e) {
                                            e.preventDefault();
                                            const nisp = $('.nisp').val(); // Gunakan .val() untuk mendapatkan nilai elemen input
                                            const password = $('.password').val();
                                            const csrf_token = $('meta[name="csrf-token"]').attr('content');
                                            
                                            $.ajax({
                                                url: 'login/admin',
                                                type: 'POST',
                                                data: {
                                                    nisp: nisp,
                                                    password: password,
                                                    _token: csrf_token
                                                },
                                                success: function(data){
                                                    if (data != null) {
                                                        // Tampilkan pesan Bootstrap jika login berhasil
                                                        $('.alert').html('<div class="alert alert-warning" role="alert">Terimakasih Sudah Login</div>');
                                                        
                                                        // Tetapkan nilai custom.api_token (asumsi ini adalah pengaturan konfigurasi)
                                                        // Catatan: Ini hanya akan berhasil jika 'config' adalah fungsi yang telah Anda tentukan di tempat lain
                                                        // config(['custom.api_token' => data.token]);
                                
                                                        // Alihkan ke halaman admin
                                                        localStorage.setItem('token', data.token)
                                                        window.location.href = '/admin';
                                                    } else {
                                                        // Log error untuk debugging
                                                        alert('Usernama Atau Password Salah');
                                                    }
                                                },
                                                error: function(xhr, status, error) {
                                                    // Log error untuk debugging
                                                    alert('Usernama Atau Password Salah');
                                                 
                                                    console.error(error);
                                                }
                                            });
                                        });
                                    });
                                </script>
                                                               
                                    
                            </body>

                        </html>