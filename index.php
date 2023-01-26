<?php
  require_once 'routes.php';

  runRoutes();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Test 1</title>
</head>
<body>
    <main>
        <div class="container mt-5 mb-5">
            <div class="col-12">
                <form id="userForm">
                    <div class="form-group">
                      <label for="firstName">First Name:</label>
                      <input type="text" class="form-control" id="firstName" name="firstName">
                    </div>
                    <div class="form-group">
                      <label for="lastName">Last Name:</label>
                      <input type="text" class="form-control" id="lastName" name="lastName">
                    </div>
                    <div class="form-group">
                      <label for="position">Position:</label>
                      <select class="form-control" id="position" name="position">
                        <option value="1">Programmer</option>
                        <option value="2">Manager</option>
                        <option value="3">Tester</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="button" class="btn btn-primary" value="Add User" onclick="addUser()">
                      <input type="button" class="btn btn-secondary" value="Edit User" onclick="editUser()" disabled>
                      <input type="button" class="btn btn-danger" value="Delete User" onclick="deleteUser()" disabled>
                    </div>
                  </form>
            </div>
              
            <div class="col-12">
                <table class="table" id="usersTable">
                    <thead>
                        <tr>
                          <th>ID</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Position</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table Content -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script src="views/script.js"></script>
</body>
</html>

