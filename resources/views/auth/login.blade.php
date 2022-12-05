<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Log in | S and m solution Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/logo.jpg">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-stylesheet" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-stylesheet" rel="stylesheet" type="text/css" />

    </head>


    <body class="authentication-bg">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="text-center">
                            <a href="index.html" class="logo">
                                {{-- <img src="assets/images/logo-light.png" alt="" height="100" class="logo-light mx-auto"> --}}
                               {{-- <img src="assets/images/logo-dark.png" alt="" height="100" class="logo-dark mx-auto"> --}}
                            </a>
                            <p class="text-muted mt-2 mb-4">Dashboard</p>
                        </div>
                        <div class="card">

                            <div class="card-body p-4">
                                
                                <div class="text-center mb-4">
                                    <h4 class="text-uppercase mt-0">Sign In</h4>
                                </div>

                                <form action="{{url('post-login')}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control" placeholder="Email"  id="inputEmailAddress" name="email">
                                        <div class="input-group-append">
                                          <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="input-group mb-3">
                                        <input type="password" class="form-control" placeholder="Password" id="inputPassword"  name="password">
                                        <div class="input-group-append">
                                          <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                          </div>
                                        </div>
                                      </div>
                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
    

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>