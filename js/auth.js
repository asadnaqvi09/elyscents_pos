// js/auth.js
document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');
    
    if (loginForm) {
        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const btn = document.getElementById('loginBtn');
            const btnText = document.getElementById('btnText');
            const loader = document.getElementById('loginLoader');
            const msg = document.getElementById('loginMessage');
            const formData = new FormData(this);

            // UI State: Loading
            btn.disabled = true;
            btnText.innerText = "VERIFYING...";
            loader.classList.remove('hidden');
            msg.classList.add('hidden');

            try {
                const response = await fetch('backend/api/auth/login.php', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();

                if (result.success) {
                    msg.className = "text-[11px] font-bold p-3 rounded-lg text-center bg-success/10 text-success block";
                    msg.innerText = "LOGIN SUCCESSFUL! REDIRECTING...";
                    setTimeout(() => window.location.href = 'index.php?page=sale', 800);
                } else {
                    throw new Error(result.message || "Invalid credentials");
                }

            } catch (error) {
                msg.className = "text-[11px] font-bold p-3 rounded-lg text-center bg-danger/10 text-danger block";
                msg.innerText = error.message.toUpperCase();
                
                // Reset UI
                btn.disabled = false;
                btnText.innerText = "SIGN IN";
                loader.classList.add('hidden');
            }
        });
    }
});