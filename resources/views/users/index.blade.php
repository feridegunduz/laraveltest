<!DOCTYPE html>
<html>
<head>
    <title>Kullanıcılar</title>
</head>
<body>
<h1>Kullanıcılar</h1>

<form action="/users/search" method="GET">
    <input type="text" name="search" placeholder="Ara">
    <button type="submit">Ara</button>
</form>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Ad</th>
        <th>E-posta</th>
        <!-- Diğer alanlar buraya eklenebilir -->
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <!-- Silme düğmesi -->
                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Sil</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>



</table>

{{ $users->links('pagination::default') }}
</body>
</html>

