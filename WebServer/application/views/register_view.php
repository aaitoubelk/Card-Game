<div class="login-form-wrapper">
    <form action="register" method="post" id="login-form">

        <div class="mb-3 section">
            <label for="login-input" class="form-label">Username</label>
            <input class="form-control" id="login-input" aria-describedby="emailHelp" name="username">
            <div id="emailHelp" class="form-text">Must be unique</div>
            <span class="isntCorrect is-unvissible">This field is requared</span><br>

        </div>

        <div class="mb-3 section">
            <label for="email-input" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email-input" aria-describedby="emailHelp" name="email">
            <span class="isntCorrect is-unvissible">This field is requared</span><br>

        </div>

        <div class="password-section section">

            <div class="mb-3" style="padding-right: 5px;">
                <label for="form-password" class="form-label">Password</label>
                <input type="password" class="form-control" id="form-password" name="password">
                <span class="isntCorrect is-unvissible">This field is requared</span><br>

            </div>

            <div class="mb-3" style="padding-left: 5px;">
                <label for="form-password-repeat" class="form-label">Repeat Password</label>
                <input type="password" class="form-control" id="form-password-repeat">
                <span class="isntCorrect is-unvissible">This field is requared</span><br>

            </div>

        </div>

        <button type="button" class="btn btn-primary">Submit</button>
        <div class="mt-3"> <a href="login">Have an account yet? Login!</a> </div>

    </form>

    <?php
    echo '<ul>';
    foreach ($this->viewBag['errors'] as $err) {
        echo "<li class=\"form-errors\">$err</li>";
    }
    echo '</ul>';

    ?>
</div>

<script>
    <?php include './js/valiidation.js'; ?>
</script>