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

</head> 

<body>
    <header>
        <!-- place navbar here -->
        <ul class="nav justify-content-center  bg-secondary">
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/create') }}" aria-current="page">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/show') }}">Show data</a>
            </li> 
        </ul>
    </header>
    <main>
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" data-bs-dismiss="alert" aria-label="Close">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
       
    @endif
        <div class="container">
            <h2 class="text-center">Update Form</h2>
            <form action="{{ url('/update') }}/{{ $user->id }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" class="form-control" value="{{ $user->name }}" name="name" id=""
                        aria-describedby="emailHelpId" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control" value="{{ $user->email }}" name="email" id=""
                        aria-describedby="emailHelpId" placeholder="abc@mail.com">
                </div>

                <div class="mb-3 d-flex">
                    <label for="">Gender</label>
                    <div class="form-check mx-4">
                        <input class="form-check-input" type="radio" name="gender" value="male" id="one"
                            {{ $user->gender === 'male' ? 'checked' : '' }}>
                        <label class="form-check-label" for="one">
                            Male
                        </label>
                    </div>
                    <div class="form-check mx-4">
                        <input class="form-check-input" type="radio" name="gender" value="female" id="two"
                        {{$user->gender === 'female'? 'checked':''}}
                        >
                        <label class="form-check-label" for="two">
                            Female
                        </label>
                    </div>
                </div>
                <div class="mb-3 d-flex">
                    <label for="">Languages</label>
                    <div class="form-check mx-5">
                        <input class="form-check-input" type="checkbox" name="language[]" value="hindi" id=""
                        {{ in_array('hindi', explode(',', $user->language))? 'checked': '' }}
                        >
                        <label class="form-check-label" for="">
                            Hindi
                        </label>
                    </div>
                    <div class="form-check  mx-5">
                        <input class="form-check-input" type="checkbox" name="language[]" value="english"
                            id=""
                            {{ in_array('english', explode(',', $user->language))? 'checked':'' }}
                            >
                        <label class="form-check-label" for="">
                            English
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">City</label>
                    <select class="form-select " name="city" id="">
                        <option>Select one</option>
                        <option value="Delhi"{{$user->city==='Delhi' ? 'selected':''}}>Delhi</option>
                        <option value="Mumbai"{{$user->city==='Mumbai' ? 'selected':''}}>Mumbai</option>
                        <option value="Nasik" {{$user->city=== 'Nasik' ? 'selected':''}}>Nasik</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
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
</body>

</html>
