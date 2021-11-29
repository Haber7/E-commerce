<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">Dojo eCommerce</a>
    </div>
</nav>
<div class="container-fluid mt-3 p-3 text-center">
<?php if(isset($_SESSION['warning']) && $_SESSION['warning'] != null){ ?>
    <div class="alert alert-danger" role="alert">
        <?= $_SESSION['warning'] ?>
    </div>
<?php } ?>
    <form class="needs-validation mt-3 mx-auto" style="width: 40%" action="/users/check_account" method="post" novalidate>
        <!-- Email -->
        <div class="row mb-3">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="form-group col-sm-10 text-lg-left">
                <input type="email" class="form-control" name="email" id="email" required>
                <div class="invalid-feedback"> Invalid Email </div>
            </div>
        </div>
        <!-- Password -->
        <div class="row mb-3">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="form-group col-sm-10 text-lg-left">
                <input type="password" class="form-control" name="password" id="password" required>
                <div class="invalid-feedback"> Invalid Password </div>
            </div>
        </div>
        <!-- Login Button -->
        <div class="text-lg-right">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
</div>