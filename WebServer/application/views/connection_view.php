<div class="conn-wrapper">

    <button id="btn-create" class="btn btn-primary">
        <span>Create new Game +</span>
    </button>

    <span>or</span>

    <button id="btn-connect" class="btn btn-primary">
        <span>Connect to Game</span>
    </button>

</div>

<?php
echo '<ul>';
foreach ($this->viewBag['errors'] as $err) {
    echo "<li class=\"form-errors\">$err</li>";
}
echo '</ul>';
?>
<script>
    <?php include './js/connection.js'; ?>
</script>