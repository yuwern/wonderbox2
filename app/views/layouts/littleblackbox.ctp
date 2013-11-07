<?php
/* SVN FILE: $Id: admin.ctp 54451 2011-05-24 12:26:17Z arovindhan_144at11 $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.skel.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision: 7805 $
 * @modifiedby    $LastChangedBy: AD7six $
 * @lastmodified  $Date: 2008-10-30 23:00:26 +0530 (Thu, 30 Oct 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Language" content="en" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />

		<title>Little Black Box by WonderBox</title>

		<!-- CSS -->

                <?php echo $this->Html->css('stylelbb.css');?>
                <?php echo $this->Html->css('blacklbb.css');?>
                <link href='http://fonts.googleapis.com/css?family=Radley:400italic' rel='stylesheet' type='text/css'>
		<!--[if IE 6]>
			<link rel="stylesheet" type="text/css" media="screen" href="css/ie-hacks.css" />
			<script type="text/javascript" src="../js/DD_belatedPNG.js"></script>
			<script>
          		/* EXAMPLE */
          		DD_belatedPNG.fix('*');
        	</script>
		<![endif]-->
		<!-- ENDS CSS -->

		<!-- prettyPhoto -->
		<link rel="stylesheet" href="../js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen" />
		<!-- ENDS prettyPhoto -->

		<!-- JS -->

		<!-- ENDS JS -->

		<!-- superfish -->

		<!-- ENDS superfish -->

		<!-- tabs -->

        <!-- Additional IE/Win specific style sheet (Conditional Comments) -->
        <!--[if lte IE 7]>
        <link rel="stylesheet" href="../css/jquery.tabs-ie.css" type="text/css" media="projection, screen">
        <![endif]-->
  		<!-- ENDS tabs -->

		<!-- Cufon -->


<script>


</script>
</head>

<body>
<!-- WRAPPER -->
	<div id="wrapper">

	<!-- TOP -->
	<!--<div id="top">
	  <div class="box">
	  	<div id="latest-tweet"><img src="img/twitter.png" class="twitter-bird" alt="Twitter" /></div>
	  	<script>Chirp({user:"ansimuz",max:1})</script>
	  </div>
	</div>-->
	<!-- ENDS TOP -->


	<!-- CONTENT -->
	<div id="content">

	<!-- top button -->
	<!--<div class="open-top">
		<a href="#" class="open"><img src="../img/top-tab.png" class="twitter-bird" alt="Twitter" /></a>
	</div>
	<!-- ENDS top button -->
 <!-- MAIN -->
		<div id="main">
                            <div id="logo">
			   <?php echo $this->Html->image('lbblogo.jpg');?>
                              </div>


			<!-- navigation -->
			<div id="centeredmenu">
			   <ul class="sf-menu">
			      <li class="current_page_item">
                              <li><?php echo $this->Html->link(__l('Home'), array('controller'=> 'subscriptions', 'action'=>'littleblackbox','admin' => false), array('title' => __l('Home')));?></li>
                               <li><?php echo $this->Html->link(__l('How It Works'), array('controller' => 'subscriptions', 'action' => 'how_it_work', 'admin' => false), array('title' => __l('How It Works'))); ?> </li>
                                            </li>
                                            </ul>
		        </div>

			<!-- ENDS navigation -->



                    <?php echo $content_for_layout;?>

<!-- FOOTER -->
	<div id="footer">
		<div id="footer-wrapper">

				<ul class="footer-cols">
				<li class="col">
					<h6>FOLLOW US</h6>
					<ul>

						<li class="icon facebook">
						<a href="https://www.facebook.com/littleblackboxMY" title="Facebook" target="_blank"><?php echo $this->Html->image('facebook_32.png',array('width'=>'32','height'=>'32')); ?></a></li>

					</ul>
				</li>

			</ul>
			<!-- footer-cols -->

		</div>

		<div class="footer-bottom">
                        <p class="legal"><?php echo $this->Html->link(__l('Back To WonderBox Home'), array('controller'=>'pages', 'action'=>'home'));?></p>
			<p class="legal">Muro created by <a href="http://www.luiszuno.com">luiszuno.com</a></p>
		</div>

	</div>
	<!-- ENDS FOOTER -->


	<!-- start cufon -->
	<script type="text/javascript"> Cufon.now(); </script>
	<!-- ENDS start cufon -->


	</body>
</html>

</body>
</html>
