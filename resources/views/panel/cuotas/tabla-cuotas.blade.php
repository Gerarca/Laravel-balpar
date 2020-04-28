@if (count($producto->cuotas) > 0)
	@foreach($producto->cuotas as $cuota)
		<tr data-id="{{ $cuota->id }}">
			<td></td>
			<td>
				<p>Plazo de <b>{{ $cuota->cantidad_cuotas }}</b> cuotas </p>
			</td>
			<td>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<input type="number" class="form-control" value="{{ $cuota->precio_cuotas }}">
					</div>
					<div class="input-group-text">Gs</div>
				</div>
			</td>
			<td>
				<button class="btn btn-sm btn-info">Editar</button>
				<button class="btn btn-sm btn-danger">Eliminar</button>
			</td>
		</tr>
	@endforeach
@else
	<tr>
		<td colspan="2"class="alert alert-secondary text-center text-dark">
		  	El producto aún no posee precios a cuotas. Puede agregarlos con el botón en la parte inferior.
		</td>
	</tr>
@endif
