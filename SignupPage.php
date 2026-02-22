<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pump House | Sign Up</title>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>

/* Same Theme Styling */
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

.form-control {
  background: #1c1c1c;
  border: 1px solid #333;
  color: #fff;
  height: 50px;
}

.form-control:focus {
  border-color: #ff3c3c;
  box-shadow: none;
  color: #fff;
}

.btn-pump {
  background: #ff3c3c;
  border: none;
  height: 50px;
  font-weight: 600;
}

.btn-pump:hover {
  background: #e60000;
}

</style>
</head>
<body>

<div class="container h-100 d-flex align-items-center justify-content-center">
  <div class="col-lg-6">
    <div class="auth-card">

      <div class="text-center mb-4">
        <div class="brand">PUMP <span>HOUSE</span></div>
        <p class="text-muted mt-2">Create Your Membership</p>
      </div>

      <form>

        <div class="mb-3">
          <input type="text" class="form-control" placeholder="Full Name">
        </div>

        <div class="mb-3">
          <input type="email" class="form-control" placeholder="Email Address">
        </div>

        <div class="mb-3">
          <input type="text" class="form-control" placeholder="Phone Number">
        </div>

        <div class="mb-3">
          <input type="password" class="form-control" placeholder="Password">
        </div>

        <div class="mb-4">
          <input type="password" class="form-control" placeholder="Confirm Password">
        </div>

        <button type="submit" class="btn btn-pump w-100">Create Account</button>

        <div class="text-center mt-4 text-muted">
          Already a member? <a href="login.html" class="text-danger">Login</a>
        </div>

      </form>

    </div>
  </div>
</div>

</body>
</html> 