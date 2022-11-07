@extends('app.base')

@section('content')
<nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky" id="navbarBlur" data-scroll="true">
  <div class="container-fluid py-1 px-3">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="nav-item">
        <a href="{{ url('post') }}"><span class="material-symbols-outlined">arrow_back</span></a>
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
<br/><br/><br/>
<div class="row">
    <div class="col-sm"></div>
    <div class="col-sm">
        <div class="nav-wrapper position-relative end-0">
          <!-- POST -->
          <div class="card card-body mx-3 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
              <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
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
              </div>
              <div class="col-auto my-auto">
                <div class="h-100">
                  <h5 class="mb-1">
                    {{ $post->usuario->nombre }}
                  </h5>
                  <p class="mb-0 font-weight-normal text-sm">
                    {{ $post->usuario->correo }}
                  </p>
                  <h6 class="mb-1">
                    Categoría: 
                    <span class="mb-0 font-weight-normal text-sm">
                      {{ $post->categoria->nombre }}
                    </span>
                  </h6>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h4>{{ $post->titulo }}</h4>
              <p>{{ $post->mensaje }}</p>
              <!-- EDITAR Y BORRAR POST -->
              <?php if (session()->get('usuario')->id == $post->idusuario) { ?>
                <?php 
                  $minutes_to_add = 5;
                  $time = new DateTime($post->created_at);
                  $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                  $stamp = $time->format('Y-m-d H:i');
                ?>
                <a href="{{ url('post/'.$post->id.'/edit') }}" class="text-secondary font-weight-normal text-xs"
                  <?php echo ($stamp < date('Y-m-d H:i')) ? 'style="pointer-events: none"' 
                                                          : '' ?>>Editar post</a>
                &nbsp;&nbsp;&nbsp;
                <a href="javascript: void(0);" 
                   data-bs-toggle="modal" 
                   data-bs-target="#ModalBorrarPost"
                   class="text-secondary font-weight-normal text-xs"
                   <?php echo ($stamp < date('Y-m-d H:i')) ? 'style="pointer-events: none"' 
                                                           : '' ?>>Borrar post</a>
                <!-- Modal -->
                <div class="modal fade" id="ModalBorrarPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title font-weight-normal" id="exampleModalLabel">¿Seguro que deseas borrar este post?</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p><b>{{ $post->titulo }}</b></p>
                      </div>
                      <div class="modal-footer">
                        <form action="{{ url('post/' . $post->id) }}" method="post">
                          @csrf
                          @method('delete')
                          <div class="modal-body">
                            <button type="button" class="btn bg-gradient-primary" data-bs-dismiss="modal">Cancelar</button>
                            <form action="{{ url('post' . $post->id) }}" method="post">
                              @method('delete')
                              @csrf
                              <button type="submit" class="btn bg-gradient-primary">Confirmar</button>
                            </form>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
          <br/><br/>
          <!-- INPUT COMENTARIO -->
          <form action="{{ url('comment') }}" method="post">
            @csrf
            <div class="row d-flex align-items-center">
              <div class="col-9">
                <div class="input-group input-group-static mb-4">
                  <label>Añadir comentario</label>
                  <input type="text" class="form-control" name="mensaje" id="mensaje" minlength="1" maxlength="200" value="{{ old('mensaje') }}" required>
                  @error('mensaje')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <input class="form-control" type="text" name="idpost" id="idpost" value="{{ $post->id }}" hidden>
                <input class="form-control" type="text" name="idusuario" id="idusuario" value="{{ session()->get('usuario')->id }}" hidden>
              </div>
              <div class="col-3">
                <form action="{{ url('comment') }}" method="post">
                  @csrf
                  <button type="submit" class="btn bg-gradient-primary">Publicar</button>
                </form>
              </div>
            </div>
          </form>
          <br/>
          <!-- COMENTARIOS -->
          <?php $numComentarios = DB::table('comment')->select('*')->where('idpost', '=', $post->id)->get() ?>
          <h5>Comentarios: {{count($numComentarios)}}</h5>
          <table class="table align-items-center mb-0">
            <tbody>
              <?php 
                $comentarios = DB::select('select * from comment where idpost = :id', ['id' => $post->id]);
              ?>
              @foreach($comentarios as $comentario)
                <tr>
                  <td>
                    <?php 
                      $usuarios = DB::select('select * from usuario where id = :id', ['id' => $comentario->idusuario]);
                    ?>
                    @foreach($usuarios as $usuario)
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
                    @endforeach()
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{ $comentario->mensaje }}</p>
                  </td>
                  <?php if (session()->get('usuario')->id == $comentario->idusuario) { ?>
                    <td class="align-middle">
                      <?php 
                        $minutes_to_add = 5;
                        $time = new DateTime($comentario->created_at);
                        $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                        $stamp = $time->format('Y-m-d H:i');
                      ?>
                      <a href="#" class="text-secondary font-weight-normal text-xs" data-bs-toggle="modal" 
                         data-bs-target="#ModalEditarComentario-<?php echo $comentario->id ?>" 
                         <?php if ($stamp < date('Y-m-d H:i')) echo 'style="pointer-events: none"' ?>>
                        Editar comentario
                      </a>
                      <!-- Modal -->
                      <div class="modal fade" id="ModalEditarComentario-<?php echo $comentario->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Editar comentario</h5>
                              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="{{ url('comment/' . $comentario->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="modal-body">
                                  <div class="input-group input-group-static mb-4">
                                    <label>Editar comentario</label>
                                    <input type="text" class="form-control" name="mensaje" id="mensaje" minlength="1" maxlength="200" value="{{ old('mensaje', $comentario->mensaje) }}" required>
                                    @error('mensaje')
                                      <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                  </div>
                                  <input class="form-control" type="text" name="idpost" id="idpost" value="{{ $post->id }}" hidden>
                                  <input class="form-control" type="text" name="idusuario" id="idusuario" value="{{ session()->get('usuario')->id }}" hidden>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn bg-gradient-primary" data-bs-dismiss="modal">Cancelar</button>
                                  <form action="{{ url('comment' . $comentario->id) }}" method="post">
                                    @method('put')
                                    @csrf
                                    <button type="submit" class="btn bg-gradient-primary">Confirmar cambios</button>
                                  </form>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle">
                      <a href="#" class="text-secondary font-weight-normal text-xs" data-bs-toggle="modal" 
                         data-bs-target="#ModalBorrarComentario-<?php echo $comentario->id ?>"
                         <?php if ($stamp < date('Y-m-d H:i')) echo 'style="pointer-events: none"' ?>>
                        Borrar comentario
                      </a>
                      <!-- Modal -->
                      <div class="modal fade" id="ModalBorrarComentario-<?php echo $comentario->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title font-weight-normal" id="exampleModalLabel">¿Seguro que deseas borrar este comentario?</h5>
                              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p><b>{{ $comentario->mensaje }}</b></p>
                            </div>
                            <div class="modal-footer">
                              <form action="{{ url('comment/' . $comentario->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <div class="modal-body">
                                  <button type="button" class="btn bg-gradient-primary" data-bs-dismiss="modal">Cancelar</button>
                                  <form action="{{ url('comment' . $comentario->id) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn bg-gradient-primary">Confirmar</button>
                                  </form>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  <?php } ?>
                </tr>
              @endforeach()
            </tbody>
          </table>
        </div>
    </div>
    <div class="col-sm"></div>
</div>
@endsection