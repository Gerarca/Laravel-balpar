@if (!$imagenes_secundarias->isEmpty())
	@foreach ($imagenes_secundarias as $img)
		<tr class="ui-state-default fila_imagen" data-id="{{ $img->id }}">
			<td></td>
			<td>
				<img src="{{ asset('storage/productos/' . $img->imagen) }}" width="120">
			</td>
			<td>{{ date("d/m/Y", strtotime($img->created_at)) }}</td>
			<td>
				<button class="btn btn-danger remove btn-delete" onclick="deleteImagen('{{ $img->id }}')">
					Eliminar
				</button>
			</td>
		</tr>
	@endforeach
@else
	<tr>
		<td colspan="3">
			<div class="alert alert-secondary" role="alert" style="color:black; text-align:center">
				Este producto aún no posee imágenes secundarias, ¡Sube algunas!
			</div>
		</td>
	</tr>
@endif
