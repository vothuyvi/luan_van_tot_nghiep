@extends('layout')
<section class="vh-100 gradient-custom">
    <form action="" method="post" role="form">
        @csrf
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="text-white-50 mb-5">Please enter your login and password!</p>
                        @if(Session::has('error'))
                            <div class="alert alert-danger">
                                <span type="button" class="" data-dismiss="alert" aria-hidden="true"></span>
                                {{Session::get('error')}}
                            </div>
                        @endif

                        @if(Session::has('success'))
                                <div class="alert alert-success">
                                    <span type="button" data-dismiss="alert" aria-hidden="true"></span>
                                    {{Session::get('success')}}
                                </div>
                        @endif
                                    <div class="form-outline form-white mb-4">
                                        <input type="email" id="typeEmailX" class="form-control form-control-lg"name='email' />
                                        @if($errors->has('email'))
                                        <span class="error-text">
                                            {{$errors->first('email')}}
                                        </span>
                                             @endif
                                     </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="typePasswordX" class="form-control form-control-lg" name="password"/>
                                        @if($errors->has('password'))
                                        <span class="error-text">
                                            {{$errors->first('password')}}
                                        </span>
                                             @endif
                                    </div>

                                    <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>


                                <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                    <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                    <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                    <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                </div>

                            </div>

                            <div>
                                <p class="mb-0">Don't have an account? <a href="#!" class="text-white-50 fw-bold">Sign Up</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</section>
