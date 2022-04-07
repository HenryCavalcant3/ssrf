<?php
	if(isset($_GET['url'])) {
		$img = "https://miro.medium.com/max/640/0*i1v1In2Tn4Stnwnl.jpg";
		$url = $_GET['url'];

		// if($img == $url)
			$image = fopen($url, 'rb');

		header("Content-Type: image/png");
		// header("Content-Type: text/html");

		fpassthru($image);
	}
?>