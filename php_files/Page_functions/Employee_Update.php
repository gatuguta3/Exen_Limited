<?php
require_once("connect.php");
$sql="UPDATE employee_details SET ";

/*UPDATE `employee_details` SET `Emp_Id`='[value-1]',`Emp_Firstname`='[value-2]',
`Emp_lastname`='[value-3]',`Emp_national_Id`='[value-4]',`Emp_Phonenumber`='[value-5]',`Emp_emailAddress`='[value-6]',
`Emp_role`='[value-7]',`Emp_dateofbirth`='[value-8]',`Emp_gender`='[value-9]',`Emp_image`='[value-10]' WHERE 1
*/
/* <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Update Data Example</h2>
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal">
            Open Update Modal
        </button>

        <!-- The Modal -->
        <div class="modal" id="updateModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update Data</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form id="updateForm">
                            <input type="hidden" id="userId" name="userId">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Example data to populate the modal form for update
            const userData = {
                id: 1,
                username: "john_doe",
                email: "john@example.com"
            };

            // Populate the form with data when the modal is opened
            $('#updateModal').on('show.bs.modal', function (e) {
                $('#userId').val(userData.id);
                $('#username').val(userData.username);
                $('#email').val(userData.email);
            });

            // Handle the form submission
            $('#updateForm').submit(function(e) {
                e.preventDefault();

                const formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: 'update_user.php',
                    data: formData,
                    success: function(response) {
                        alert(response);
                        $('#updateModal').modal('hide');
                    },
                    error: function() {
                        alert('Error updating data.');
                    }
                });
            });
        });
    </script>
</body>
</html */
