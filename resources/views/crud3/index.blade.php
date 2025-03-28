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
    </header>
    <main>
        <!--  Modal trigger button  -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalId">
            Registration
        </button>

        <!-- Modal Body-->
        <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form method="get" id="myform">
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
                                        aria-describedby="emailHelpId" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="">
                                </div>
                                <button type="submit" id="submit" data-bs-dismiss="modal"
                                    class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="table-responsive-md">
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="table_data">

                        {{-- @foreach ($student as $it)
                            <tr class="table-primary">
                                <td scope="row">{{ $it->id }}</td>
                                <td>{{ $it->name }}</td>
                                <td>{{ $it->email }}</td>
                                <td>{{ $it->password }}</td>
                                <td>
                                    <a href="{{ route('edit', ['id' => $it->id]) }}" class="btn btn-success">Edit</a>
                                    <a href="{{ route('crud.delete', ['id' => $it->id]) }}"
                                        class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach --}}

                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>

        </div>





    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('getstudents') }}",
                type: "get",
                success: function(data) {
                    // console.log(data);
                    // $("#table_data").html(data);
                    if (data.student.length > 0) {
                        for (let i = 0; i < data.student.length; i++) {
                            $('#table_data').append(`<tr>
                                    <td>` + (i + 1) + `</td>
                                    <td>` + (data.student[i]['name']) + `</td>
                                    <td>` + (data.student[i]['email']) + `</td>
                                    <td>` + (data.student[i]['password']) + `</td>
                                </tr>`);

                        }
                    } else {
                        $('#table_data').append("<tr colspan='4'>Data not found <td></td> </tr>")
                    }
                },
                error: function(err) {
                    console.log(err.responseText);
                }
            });



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
                        url: "{{ route('crud.store') }}",
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
