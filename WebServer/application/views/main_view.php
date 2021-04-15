<center>
    <h1>LOGED IN</h1>
    <p>Username is: <strong><?php echo $_SESSION['user']['username']; ?></strong> </p>
    <p>Is admin: <strong><?php echo $_SESSION['user']['isAdmin'] == 0 ? 'false' : 'true'; ?></strong> </p>

    <a href="main/logout">LogOut</a>
    <br>
    <br>
    <a href="game">To CardGame</a>


</center>