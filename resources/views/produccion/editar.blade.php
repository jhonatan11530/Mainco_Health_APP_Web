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
<script>
function variable() {
    document.getElementById("variable2").value = document.getElementById("variable1").value;
}
</script>
<div class="page-inner mt--5">
    <div class="col mt--2">
        <div class="col-md-6 mx-auto">
            <div class="card full-height">
                <div class="card-body">
                    {!! Form::model($produccion, ['method' => 'PATCH', 'route' => ['produccion.update',
                    $produccion->id], 'files' => true ]) !!}

                    <div class="form-group">
                        {!! Form::label('Nombre', 'Asignar numero op :') !!}
                        <input class="form-control" name="numero_id" value="{{$produccion->numero_op}}" required />

                    </div>

                    <div class="form-group">
                        {!! Form::label('codigo producto', 'codigo producto:') !!}
                        <input class="form-control" name="cod_producto" value="{{$produccion->cod_producto}}"
                            readonly />
                    </div>

                    <div class="form-group">
                        {!! Form::label('descripcion', 'Descripcion :') !!}
                        <input class="form-control" name="descripcion" value="{{$produccion->descripcion}}" readonly />
                    </div>

                    <div class="form-group">
                        {!! Form::label('cantidad', 'Cantidad:') !!}
                        <input class="form-control" type="text" id="variable1" name="cantidad" onchange="variable()"
                            require />
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="hidden" id="variable2" name="autorizado" require />
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