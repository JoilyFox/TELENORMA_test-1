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

    <link rel="stylesheet" href="assets/style.css">
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
                        <!-- Select Content -->
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="button" class="btn btn-primary" value="Add User" onclick="addUser()">
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
                          <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table Content -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Edit user modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="editFirstName">First Name:</label>
                        <input type="text" class="form-control" id="editFirstName" name="editFirstName">
                    </div>
                    <div class="form-group">
                        <label for="editLastName">Last Name:</label>
                        <input type="text" class="form-control" id="editLastName" name="editLastName">
                    </div>
                    <div class="form-group">
                        <label for="editPosition">Position:</label>
                        <select class="form-control" id="editPosition" name="editPosition">
                          <!-- Select Content -->
                        </select>
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="editUserBtn" onclick="editUser()">Update</button>
              </div>
            </div>
          </div>
        </div>
    </main>
    
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>


