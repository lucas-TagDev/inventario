@extends('layouts.app')

@section('content')

<div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Redefinir Senha</h3></div>
                                    <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                        <div class="small mb-3 text-muted">Enviaremos um link para o seu email para que possa redefinir sua senha.</div>
                                        <form method="POST" action="{{ route('password.email') }}">
                                            @csrf
                                            <div class="form-floating mb-3">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <label for="inputEmail">Email</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="{{ route('login') }}">Retornar ao login</a>
                                                <button type="submit" class="btn btn-primary">
                                                    Enviar Link de Refinição
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="{{ route('register') }}">Você não possui uma conta? Registre-se!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection

