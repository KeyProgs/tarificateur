<!-- Content area -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Connexion : </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Advanced login -->

                        @if (strpos(request(), 'espace-client/connexion') !== false)
                          <form method="POST" action="{{ route('login.client') }}">
                        @else
                          <form method="POST" action="{{ route('login') }}">
                        @endif

                                @csrf

                                <input id="has_client_login" type="hidden" name="has_client_login">

                                <div class="panel panel-body login-form">
                                    <div class="text-center">
                                        <div class="icon-object border-slate-300 text-slate-300"><i
                                                    class="icon-lock"></i></div>
                                        <h5 class="content-group">Connexion Workspace
                                            <small class="display-block">Vos identifiants
                                            </small>
                                        </h5>
                                    </div>

                                    <div class="form-group has-feedback has-feedback-left">
                                        <!--<input type="text" class="form-control" placeholder="Username">-->
                                        <input id="email" type="text"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email"
                                               value="{{ old('email') }}" autofocus placeholder="Email">

                                        <div class="form-control-feedback">
                                            <i class="icon-user text-muted"></i>
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback error-msg text-danger">
                                        <strong>- {{ $errors->first('email') }}</strong>
                                </span>
                                        @endif

                                    </div>

                                    <div class="form-group has-feedback has-feedback-left">
                                        <!--<input type="password" class="form-control" placeholder="Password">-->
                                        <input id="password" name="password" type="password"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               placeholder="Mot de passe">

                                        <div class="form-control-feedback">
                                            <i class="icon-lock2 text-muted"></i>
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback error-msg text-danger">
                                        <strong>- {{ $errors->first('password') }}</strong>
                                </span>
                                        @endif
                                    </div>

                                    <div class="form-group login-options">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="checkbox-inline">
                                                    <input class="styled" type="checkbox" name="remember"
                                                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    Rester connecté
                                                </label>
                                            </div>

                                            <div class="col-sm-6 text-right">
                                                <!--<a href="login_password_recover.html">Forgot password?</a>-->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn bg-info btn-block">
                                            {{ __('Ouvrire la session') }} <i class="icon-unlocked2 position-right"></i>
                                        </button>
                                    </div>


                                </div>
                            </form>
                            <!-- /advanced login -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- /content area -->

