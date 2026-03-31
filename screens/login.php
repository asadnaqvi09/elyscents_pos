<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Elyscents POS</title>
    <link rel="stylesheet" href="css/auth/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
</head>
<body>

    <div class="login-card">
        <header class="header">
            <h1 class="brand-title">ELYSCENTS</h1>
            <p class="brand-subtitle">Point of Sale System</p>
        </header>

        <form id="loginForm">
            <div class="form-group">
                <label class="label">Username</label>
                <input type="text" name="username" class="input-field" placeholder="admin" required autocomplete="username">
            </div>

            <div class="form-group">
                <label class="label">Password</label>
                <input type="password" name="password" class="input-field" placeholder="••••••••••••" required autocomplete="current-password">
            </div>

            <div id="loginMessage"></div>

            <button type="submit" id="loginBtn" class="signin-btn">
                <span id="btnText">Sign In</span>
            </button>
        </form>

        <footer class="footer-copy">
            &copy; 2026 ELYSCENTS PERFUMERY. All Rights Reserved.
        </footer>
    </div>

    <script src="js/auth.js"></script>
</body>
</html>