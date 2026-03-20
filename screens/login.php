<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Elyscents POS</title>
    <link rel="stylesheet" href="css/output.css">
</head>
<body class="bg-background h-screen flex items-center justify-center p-6 font-sans">

    <div class="w-full max-w-[400px] bg-surface rounded-3xl shadow-soft border border-border p-8 md:p-10">
        
        <div class="text-center mb-10">
            <h1 class="text-3xl font-black tracking-tighter text-primary">ELYSCENTS</h1>
            <p class="text-text-secondary text-xs font-medium uppercase tracking-widest mt-2 tracking-widest">Point of Sale System</p>
        </div>

        <form id="loginForm" class="space-y-6">
            <div>
                <label class="text-[11px] font-bold uppercase text-text-secondary ml-1 tracking-wider">Username</label>
                <input type="text" name="username" required 
                    class="w-full mt-1.5 px-5 py-3.5 bg-input-background border border-transparent rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all font-medium text-text-primary"
                    placeholder="admin_asad" autocomplete="username">
            </div>

            <div>
                <label class="text-[11px] font-bold uppercase text-text-secondary ml-1 tracking-wider">Password</label>
                <input type="password" name="password" required 
                    class="w-full mt-1.5 px-5 py-3.5 bg-input-background border border-transparent rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all font-medium text-text-primary"
                    placeholder="••••••••" autocomplete="current-password">
            </div>

            <div id="loginMessage" class="hidden text-[11px] font-bold p-3 rounded-lg text-center"></div>

            <button type="submit" id="loginBtn" 
                class="w-full bg-primary text-white font-bold py-4 rounded-xl hover:bg-primary-dark shadow-lg shadow-primary/20 transition-all flex items-center justify-center gap-3 active:scale-[0.98]">
                <span id="btnText">SIGN IN</span>
                <div id="loginLoader" class="hidden w-5 h-5 border-2 border-white/30 border-t-white rounded-full animate-spin"></div>
            </button>
        </form>

        <p class="text-center mt-8 text-[10px] text-text-secondary font-medium uppercase tracking-tight">
            &copy; 2026 ELYSCENTS PERFUMERY. ALL RIGHTS RESERVED.
        </p>
    </div>

    <script src="js/auth.js"></script>
</body>
</html>