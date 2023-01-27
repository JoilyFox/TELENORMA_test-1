let users = [];
let positions = [];


function getAllUsers() {
    return $.ajax({
        type: 'GET',
        url: '/get-users',
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        success: function(data) {
            users = data;
        },
        error: function(xhr) {
            alert(xhr.responseText);
        }
    });
}

function getAllPositions() {
    return $.ajax({
        type: 'GET',
        url: '/get-positions',
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        success: function(data) {
            let transformedPos = data.reduce(
                (obj, item) => (obj[item.id] = item.name, obj), {}
            );

            positions = transformedPos;
        },
        error: function(xhr) {
            alert(xhr.responseText);
        }
    });
}

function renderUsers(users, positions) {
    let usersTable = $('#usersTable tbody');
    usersTable.empty();

    users.forEach(function(user) {
        let row = $('<tr>');

        row.append($('<td>').text(user.id));
        row.append($('<td>').text(user.name));
        row.append($('<td>').text(user.surname));
        row.append($('<td>').text(positions[user.position_id]));

        let actionTd = $('<td>');
        let editBtn = $('<button>')
            .addClass('btn btn-info btn-sm m-1')
            .text('Edit User')
            .attr('onclick', 'openEditUserModal(' + user.id + ')');
        let deleteBtn = $('<button>')
            .addClass('btn btn-danger btn-sm m-1')
            .text('Delete User')
            .attr('onclick', 'deleteUser(' + user.id + ')');

        actionTd.append(editBtn, deleteBtn);
        row.append(actionTd);
        usersTable.append(row);
    });
}

function getAndRenderUsers() {
    $.when(getAllUsers()).done(function() {
        renderUsers(users, positions);
    });
}

function renderPositions(positions) {
    let options = "";

    for (let id in positions) {
        options += "<option value='" + id + "'>" + positions[id] + "</option>";
    }
    
    $("#position").html(options);
    $("#editPosition").html(options);
}

function addUser() {
    let name = $("#firstName").val();
    let surname = $("#lastName").val();
    let position_id = $("#position").val();

    function clearFields() {
        $("#firstName").val("");
        $("#lastName").val("");
    }

    if (name === "" || surname === "") {
        alert("First Name and Last Name fields are required");

        return false;
    }

    $.ajax({
        type: 'POST',
        url: '/add-user',
        data: { 
            name: name, 
            surname: surname, 
            position_id: position_id,
        },
        success: function(response) {
            getAndRenderUsers();
            clearFields();

            alert(response);
        },
        error: function(xhr) {
            alert(xhr.responseText);
        }
    });
}

function deleteUser(id) {
    if (confirm("Are you sure you want to delete this user? This action cannot be undone.")) {
        $.ajax({
            type: 'DELETE',
            url: '/delete-user',
            data: {id: id}, 
            success: function(response) { 
                getAndRenderUsers();
            },
            error: function(xhr) {
                alert(xhr.responseText);
            }
        });
    }
}

function findUserById(id) {
    let user = $.grep(users, function(e){ return e.id == id; });

    if(user.length > 0) {
      return user[0];
    }
    else {
      alert("User not found with provided ID.");

      return false;
    }
  }
  

function openEditUserModal(id) {
    if (!findUserById(id)) return;
    let currentUserData = findUserById(id);

    $('#editModal').modal('show');

    $("#editFirstName").val(currentUserData.name);
    $("#editLastName").val(currentUserData.surname);
    $("#editPosition").val(currentUserData.position_id);
    $('#editUserBtn').attr('onclick','editUser(' + id + ')');
}

function editUser(id) {
    if (!findUserById(id)) return;
    let currentUserData = findUserById(id);

    let updatedName = $("#editFirstName").val();
    let updatedSurname = $("#editLastName").val();
    let updatedPosition = $("#editPosition").val();

    // Validate that at least one field is changed
    if (updatedName == currentUserData.name && 
        updatedSurname == currentUserData.surname && 
        updatedPosition == currentUserData.position_id) 
    {
        alert("Error: At least one field must be changed.");
        
        return;
    }

    $.ajax({
        type: "PUT",
        url: "/edit-user",
        data: {
            id: id,
            name: updatedName,
            surname: updatedSurname,
            position_id: updatedPosition
        },
        success: function(response) {
            $('#editModal').modal('hide');

            getAndRenderUsers();
        },
        error: function(xhr) {
            alert(xhr.responseText);
        }
    });
}




$(document).ready(function() {
    $.when(getAllUsers(), getAllPositions()).done(function() {
        renderUsers(users, positions);
        renderPositions(positions);
    });
});