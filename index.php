<!DOCTYPE html>
<?php
	session_start();
	session_regenerate_id();
?>
<html>
	<head>
		<?php
		include_once("sources/php/head.php");
		$session = (check_session()) ? header("Location: dashboard.php") : header("Location: login_form.php");
		?>
	</head>
	<body>
		<div class="container">
    <div class="row">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Zaloguj się</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form accept-charset="UTF-8" role="form">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="email@adres.pl" name="email" type="text">
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Hasło" name="password" type="password" value="">
			    		</div>
			    		<div class="checkbox">
			    	    	<label>
			    	    		<input name="remember" type="checkbox" value="Remember Me"> Zapamiętaj mnie
			    	    	</label>
			    	    </div>
			    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Zaloguj się">
			    	</fieldset>
			      	</form>
                      <hr/>
                    <center><h4>LUB</h4></center>
                    <a href="revocery_password.php" class="btn btn-lg btn-block">Odzyskaj hasło</a>
			    </div>
			</div>
		</div>
	</div>
</div>
	</body>
</html>