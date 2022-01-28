@extends('layout.app')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Detalhes do Dispositivo</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('web.index') }}"> Voltar</a>
            </div>
        </div>
    </div>
     
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Patrimônio:</strong>
                {{ $product->patri }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Setor / Departamento:</strong>
                {{ $product->setor }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Usuário:</strong>
                {{ $product->user }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nome:</strong>
                {{ $product->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Marca:</strong>
                {{ $product->brand }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Modelo:</strong>
                {{ $product->model }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Número de Série:</strong>
                {{ $product->sn }}
            </div>
        </div>
        <strong>Imagem:</strong>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <img src="/images/{{ $product->image }}" width="500px">
            </div>
        </div>
    </div>
@endsection