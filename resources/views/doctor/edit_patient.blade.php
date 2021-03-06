@extends('layouts.app1')
@section('toggle')
<a href="{{ route('doctor patients') }}" class="btn btn-secondary">← Pacientes</a>
@endsection
@section('content')
<div class="container form-md">
	<table class="table table-striped">
		<tbody>
			<tr>
				<td>
					<form class="well form-horizontal"method="post" action="{{ route('doctor update patient',$patient->id) }}">
						@csrf
						@method('PUT')
						<fieldset>
							<legend>Editar perfil de paciente</legend>
							<label>Nombre del paciente:</label>
							<input name="id_doctor" class="form-control" value="{{$patient->doctor_id}}" type="hidden">
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-user"></i> </span>
								</div>
								<input name="name" class="form-control" value="{{$patient->name}}" {{ old('name') == $patient->name ? 'selected' : ''  }} type="text">
							</div>
							@if($errors->has('name'))
							<div class="alert alert-danger">
								<span>{{ $errors->first('name') }}</span>
							</div>
							@endif
							<label>Correo electrónico:</label>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
								</div>
								<input name="email" class="form-control" value="{{$patient->email}}" {{ old('email') == $patient->email ? 'selected' : ''  }} type="email">
							</div>
							@if($errors->has('email'))
							<div class="alert alert-danger">
								<span>{{ $errors->first('email') }}</span>
							</div>
							@endif
							<label>Teléfono:</label>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
								</div>
								<input name="phone" class="form-control" value="{{$patient->phone}}"
								{{ old('phone') == $patient->phone ? 'selected' : ''  }} type="text">
							</div>
							@if($errors->has('phone'))
							<div class="alert alert-danger">
								<span>{{ $errors->first('phone') }}</span>
							</div>
							@endif
							<label>Fecha de nacimiento:</label>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-calendar"></i> </span>
								</div>
								<input name="birthdate" class="form-control" value="{{date( 'Y-m-d', strtotime($patient->birthdate))}}" {{ old('birthdate') == $patient->birthdate ? 'selected' : ''  }}  type="date">
							</div>
							@if($errors->has('birthdate'))
							<div class="alert alert-danger">
								<span>{{ $errors->first('birthdate') }}</span>
							</div>
							@endif
							<label>Dirección residencial:</label>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-home"></i> </span>
								</div>
								<input name="home_address" class="form-control" value="{{$patient->home_address}}"
								{{ old('home_address') == $patient->home_address ? 'selected' : ''  }} type="text">
							</div>
							@if($errors->has('home_address'))
							<div class="alert alert-danger">
								<span>{{ $errors->first('home_address') }}</span>
							</div>
							@endif
							<label>Tipo de sangre:</label>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-tint"></i> </span>
								</div>
								<select  name="blood_type_id"  class="form-control">
									@foreach($blood_types as $blood_type)
									@if($blood_type->id == $patient->blood_type_id)
									<option value="{{ $blood_type->id }}" selected="">{{ $blood_type->name }}</option>
									@else
									<option value="{{ $blood_type->id }}" {{ old('blood_type_id') == $patient->blood_type ? 'selected' : '' }}>{{ $blood_type->name }}</option>
									@endif
									@endforeach
								</select>
							</div>
							@if($errors->has('blood_type_id'))
							<div class="alert alert-danger">
								<span>{{ $errors->first('blood_type_id') }}</span>
							</div>
							@endif
							<label>Sexo:</label>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa  fa-venus-mars
									"></i> </span>
								</div>
								<select  name="gender_id"  class="form-control">
									@foreach($genders as $gender)
									@if($gender->id == $patient->gender_id)
									<option value="{{ $gender->id }}" selected="">{{ $gender->name }}</option>
									@else
									<option value="{{ $gender->id }}" {{ old('gender_id') == $patient->gender ? 'selected' : '' }}>{{ $gender->name }}</option>
									@endif
									@endforeach
								</select>
							</div>
							@if($errors->has('gender_id'))
							<div class="alert alert-danger">
								<span>{{ $errors->first('gender_id') }}</span>
							</div>
							@endif
							<label>Descripción:</label>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-sticky-note"></i> </span>
								</div>
								<textarea name="description" class="form-control form-textarea"
								>{{$patient->description}}</textarea>
							</div>
							@if($errors->has('description'))
							<div class="alert alert-danger">
								<span>{{ $errors->first('description') }}</span>
							</div>
							@endif
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block"> Guardar cambios</button>
							</div>
						</fieldset>
					</form>
				</td>
			</tr>
		</tbody>
	</table>
</div>
@endsection