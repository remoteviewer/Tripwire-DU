<?php

require_once '../paypal/PayPalAutoload.php';

$wsdl = array();
$wsdl[PayPalWsdlClass::WSDL_URL] = 'https://www.paypalobjects.com/wsdl/PayPalSvc.wsdl';
// no cache so you always get the latest version, slower so you can comment this line if you prefer
$wsdl[PayPalWsdlClass::WSDL_CACHE_WSDL] = WSDL_CACHE_NONE;

$get = new PayPalServiceGet($wsdl);

$password = new PayPalStructUserIdPasswordType();
$password->setUsername('josh.glassmaker_api1.gmail.com');
$password->setPassword('95QQJ8J8UPB9Q7JM');
$password->setSignature('AFcWxV21C7fd0v3bYYYRCpSSRl31AXeu8iMzDLjetEgOG2iEfgw24e.O');
$get->setSoapHeaderRequesterCredentials(new PayPalStructCustomSecurityHeaderType(null,null,$password));

$get->setLocation('https://api-3t.paypal.com/2.0/');


// 1: all currencies, 0: your main currency
$requestType = new PayPalStructGetBalanceRequestType(0);
// the latest available version of the PayPal API, indicated in the "ns:version" attribute of the WSDL definitions root tag
$requestType->setVersion(98.0);
$result = $get->GetBalance(new PayPalStructGetBalanceReq($requestType));

if($result) {
    #echo "\r\nYour PayPal account balance amount is: " . $result->getBalance()->get_();
    $balance = $result->getBalance()->get_();
} else {
    print_r($get->getLastError());
}

#$balance = 50;
$goal = 2500;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Tripwire T-Shirt</title>

	<link rel="shortcut icon" href="//static.eve-apps.com/images/favicon.png">
	<link href='//fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<style type="text/css">

		* {
			margin: 0;
			padding: 0;
		}

		body {
			background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAACWCAIAAACzY+a1AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA2ZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDpFOTY0OTRFQjVGMjA2ODExOTdBNUEwQjc5MDBCQTdENSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpBQjFENUY3MDgyQTExMUUxOTNEOUYwNDcxOTgzQkRCRCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpBQjFENUY2RjgyQTExMUUxOTNEOUYwNDcxOTgzQkRCRCIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M1IE1hY2ludG9zaCI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjRBQzc2N0Y3QjkyNDY4MTE4MjJBQjA2QzVDRjY1NTZCIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkU5NjQ5NEVCNUYyMDY4MTE5N0E1QTBCNzkwMEJBN0Q1Ii8+IDwvcmRmOkRlc2NyaXB0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") repeat top left;
			font-family: "Quicksand","Helvetica Neue",helvetica,sans-serif;
			font-size: 14px;
			color: #aaa;
		}

		h1 {
			font-weight: normal;
			font-size: 10em;
			letter-spacing: -0.05em;
			line-height: 0.7;
		}

		#content {
			margin-top: 5%;
		}

		#shirts {
			display: inline-block;
			position: relative;
			width: 480px;
			height: 460px;
		}

		#purchase {
			display: inline-block;
			vertical-align: top;
			height: 460px;
			position: relative;
			padding-top: 100px;
			padding-left: 25px;
		}

		#donate {
			display: inline-block;
			vertical-align: top;
			height: 460px;
			position: relative;
		}

		#donate a {
			color: #319ebc;
		}

		#donate .details {
			text-align: left;
			line-height: 0.7;
			padding: 6px 0;
			font-size: 2em;
		}

		#donate .detailsSmall {
			text-align: left;
			font-size: 15px;
			padding-top: 50px;
		}


		#price {
			display: inline-block;
			position: absolute;
			bottom: 0;
		}

		.super {
			vertical-align: top;
		}

		#msg {
			text-align: justify;
			padding-top: 10px;
		}

		.tagline {
			color: #fff;
			font-size: 19px;
			letter-spacing: 0.35em;
		}

		a {
			text-decoration: none;
			outline: none;
			color: #319ebc;
		}

		a:hover {
			text-decoration: none;
		}

		#goalbar {
			width: 100%;
			font-size: 10px;
		}

		.startCap {
			border-right: 1px solid #aaa;
			width: 1px;
		}

		.endCap {
			border-left: 1px solid #aaa;
			width: 1px;
		}

		.top .line {
			border-bottom: 1px solid #aaa;
		}

		.bottom .line {
			border-top: 1px solid #aaa;
		}

		.top .met {
			border-bottom: 4px solid #319ebc;
		}

		.bottom .met {
			border-top: 4px solid #319ebc;
		}

		#progress {
			font-size: 16px;
			text-align: center;
		}

		p {
			padding-bottom: 8px;
		}

		ul {
			margin-left: 30px;
		}

		li {
			padding-bottom: 4px;
		}

		.hidden {
			display: none;
		}

	</style>
</head>
<body>
	<div id="content">
		<div style="width: 880px; margin: 0 auto;">
			<form id="donate_form" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="7EQ3L7DJBWFVW">
				<input type="hidden" name="on0" value="Style">
				<input type="hidden" name="on1" value="Color">
				<input type="hidden" name="on2" value="Size">
					
				<div id="shirts">
					<img width="340" style="position: absolute;" src="//static.eve-apps.com/images/tshirt_black.png" data-zoom-image="//static.eve-apps.com/images/tshirt_black.png" />
					<img width="340" style="position: absolute; left: 150px; top: 150px;" src="//static.eve-apps.com/images/tshirt_white.png" data-zoom-image="//static.eve-apps.com/images/tshirt_white.png" />
				</div>
				<div id="donate">
					<span style="font-size: 2em;"><a id="order" href="">Click to get your t-shirt!</a></span>
					<div class="details">
						Goal: <span style="font-size: 18px;" class="super">$</span>2,500<span style="font-size: 18px;" class="super">.00</span>
					</div>
					<table id="goalbar" cellpadding="0" cellspacing="0">
						<tr class="top">
							<td class="startCap">&nbsp;</td>
						<?php

							for ($i = 1, $l = 100; $i <= $l; $i++) {
								echo '<td class="line '.($balance >= ($goal / $l) * $i ? 'met' : '').'">&nbsp;</td>';
							}

						?>
							<td class="endCap">&nbsp;</td>
						</tr>
						<tr class="bottom">
							<td class="startCap">&nbsp;</td>
						<?php

							for ($i = 1, $l = 100; $i <= $l; $i++) {
								echo '<td class="line '.($balance >= ($goal / $l) * $i ? 'met' : '').'">&nbsp;</td>';
							}

						?>
							<td class="endCap">&nbsp;</td>
						</tr>
					</table>
					<div id="progress"><?= number_format($balance / $goal * 100) ?>% - <?= number_format(($goal - $balance) / 25) ?> shirts to go...</div>
					<div class="detailsSmall">
						Hanes Tagless T-Shirts
						<br/>
						Men's or Women's
						<br/>
						Black or White
						<br/>
						Small, Medium, Large, XLarge
						<br/>
						<span style="font-size: 10px;">Further customization by request</span>
					</div>
					<div id="price">
						<h1><span style="font-size: 60px;" class="super">$</span>25<span style="font-size: 60px;" class="super">.00</span></h1>
						<span class="tagline">Tripwire T-Shirt</span>
					</div>
				</div>
				<div id="purchase" class="hidden">
					<div class="btn-group" data-toggle="buttons">
						<label class="btn btn-primary active">
							<input type="radio" name="os0" value="Men's" autocomplete="off" checked> Men's
						</label>
						<label class="btn btn-primary">
							<input type="radio" name="os0" value="Women's" autocomplete="off"> Women's
						</label>
					</div>
					<br/><br/>
					<div class="btn-group" data-toggle="buttons">
						<label class="btn btn-primary active">
							<input type="radio" name="os1" value="White" autocomplete="off" checked> White
						</label>
						<label class="btn btn-primary">
							<input type="radio" name="os1" value="Black" autocomplete="off"> Black
						</label>
					</div>
					<br/><br/>
					<div class="btn-group" data-toggle="buttons">
						<label class="btn btn-primary active">
							<input type="radio" name="os2" value="Small" autocomplete="off" checked> Small
						</label>
						<label class="btn btn-primary">
							<input type="radio" name="os2" value="Medium" autocomplete="off"> Medium
						</label>
						<label class="btn btn-primary">
							<input type="radio" name="os2" value="Large" autocomplete="off"> Large
						</label>
						<label class="btn btn-primary">
							<input type="radio" name="os2" value="X Large" autocomplete="off"> X-Large
						</label>
					</div>
					<br/><br/>
					<button type="button" id="buy" class="btn btn-lg btn-success" autocomplete="off">Purchase</button>
				</div>
				<div id="msg">
					<p>This is a fund raising for Tripwire development, I have recently been laid off and am in search of work - I shouldn't have much trouble finding a new job with examples of my talents like Tripwire.</p>
					<p>This is not to supplement my income but to delay my re-entering the work force and instead dedicate a large amount of my time on Tripwire development. Expect about 80 hours worth of development time that I will tweet about as I work.</p>
					<ul>
						<li>If you would like to donate more or donate without getting a t-shirt <a href="https://tripwire.eve-apps.com/donate">Click Here</a></li>
						<li>Please be sure your PayPal is set to the address you want the t-shirt sent when checking out</li>
						<li>Yes I can ship outside of the US</li>
						<li>If you want more then 1 t-shirt you must place 1 at a time, sorry PayPal sucks</li>
						<li>Once the goal is met I will place the order for the shirts and once I receive them I will send them to you individually - expect 2-4 weeks</li>
						<li>If the goal is met and you still want a t-shirt I will place more orders every 2 weeks</li>
						<li>Other options like different colors, additional sizes, styles are available - please contact me</li>
						<li>If you just want a cheap Tripwire t-shirt you have my permission (though you don't need it) to make your own, this is more about raising funds</li>
					</ul>
				</div>
			</form>
		</div>
	</div>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="//static.eve-apps.com/js/zoom.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<script type="text/javascript">

		$("#shirts img").elevateZoom({zoomType: "lens", lensShape: "round", lensSize: 200, containLensZoom: true});

		$("#order").click(function(e) {
			e.preventDefault();

			$("#donate").hide();
			$("#purchase").removeClass("hidden").show();
		});

		$("#buy").click(function(e) {
			$("#donate_form").submit();
		});

	</script>
</body>
</html>