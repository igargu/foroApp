@extends('app.base')

@section('content')
<main class="main-content  mt-0">
  <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
  <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container my-auto">
      <div class="row">
        <div class="col-sm"></div>
        <div class="col-sm">
          <div class="nav-wrapper position-relative end-0">
            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#pills-login" role="tab" aria-controls="login" aria-selected="true">Iniciar sesión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#pills-register" role="tab" aria-controls="registro" aria-selected="false">Registrarse</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
                <div class="card">
                  <div class="card-body">
                    <div class="text-center">
                        <h3>Iniciar sesión</h3>
                    </div>
                    <form action="{{ url('usuario/login') }}" method="post">
                      @csrf
                      <div class="input-group input-group-static mb-4">
                        <label>Email</label>
                        <input type="email" class="form-control" name="login-correo" id="login-correo">
                      </div>
                      @error('login-correo')
                        <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                      <form action="{{ url('usuario/login') }}" method="post">
                        @csrf
                        <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Iniciar sesión</button>
                      </form>
                    </form>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab">
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
                  <div class="card">
                    <div class="card-body">
                      <div class="text-center">
                          <h3>Registrarse</h3>
                      </div>
                      <form action="{{ url('usuario') }}" method="post">
                        @csrf
                        <div class="input-group input-group-static mb-4">
                          <label>Nombre</label>
                          <input type="text" class="form-control" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
                        </div>
                        @error('nombre')
                          <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="input-group input-group-static mb-4">
                          <label>Email</label>
                          <input type="email" class="form-control" name="correo" id="correo" value="{{ old('correo') }}" required>
                        </div>
                        @error('correo')
                          <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="input-group input-group-static mb-4">
                          <label>Fecha de nacimiento</label>
                          <input type="date" class="form-control" name="fechaNacimiento" id="fechaNacimiento" value="{{ old('fechaNacimiento') }}" required>
                        </div>
                        @error('fechaNacimiento')
                          <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="text-center">
                          <form action="{{ url('usuario') }}" method="post">
                            @csrf
                            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Registrarse</button>
                          </form>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm"></div>
      </div>
    </div>
  </div>
</main>
@endsection