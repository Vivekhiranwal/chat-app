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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>


</head>

<body>

    <main>
        <div class="container">
            <h2 class="text-center">Login chat</h2>
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 border">
                    <form action="{{ url('/user/login') }}" id="myForm" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" name="email" id="" aria-describedby="emailHelpId"
                                placeholder="abc@mail.com">
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror"
                                name="password" id="" placeholder="">
                            <span class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>


                        <button type="submit" class="btn btn-primary">Login</button>
                        <a href="{{ route('user.create') }}">Register</a>
                    </form>
                </div>
            </div>
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
        $(document).ready(function() {
            $("#myForm").on("submit", function(event) {
                event.preventDefault(); // Prevent default form submission
                let formData = $(this).serialize(); // Serialize form data

                $.ajax({
                    url: $(this).attr("action"), // Get the form action URL
                    method: "POST", // Set the HTTP method to POST
                    data: formData, // Include serialized form data
                    headers: {
                        "X-CSRF-TOKEN": $('input[name="_token"]')
                        .val() // Add CSRF token for security
                    },
                    success: function(response) {
                        // Show a success toast using SweetAlert2
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            title: response.message || "Login successful!"
                        });

                        // Redirect to the chat route after a short delay
                        setTimeout(() => {
                            window.location.href = response
                            .redirect; // Redirect using the URL from the response
                        }, 2000);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Handle validation errors
                            let errors = xhr.responseJSON.errors;
                            let errorMessages = Object.values(errors).map(
                                (messages) => messages.join(", ")
                            );
                            Swal.fire({
                                icon: "error",
                                title: "Validation Error",
                                html: errorMessages.join("<br>")
                            });
                        } else {
                            // Handle other errors
                            Swal.fire({
                                icon: "error",
                                title: "Submission Failed",
                                text: xhr.responseJSON?.message ||
                                    "Something went wrong. Please try again later."
                            });
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>
