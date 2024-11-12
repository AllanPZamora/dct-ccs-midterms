<?php

include("header.php");
?>

<br><br>
<div class="card p-4 mx-auto" style="width: 300px;">
    <h3 class="card-title text-center">Login</h3>
    <div class="container">
        <form>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password">
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
            
        </form>
    </div>
</div>

<?php
include("footer.php");
?>