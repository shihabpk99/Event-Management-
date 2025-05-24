<style>
    .auth-wrapper {
        display: flex;
        justify-content: center;
        gap: 50px;
        margin: 30px auto;
    }

    .auth-container {
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 20px 30px;
        width: 300px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .auth-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .auth-container label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }

    .auth-container input {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border-radius: 5px;
        border: 1px solid #aaa;
    }

    .auth-container button {
        margin-top: 15px;
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
    }

    .auth-container button:hover {
        background-color: #0056b3;
    }
</style>

<div class="auth-wrapper">
    <div class="auth-container">
        <h2>Login</h2>
        <form method="POST" action="auth_process.php">
            <input type="hidden" name="action" value="login">
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>

    <div class="auth-container">
        <h2>Register</h2>
        <form method="POST" action="auth_process.php">
            <input type="hidden" name="action" value="register">
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Confirm Password</label>
            <input type="password" name="confirm_password" required>

            <button type="submit">Register</button>
        </form>
    </div>
</div>
