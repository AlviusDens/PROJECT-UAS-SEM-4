<!DOCTYPE html>
<html>

<head>
    <title>Daftar Pengguna</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-5">

        <h2>Daftar Pengguna</h2>

        <table class="table table-bordered mt-3">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Password</th>
            </tr>

            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->password }}</td>
                </tr>
            @endforeach

            <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" method="POST" action="/logout" style="display: none;">
                @csrf
            </form>

        </table>

    </div>


</body>

</html>