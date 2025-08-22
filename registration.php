<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registry</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<style>
	
	main{
		padding: 10px 50px;
	}	
	
.form {
    margin: 50px auto;
    width: 500px;
    padding: 30px 25px;
    /*background: #DDE5ED;*/
/*	border: 0.8px solid darkgray;*/
}
h1.login-title {
    color: #666;
    margin: 0px auto 25px;
    font-size: 25px;
    font-weight: 300;
    text-align: center;
}
.login-input {
    font-size: 15px;
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 25px;
    height: 25px;
    width: calc(100% - 23px);
}
.login-input:focus {
    border-color:#6e8095;
    outline: none;
}
.login-button {
    color: #fff;
    background: slategray;
    border: 0;
    outline: 0;
    width: 100%;
    height: 50px;
    font-size: 16px;
    text-align: center;
    cursor: pointer;
}
.link {
    color: #666;
    font-size: 15px;
    text-align: center;
    margin-bottom: 0px;
}
.link a {
    color: #666;
}
h3 {
    font-weight: normal;
    text-align: center;
}
	</style>
</head>

<body>
	<?php include("header2.php"); ?>
	<main>
	<div align="center">
		<form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email address">
		<input type="text" class="login-input" name="address" placeholder="Address"/>
		<input type="number" class="login-input" name="number" placeholder="Phone no."/>
		<input type="text" class="login-input" name="center" placeholder="Center name" />
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Click to Login</a></p>
    </form>
	</div>
	
	
	</main>
	
	<?php include("footer.php"); ?>
</body>
</html>