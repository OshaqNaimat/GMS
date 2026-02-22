<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pump House | Login</title>

<!-- Bootstrap 5 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>

/* ===========================
   PUMP HOUSE THEME
=========================== */

body {
  background: linear-gradient(135deg, #0f0f0f, #1a1a1a);
  font-family: 'Segoe UI', sans-serif;
  height: 100vh;
}

.brand {
  font-size: 32px;
  font-weight: 800;
  color: #ff3c3c;
  letter-spacing: 2px;
}

.brand span {
  color: #ffffff;
}

.auth-card {
  background: #111;
  border: 1px solid #222;
  border-radius: 15px;
  padding: 40px;
  box-shadow: 0 0 30px rgba(255, 0, 0, 0.15);
}

.auth-title {
  color: #fff;
  font-weight: 700;
}

.form-control {
  background: #1c1c1c;
  border: 1px solid #333;
  color: #fff;
  height: 50px;
}

.form-control:focus {
  background: #1c1c1c;
  border-color: #ff3c3c;
  box-shadow: none;
  color: #fff;
}

.btn-pump {
  background: #ff3c3c;
  border: none;
  height: 50px;
  font-weight: 600;
  transition: 0.3s;
}

.btn-pump:hover {
  background: #e60000;
}

.form-text a {
  color: #ff3c3c;
  text-decoration: none;
}

.form-text a:hover {
  text-decoration: underline;
}

.icon-input {
  position: relative;
}

.icon-input i {
  position: absolute;
  top: 50%;
  left: 15px;
  transform: translateY(-50%);
  color: #777;
}

.icon-input input {
  padding-left: 45px;
}

.gym-bg {
  background: url('https://images.unsplash.com/photo-1599058917212-d750089bc07e') center/cover no-repeat;
  border-radius: 15px;
  min-height: 100%;
}

@media (max-width: 992px) {
  .gym-bg {
    display: none;
  }
}

</style>
</head>
<body>

<div class="container h-100">
  <div class="row h-100 align-items-center">

    <!-- LEFT SIDE IMAGE -->
    <div class="col-lg-6 gym-bg"></div>

    <!-- RIGHT SIDE FORM -->
    <div class="col-lg-6">
      <div class="auth-card">

        <div class="text-center mb-4">
          <div class="brand">PUMP <span>HOUSE</span></div>
          <p class="text-muted mt-2">Gym Management System</p>
        </div>

        <h4 class="auth-title mb-4 text-center">Login to Your Account</h4>

        <form>

          <div class="mb-3 icon-input">
            <i class="fa fa-envelope"></i>
            <input type="email" class="form-control" placeholder="Email Address">
          </div>

          <div class="mb-3 icon-input">
            <i class="fa fa-lock"></i>
            <input type="password" class="form-control" placeholder="Password">
          </div>

          <div class="d-flex justify-content-between mb-3">
            <div>
              <input type="checkbox"> <span class="text-muted">Remember Me</span>
            </div>
            <a href="#" class="text-danger">Forgot Password?</a>
          </div>

          <button type="submit" class="btn btn-pump w-100">Login</button>

          <div class="text-center mt-4 form-text">
            Don’t have an account? <a href="signup.html">Sign Up</a>
          </div>

        </form>

      </div>
    </div>

  </div>
</div>

</body>
</html>