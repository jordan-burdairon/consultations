	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#">Menu</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNavDropdown">
		<ul class="navbar-nav">
		  <li class="nav-item active">
			<a class="nav-link" href="<?= APP_ROOT; ?>/index.php">Accueil <span class="sr-only">(current)</span></a>
		  </li>
		  <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Requêtes
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  <a class="dropdown-item" href="<?= APP_ROOT; ?>/showme.php">All consults</a>
			  <a class="dropdown-item" href="<?= APP_ROOT; ?>/showme.php?select=2">10 consults</a>
			  <a class="dropdown-item" href="<?= APP_ROOT; ?>/showme.php?select=3">AllType</a>
			  <a class="dropdown-item" href="<?= APP_ROOT; ?>/showme.php?select=4">ClientsIvry</a>
			  <a class="dropdown-item" href="<?= APP_ROOT; ?>/showme.php?select=5">ClientsPasFosPaye</a>
			  <a class="dropdown-item" href="<?= APP_ROOT; ?>/showme.php?select=6">ClientsChienChat</a>
			  <a class="dropdown-item" href="<?= APP_ROOT; ?>/showme.php?select=7">ThisYear</a>
			</div>
		  </li>
		  <li class="nav-item">
			<a href="<?= APP_ROOT; ?>/admin/index.php"><i class="fas fa-key"></i></a>
		  </li>
		</ul>
	  </div>
	</nav>
	
	
	
	
	
	
	
	