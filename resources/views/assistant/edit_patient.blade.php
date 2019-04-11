@extends('layouts.app1')
@section('toggle')
<a href="{{ route('assistant patients') }}" class="btn btn-secondary">← Pacientes</a>
@endsection
@section('content')
<div class="container form-lg">
	<table class="table table-striped">
		<tbody>
			<tr>
				<td>
					<form class="well form-horizontal" method="post" action="{{ route('assistant update patient',$patient->id) }}">
						@csrf
						@method('PUT')
						<fieldset>
							<legend>Editar perfil de paciente</legend>
							<input name="id_doctor" class="form-control" placeholder="Nombre completo" value="{{$patient->doctor_id}}" type="hidden">
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
			            	<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-calendar"></i> </span>
								</div>
								<input name="birthdate" class="form-control" value="{{$patient->birthdate}}" {{ old('birthdate') == $patient->birthdate ? 'selected' : ''  }}  type="text">
							</div>
							@if($errors->has('birthdate'))
			            		<div class="alert alert-danger">
			                		<span>{{ $errors->first('birthdate') }}</span>
			            		</div>
			           		@endif
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
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-tint"></i> </span>
								</div>
								<select  name="blood_type_id"  class="form-control">
									<option selected="">Seleccione el tipo de sangre</option>
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
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-plus-circle"></i> </span>
								</div>
								<select name="insurance_type_id" class="form-control">
									<option selected="">Seleccione el tipo de seguro</option>
									@foreach($insurance_types as $insurance_type)
										@if($insurance_type->id == $patient->insurance_type_id)
											 	<option value="{{ $insurance_type->id }}" selected="">{{ $insurance_type->name }}</option>
											@else
												<option value="{{ $insurance_type->id }}" {{ old('blood_type_id') == $patient->insurance_type ? 'selected' : '' }}>{{ $insurance_type->name }}</option>
											@endif
									@endforeach
								</select>
							</div>
							@if($errors->has('insurace_type_id'))
			            	<div class="alert alert-danger">
			                	<span>{{ $errors->first('insurance_type_id') }}</span>
			            	</div>
			            	@endif
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-sticky-note"></i> </span>
								</div>
								<textarea name="description" class="form-control form-textarea" 
								>
								{{$patient->description}}
								</textarea>
							</div>
							@if($errors->has('description'))
			            	<div class="alert alert-danger">
			                	<span>{{ $errors->first('description') }}</span>
			            	</div>
			            	@endif
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block"> Editar</button>
							</div>
						</fieldset>
					</form>
				</td>
			</tr>
		</tbody>
	</table>
</div>
@endsection