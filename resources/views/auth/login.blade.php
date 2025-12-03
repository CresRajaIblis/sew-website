<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Login Staff - Zulaeha Tailor</title>
<style>
  body {
    margin: 0;
    background: linear-gradient(135deg, #f8b4b4 0%, #e89999 100%);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center; /* Tambahan agar center vertikal */
    padding: 20px;
    min-height: 100vh;
    position: relative;
    overflow: hidden;
  }

  /* Animasi background particles */
  .particle {
    position: absolute;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 50%;
    animation: float 15s infinite ease-in-out;
    z-index: 1;
  }

  @keyframes float {
    0%, 100% { transform: translateY(0) translateX(0) rotate(0deg); opacity: 0.3; }
    50% { transform: translateY(-100px) translateX(50px) rotate(180deg); opacity: 0.6; }
  }

  h1 {
    color: #4c2f2f;
    text-shadow: 1px 1px 3px rgba(255,255,255,0.3);
    margin-bottom: 20px;
    animation: fadeInDown 0.8s ease-out;
    z-index: 10;
    font-weight: 800;
    letter-spacing: 1px;
    text-transform: uppercase;
  }

  @keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-30px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .outer-box {
    background-color: #8b5a5a;
    padding: 10px; /* Sedikit padding agar terlihat seperti border tebal */
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    border-radius: 15px; /* Lebih rounded */
    animation: fadeInUp 1s ease-out;
    z-index: 10;
    transition: transform 0.3s ease;
  }

  .outer-box:hover { transform: translateY(-5px); }

  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .login-box {
    background-color: #4c2f2f;
    padding: 40px 30px;
    width: 100%;
    max-width: 400px; /* Agar responsif di HP */
    border-radius: 10px;
    color: white;
  }

  .input-group {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
    background: rgba(255, 255, 255, 0.1); /* Latar input transparan */
    border-radius: 30px;
    padding: 5px 15px;
    border: 1px solid transparent;
    transition: all 0.3s;
  }

  .input-group:hover, .input-group:focus-within {
    background: rgba(255, 255, 255, 0.2);
    border-color: #f8b4b4;
  }

  .input-group svg {
    flex-shrink: 0;
    width: 24px;
    height: 24px;
    fill: #f8b4b4;
    margin-right: 15px;
  }

  input[type="text"],
  input[type="password"] {
    flex-grow: 1;
    background: transparent;
    border: none;
    color: white;
    font-size: 16px;
    padding: 10px 0;
    outline: none;
  }

  input::placeholder { color: #dcbaba; }

  button {
    display: block;
    width: 100%;
    padding: 12px;
    font-size: 18px;
    font-weight: bold;
    background: linear-gradient(135deg, #f8b4b4 0%, #e89999 100%);
    color: #4c2f2f;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
    margin-top: 20px;
  }

  button:hover {
    transform: scale(1.02);
    box-shadow: 0 6px 20px rgba(0,0,0,0.3);
    background: linear-gradient(135deg, #e89999 0%, #d47777 100%);
  }

  .error-message {
    background-color: #ffcccc;
    color: #cc0000;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 14px;
    text-align: center;
    animation: fadeIn 0.5s;
    border: 1px solid #ff9999;
  }

  .links { margin-top: 20px; text-align: center; }
  .links a { color: #f8b4b4; text-decoration: none; font-size: 14px; }
  .links a:hover { color: white; text-decoration: underline; }

  @media (min-width: 450px) {
      .login-box { width: 380px; }
  }
</style>
</head>
<body>

<!-- Background particles -->
<div class="particle" style="width: 60px; height: 60px; top: 10%; left: 10%; animation-delay: 0s;"></div>
<div class="particle" style="width: 40px; height: 40px; top: 20%; left: 80%; animation-delay: 2s;"></div>
<div class="particle" style="width: 80px; height: 80px; top: 60%; left: 15%; animation-delay: 4s;"></div>
<div class="particle" style="width: 50px; height: 50px; top: 70%; left: 85%; animation-delay: 1s;"></div>
<div class="particle" style="width: 70px; height: 70px; top: 40%; left: 90%; animation-delay: 3s;"></div>

<h1>PORTAL STAFF</h1>

<div class="outer-box">
  <div class="login-box">
    
    <!-- Tampilkan Error Jika Login Gagal -->
    @if($errors->any())
        <div class="error-message">
            ⚠️ {{ $errors->first() }}
        </div>
    @endif

    <form id="adminLoginForm" action="{{ route('login.post') }}" method="POST">
      @csrf
      
      <!-- Input Username -->
      <div class="input-group">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
        <input type="text" placeholder="Username (misal: admin)" name="username" required autocomplete="off"/>
      </div>

      <!-- Input Password -->
      <div class="input-group">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 17a2 2 0 0 0 2-2v-3a2 2 0 1 0-4 0v3a2 2 0 0 0 2 2zm6-6V9a6 6 0 0 0-12 0v2H4v10h16V11h-2zm-8-2a4 4 0 1 1 8 0v2H10V9z"/></svg>
        <input type="password" placeholder="Password" name="password" required />
      </div>

      <button type="submit">MASUK</button>

      <div class="links">
        <a href="{{ route('user.login') }}">Bukan Staff? Login Pelanggan &rarr;</a>
      </div>
    </form>
  </div>
</div>

</body>
</html>