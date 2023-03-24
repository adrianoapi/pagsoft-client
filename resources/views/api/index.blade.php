@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">API</h4></h4>
                    </div>
                    <div class="card-body table-full-width table-responsive">

                    <div class="card-body">

                        <h5>Login</h5>

                        <ul>
                            <li>POST http://pagsoft.com.br/api/auth/login</li>
                            <li>body

                                <ul>
                                    <li>email: seu email</li>
                                    <li>password: sua senha</li>
                                </ul>
                            </li>
                        </ul>

                        Exemplo de resposta JSON:
                        <pre>
                            {
                                "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTY3NTAzODc3MiwiZXhwIjoxNjc1MDQyMzcyLCJuYmYiOjE2NzUwMzg3NzIsImp0aSI6ImZZcVRjWW5YeVlBcndaRUMiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.2nSNvwH8R6JtjJOLWpmKQyp2KM8c9OPx5KW1KIidlFA",
                                "token_type": "bearer",
                                "expires_in": 3600
                            }
                        </pre>

                        <hr>

                        <h5>Senhas</h5>

                        <strong>GET</strong>
                        <ul>
                            <li>GET http://pagsoft.com.br/api/password</li>
                            <li>Authorization: Bearer Token</li>
                            <li>Token
                                <ul>
                                    <li>access_token</li>
                                </ul>
                            </li>
                        </ul>

                        <strong>POST</strong>
                        <ul>
                            <li>POST http://pagsoft.com.br/api/password</li>
                            <li>Authorization: Bearer Token</li>
                            <li>Token
                                <ul>
                                    <li>access_token</li>
                                </ul>
                            </li>
                            <li>Body
                                <ul>
                                    <li>raw: json</li>
                                    <li>{
                                        "title": "kindle",
                                        "login": "usuario.abc",
                                        "pass": "123456",
                                        "url": "kindle.com"
                                    }</li>
                                </ul>
                            </li>
                        </ul>

                        <strong>PUT</strong>
                        <ul>
                            <li>PUT http://pagsoft.com.br/api/password/123</li>
                            <li>Authorization: Bearer Token</li>
                            <li>Token
                                <ul>
                                    <li>access_token</li>
                                </ul>
                            </li>
                            <li>Body
                                <ul>
                                    <li>raw: json</li>
                                    <li>{
                                        "title": "kindle",
                                        "login": "usuario@133",
                                        "pass": "abc123",
                                        "url": "kindle.com"
                                    }</li>
                                </ul>
                            </li>
                        </ul>

                        <strong>DELETE</strong>
                        <ul>
                            <li>DELETE http://pagsoft.com.br/api/password/123</li>
                            <li>Authorization: Bearer Token</li>
                            <li>Token
                                <ul>
                                    <li>access_token</li>
                                </ul>
                            </li>
                        </ul>

                        <a href="{{Route('login')}}">Voltar</a>
                        
                    </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
