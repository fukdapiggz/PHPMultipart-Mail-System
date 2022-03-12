<?php
////Get info from form////
//Get all posted data from form.
$senderName = $_GET["businessName"];
$senderEmail = $_GET["senderEmail"];
$receiverName = $_GET["receiverName"];
$receiverEmail = $_GET["receiverEmail"];
$subjectHeader = $_GET["subject"];
$titleHeader = $_GET["title"];
$body = $_GET["body"];


////Custom Touches////
//Subject Name
if ($subjectHeader == $titleHeader) {$chosenSubject = $titleHeader . ' | ' . $senderName;}
  else {$chosenSubject = $subjectHeader . ' | ' . $senderName;}
//Social Footer (controls $igLink, $igDesktop, $igMobile, $fbLink, $fbDesktop, $fbMobile)
if (($_GET["ig"] ?? '')=='1'){$igLink='https://' . $_GET["igLink"]; $igDesktop='<td><a href=' . $igLink . ' target="_blank"><img src="https://raw.githubusercontent.com/fukdapiggz/PHPMultipartMailSystem/main/ig.png" class="social"/></a></td><td>&nbsp;</td>';}else{$igDesktop=''; $igLink='0';}if (($_GET["fb"] ?? '')=='1'){$fbLink='https://' . $_GET["fbLink"]; $fbDesktop='<td><a href=' . $fbLink . ' target="_blank"><img src="https://raw.githubusercontent.com/fukdapiggz/PHPMultipartMailSystem/main/fb.png" class="social"/></a></td>';}else{$fbDesktop=''; $fbLink='0';}
if (!($igLink ?? '') == '0') {$igMobile = '<a href=' . $igLink . ' class="socialLink"target="_blank">Instagram</a> &nbsp; ';} else {$igMobile = '';} if (!($fbLink ?? '') == '0') {$fbMobile = '<a href=' . $fbLink . ' class="socialLink"target="_blank">Facebook</a>';} else {$fbMobile = '';}


////Multipart Email System////
//BoundaryUID, required for multipart emails
$boundaryUID=md5(uniqid(rand())); $chosenBoundary = "----=_NextPart".$senderName."_" . $boundaryUID;
$eol = "\n";
//Make and encrypt a textonly version, of string returned within $body
$textOnlyInput = strip_tags($body); $textOnly = strip_tags($body, "<strong><em>");
//Server fields, creates email
$to = $receiverEmail;
$subject = $chosenSubject;
$header = "Delivered-To:".$receiverName."<".$receiverEmail.">".$eol;
$header = "To:".$receiverName."<".$receiverEmail.">".$eol;
$header .= "From:".$senderName."<".$senderEmail.">".$eol;
$header .= "Cc:".$senderName."<".$senderEmail.">".$eol;
$header .= "Return-Path:".$senderEmail.$eol;
$header .= "X-Sender:".$senderName."<".$senderEmail.">".$eol;
$header .= "X-Mailer: PHP/".phpversion().$eol;
$header .= "X-Business-Group:".$senderName.$eol;
$header .= "X-Priority: 1".$eol;
$header .= "MIME-Version: 1.0".$eol;
$header .= 'Content-type: multipart/alternative; boundary="'.$chosenBoundary.'"'.$eol;
$message = "This is multipart message using MIME".$eol;
$message .= "--".$chosenBoundary.$eol."Content-Type: text/plain; charset=UTF-8".$eol;
$message .= "Content-Transfer-Encoding: 7bit".$eol;
$message .= $eol.$textOnly.$eol;


////Handling Raw HTML////
//Enter raw, html, js, css
$htmlRaw = '
<html>
  <head>
    <title>'.$chosenSubject.'</title>
    <meta name=3D"viewport" content=3D"width=3Ddevice-width">
    <style type="text/css">
      .titleHeader{font-weight:bold;font-size:1.5em;}.subHeader{color:#a6a6a6;font-style:italic;font-family:sans-serif;font-size:1em}h1{color:#0070c0;font-style:normal;font-weight:700;font-family:sans-serif;font-size:2em}body{font-style:normal;font-family:sans-serif;font-size:1em}li{margin-bottom:5px}.socialBtn{margin:25px;display:flex;justify-content:center}a.socialLink:link,a.socialLink:visited{color:#4a32a8;font-weight:700;font-size:1.5em;text-decoration:underline}a.socialLink:hover{color:#a6a6a6;font-weight:400;text-decoration:none}img.social:hover{-webkit-border-radius:10px;-moz-border-radius:10px;border-radius:10px;-webkit-box-shadow:0 0 30px 0 rgba(0,255,0,.67);-moz-box-shadow:0 0 30px 0 rgba(0,255,0,.67);box-shadow:0 0 30px 0 rgba(0,255,0,.67)}.social img.social:last-of-type:hover{-webkit-border-radius:10px;-moz-border-radius:10px;border-radius:10px;-webkit-box-shadow:0 0 20px 0 rgba(159,159,159,.67);-moz-box-shadow:0 0 20px 0 rgba(159,159,159,.67);box-shadow:0 0 20px 0 rgba(159,159,159,.67)}
      @media only screen and (min-width:700px){.container{width:62%}.hideDesktopIcons{display:inline}.hideMobileIcons{display:none!important;visibility:hidden!important}}
      @media only screen and (max-width:699px){.container{width:100%}.hideMobileIcons{display:inline}.hideDesktopIcons{display:none!important;visibility:hidden!important}}
    </style>
  </head>
  <body>
    <header>
      <table>
        <td><img src="https://raw.githubusercontent.com/fukdapiggz/PHPMultipartMailSystem/main/contactform.bmp"  /></td>
        <td><span class="titleHeader">ContactForm</span></td>
      </table>
      <span class="subHeader">Easiest&nbsp;Way&nbsp;to&nbsp;Contact&nbsp;Clients.</span>
    </header>            
    <div class="container">
      <hr>                
      <center><h1>'.$subjectHeader.'</h1></center>
      <h2>'.$titleHeader.'</h2>
      <ul>'.$body.'</ul><br>
      <hr>
      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse; padding:0; margin:0px;">
        <tr valign="top">
          <td align="center">
            <div class="socialBtn">
              <div class="hideDesktopIcons"><table align="center"><tr>'.$igDesktop.' '.$fbDesktop.'</tr></table></div>
              <div class="hideMobileIcons">'.$igMobile.' '.$fbMobile.'</div>
            </div>
          </td>
        </tr>
      </table>
    </div>
  </body>
</html>';


////Finalize Process
//Encrypts and Last BoundaryUID
$htmlEncrypt = base64_encode($htmlRaw);
$message .= "--".$chosenBoundary.$eol."Content-type: text/html; charset=utf-8".$eol;
$message .= "Content-Transfer-Encoding: base64".$eol;
$message .= $htmlEncrypt.$eol.$eol.$eol;
$message .= "--".$chosenBoundary."--";
//Send and response
$retval = mail ($to,$subject,$message,$header);        
if( $retval==true ){echo 'Message sent successfully...';}else{echo 'Message could not be sent...';}echo '<br><a href="index.php">Go back to form</a>';
?>