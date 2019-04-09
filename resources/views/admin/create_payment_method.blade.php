@extends('layouts.app1')
@section('toggle')
<a href="{{ route('admin payment methods') }}" class="btn btn-secondary">← Tipos de pago</a>
@endsection
@section('content')
<div class="container form-sm">
	<table class="table table-striped">
		<tbody>
			<tr>
				<td>
					<form method="get" action="{{route('admin store payment method')}}" class="well form-horizontal">
						<legend>Crear método de pago</legend>
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"> <i class="fa  fa-money-bill-alt"></i> </span>
							</div>
							<input name="name" class="form-control" placeholder="Ingrese el método de pago" type="text" autofocus="">
							@if($errors->has('name'))
				            	<div class="alert alert-danger">
				                	<span>{{ $errors->first('name') }}</span>
				            	</div>
            				@endif
						</div>

 						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
						</div>

					</form>
				</td>
			</tr>
		</tbody>
	</table>
</div>
@endsection