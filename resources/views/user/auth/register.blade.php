<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Daftar - Pelanggan</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;1,700&display=swap');

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
    width: 900px;
    max-width: 95%;
    padding: 30px 50px; 
    box-sizing: border-box;
    color: #2d2c2c;
    text-align: center;
    box-shadow: 0 10px 30px rgba(214, 162, 162, 0.3);
    backdrop-filter: blur(5px);
    animation: slideUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
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
    font-weight: 700;
    font-size: 2.8rem; 
    margin: 0 0 5px 0;
    color: #222;
    letter-spacing: 0.5px;
    text-transform: uppercase;
  }

  .subtitle {
    font-weight: 400;
    font-size: 1rem;
    color: #444;
    margin-bottom: 20px;
    margin-top: 0;
  }

  /* Update agar Link terlihat seperti Button */
  .google-btn {
    display: block; /* Agar bisa di-margin auto jika perlu */
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

  .input-row {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 12px;
    width: 100%;
    max-width: 650px;
    margin-left: auto;
    margin-right: auto;
  }

  input[type="text"],
  input[type="email"],
  input[type="password"] {
    width: 100%;
    padding: 10px 15px;
    border: 2px solid #dbaaaa;
    border-radius: 8px;
    font-size: 15px;
    color: #555;
    background-color: #ffffff; 
    box-sizing: border-box;
    outline: none;
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
    margin-top: 5px;
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
    margin-right: 10px;
    cursor: pointer;
    accent-color: #d98080; 
    background-color: white;
    transition: transform 0.2s;
  }

  .checkbox-container:hover input {
    transform: scale(1.1);
  }

  .btn-container {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-bottom: 15px;
  }

  button.back,
  button.signup-submit {
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
  button.signup-submit:hover {
    background-color: #bf6e6e;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(217, 128, 128, 0.4);
  }

  button.back:active,
  button.signup-submit:active {
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
      max-width: 650px;
      margin-left: auto;
      margin-right: auto;
  }
</style>
</head>
<body>
  <!-- Tambahkan class shake-active jika ada error dari server -->
  <div class="container {{ $errors->any() ? 'shake-active' : '' }}" id="cardContainer" role="main">
    <h1>HELLO!</h1>
    <p class="subtitle">Sign up to continue accessing our tailoring services.</p>

    <!-- Tombol Google (Link ke Route Laravel) -->
    <a href="{{ route('auth.google') }}" class="google-btn" id="googleSignUpBtn">
        Sign Up with Google
    </a>

    <div class="line-or">Or</div>

    <!-- Tampilkan Error Server (misal: Email sudah terdaftar) -->
    @if($errors->any())
        <div class="alert-error">
            <ul style="list-style: none; padding: 0; margin: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="signupForm" action="{{ route('user.register') }}" method="POST">
      @csrf <!-- Token Keamanan -->
      
      <div class="input-row">
        <!-- Name: ubah name="fullname" jadi name="name" -->
        <input type="text" placeholder="Name" name="name" required value="{{ old('name') }}" />
        
        <input type="email" placeholder="Email Address" name="email" required value="{{ old('email') }}" />
      </div>

      <div class="input-row">
        <input type="password" placeholder="Password" name="password" required />
        <!-- Repeat Password: ubah name jadi "password_confirmation" -->
        <input type="password" placeholder="Repeat Password" name="password_confirmation" required />
      </div>
      
      <label class="checkbox-container">
        <input type="checkbox" name="terms" required />
        I agree with all terms and privacy policy
      </label>

      <div class="btn-container">
        <button class="back" type="button" id="btnBack">BACK</button>
        <button class="signup-submit" type="submit">SIGN UP</button>
      </div>
    </form>

    <p class="footer-text">
      Already have an account? <a href="{{ route('user.login') }}">Sign In</a>
    </p>
  </div>

  <script>
    // Link Google
    document.getElementById('googleSignUpBtn').addEventListener('click', function(e) {
      // Biarkan redirect terjadi
      this.innerHTML = "Loading...";
    });

    // Tombol Back ke halaman Login
    document.getElementById('btnBack').addEventListener('click', function() {
      const container = document.getElementById('cardContainer');
      container.style.transition = "all 0.5s ease";
      container.style.opacity = "0";
      container.style.transform = "translateY(50px)";
      
      setTimeout(() => {
        // Redirect ke route login user
        window.location.href = "{{ route('user.login') }}";
      }, 400);
    });

    // Validasi Client Side (Password Match)
    document.getElementById('signupForm').addEventListener('submit', function(e) {
      const pass = document.querySelector('input[name="password"]').value;
      const repeatPass = document.querySelector('input[name="password_confirmation"]').value;
      const container = document.getElementById('cardContainer');

      if(pass !== repeatPass) {
        // Jika password beda, stop submit & shake
        e.preventDefault(); 
        container.classList.add('shake-active');
        
        // Buat elemen alert error sementara jika belum ada
        if(!document.querySelector('.alert-error')) {
            let errorDiv = document.createElement('div');
            errorDiv.className = 'alert-error';
            errorDiv.innerText = "Passwords do not match!";
            const form = document.getElementById('signupForm');
            form.parentNode.insertBefore(errorDiv, form);
        } else {
             document.querySelector('.alert-error').innerText = "Passwords do not match!";
        }

        setTimeout(() => {
            container.classList.remove('shake-active');
        }, 500);
        return;
      }
      
      // Jika lolos, biarkan form terkirim (POST) ke Laravel
      const btn = document.querySelector('button.signup-submit');
      btn.innerHTML = "CREATING...";
      btn.style.backgroundColor = "#a65c5c";
    });
  </script>
</body>
</html>