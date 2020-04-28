<table border="1">
    <thead>
    <tr>
        <th>Pedido</th>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Email</th>
        <th>Ciudad</th>
        <th>Dirección</th>
        <th>Referencias</th>
        <th>Método</th>
        <th>Observaciones</th>
        <th>Sub Total</th>
        <th>Envio</th>
        <th>Total</th>
        <th>Estado</th>
        <th>Fecha</th>
        <th>Productos</th>

    </tr>
    </thead>
    <tbody>
    @foreach($pedidos as $pedido)
        <tr>
            <td>PED-{{ $pedido->id }}</td>
            <td>{{ $pedido->nombre }}</td>
            <td>{{ $pedido->telefono }}</td>
            <td>{{ $pedido->email }}</td>
            <td>{{ $pedido->ciudad->ciudad }}</td>
            <td>{{ $pedido->direccion }}</td>
            <td>{{ $pedido->referencias }}</td>
            <td>{{ $pedido->metodo }}</td>
            <td>{{ $pedido->observaciones }}</td>
            <td>{{ $pedido->total }}</td>
            <td>{{ $pedido->monto_envio }}</td>
            <td>{{ $pedido->monto_total }}</td>
            <td>
              @if ($pedido->estado==2)
                Confirmado
              @elseif ($pedido->estado==3)
                Rechazado
              @else
                Pendiente
              @endif
            </td>
            <td>{{date('d/m/Y H:i:s', strtotime($pedido->created_at))}}</td>
            <td>{{$pedido->productosPorComma()}}</td>

        </tr>
    @endforeach
    </tbody>
</table>
