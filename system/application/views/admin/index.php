<html>
<head>
<title>User Login</title>

</head>
<body>

<?php
if(isset($message))
{
	echo $message;
}
?>

<p>
<?=form_open('users/login/' . $redirect_to) ?>

<h5>Username</h5>
<?=$this->validation->username_error; ?>
<input type="text" name="username" value="<?=$this->validation->username;?>" size="50" />

<h5>Password</h5>
<?=$this->validation->password_error; ?>
<input type="text" name="password" value="<?=$this->validation->password;?>" size="50" />

<div><input type="submit" value="Submit" /></div>

</form>
</p>

</body>
</html>