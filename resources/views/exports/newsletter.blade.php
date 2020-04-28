<table border="1">
    <thead>
    <tr>
        <th>Mail</th>
        <th>Fecha</th>

    </tr>
    </thead>
    <tbody>
    @foreach($newsletters as $new)
        <tr>
            <td>{{ $new->mail }}</td>
            <td>{{ $new->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
