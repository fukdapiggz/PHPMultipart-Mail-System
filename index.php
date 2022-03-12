<?php
//Initialize
if (($_GET["success"] ?? '')=='1'){echo 'Message sent success!<br><a href="index.php?success=0">Reset Form</a>';exit;}
//Config
$businessName = 'Instant Contact';
$senderEmail = 'InstactContact@server.nz';
$receiverName = $businessName . ' Recipient';
$receiverEmail = 'recipient@domain.com';
//Links
$InstagramLink = 'instagram.com'; //without www.
$FacebookLink = 'facebook.com'; //without www.
?>
<!DOCTYPE HTML> <html><head><title>Email Form</title><meta http-equiv="content-Type" content="text/html; charset=UTF-8"><meta content="width=device-width, initial-scale=1" name="viewport" />
<style type="text/css" title="global">.pageBox{width:100%;display:flex;justify-content:center;}.container{width:65%;}</style>
<script type="text/javascript">

function igOptionAction() {
if (this.checked == true) {
document.getElementById("ig").value = '1';
document.getElementById("igLink").placeholder = "";
document.getElementById("igLink").value = "<?php echo $InstagramLink ?>";
document.getElementById("igLink").required = "required";
document.getElementById("igLink").disabled = false;
}
else if (this.checked == false) {
document.getElementById("ig").value = '0';
document.getElementById("igLink").placeholder = "Enable Option to Use.";
document.getElementById("igLink").value = "";
document.getElementById("igLink").required = "";
document.getElementById("igLink").disabled = true;
}
}

function fbOptionAction() {
if (this.checked == true) {
document.getElementById("fb").value = '1';
document.getElementById("fbLink").placeholder = "";
document.getElementById("fbLink").value = "<?php echo $FacebookLink ?>";
document.getElementById("fbLink").required = "required";
document.getElementById("fbLink").disabled = false;
}
else if (this.checked == false) {
document.getElementById("fb").value = '0';
document.getElementById("fbLink").placeholder = "Enable Option to Use.";
document.getElementById("fbLink").value = "";
document.getElementById("fbLink").required = "";
document.getElementById("fbLink").disabled = true;
}
}

</script>
<script type="text/javascript">

function initializeToggles() {

var igOption= document.getElementById('igOption');
igOption.onchange = igOptionAction;

var fbOption= document.getElementById('fbOption');
fbOption.onchange = fbOptionAction;

}

</script>
<script type="text/javascript">window.onload = initializeToggles;</script>
	</head>
	<body>
<div class="pageBox">
<form name="email" action="send_email.php" method="get" autocomplete="false" autofill="off">
<div class="container">
<table align="center">
<tr><td><label for="subject"><b>Email Subject</b>:</label><br><input type="text" size="75%" id="subject" name="subject" required></td></tr>
<tr><td><label for="businessName"><b>Sender Name</b>: *(Change in config with other fields)</label><br><input type="text" size="75%" id="businessNameDisable" name="businessNameDisable" value="<?php echo $businessName; ?>" disabled>
<input type="hidden" id="businessName" name="businessName" value="<?php echo $businessName; ?>"></td></tr>
<tr><td><label for="subject"><b>Sender Email</b>:</label><br><input type="text" size="75%" id="senderEmailDisable" name="senderEmailDisable" value="<?php echo $senderEmail; ?>" disabled>
<input type="hidden" id="senderEmail" name="senderEmail" value="<?php echo $senderEmail; ?>"></td></tr>

<tr><td><label for="receiverName"><b>Recipient Name</b>:</label><br><input type="text" size="75%" id="receiverName" name="receiverName" <?php if (!($receiverName ?? '') == '') {echo 'value="' . $receiverName . '"';} ?> required></td></tr>

<tr><td><label for="receiverEmail"><b>Recipient Email</b>:</label><br><input type="email" size="75%" id="receiverEmail" name="receiverEmail" <?php if (!($receiverEmail ?? '') == '') {echo 'value="' . $receiverEmail . '"';} ?>  required></td></tr>

<tr><td><label for="title"><b>Email Title</b>:</label><br><input type="text" size="75%" id="ti<?php if (!isset($InstagramLink)) {echo 'placeholder="Enable Option to Use."';}?> tle" name="title" required></td></tr>
<tr><td><label for="body"><b>Email Body</b>:</label><br>
<center><textarea style="overflow:auto;resize:none" rows="6" cols="60" id="body" name="body">
<li><b>Bullet-point</b> one.</li>
<li>Bullet-point two.</li>

<p><b>Paragraph one.</b></p>
<p>Paragraph two.</p>
</textarea></center>
</td></tr>
<tr><td><br><center><label><b>Footer Socials</b>:</label></center></td></tr>
<tr><center>
<table border="1" style="float:center;min-width:535px!important;">
	<tr>
		<td border="1px"><center><input type="checkbox" id="igOption" <?php if (!($InstagramLink ?? '') == '') {echo "checked";} ?> >Instagram</center></td>
		<td border="1px"><center><input type="checkbox" id="fbOption" <?php if (!($FacebookLink ?? '') == '') {echo "checked";} ?> >Facebook</center></td>
	</tr>
	<tr>
		<td border="1px"><center><input type="hidden" id="ig" name="ig" <?php if (!($InstagramLink ?? '') == '') {echo 'value="1"';}?> ><b>"</b>https://www.

			<input type="text" size="20" id="igLink" name="igLink" <?php if (!isset($InstagramLink)) {echo 'placeholder="Enable Option to Use."';}?> value="<?php echo $InstagramLink; ?>" required><b>"</b></center></td>
		<td border="1px"><center><input type="hidden" id="fb" name="fb" <?php if (!($FacebookLink ?? '') == '') {echo 'value="1"';} ?> ><b>"</b>https://www.

			<input type="text" size="20" id="fbLink" name="fbLink" <?php if (!isset($FacebookLink)) {echo 'placeholder="Enable Option to Use."';}?> value="<?php echo $FacebookLink; ?>" required><b>"</b></center></td>
	</tr>
</table>
</center></tr>
<tr><td><br><br><center><button type="submit">Submit</button></center></td></tr>
</table>
</div>
</form>
</div>
	</body>
</html>
