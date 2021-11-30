<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="">Dojo eCommerce</a>
        <div class="d-flex">
            <a class="text-white" href="/users/show_cart">Shopping Cart (5)</a>
            <a class="text-white px-3" href="">log off</a>
        </div>
    </div>
</nav>
<div class="container-fluid mt-2">
    <table class="table table-striped table-hover border">
        <thead>
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
<?php ?>
            <tr>
                <td>Black Belt</td>
                <td>19.99</td>
                <td>
                    2
                    <a class="mx-3" href=""> update </a>
                    <button class="btn"> <i class="fa fa-trash"></i> </button>
                </td>
                <td>39.98</td>
            </tr>
<?php ?>
        </tbody>
    </table>
    <div class="text-lg-right">
        <h5> Total: 79.96 </h5>
        <form action="/users/show_catalog">
            <button class="btn btn-success">Continue Shopping</button>
        </form>
    </div>
    <form class="mt-3 ml-3" style="width: 50%;">
        <h2>Shipping Information</h2>
        <div class="row mb-3">
            <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="first_name">
            </div>
        </div>
        <div class="row mb-3">
            <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="last_name">
            </div>
        </div>
        <div class="row mb-3">
            <label for="address" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address">
            </div>
        </div>
        <div class="row mb-3">
            <label for="address_two" class="col-sm-2 col-form-label">Address 2</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address_two">
            </div>
        </div>
        <div class="row mb-3">
            <label for="city" class="col-sm-2 col-form-label">City</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="city">
            </div>
        </div>
        <div class="row mb-3">
            <label for="state" class="col-sm-2 col-form-label">State</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="state">
            </div>
        </div>
        <div class="row mb-3">
            <label for="zipcode" class="col-sm-2 col-form-label">Zip Code</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="zipcode">
            </div>
        </div>
        <h2>Billing Information</h2>
        <div class="row mb-3">
            <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="first_name">
            </div>
        </div>
        <div class="row mb-3">
            <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="last_name">
            </div>
        </div>
        <div class="row mb-3">
            <label for="address" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address">
            </div>
        </div>
        <div class="row mb-3">
            <label for="address_two" class="col-sm-2 col-form-label">Address 2</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address_two">
            </div>
        </div>
        <div class="row mb-3">
            <label for="city" class="col-sm-2 col-form-label">City</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="city">
            </div>
        </div>
        <div class="row mb-3">
            <label for="state" class="col-sm-2 col-form-label">State</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="state">
            </div>
        </div>
        <div class="row mb-3">
            <label for="zipcode" class="col-sm-2 col-form-label">Zip Code</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="zipcode">
            </div>
        </div>
        <!-- Card Details -->
        <div class="row mb-3">
            <label for="card" class="col-sm-2 col-form-label">Card</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="card">
            </div>
        </div>
        <div class="row mb-3">
            <label for="security_code" class="col-sm-2 col-form-label">Security Code</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="security_code">
            </div>
        </div>
        <div class="row mb-3">
            <label for="expiration_date" class="col-sm-2 col-form-label">Expiration</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="expiration_date">
            </div>
        </div>
        <div class="row float-lg-right my-3">
            <button class="btn btn-success mx-3">Pay</button>
        </div>
    </form>
</div>