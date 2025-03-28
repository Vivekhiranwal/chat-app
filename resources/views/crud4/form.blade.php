<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <div id="success_message"></div>
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
                        <ul id="saveform_error"></ul>
                        <div class="container-fluid">
                            <form method="get" id="myform">
                                @csrf
                                <h2 class="text-center">Registration Form</h2>
                                <div class="mb-3">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" class="form-control   @error('name') is-invalid @enderror"
                                        name="name" id="name" aria-describedby="helpId" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" class="form-control  @error('email') is-invalid @enderror"
                                        name="email" id="email" aria-describedby="emailHelpId" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password"
                                        class="form-control   @error('password') is-invalid @enderror" name="password"
                                        id="password" placeholder="">
                                </div>
                                <button type="submit" class="add_student btn btn-primary">Submit</button>
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


        {{-- Edit modal --}}
        <div class="modal fade" id="editmodalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul id="updateform_error"></ul>
                        <div id="success_message"></div>
                        <div class="container-fluid">
                            <form method="get">
                                @csrf
                                <h2 class="text-center">Update Form</h2>
                                <div class="mb-3">
                                    <input type="hidden" id="edit_student_id">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="edit_name"
                                        aria-describedby="helpId" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="edit_email"
                                        aria-describedby="emailHelpId" placeholder="">
                                </div>

                                <button type="submit" class="update_student btn btn-primary">Update</button>
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

        {{-- Delete student model --}}
        <div class="modal fade" id="deletemodalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Delete student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="delete_student">
                        <ul id="updateform_error"></ul>
                        <div id="success_message"></div>
                        <h5>Are you sure you want to delete this record</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="delete_student_btn btn btn-primary">Yes delete</button>
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
                    <tbody class="table-group-divider">
                        {{-- <tr class="table-primary">
                            <td scope="row">Item</td>
                            <td>Item</td>
                            <td>Item</td>
                            <td>Item</td>
                            <td>
                                <a href="" class="btn btn-success">Edit</a>
                                <a href="" class="btn btn-danger">Delete</a>
                            </td>
                        </tr> --}}

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

            function loadTable() {
                $.ajax({
                    type: 'get',
                    url: '/show',
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response.user)
                        $('tbody').html('');
                        $.each(response.user, function(key, item) {
                            $('tbody').append('<tr>\
                                                                            <td>' + item.id + '</td>\
                                                                            <td>' + item.name + '</td>\
                                                                            <td>' + item.email + '</td>\
                                                                            <td>' + item.password + '</td>\
                                                                            <td>\
                                                                                <a href="" data-student-id="' + item.id + '" class="edit_student btn btn-success">Edit</a>\
                                                                                <a href=""  data-student-id="' + item.id + '" class="delete_student btn btn-danger">Delete</a>\
                                                                            </td>\
                                                                        </tr>');
                        })
                    }
                })
            }
            loadTable();

            $(document).on('click', '.edit_student', function(e) {
                e.preventDefault();
                var student_id = $(this).data('student-id');
                // console.log(student_id);
                // alert()
                $('#editmodalId').modal('show');
                $.ajax({
                    url: '/edit/' + student_id,
                    type: "get",
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 404) {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.messages);
                        } else {
                            $('#edit_name').val(response.student.name);
                            $('#edit_email').val(response.student.email);
                            $('#edit_student_id').val(student_id);

                        }
                    }
                })
            })

            $(document).on('click', '.update_student', function(e) {
                e.preventDefault();
                let student_id = $('#edit_student_id').val();
                let data = {
                    'name': $('#edit_name').val(),
                    'email': $('#edit_email').val(),
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "Put",
                    url: "/update/" + student_id,
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 400) {
                            $('#updateform_error').html("");
                            $('#updateform_error').addClass('alert alert-danger');
                            $.each(response.errors, function(key, err_values) {
                                $('#updateform_error').append('<li>' + err_values +
                                    '</li>')
                            })
                        } else if (response.status == 404) {
                            $('#updateform_error').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.messages);
                        } else {
                            $('#updateform_error').html("");
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.messages);
                            $('#editmodalId').modal('hide');
                            loadTable();
                        }
                    }
                });

            })


            $(document).on('click', '.delete_student', function(e) {
                e.preventDefault();
                let student_id = $(this).data('student-id');
                $('#delete_student').val(student_id);
                $('#deletemodalId').modal('show');
            });
            $(document).on('click', '.delete_student_btn', function(e) {
                e.preventDefault();
                let student_id = $('#delete_student').val();
                // console.log(student_id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "get",
                    url: "/delete/" + student_id,
                    success: function(response) {
                        // console.log(response);
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.messages);
                        $('#deletemodalId').modal('hide');
                        loadTable();
                    }
                });
            });


            $(document).on('click', '.add_student', function(e) {
                e.preventDefault();
                var data = {
                    'name': $('#name').val(),
                    'email': $('#email').val(),
                    'password': $('#password').val(),
                }
                //    console.log(data)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/",
                    type: "post",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 400) {
                            $('#saveform_error').html("");
                            $('#saveform_error').addClass('alert alert-danger');
                            $.each(response.errors, function(key, err_values) {
                                $('#saveform_error').append('<li>' + err_values +
                                    '</li>')
                            })
                        } else {
                            $('#saveform_error').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.messages);
                            $('#modalId').modal('hide');
                            $('#modalId').find('input').val("");
                            loadTable();
                        }
                    }
                })
            })

            // $('#myform').on('submit', function(e) {
            //     e.preventDefault();
            //     $.ajax({
            //         type: "post",
            //         url: "/",
            //         data: $('#myform').serialize(),
            //         success: function(response) {
            //             console.log(response);
            //             $('#modalId').modal('hide')
            //             $('#myform')[0].reset();
            //             alert('Data save');
            //             loadTable();
            //         },
            //         error: function(error) {
            //             console.log(error);
            //             alert('Data not save');
            //         }
            //     })
            // })


        })
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
