<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Masuk - Pelanggan</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;1,600&display=swap');

  @keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  @keyframes slideUp {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
  }

  @keyframes fadeInStagger {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  @keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
  }

  body {
    margin: 0;
    background: linear-gradient(-45deg, #faeef1, #fce3e3, #ebd4d4, #faeef1);
    background-size: 400% 400%;
    animation: gradientBG 15s ease infinite;
    
    font-family: 'Poppins', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    overflow: hidden;
  }

  .container {
    background-color: rgba(252, 220, 220, 0.95);
    border: 3px solid #d6a2a2;
    border-radius: 15px;
    width: 850px;
    max-width: 90%;
    padding: 30px 50px;
    box-sizing: border-box;
    color: #2d2c2c;
    text-align: center;
    
    box-shadow: 0 10px 30px rgba(214, 162, 162, 0.3);
    
    animation: slideUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
    
    backdrop-filter: blur(5px);
  }

  .container.shake-active {
    animation: shake 0.5s ease-in-out;
  }

  .container > * {
    opacity: 0;
    animation: fadeInStagger 0.6s ease forwards;
  }
  .container h1 { animation-delay: 0.2s; }
  .container .subtitle { animation-delay: 0.3s; }
  .container .google-btn { animation-delay: 0.4s; }
  .container .line-or { animation-delay: 0.5s; }
  .container form { animation-delay: 0.6s; }
  .container .footer-text { animation-delay: 0.7s; }

  h1 {
    font-style: italic;
    font-weight: 600;
    font-size: 2.4rem;
    margin: 0 0 5px 0;
    color: #222;
    letter-spacing: -0.5px;
  }

  .subtitle {
    font-weight: 400;
    font-size: 1rem;
    color: #444;
    margin-bottom: 20px;
    margin-top: 0;
  }

  /* Update Google Btn agar bisa jadi Link <a> */
  .google-btn {
    display: block;
    text-decoration: none;
    background-color: #d98080;
    border: none;
    border-radius: 8px;
    color: white;
    font-weight: 600;
    font-size: 14px;
    padding: 10px 30px;
    cursor: pointer;
    margin-bottom: 20px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    width: fit-content;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.5;
  }

  .google-btn:hover {
    background-color: #bf6e6e;
    transform: translateY(-3px);
    box-shadow: 0 7px 14px rgba(217, 128, 128, 0.4);
    color: white;
  }
  
  .google-btn:active {
    transform: scale(0.95);
  }

  .line-or {
    display: flex;
    align-items: center;
    color: #4a4545;
    font-weight: 700;
    font-size: 1rem;
    margin-bottom: 20px;
    width: 70%;
    margin-left: auto;
    margin-right: auto;
  }
  .line-or::before, .line-or::after {
    content: ""; flex: 1; border-bottom: 2px solid #4a4545;
  }
  .line-or:not(:empty)::before { margin-right: 15px; }
  .line-or:not(:empty)::after { margin-left: 15px; }

  input[type="email"],
  input[type="password"] {
    width: 100%;
    max-width: 450px;
    padding: 10px 14px;
    margin-bottom: 12px;
    border: 2px solid #dbaaaa;
    border-radius: 8px;
    font-size: 15px;
    color: #555;
    background-color: #ffffff;
    box-sizing: border-box;
    outline: none;
    display: block;
    margin-left: auto;
    margin-right: auto;
    font-family: 'Poppins', sans-serif;
    
    transition: all 0.3s ease;
  }

  input:focus {
    border-color: #bf6e6e;
    transform: scale(1.02);
    box-shadow: 0 4px 12px rgba(191, 110, 110, 0.2);
  }

  ::placeholder {
    color: #bfa0a0;
    font-weight: 500;
    transition: opacity 0.3s ease;
  }
  
  input:focus::placeholder {
    opacity: 0.5;
  }

  .checkbox-container {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    font-weight: 500;
    font-size: 14px;
    color: #5a4040;
    cursor: pointer;
    user-select: none;
  }

  .checkbox-container input {
    width: 18px;
    height: 18px;
    border: 2px solid #dbaaaa;
    margin-right: 8px;
    cursor: pointer;
    accent-color: #d98080;
    transition: transform 0.2s;
  }
  
  .checkbox-container:hover input {
    transform: scale(1.1);
  }

  .btn-container {
    display: flex;
    justify-content: center;
    gap: 25px;
    margin-bottom: 20px;
  }

  button.back,
  button.signin {
    width: 130px;
    background-color: #d98080;
    border: none;
    border-radius: 8px;
    color: white;
    font-weight: 700;
    font-size: 14px;
    padding: 12px 0;
    cursor: pointer;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    transition: all 0.3s ease;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  }

  button.back:hover,
  button.signin:hover {
    background-color: #bf6e6e;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(217, 128, 128, 0.4);
  }
  
  button.back:active,
  button.signin:active {
    transform: scale(0.95) translateY(0);
  }

  .footer-text {
    font-weight: 500;
    font-size: 14px;
    color: #5a4040;
    margin-top: 0;
  }

  .footer-text a {
    font-weight: 600;
    color: #d98080;
    margin-left: 5px;
    text-decoration: none;
    position: relative;
    transition: color 0.3s;
  }

  .footer-text a::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: -2px;
    left: 0;
    background-color: #bf6e6e;
    transition: width 0.3s ease;
  }

  .footer-text a:hover {
    color: #bf6e6e;
  }

  .footer-text a:hover::after {
    width: 100%;
  }

  /* Style tambahan untuk Pesan Error */
  .alert-error {
      background-color: #fee2e2;
      color: #991b1b;
      border: 1px solid #ef4444;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 14px;
      max-width: 450px;
      margin-left: auto;
      margin-right: auto;
  }
</style>
</head>
<body>
  <!-- Tambahkan class shake-active jika ada error dari Laravel -->
  <div class="container {{ $errors->any() ? 'shake-active' : '' }}" id="cardContainer" role="main">
    <h1>Welcome Back!</h1>
    <p class="subtitle">Sign in to continue accessing our tailoring services.</p>

    <!-- Tombol Google (Ganti jadi Link Route Laravel) -->
    <a href="{{ route('auth.google') }}" class="google-btn" id="googleSignInBtn">
        Sign In with Google
    </a>

    <div class="line-or">Or</div>

    <!-- Menampilkan Error jika Login Gagal -->
    @if($errors->any())
        <div class="alert-error">
            {{ $errors->first() }}
        </div>
    @endif

    <!-- Form Login Laravel -->
    <form id="loginForm" action="{{ route('user.login.post') }}" method="POST">
      @csrf <!-- TOKEN KEAMANAN WAJIB -->

      <input type="email" placeholder="Email Address" name="email" id="emailInput" required value="{{ old('email') }}" />
      
      <input type="password" placeholder="Password" name="password" id="passInput" required />
      
      <label class="checkbox-container">
        <input type="checkbox" name="remember" />
        Remember me
      </label>

      <div class="btn-container">
        <!-- Tombol Back diarahkan ke halaman utama '/' -->
        <button class="back" type="button" id="btnBack">BACK</button>
        <button class="signin" type="submit">SIGN IN</button>
      </div>
    </form>

    <p class="footer-text">
      Don’t have an account? <a href="{{ route('user.register') }}">Sign Up</a>
    </p>
  </div>

  <script>
    // Efek Tombol Google
    document.getElementById('googleSignInBtn').addEventListener('click', function(e) {
      // Kita biarkan link bekerja, tapi tambahkan efek visual sebentar
      this.innerHTML = "Loading...";
      // Tidak ada preventDefault agar redirect jalan
    });

    document.getElementById('btnBack').addEventListener('click', function() {
        // Animasi keluar sebelum pindah halaman
        const container = document.getElementById('cardContainer');
        container.style.transition = "all 0.5s ease";
        container.style.opacity = "0";
        container.style.transform = "translateY(50px)";
        
        setTimeout(() => {
            // Redirect ke halaman utama
            window.location.href = "{{ url('/') }}"; 
        }, 400);
    });

    // Kita HAPUS preventDefault di form submit agar Laravel bisa memproses data
    document.getElementById('loginForm').addEventListener('submit', function(e) {
      const email = document.getElementById('emailInput').value;
      const pass = document.getElementById('passInput').value;
      
      // Animasi Loading UI saja
      const btn = document.querySelector('button.signin');
      btn.innerHTML = "SIGNING IN...";
      btn.style.backgroundColor = "#a65c5c";
      
      // Form akan terkirim secara otomatis (POST) ke Laravel
    });
  </script>
</body>
</html>