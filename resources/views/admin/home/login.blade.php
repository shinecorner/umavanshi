@extends('admin.layouts.login')

@section('content')
@parent
<div class="container">

    {!! Form::open(array('route' => 'do_login','class' => 'form-signin')) !!}
    <div class="form-signin-heading text-center">
        <h1 class="sign-title">Sign In</h1>
        <img src="/images/login-logo.png" alt=""/>
    </div>    
    <div class="login-wrap">
        @if (count($errors) > 0)
        <div class="alert alert-block alert-danger fade in">
            <button type="button" class="close close-sm" data-dismiss="alert">
                <i class="fa fa-times"></i>
            </button>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
        @endif
        {!! Form::text('username', Input::old('username'), array('placeholder' => 'User ID','class' => 'form-control', 'autofocus' => true)) !!}        
        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}                

        {!! Form::submit('Submit',array('class'=>'btn btn-lg btn-login btn-block')) !!}


        <!--                    <div class="registration">
                                Not a member yet?
                                <a class="" href="registration.html">
                                    Signup
                                </a>
                            </div>
                            <label class="checkbox">
                                <input type="checkbox" value="remember-me"> Remember me
                                <span class="pull-right">
                                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>
        
                                </span>
                            </label>-->

    </div>

    <!-- Modal -->
    <!--                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Forgot Password ?</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Enter your e-mail address below to reset your password.</p>
                                    <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
    
                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                                    <button class="btn btn-primary" type="button">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>-->
    <!-- modal -->

    {!! Form::close() !!}

</div>
@endsection