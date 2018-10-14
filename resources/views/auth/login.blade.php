@extends('auth.contenido')

@section('login')
<div class="row justify-content-center" >
      <div class="col-md-8">
        <div class="card-group mb-0" >
          <div class="card p-4" style="background-color:rgba(0,0,0,0.15); border:none; color:#fff;">
          <form>
          {{ csrf_field() }}
              <div class="card-body" >
              <h3 class="text-center">Colegio Evangelico Shaddai</h3>
              <p class="text-center">Control de acceso al sistema</p>
              <div class="col-auto">
                  <label class="sr-only" for="Usuario">Usuario</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="icon-user"></i></div>
                      </div>
                      <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario">
                    </div>
              </div>
              <div class="col-auto">
                  <label class="sr-only" for="Usuario">Usuario</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="icon-lock"></i></div>
                      </div>
                      <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                  </div>
              </div>
              <div class="row">
                <div class="modal-footer col-12">
                  <button type="submit" class="btn btn-primary px-4">Acceder</button>
                </div>
              </div>
            </div>
          </form>
          </div>
          
        </div>
      </div>
    </div>
@endsection
