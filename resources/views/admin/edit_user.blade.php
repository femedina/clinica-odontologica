@extends('layouts.app1')
@section('toggle')
<a href="{{ route('users') }}" class="btn btn-secondary">← Usuarios</a>
@endsection
@section('content')
<div class="container form-sm">
	<form>
		<legend>Editar cuenta de usuario</legend>
		<div class="form-group input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"> <i class="fa fa-user"></i> </span>
			</div>
			<input name="" class="form-control" placeholder="Juan Perez" type="text">
		</div>
		<div class="form-group input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
			</div>
			<input name="" class="form-control" placeholder="juanperez@correo.com" type="email">
		</div>
		<div class="form-group input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
			</div>

			<input name="" class="form-control" placeholder="99287377" type="text">
		</div>
		<div class="form-group input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"> <i class="fa fa-building"></i> </span>
			</div>
			<select class="form-control">
				<option > Seleccione el tipo de trabajo</option>
				<option selected="">Odontólogo</option>
				<option>Asistente</option>
			</select>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-block"> Editar usuario  </button>
		</div>
	</form>
</div>
@endsection