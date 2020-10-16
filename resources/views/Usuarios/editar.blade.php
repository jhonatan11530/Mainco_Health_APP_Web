@extends('layout.plantilla')
@section('content')
<div class="panel-header bg-primary-gradient">
     <div class="page-inner py-5">
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
               <div>
                    <h2 class="text-white pb-2 fw-bold">Editar Usuario</h2>
               </div>
               <div class="ml-md-auto py-2 py-md-0">
                    <a href="{{url('/usuarios')}}" class="btn btn-secondary btn-round">Atras</a>

               </div>
          </div>
     </div>
</div>


<div class="page-inner mt--5">
     <div class="col mt--2">
          <div class="col-md-6 mx-auto">
               <div class="card full-height">
                    <div class="card-body">
                         {!! Form::model($usuario, ['method' => 'PATCH', 'route' => ['usuarios.update', $usuario->id], 'files' => true ]) !!}
                         <div class="form-group">
                              {!! Form::label('Nombre', 'Nombre:') !!}
                              {!! Form::text('nomusuario',null,['class' => 'form-control']) !!}
                         </div>
                         <div class="form-group">
                              {!! Form::label('Apellido', 'Apellido:') !!}
                              {!! Form::text('apeusuario',null,['class' => 'form-control']) !!}
                         </div>

                         <div class="form-group">
                              {!! Form::label('Apellido', 'Codigo Unico:') !!}
                              {!! Form::text('cedula',null,['class' => 'form-control']) !!}
                         </div>

                         <div class="form-group">
                              {!! Form::label('Contraseña', 'Contraseña:') !!}
                              <input name="password" type="password" class="form-control" required>
                         </div>

                         <div class="form-group">
                              {!! Form::submit('Guardar', ['class' => 'btn btn-primary form-control']) !!}
                         </div>
                         {!! Form::close() !!}

                    </div>
               </div>
          </div>
     </div>
     @stop