<div id="bandeau">

<header class="container-fluid header">

	<div class="container">

<!-- Image-->
	<!-- <ul id="menu">
			<table id="lespuces"> -->
<!-- <img src="<?php echo base_url('Images/Menu.png');?>" /> -->
					 <a href="<?php echo site_url (); ?>" class="logo"> La Criée de Cornouaille </a>
					<nav class="menu">
					<a href ="<?php echo site_url (); ?>" id="logoAcc"> Accueil </a>

				<!---->

					<a href ="<?php echo site_url ('utilisateur/contenu/catalogue'); ?>"id="logoPoisson">Les poissons</a>

					

				<!---->
				<?php if (!isset($_SESSION['login']) && !isset($_SESSION['pwd']))
				{ ?>

	        		<a href ="<?php echo site_url ('utilisateur/contenu/connecter'); ?>" id="logoSeCo">Se connecter</a>


	    


					<a href ="<?php echo site_url ('utilisateur/contenu/admin'); ?>"id= "logoInscription">S'inscrire</a>

					




				<?php }
				else
				{ ?>
					<?php if ($_SESSION['login'] == 'administrateur' )
					{ ?>

						<a href ="<?php echo site_url ('utilisateur/contenu/administrer'); ?>"id="logoAdministrer">Administrer</a>

						<a href ="<?php echo site_url ('utilisateur/contenu/ajouter'); ?>"id="logoAddDonnees">Ajouter des données</a>

						<a href ="<?php echo site_url ('utilisateur/contenu/chat'); ?>" id="logoChat">Le chat</a>
						





						<a href ="<?php echo site_url ('utilisateur/contenu/deconnecter'); ?>">Se Deconnecter</a>


					<?php }
					else
					{ ?>
						<a href ="<?php echo site_url ('utilisateur/contenu/panier'); ?>" id="logoPanier">Voir mon panier</a>
						<a href ="<?php echo site_url ('utilisateur/contenu/chat'); ?>" id="logoChat" >Le chat</a>
						<a href ="<?php echo site_url ('utilisateur/contenu/monCompte'); ?>"id ="logoCompte">Mon compte</a>
						<a href ="<?php echo site_url ('utilisateur/contenu/deconnecter'); ?>">Se Deconnecter</a>
					<?php } ?>

				<?php } ?>

				<!---->

		<!-- </table>
	</ul> -->
		</nav>
	</div>
</header>
</div>
