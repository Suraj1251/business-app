<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<style>
body{
    font-family: Arial;
    margin:0;
    background:#f4f6f9;
}
.nav{
    background:#2c3e50;
    color:white;
    padding:15px;
    display:flex;
    justify-content:space-between;
}
.container{
    padding:20px;
}
.card{
    background:white;
    padding:20px;
    margin-top:20px;
    border-radius:10px;
    box-shadow:0px 2px 10px rgba(0,0,0,0.1);
}
.logout{
    background:red;
    padding:5px 10px;
    color:white;
    text-decoration:none;
}
</style>
</head>

<body>

<div class="nav">
    <h3>Dashboard</h3>
    <div>
        Welcome, <?php echo $_SESSION['user']; ?>
        <a class="logout" href="index.html">Logout</a>
    </div>
</div>

<div class="container">
    <div class="card">
        <h2>Welcome 🎉</h2>
        <p>This is your dashboard.</p>
    </div>
</div>

</body>
</html>
