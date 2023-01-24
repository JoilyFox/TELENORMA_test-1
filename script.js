// // call ajax
// var ajax = new XMLHttpRequest();
// var method = "GET";
// var url = "api/get-users.php";
// var asynchronous = true;

// ajax.open(method, url, asynchronous);

// // sending ajax request
// ajax.send();

// // receiving response from data.php
// ajax.onreadystatechange = function () {
//     if (this.readyState == 4 && this.status == 200) {
//         console.log(this.responseText)
//     }
// }

function getAllUsers() {
    $.ajax({
        type: 'GET',
        url: 'api/get-users.php',
        dataType: 'json',
        success: function(data) {
            console.log(data);
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

getAllUsers();