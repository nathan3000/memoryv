<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>memoryv - online bible memorization tool</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/app/assets/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/app/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="bootstrap/app/assets/css/docs.css" rel="stylesheet">
    <link href="bootstrap/app/assets/js/google-code-prettify/prettify.css" rel="stylesheet">

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


  <!-- Navbar
    ================================================== -->
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="./index.html">mv</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active">
                <a href="./index.html">Home</a>
              </li>
              <li class="">
                <a href="./scaffolding.html">Feedback</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
        <header class="site-title">
            <h1>memoryv</h1> 
            <p class="lead">Memorising the Bible one verse at a time.</p>
        </header>
        <form class="search well form-inline">
            <input id="ref" class="" type="text">
            <button id="get" type="submit" class="btn">Grab Verse</button>
        </form>
        <div id="passage" class="row" style="display:none">
            <div class="well span8">
                <h3 id="meta"></h3>
                <p id="content" class="lead"></p>
                <button id="refresh" class="btn">New blanks!</button>
                <button id="next" class="btn">More blanks</button>
                <button id="prev" class="btn">Less blanks</button>
            </div>
        </div>
        <footer class="footer" style="display:none"><p>Scripture taken from The Holy Bible, English Standard Version. Copyright &copy;2001 by <a href="http://www.crosswaybibles.org">Crossway Bibles</a>, a publishing ministry of Good News Publishers.</p><p> Used by permission. All rights reserved. Text provided by the <a href="http://www.gnpcb.org/esv/share/services/">Crossway Bibles Web Service</a></p></footer>

    </div><!-- /container -->



    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    <script src="bootstrap/app/assets/js/jquery.js"></script>
    <script src="bootstrap/app/assets/js/google-code-prettify/prettify.js"></script>
    <script src="bootstrap/app/assets/js/bootstrap-transition.js"></script>
    <script src="bootstrap/app/assets/js/bootstrap-alert.js"></script>
    <script src="bootstrap/app/assets/js/bootstrap-modal.js"></script>
    <script src="bootstrap/app/assets/js/bootstrap-dropdown.js"></script>
    <script src="bootstrap/app/assets/js/bootstrap-scrollspy.js"></script>
    <script src="bootstrap/app/assets/js/bootstrap-tab.js"></script>
    <script src="bootstrap/app/assets/js/bootstrap-tooltip.js"></script>
    <script src="bootstrap/app/assets/js/bootstrap-popover.js"></script>
    <script src="bootstrap/app/assets/js/bootstrap-button.js"></script>
    <script src="bootstrap/app/assets/js/bootstrap-collapse.js"></script>
    <script src="bootstrap/app/assets/js/bootstrap-carousel.js"></script>
    <script src="bootstrap/app/assets/js/bootstrap-typeahead.js"></script>
    <script src="bootstrap/app/assets/js/application.js"></script>

	<script src="js/jquery-1.5.1.min.js" type="text/javascript"></script> 	
	<script src="js/custom.js" type="text/javascript"></script> 	

  </body>
</html>
