@extends('app.base')

@section('content')
<nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky" id="navbarBlur" data-scroll="true">
  <div class="container-fluid py-1 px-3">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="nav-item">
        <a href="javascript:history.back()"><span class="material-symbols-outlined">arrow_back</span></a>
      </li>
      &nbsp;&nbsp;&nbsp;
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
<div class="container-fluid px-2 px-md-4">
  <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
    <span class="mask  bg-gradient-primary  opacity-6"></span>
  </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
                <div data-initials="
                  <?php
                    $nombre = explode(" ", $usuario->nombre);
                    $iniciales = substr($nombre[0], 0, 1) ." ". substr($nombre[1], 0, 1);
                    echo $iniciales;
                  ?>
                ">
                </div>
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                {{ $usuario->nombre }}
              </h5>
              <p class="mb-0 font-weight-normal text-sm">
                {{ $usuario->correo }}
              </p>
            </div>
          </div>
        </div>
    </div>
<br/>
<?php $posts = DB::table('post')->select('*')->where('idusuario', '=', $usuario->id)->get() ?>
<?php if(count($posts) == 0) { ?>
<h6>Este usuario aún no ha publicado nada</h6>
<?php } else { ?>
<h6>Últimos posts</h6>
<div class="row">
  <div class="col-12">
      <div class="card">
        <div class="table-responsive">
          <table class="table align-items-center mb-0">
            <tbody>
              @foreach($posts as $post)
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <a href="{{ url('usuario/'.$usuario->id) }}">
                        <div data-initials="
                          <?php
                            $nombre = explode(" ", $usuario->nombre);
                            $iniciales = substr($nombre[0], 0, 1) ." ". substr($nombre[1], 0, 1);
                            echo $iniciales;
                          ?>
                        ">
                        </div>
                      </a>
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-xs">{{ $usuario->nombre }}</h6>
                      <p class="text-xs text-secondary mb-0">{{ $usuario->correo }}</p>
                    </div>
                  </div>
                </td>
                <td>
                  <h6  class="mb-0 text-xs">{{ $post->titulo }}</h6>
                </td>
                <td>
                  <div class="d-flex flex-column justify-content-center">
                      <?php $categorias = DB::table('categoria')->select('*')->where('id', '=', $post->idcategoria)->get() ?>
                      @foreach($categorias as $categoria)
                        <h6 class="mb-0 text-xs">Categoría: <span class="text-xs font-weight-bold mb-0">{{ $categoria->nombre }}</span></h6>
                      @endforeach
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
  <?php } ?>
</div>
</div>
@endsection