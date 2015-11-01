<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="AllyTech Desarrollo">
		<link rel="shortcut icon" hrlogo-agimedef="<?php echo ASSETS;?>ico/favicon.png">
		<title><?php echo $title;?></title>


		<!-- Jquery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

		<!-- Jquery UI -->
		 <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

		<!-- bootstrap 3.5 -->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>




		<!-- Uso para los menúes -->
		<link href="<?php echo ASSETS;?>css/docs.css" rel="stylesheet">
		<!-- <link href="<?php echo ASSETS;?>css/pygments-manni.css" rel="stylesheet"> -->

		  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


		<!-- DatePicker -->
		<script>
			$(function() {
				$.datepicker.regional['es'] = {
					closeText: 'Cerrar',
					prevText: '<Ant',
					nextText: 'Sig>',
					currentText: 'Hoy',
					monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
					monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
					dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
					dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
					dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
					weekHeader: 'Sm',
					dateFormat: 'dd/mm/yy',
					firstDay: 1,
					isRTL: false,
					showMonthAfterYear: false,
					yearSuffix: ''
				}
				$.datepicker.setDefaults($.datepicker.regional['es']);
				$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
				$( "#datepicker" ).datepicker( "option", "showAnim", "drop" );
			});
		</script>











		<!-- CSS Principal -->
		<link href="<?php echo PUBLIC_FOLDER;?>css/main.css" rel="stylesheet">

		<!-- Extras CSS -->
		<?php if(isset($scripts_css)):?>
		<?php echo $scripts_css;?>
		<?php endif;?>
		<!-- Fin Extras CSS -->



		<script type="text/javascript">
		var _public_folder = '<?php echo PUBLIC_FOLDER;?>'; var _base_url = '<?php echo base_url();?>'; var _this_url = '<?php echo $this_url;?>';
		</script>

		<!-- Extras scripts -->
	<?php if(isset($scripts)):?>
	<?php echo $scripts;?>
	<?php endif;?>
	<!-- Fin Extras scripts -->

		<!-- Choosen Select -->

		<link rel="stylesheet" href="<?php echo PUBLIC_FOLDER;?>assets/chosen/docsupport/prism.css">
		<link rel="stylesheet" href="<?php echo PUBLIC_FOLDER;?>assets/chosen/chosen.css" />
		<style type="text/css" media="all">
			/* fix rtl for demo */
			.chosen-rtl .chosen-drop { left: -9000px; }
		</style>

		<!-- Recolector de incidencias -->
		<script type="text/javascript" src="http://jira.allytech.com/s/d41d8cd98f00b204e9800998ecf8427e/es_ESvh6qat-1988229788/6144/4/1.4.0-m6/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?collectorId=93c84ce5"></script>
 </head>
 <body>
