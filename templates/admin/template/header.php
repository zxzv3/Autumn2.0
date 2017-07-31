<!DOCTYPE html>
<html>
<head>
	<title>Autumn 2.0</title>
	<base href="<?=$this->config->item('autumn')['base_url']?>">
	<link rel="stylesheet" href="./assets/css/admin/style.css">
	<link rel="stylesheet" href="./assets/bin/font-awesome/font-awesome.min.css">
	<?php
	    if( strrpos($_SERVER['REQUEST_URI'] , '?') == -1){
	        $path = 'http://' .  $_SERVER['HTTP_HOST'] . substr($_SERVER['REQUEST_URI'] , 0 , strrpos($_SERVER['REQUEST_URI'] , '?'));
	    }else{
	        $path = 'http://' .  $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	    }

	    $path = substr($path , 0 , strrpos($path , '?'));

	    if($path == ''){
	        $path = 'http://' .  $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	    }
	?>
	<script type="text/javascript">
		var path = '<?=$path?>';
	</script>

	<style type="text/css" media="screen">
		th,td{white-space: nowrap!important;}
	</style>