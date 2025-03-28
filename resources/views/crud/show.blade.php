<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body>
    <header>
        <!-- place navbar here -->
        <ul class="nav justify-content-center  bg-secondary">
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url("/user/create") }}" aria-current="page">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/show') }}">Show data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/') }}">Chat</a>
            </li>
            <li class="nav-item">
                @if (auth()->check())  
                    <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                @endif
            </li>
        </ul>
    </header> 
    <main>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" id="show" data-bs-dismiss="alert" aria-label="Close">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
           
        @endif
        <div class="table-responsive">
            <table
                class="table table-striped
        table-hover	
        table-borderless
        table-primary
        align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Gender</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($user as $data)
                        <tr class="table-primary">
                            <td scope="row">{{ $data->id }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->password }}</td>
                            <td>{{ $data->gender }}</td>
                            <td>{{ $data->city }}</td>
                            <td>
                                <a href="{{ route('edit', ['id' => $data->id]) }}" class="btn btn-success">Edit</a>
                                <a href="{{ route('delete', ['id' => $data->id]) }}"
                                    onclick="return confirm('Are you sure you want to delete this record')"
                                    class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>


    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function () {
            setTimeout(() => {
            $('#show').remove();
        }, 2000);
        });
    </script>
</body>

</html>
