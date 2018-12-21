<div id="bandeau">

<header class="container-fluid header">

	<div class="container">
<!-- Image-->
	<!-- <ul id="menu">
			<table id="lespuces"> -->
<!-- <img src="<?php echo base_url('Images/Menu.png');?>" /> -->
					 <a href="<?php echo site_url (); ?>" class="logo"> La Criée de Cornouaille </a>
					<nav class="menu">
					<a href ="<?php echo site_url (); ?>"> Accueil </a>

				<!---->

					<a href ="<?php echo site_url ('utilisateur/contenu/catalogue'); ?>">Les poissons</a>

				<!---->

					<a href ="<?php echo site_url ('utilisateur/contenu/panier'); ?>">Voir mon panier</a>

				<!---->
				<?php if (!isset($_SESSION['login']) && !isset($_SESSION['pwd']))
				{ ?>

	        <a href ="<?php echo site_url ('utilisateur/contenu/connecter'); ?>">Se connecter</a>



					<a href ="<?php echo site_url ('utilisateur/contenu/admin'); ?>">S'incrire</a>

				<?php }
				else
				{ ?>

						<a href ="<?php echo site_url ('utilisateur/contenu/deconnecter'); ?>">Se Deconnecter</a>

				<?php } ?>

				<!---->

		<!-- </table>
	</ul> -->
		</nav>
	</div>
</header>
</div>
