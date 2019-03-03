<?php global $Wcms ?>
<!DOCTYPE html>
<?php

    $Wcms->addListener('menu', 'colorSelector');

    function colorSelector ($args) {
    	$args[0] .= '
            <li>
            	<ul class="color-selector">
            		<li><a href="" id="nightmode"><span class="fa fa-moon-o fa-lg" style="color: black;" aria-hidden="true"></span></a></li>
            		<li><a href="" id="default"><span class="fa fa-sun-o fa-lg" style="color: white;" aria-hidden="true"></span></a></li>
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

    	<title><?= $Wcms->get('config','siteTitle') ?> - <?= $Wcms->page('title') ?></title>
    	<meta name="description" content="<?=$Wcms->page('description') ?>">
    	<meta name="keywords" content="<?= $Wcms->page('keywords') ?>">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    	<link id="stylesheet" rel="stylesheet" href="<?= $Wcms->asset($css) ?>">
    	<?= $Wcms->css() ?>

    </head>

    <body>
    	<div style="margin-top:60px">
        	<?= $Wcms->alerts() ?>
        	<?= $Wcms->settings() ?>

        </div>

    	<nav class="navbar navbar-inverse navbar-fixed-top">
    		<div class="container-fluid css3-shadow colorBackground">
    			<div class="navbar-header padLeft15">
    				<button type="button" class="navbar-toggle x collapsed" data-toggle="collapse" data-target="#navbar-collapse-x">
    					<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
    				</button>
    					<a class="navbar-brand" href="<?= $Wcms->url() ?>">
    						<?= $Wcms->get('config','siteTitle') ?>

    					</a>
    			</div>
    			<div class="collapse navbar-collapse" id="navbar-collapse-x">
    				<ul class="nav navbar-nav navbar-right">
    					<?= $Wcms->menu() ?>

    				</ul>
    			</div>
    		</div>
    	</nav>

    	<div class="container-fluid">
    		<div class="row-fluid sm-gutter">
    			<div class="col-xs-12 col-sm-8">
        			<div class="box css3-shadow whiteBackground padding10">
        				<?= $Wcms->page('content') ?>

        			</div>
    			</div>

    			<div class="col-xs-12 col-sm-4">
        			<div class="box css3-shadow whiteBackground padding10">
        				<?= $Wcms->block('subside') ?>
        			</div>
    			</div>
    		</div>
    	</div>

    	<footer class="container-fluid css3-shadow whiteFont colorBackground padding20">
    		<p><?= $Wcms->footer() ?></p>
    	</footer>

        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    	<?= $Wcms->js() ?>

    	<script src="<?= $Wcms->asset('js/js.cookie.js') ?>"></script>
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
