@extends('app.base')

@section('content')
<div class="row">
    <div class="col-sm"></div>
    <div class="col-sm">
        <div class="nav-wrapper position-relative end-0">
            @if ($errors->any())
                <div class="alert alert-danger">
                    El post no se ha podido publicar, por favor corrige los errores.
                </div>
                @error('store')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            @endif
            <div class="card">
              <div class="card-body">
                <div class="text-center">
                    <h3>Comentar post</h3>
                </div>
                <form action="{{ url('comment') }}" method="post">
                    @csrf
                    <div class="input-group input-group-outline my-3">
                      <label class="form-label">Añadir comentario</label>
                      <input type="text" class="form-control" name="mensaje" id="mensaje" minlength="1" maxlength="200" value="{{ old('mensaje') }}" required>
                      @error('mensaje')
                        <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <?php 
                      $posts = DB::select('select * from post where id = :id', ['id' => 1]);
                    ?>
                    <input class="form-control" type="text" name="idpost" id="idpost" value="{{ $post->id }}" hidden>
                    <input class="form-control" type="text" name="idusuario" id="idusuario" value="1" hidden>
                    <form action="{{ url('comment') }}" method="post">
                      @csrf
                      <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Publicar</button>
                    </form>
                </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm"></div>
</div>
@endsection