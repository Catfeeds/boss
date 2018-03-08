<?php
$this->registerCss('#page-wrapper{ position:relative; margin:0px}');
$title = Yii::t('app', 'Please Sign In');
$usernameText = Yii::t('app', 'Username');
$passwordText = Yii::t('app', 'Password');
$remembermeText = Yii::t('app', 'Remember Me');
$loginText = Yii::t('app', 'Login');
?>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?= $title ?></h3>
				</div>
				<div class="panel-body">
					<form role="form" method="POST" action="index.php?r=admin/default/login">
						<input type="hidden" value="<?= Yii::$app->getRequest()->getCsrfToken() ?>" name="_csrf" />
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="<?= $usernameText ?>" id="username" name="username" type="username" autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="<?= $passwordText ?>" id="password" name="password" type="password">
							</div>
							<!--
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" ><?= $remembermeText ?>
								</label>
							</div>
							-->
							<!-- Change this to a button or input when using this as a form -->
							<input type="submit" class="btn btn-lg btn-success btn-block" value="<?= $loginText ?>" />
						</fieldset>
					</form>
					<div style="color:red" data-bind="html:errmsg"></div>
				</div>
			</div>
		</div>
	</div>
</div>