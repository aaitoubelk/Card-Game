<div class="login-form-wrapper">
    <form id="login-form" method="POST">
        <div class="mb-3 section">
            <label for="email-input" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email-input" aria-describedby="emailHelp" name="email">
        </div>

        <div class="mb-3 section" style="padding-right: 5px;">
            <label for="form-password" class="form-label">Password</label>
            <input type="password" class="form-control" id="form-password" name="password">
            <a href="passreminder">Forgot your password?</a>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <div class="mt-3"> <a href="register">Have not any account yet? Register!</a> </div>
    </form>

    <?php
    echo '<ul>';
    foreach ($this->viewBag['errors'] as $err) {
        echo "<li class=\"form-errors\">$err</li>";
    }
    echo '</ul>';
    ?>
</div>