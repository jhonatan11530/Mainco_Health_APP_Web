@extends('layout.plantilla')
@section('content')
<div class="panel-header bg-primary-gradient">
     <div class="page-inner py-5">
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
               <div>

               </div>
               <div class="ml-md-auto py-2 py-md-0">
                    <a href="{{url('/produccion')}}" class="btn btn-secondary btn-round">Atras</a>

               </div>
          </div>
     </div>
</div>
<div class="page-inner mt--5">
     <div class="col mt--2">
          <div class="col-md-6 mx-auto">
               <div class="card full-height">
                    <div class="card-body">
                         {!! Form::model($produccion, ['method' => 'PATCH', 'route' => ['produccion.update', $produccion->id], 'files' => true ]) !!}

                         <div class="form-group">
                              {!! Form::label('Nombre', 'Asignar numero op :') !!}
                              <input class="form-control" name="numero_id" required />

                         </div>


                         <div class="form-group">
                              {!! Form::label('codigo producto', 'codigo producto:') !!}
                              <input class="form-control" name="cod_producto" value="{{$produccion->cod_producto}}" />
                         </div>

                         <div class="form-group">
                              {!! Form::label('descripcion', 'Descripcion :') !!}
                              <input class="form-control" name="descripcion" value="{{$produccion->descripcion}}" />
                         </div>

                         <div class="form-group">
                              {!! Form::label('cantidad', 'Cantidad:') !!}
                              {!! Form::text('cantidad',null,['class' => 'form-control', 'required' => 'required']) !!}
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