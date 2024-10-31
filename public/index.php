<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application</title>
    <link rel="stylesheet" href="../assets/css/style.css">
   
</head>
<body>
    <h1>Application</h1>

    <form id="userForm">
        <label for="" class="form-label">Name:</label>
        <input type="text" id="name" placeholder="Name">
        <label for="" class="form-label">Email address:</label>
        <input type="email" id="email" placeholder="Email">
        <label for="" class="form-label">Password:</label>
        <input type="password" id="password" placeholder="Password">
        <button type="submit">Create</button>
        <div id="error-message" style="color: red;"></div>
    </form>

    <table id="userTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be injected here by JavaScript -->
        </tbody>
    </table>

    <script src="../assets/js/app.js"></script>
</body>
</html>
