<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/application_top.php');
	
	if (trim($_GET['query']) != ''){
		$myConnection = new FormspringOAuth('923d7f9ed7b5b1974b85fc48a6ebd53604d0eb445', 'db1ed9c781cc5d14486b75fa9c2076fc04d0eb445');
		$list = $myConnection->get("search/profiles", array('query' => trim($_GET['query'])));
	}
	// Return success or failure
	//return ($twitterConnection->http_code == '200');	
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Formspring Extender</title>
	<link href="/assets/main.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
	<header id="top">
		<div class="wrap"><div class="wrap-inner">
			<h1><a href="/">Formspring Extender</a></h1>
		
		<div id="subbar">
          <nav id="primary">
            <ul>
              <li class="home selected"><a href="/">Home</a></li>
              <li class="accounts"><a href="/accounts">Accounts</a></li>
              <li class="signup"><a href="/signup">Signup</a></li>
              <li class="signin"><a href="/signin">Signin</a></li>
            </ul>
          </nav>
        </div>
        
        </div></div>
   	</header>
	<section id="content">
		<div class="wrap"><div class="wrap-inner">
			<div class="box">
				<header>
					<h1>Manage Multiple Formspring Accounts!</h1>
				</header>
				<div class="box-content">
		 			<p>Use this to connect multiple people to one formspring account.</p>
		 			
		 			<h2>Search Profiles</h2>
		 			<form action="/" method="get">
		 			<fieldset>
		 				<label for="query">Search: </label>
		 				<input name="query" id="query" type="text" value="<?php echo trim($_GET['query']); ?>" />
		 			</fieldset>
		 			<input type="submit" value="Search" />
		 			</form>
		 			
		 			
		 			<?php
		 				if ($list->status == 'ok'){
		 					echo '<h3>Results</h3><pre>';
		 					foreach ($list->response->profiles as $profile){
		 						print_r($profile);
		 					}
		 					echo '</pre>';
		 				}
		 			?>
		 		</div>
			</div>
		</div></div>
	</section>
	<footer>
		<div class="wrap"><div class="wrap-inner">
			<p>Maintained by <a href="http://nickdenardis.com/">Nick DeNardis</a></p>
		</div></div>
	</footer>
</div>
</body>
</html>