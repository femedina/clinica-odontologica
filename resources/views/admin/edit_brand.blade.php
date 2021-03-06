@extends('layouts.app1')
@section('toggle')
<a href="{{ route('admin brands') }}" class="btn btn-secondary">← Marcas</a>
@endsection
@section('content')
<div class="container form-sm">
	<table class="table table-striped">
		<tbody>
			<tr>
				<td>
					<form method="post" action="{{route('admin update brand', $brand->id)}}" class="well form-horizontal">
						@csrf
            			@method('PUT')
						<legend>Editar marca</legend>
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"> <i class="fa  fa-money-bill-alt"></i> </span>
							</div>
							<input name="name" class="form-control" placeholder="Ingrese la marca" type="text" autofocus="" value="{{$brand->name}}"{{ old('name') == $brand->name ? 'selected' : ''  }}>
							
						</div>

						@if($errors->has('name'))
				            <div class="alert alert-danger">
				               	<span>{{ $errors->first('name') }}</span>
				            </div>
            			@endif

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