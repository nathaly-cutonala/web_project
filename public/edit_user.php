<?php
// Include the User.php file
require_once '../app/controllers/UserController.php'; 

// Initialize the User object
$user = new UserController();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$userData = $user->show($id);

// Check if user data is found
if (!$userData) {
    die("User not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1>Edit User</h1>
    <form id="editUserForm">
        <input type="hidden" id="id" value="<?php echo htmlspecialchars($id); ?>">
        <label for="editName">Name:</label>
        <input type="text" id="name" value="<?php echo htmlspecialchars($userData['username']); ?>">
        <label for="editEmail">Email address:</label>
        <input type="email" id="email" value="<?php echo htmlspecialchars($userData['email']); ?>">
        <label for="editPassword">Password:</label>
        <input type="password" id="password" value="<?php echo htmlspecialchars($userData['email']); ?>">
        <!-- <button type="button" class="btn btn-primary" onclick="submitEditUser()">Save Changes</button>
        <a href="index.php" class="btn btn-primary btn-lg" >Cancel</a> -->
        <button type="button" class="btn btn-primary" onclick="submitEditUser()">Save Changes</button>
        <a type="button" class="btn btn-secondary" href="index.php">Cancel</a>
        <div id="error-message" style="color: red;"></div>
    </form>

    <script>
         function submitEditUser() {
            const id = document.getElementById('id').value;
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const errorMessageElement = document.getElementById('error-message');
            if(!name || !email || !password ){
                errorMessageElement.textContent = "Please fill out all fields.";
            }else{
                fetch('../router.php?action=update', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id, name, email, password })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'User updated successfully') {
                        window.location.href = 'index.php';  // Redirect to the main page
                    } else {
                        console.error('Update failed:', data.status);
                    }
                })
                .catch(error => console.error('Error:', error));
                errorMessageElement.textContent = "";
            }
        }
    </script>
</body>
</html>
