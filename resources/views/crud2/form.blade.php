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
                <a class="nav-link text-light" href="{{ url('/form') }}" aria-current="page">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/show') }}">Show Data</a>
            </li>
        </ul>
    </header>
    <main>
        <div class="container">
            <div class="row d-flex justify-content-center mt-3">
                <div class="col-md-6 border">
                    <form  method="get" id="myform">
                        @csrf
                        <h2 class="text-center">Registration Form</h2>
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                aria-describedby="emailHelpId" placeholder="abc@mail.com">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="">
                        </div>
                        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>



    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <script> 
        $(document).ready(function() {
           
            $("#submit").on("click", function(e) {
                e.preventDefault();
                let name = $("#name").val();
                let email = $("#email").val();
                let password = $("#password").val();
            // console.log(name, email,password);
                if (name == "") {
                    alert("Input reqired");
                } else {
                    $.ajax({
                        url: "{{ route('customer.store') }}",
                        type: "get",
                        data: {
                            name: name,
                            email: email,
                            password: password,
                        },
                        success: function(data) {
                            if (data == 1) {
                                $("#myform").trigger("reset");
                            } 
                        }
                    });
                }
            });
        });
    </script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
