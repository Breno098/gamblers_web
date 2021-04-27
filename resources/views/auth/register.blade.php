@extends('auth.layout')

@section('content')
    <div id="intro" class="bg-image shadow-2-strong">
        <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.8);">
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-xl-5 col-md-8">

                <form class="bg-white rounded shadow-5-strong p-5" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-outline mb-4">
                    <input name="email" type="email" id="form1Example1" class="form-control" value="breno@email.com"/>
                    <label class="form-label" for="form1Example1">Email</label>
                </div>

                <div class="form-outline mb-4">
                    <input name="password" type="password" id="form1Example2" class="form-control" />
                    <label class="form-label" for="form1Example2">Senha</label>
                </div>

                <div class="form-outline mb-4">
                    <input name="password" type="confirm_password" id="form1Example2" class="form-control" />
                    <label class="form-label" for="form1Example2">Confirmar senha</label>
                </div>

                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                        <label class="form-check-label" for="form1Example3">
                        Lembrar
                        </label>
                    </div>
                    </div>

                    <div class="col text-center">
                    <a href="#!">Esqueceu a senha?</a>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>

    <footer class="bg-light text-lg-start">
        <div class="py-4 text-center">
            <a role="button" class="btn btn-primary btn-lg m-2"
            href="https://www.youtube.com/channel/UC5CF7mLQZhvx8O5GODZAhdA" rel="nofollow" target="_blank">
            Learn Bootstrap 5
            </a>
            <a role="button" class="btn btn-primary btn-lg m-2" href="https://mdbootstrap.com/docs/standard/" target="_blank">
            Download MDB UI KIT
            </a>
        </div>

        <hr class="m-0" />

        <div class="text-center py-4 align-items-center">
            <p>Follow MDB on social media</p>
            <a href="https://www.youtube.com/channel/UC5CF7mLQZhvx8O5GODZAhdA" class="btn btn-primary m-1" role="button"
            rel="nofollow" target="_blank">
            <i class="fab fa-youtube"></i>
            </a>
            <a href="https://www.facebook.com/mdbootstrap" class="btn btn-primary m-1" role="button" rel="nofollow"
            target="_blank">
            <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/MDBootstrap" class="btn btn-primary m-1" role="button" rel="nofollow"
            target="_blank">
            <i class="fab fa-twitter"></i>
            </a>
            <a href="https://github.com/mdbootstrap/mdb-ui-kit" class="btn btn-primary m-1" role="button" rel="nofollow"
            target="_blank">
            <i class="fab fa-github"></i>
            </a>
        </div>

        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2020 Copyright:
            <a class="text-dark" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
    </footer>

@endsection
