document.addEventListener("DOMContentLoaded", function () {
    fetchUsers();

    document.getElementById('userForm').addEventListener('submit', function (e) {
        e.preventDefault();
        createUser();
    });
});

//http://localhost/web_project/public/index.php
function fetchUsers() {
    fetch('../router.php', {
        method: 'GET'
    })
        .then(response => response.json()) // Parse the response as JSON
        .then(data => { // Handle the parsed data (JSON)
            const tableBody = document.querySelector('#userTable tbody');
            tableBody.innerHTML = '';
            data.forEach(user => {
                const row = `
                    <tr>
                        <td>${user.user_id}</td>
                        <td>${user.username}</td>
                        <td>${user.email}</td>
                        <td>
                            <button onclick="editUser(${user.user_id})">Edit</button>
                            <button onclick="deleteUser(${user.user_id})">Delete</button>
                        </td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', row);
            });
        }).catch(error => console.error('Error:', error));  // Handle errors;
}

function createUser() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const errorMessageElement = document.getElementById('error-message');

    if (!name || !email || !password) {
        errorMessageElement.textContent = "Please fill out all fields.";
    }
    fetch('../router.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ name, email, password })
    }).then(response => response.json())
        .then(() => fetchUsers());

    errorMessageElement.textContent = "";
}

function deleteUser(id) {
    fetch('../router.php&id=' + id, {
        method: 'DELETE'
    }).then(() => fetchUsers());
}

function editUser(id) {
    window.location.href = `edit_user.php?id=${id}`;
}
