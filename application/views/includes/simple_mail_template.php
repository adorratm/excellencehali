<!DOCTYPE html>
<html lang="<?=$lang?>">
<head>
    <title><?= $subject; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no,shrink-to-fit=no" />
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,400i,700&display=swap" rel="stylesheet">
	<style type="text/css">
		Body {font-family: Noto Sans, Arial;}
		div.content {width: 600px; min-height: 150px; margin: 0px auto; padding: 30px; background-color: #FFFFFF; border: solid 1px rgba(0,0,0,0.1); border-radius: 4px; text-align: center;}
		a {color: #333333; font-weight: bold;}
		h2 {margin: 0px; padding: 0px;}
	</style>
</head>
<body>
	<div class="content">
        <img src="<?= get_picture("settings_v", $settings->logo) ?>" width="250" height="250">
		<h4 class="p-0 m-0"><?=$subject; ?></h4>
		<p><?= $message ?></p>
	</div>
</body>
</html>