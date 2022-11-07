@extends('app.base')

@section('content')
{{-- @parent --}}
<nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky" id="navbarBlur" data-scroll="true">
  <div class="container-fluid py-1 px-3">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="nav-item">
        ¡Hola <b>{{ session()->get('usuario')->nombre }}</b>!
      </li>
    </ol>
    <ul class="navbar-nav  justify-content-end">
      <li class="nav-item">
        <a href="{{ url('usuario/'.session()->get('usuario')->id) }}">Mi perfil</a>
      </li>
      &nbsp;&nbsp;&nbsp;
      <li class="nav-item">
        <a href="{{ url('/') }}">Cerrar sesión</a>
      </li>
    </ul>
  </div>
</nav>
<div class="row">
  <div class="col-12">
    <div class="card my-4">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
          <h6 class="text-white text-capitalize ps-3">Últimos posts</h6>
        </div>
      </div>
      <div class="card">
        <div class="table-responsive">
          <table class="table align-items-center mb-0">
            <tbody>
              @foreach($posts as $post)
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <a href="{{ url('usuario/'.$post->usuario->id) }}">
                        <div data-initials="
                          <?php
                            $nombre = explode(" ", $post->usuario->nombre);
                            $iniciales = substr($nombre[0], 0, 1) ." ". substr($nombre[1], 0, 1);
                            echo $iniciales;
                          ?>
                        ">
                        </div>
                      </a>
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-xs">{{ $post->usuario->nombre }}</h6>
                      <p class="text-xs text-secondary mb-0">{{ $post->usuario->correo }}</p>
                    </div>
                  </div>
                </td>
                <td>
                  <h6  class="mb-0 text-xs">{{ $post->titulo }}</h6>
                </td>
                <td>
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-xs">Categoría: <span class="text-xs font-weight-bold mb-0">{{ $post->categoria->nombre }}</span></h6>
                  </div>
                </td>
                <td>
                  <div class="d-flex flex-column justify-content-center">
                    <?php $numComentarios = DB::table('comment')->select('*')->where('idpost', '=', $post->id)->get() ?>
                    <h6  class="mb-0 text-xs">Comentarios: <span class="text-xs font-weight-bold mb-0">{{ count($numComentarios) }}</span></h6>
                  </div>
                </td>
                <td class="align-middle">
                  <a href="{{ url('post/' . $post->id) }}" class="text-secondary font-weight-bold mb-0" data-toggle="tooltip" data-original-title="ver-post">
                    Ver post
                  </a>
                </td>
              </tr>
              @endforeach()
            </tbody>
          </table>
        </div>
      </div>
    </div>  
  </div>
</div>
<footer class="footer py-4  ">
  <div class="container-fluid">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-12">
        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
          <li class="nav-item">
            <a href="{{ url('post/create') }}">
              <button class="btn btn-icon btn-2 btn-primary" type="button">
                Publicar post
              </button>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>
@endsection