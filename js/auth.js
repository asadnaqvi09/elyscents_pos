document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = document.getElementById('loginBtn');
            const btnText = document.getElementById('btnText');
            const loader = document.getElementById('loginLoader');
            const msg = document.getElementById('loginMessage');
            btn.disabled = true;
            btnText.innerText = "Loading...";
            if(loader) loader.style.display = 'block';
            msg.style.display = 'none';
            msg.innerText = "";
            msg.className = "";
            const formData = new FormData(this);
            try {
                const response = await fetch('backend/api/auth/login.php', {
                    method: 'POST',
                    body: formData
                });
                if (!response.ok) throw new Error("Server connection failed");
                const result = await response.json();
                if (result.success) {
                    msg.style.display = 'block';
                    msg.className = "msg-success";
                    msg.style.color = "#10b981";
                    msg.innerText = "LOGIN SUCCESSFUL! REDIRECTING...";
                    setTimeout(() => window.location.href = 'index.php?page=sale', 800);
                } else {
                    throw new Error(result.message || "Invalid credentials");
                }
            } catch (error) {
                msg.style.display = 'block';
                msg.className = "msg-error";
                msg.innerText = error.message.toUpperCase();
                btn.disabled = false;
                btnText.innerText = "SIGN IN";
                if(loader) loader.style.display = 'none';
                loginForm.classList.add('shake');
                setTimeout(() => loginForm.classList.remove('shake'), 500);
            }
        });
    }
});