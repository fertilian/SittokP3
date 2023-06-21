<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Sittok</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="login/css/sb-admin-2.min.css" rel="stylesheet">

    <script>
        $(document).ready(function(){       
            $('.form-checkbox').click(function(){
                if($(this).is(':checked')){
                    $('.form-password').attr('type','text');
                }else{
                    $('.form-password').attr('type','password');
                }
            });
        });
    </script>

</head>

<body style="background-image: url('assets/img/bg.png');">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg" style="margin-top: 125px;">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6" class="text-center"><img src="/assets/img/logo/sittok-gambar.png" style="margin-top: 50px;" style="margin-right: 5px;" align="center" class="mx-auto d-block" width="250px" ></div>
                            
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang di Sittok!</h1>
                                    </div>
                                    @if(Session::has('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('success') }}
                                    </div>
                                    @endif
                                    @if(Session::has('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ Session::get('error') }}
                                    </div>
                                    @endif
                                    <form class="user" action="{{ route('loginn')}}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="txt_email" aria-describedby="emailHelp"
                                                placeholder="Masukkan Alamat Email" name="email" autocomplete="off">
                                        </div>
                                    
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="txt_pass" placeholder="Masukkan Password" name="password" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="show_password" name="show_password">
                                                <label class="custom-control-label" for="show_password">Tampilkan Password</label>
                                            </div>
                                        </div>
                                        <button type="submit" name="login" class="btn-user btn-block" style="background-color:#d2afff;">Login</button>
                                    </form>
                                    <hr>
                                </div>
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

    <script type="text/javascript">
        $(document).ready(function(){  
            $('#show_password').on('click', function(){  
                var passwordField = $('#password');  
                var passwordFieldType = passwordField.attr('type');
                if(passwordField.val() != '')
                {
                    if(passwordFieldType == 'password')  
                    {  
                        passwordField.attr('type', 'text');  
                        $(this).text('Hide Password');  
                    }  
                    else  
                    {  
                        passwordField.attr('type', 'password');  
                        $(this).text('Show Password');  
                    }
                }
                else
                {
                    alert("Please Enter Password");
                }
            });  
        }); 
    </script>
</body>

</html>