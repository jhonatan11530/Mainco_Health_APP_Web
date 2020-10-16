@extends('layout.plantilla')
@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Editar Operador</h2>
            </div>
            <div class="ml-md-auto py-2 py-md-0">
                <a href="{{url('/operador')}}" class="btn btn-secondary btn-round">Atras</a>

            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="col mt--2">
        <div class="col-md-6 mx-auto">
            <div class="card full-height">
                <div class="card-body">
                    {!! Form::model($operador, ['method' => 'PATCH', 'route' => ['operador.update', $operador->id], 'files' => true ]) !!}

                    <div class="form-group">
                        {!! Form::label('CAMBIAR ID DEL OPERADOR', 'CAMBIAR ID DEL OPERADOR :') !!}
                        {!! Form::text('id',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Nombre y Apellido', 'Nombre y Apellido :') !!}
                        {!! Form::text('nombre',null,['class' => 'form-control']) !!}
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