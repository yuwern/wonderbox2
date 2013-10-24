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

		<title>LBB</title>

		<!-- CSS -->

                <?php echo $this->Html->css('stylelbb.css');?>
                <?php echo $this->Html->css('bluelbb.css');?>
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
		<script type="text/javascript" src="../js/jquery_1.4.2.js"></script>
		<script type="text/javascript" src="../js/jqueryui.js"></script>
		<script type="text/javascript" src="../js/easing.js"></script>
		<script type="text/javascript" src="../js/jquery.cycle.all.js"></script>
		<script type="text/javascript" src="../js/tooltip/jquery.tools.min.js"></script>
		<script type="text/javascript" src="../js/jquery.tabs/jquery.tabs.pack.js"></script>
		<script type="text/javascript" src="../js/filterable.pack.js"></script>
		<script type="text/javascript" src="../js/prettyPhoto/js/jquery.prettyPhoto.js"></script>
		<script type="text/javascript" src="../js/chirp.js"></script>
		<script type="text/javascript" src="../js/custom.js"></script>
		<script type="text/javascript" src="../js/jQuery.equalHeights.js"></script>
		<!-- ENDS JS -->

		<!-- superfish -->
		<link rel="stylesheet" type="text/css" media="screen" href="../css/superfish-custom.css" />
		<script type="text/javascript" src="../js/superfish-1.4.8/js/hoverIntent.js"></script>
		<script type="text/javascript" src="../js/superfish-1.4.8/js/superfish.js"></script>
		<!-- ENDS superfish -->

		<!-- tabs -->
        <link rel="stylesheet" href="../css/jquery.tabs.css" type="text/css" media="print, projection, screen" />
        <!-- Additional IE/Win specific style sheet (Conditional Comments) -->
        <!--[if lte IE 7]>
        <link rel="stylesheet" href="../css/jquery.tabs-ie.css" type="text/css" media="projection, screen">
        <![endif]-->
  		<!-- ENDS tabs -->

		<!-- Cufon -->
		<script src="../js/cufon-yui.js" type="text/javascript"></script>
		<script src="../js/bebas_400.font.js" type="text/javascript"></script>



</script>
        <!-- /Cufon -->
</head>

<body>

<?php echo $content_for_layout;?>
</body>
</html>
