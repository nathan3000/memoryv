<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>memoryv - online bible memorization tool</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="assets/css/docs.css" rel="stylesheet">
    <link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons 
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon" href="assets/ico/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/ico/apple-touch-icon-72x72.png">
-->
    <link rel="apple-touch-icon" sizes="114x114" href="assets/ico/apple-touch-icon-114x114.png">
    </head>

  <body>
    <div class="container">
        <header class="site-title">
            <h1>memoryv</h1> 
            <p class="lead">Memorising the Bible one verse at a time.</p>
        </header>
        <form class="search well form-inline">
            <input id="ref" class="" type="text">
            <button id="get" type="submit" class="btn">Grab Verse</button>
        </form>
        <div class="row">
            <div class="passage well span12" style="display:none">
                <h3></h3>
                <p id="content" class="lead"></p>
                <button id="refresh" class="btn">New blanks!</button>
                <button id="next" class="btn">More blanks</button>
                <button id="prev" class="btn">Less blanks</button>
            </div>
        </div>
    <footer class="footer" style="display:none"><p>Tip: If you get stuck press enter for a hint :)</p><p>Scripture taken from The Holy Bible, English Standard Version. Copyright &copy;2001 by <a href="http://www.crosswaybibles.org">Crossway Bibles</a>, a publishing ministry of Good News Publishers. Used by permission. All rights reserved. Text provided by the <a href="http://www.gnpcb.org/esv/share/services/">Crossway Bibles Web Service</a></p></footer>

</div><!-- /container -->



    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/google-code-prettify/prettify.js"></script>
	<script src="assets/js/custom.js" type="text/javascript"></script> 	

  </body>
</html>
