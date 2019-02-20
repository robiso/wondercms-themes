<!DOCTYPE html>
<?php
if(defined('VERSION') && !defined('version'))
	define('version', VERSION);
if(version<'2.0.0')
	defined('INC_ROOT') OR die('Direct access is not allowed.');

wCMS::addListener('menu', 'colorSelector');

function colorSelector ($args) {
	$args[0] .= '
<li>
	<ul class="color-selector">
		<li><a href="" id="nightmode"><span class="glyphicon glyphicon-adjust" style="color: black;" aria-hidden="true"></span></a></li><li><a href="" id="default"><span class="glyphicon glyphicon-adjust" style="color: white;" aria-hidden="true"></span></a></li>
	    <li><p><font size="-8">Theme</font></p></li>
	</ul>
</li>';
	return $args;
}
if(isset($_COOKIE['stylesheet'])) {
	switch($_COOKIE['stylesheet']) {
		case 'nightmode':
			$css = 'css/style-night.css';
			break;
		default:
			$css = 'css/style-default.css';
			break;
	}
} else {
	$css = 'css/style-default.css';
}
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#75b1f2">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=wCMS::get('config','siteTitle')?> - <?=wCMS::page('title')?></title>
	<meta name="description" content="<?=wCMS::page('description')?>">
	<meta name="keywords" content="<?=wCMS::page('keywords')?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link id="stylesheet" rel="stylesheet" href="<?=wCMS::asset($css)?>">
	<?=wCMS::css()?>

</head>
<body>
	<div style="margin-top:60px">
	<?=wCMS::alerts()?>
	<?=wCMS::settings()?>
    </div>

	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid css3-shadow colorBackground">
			<div class="navbar-header padLeft15">
				<button type="button" class="navbar-toggle x collapsed" data-toggle="collapse" data-target="#navbar-collapse-x">
					<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
				</button>
					<a class="navbar-brand" href="<?= wCMS::url() ?>">
						<?= wCMS::get('config','siteTitle') ?>

					</a>
			</div>
			<div class="collapse navbar-collapse" id="navbar-collapse-x">
				<ul class="nav navbar-nav navbar-right">
					<?=wCMS::menu()?>

				</ul>
			</div>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row-fluid sm-gutter">
			<div class="col-xs-12 col-sm-8">
			<div class="box css3-shadow whiteBackground padding10">
				<?=wCMS::page('content')?>
			</div>
			</div>

			<div class="col-xs-12 col-sm-4">
			<div class="box css3-shadow whiteBackground padding10">
				<?=wCMS::block('subside')?>


				<div class="wrapper">
				<div class="links">
                <a href="https://github.com/carbideband"><svg class="svg-icon" style="width:30px; height:25px; fill:#75b1f2;"><use xlink:href="/themes/carbide/img/minima-social-icons.svg#github"></use></svg></a>
			    </div>
			    </div>


			</div>
			</div>

		</div>
	</div>

	<footer class="container-fluid css3-shadow whiteFont colorBackground padding20">
				<p><?= wCMS::footer() ?></p>
	</footer>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/jquery.autosize/3.0.17/autosize.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<?=wCMS::js()?>
	<script src="<?=wCMS::asset('js/js.cookie.js')?>"></script>
	<script>
		$( document ).ready(function() {
			$('body').css('margin-bottom', $('footer').height()+'px');
			
			function change_stylesheet(c) {
				switch(c) {
					case 'nightmode':
						var stylesheet = $('#stylesheet').attr('href').replace(/css\/style\-(.*)/g, 'css/style-night.css');
						break;
					case 'default':
						var stylesheet = $('#stylesheet').attr('href').replace(/css\/style\-(.*)/g, 'css/style-default.css');
						break;
				}
				Cookies.set("stylesheet", c, { expires: 365 });
				$("#stylesheet").attr({href: stylesheet});
			}
			
			if(Cookies.get("stylesheet")) {
				change_stylesheet(Cookies.get("stylesheet"));
			}
			
			$('.color-selector li a').click(function(e){
				e.preventDefault();
				change_stylesheet($(this).attr('id'));
			});
		});
	</script>
</body>
</html>

