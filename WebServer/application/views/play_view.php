<style>
    <?php include './css/game.css'; ?>
</style>



<div class="avatar-wrapper">
<div class="avatar" id="my-avatar">
<div>HP:</div><span>100</span>
</div>

<div class="avatar" id="enemy-avatar">
<div>HP:</div><span>100</span>
</div>
</div>



<div class="my-card-hand">
</div>




<div class="waiting-msg">
    <h1 >Waiting For player</h1>
</div>


<div id="enemy-deck-slot">

</div>
<div id="my-deck-slot">

</div>




<div class="enemy-card-hand">
    <div class="card enemy-card"></div>
    <div class="card enemy-card"></div>
    <div class="card enemy-card"></div>
    <div class="card enemy-card"></div>
    <div class="card enemy-card"></div>
</div>

<input type="hidden" id="roomId" value="<?php echo $_GET['roomId'] ?>">

<script>
    <?php include './js/game.js'; ?>
</script>