<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register Sittok</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="login/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body style="background-color: #d2afff">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg" style="margin-top: 107px;">
       
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
               
                <div class="row">
                    

                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form action="{{ route('register')}}" method="POST" class="user">
                                @csrf
                    <div class="form-group"> 
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                      <label for="txt_user_email">Email</label>
                      <input type="text" class="form-control" name="email" placeholder="Masukkan Email">
                    </div>
                    <div class="form-group">
                      <label for="txt_user_password">Password</label>
                      <input type="password" class="form-control" name="password" placeholder="Masukkan Password">
                    </div>
                    <div class="form-group">
                      <label for="txt_user_fullname">Nama</label>
                      <input type="text" class="form-control" name="user_fullname" placeholder="Masukkan Nama">
                    </div>
                    <div class="form-group">
                      <label for="txt_alamat">Alamat</label>
                      <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat">
                    </div>
                    <button type="submit" name="create" class="btn btn-primary">Submit</button>
                  </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('loginn')}}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="login/js/sb-admin-2.min.js"></script>

</body>

</html>