<?php
define('SITE_NAME',     'mybestsite.com');
define('API_KEY',       'y8Syr1geg');
define('SHARED_SECRET', '3kJfHp0OfwinB55mejerpNFdWAjllUTPfCNZUqbhZp3GlK3Dy3RT0Gn8l894DrzO');

$expires = strtotime('now + 2 minutes');
$signature = sha1(SHARED_SECRET . 'POST' . '/users' . $expires);
$loginUri = ('http://' . SITE_NAME . '.api.jaycut.com/users?login=true' .
             '&api_key='   . API_KEY .
             '&signature=' . $signature .
             '&expires='   . $expires);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <title>My own online video editor</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style type="text/css">
      <!--
         html { height: 100% }
         body { overflow: hidden; height: 100%; margin: 0 }
      -->
    </style>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
    <script type="text/javascript">
    //<![CDATA[
         var loaderUrl = 'http://<?php print SITE_NAME; ?>.api.jaycut.com/assets/flash/ApplicationLoader.swf'
         var flashvars = {};
         flashvars.applicationUri = encodeURIComponent('http://<?php print SITE_NAME; ?>.api.jaycut.com/applets/login.xml?chain=mixer');
         flashvars.loginUri = encodeURIComponent('<?php print $loginUri; ?>');

         var params = {};
         params.wmode = 'window';
         params.allowScriptAccess = 'always';
         params.allowFullScreen = 'true';
         params.bgcolor = '#000000';

         swfobject.embedSWF(loaderUrl, 'flash-holder', '100%', '100%', '9.0.0', loaderUrl, flashvars, params);
    //]]>
    </script>
  </head>

  <body>
    <div id="flash-holder" >
      <p>This will be replaced by the flash object</p>
    </div>
  </body>
</html>
