let users = [],
    positions = [];


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
            renderPositions(positions);
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
        usersTable.append(row);
    });
}

function renderPositions(positions) {
    console.log(positions)

    let options = "";
    for (let id in positions) {
        options += "<option value='" + id + "'>" + positions[id] + "</option>";
    }
    
    $("#position").html(options);
}

function addUser() {
    let firstName = $("#firstName").val();
    let lastName = $("#lastName").val();
    let position = $("#position").val();

    if (firstName === "" || lastName === "") {
        alert("First Name and Last Name fields are required");

        return false;
    }

    $.ajax({
      type: 'POST',
      url: '/add-user',
      data: { firstName: firstName, lastName: lastName, position: position },
      success: function(data) {
          positions = data;
      },
      error: function(xhr) {
          alert(xhr.responseText);
      }
  });
}


$(document).ready(function() {
    $.when(getAllUsers(), getAllPositions()).done(function() {
        renderUsers(users, positions);
    });
});