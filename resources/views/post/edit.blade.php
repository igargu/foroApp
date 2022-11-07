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
<div class="row">
    <div class="col-sm"></div>
    <div class="col-sm">
        <div class="nav-wrapper position-relative end-0">
            @if ($errors->any())
                <div class="alert alert-danger">
                    El post no se ha podido editar, por favor corrige los errores.
                </div>
                @error('store')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            @endif
            <div class="card">
              <div class="card-body">
                <div class="text-center">
                    <h3>Editar post</h3>
                </div>
                <form action ="{{ url('post/' . $post->id) }}" method="post" role="form" class="text-start">
                  @csrf
                  @method('put')
                  <div class="input-group input-group-static mb-4">
                    <label>Título</label>
                    <input class="form-control" type="text" name="titulo" id="titulo" minlength="1" maxlength="100" value="{{ old('titulo', $post->titulo) }}" required>
                    @error('titulo')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="input-group input-group-static mb-4">
                    <label>Mensaje</label>
                    <input class="form-control" type="text" name="mensaje" id="mensaje" minlength="1" maxlength="200" value="{{ old('mensaje', $post->mensaje) }}" required>
                    @error('mensaje')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  
                  <input class="form-control" type="text" name="idusuario" id="idusuario" value="{{ session()->get('usuario')->id }}" hidden>
                 
                  <label for="categoria">Categoría:</label>
                  <select class="dropdown" name="idcategoria" id="idcategoria">
                    <?php 
                      $categorias = DB::select('select * from categoria order by nombre');
                    ?>
                    @foreach($categorias as $categoria)
                      <option class="dropdown-item" value="{{ $categoria->id }}" <?php if($categoria->id == $post->idcategoria) echo 'selected="selected"' ?> >{{ $categoria->nombre }}</option>
                    @endforeach()
                  </select>
                  <br/><br/>
                  <form action="{{ url('post/'. $post->id ) }}" method="put">
                    @method('put')
                    @csrf
                    <input type="submit" class="btn btn-primary" value="Confirmar cambios"/>
                  </form>
                </form>
              </div>
            </div>
        </div>
    </div>
    <div class="col-sm"></div>
</div>
@endsection