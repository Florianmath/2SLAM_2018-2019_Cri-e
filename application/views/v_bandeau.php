<div id="bandeau">

<header>
<!-- Image-->

</div>


	<ul id="menu">
		<table id="lespuces">
			<tr>
				<th>
					<li><a href ="<?php echo site_url (); ?>"> Accueil </a></li>
				</th>
				<!---->
				<th>
					<li><a href ="<?php echo site_url ('utilisateur/contenu/catalogue'); ?>">Les poissons</a></li>
				</th>
				<!---->
				<th>
					<li><a href ="<?php echo site_url ('utilisateur/contenu/panier'); ?>">Voir mon panier</a></li>
				</th>
				<!---->
				<?php if (!isset($_SESSION['login']) && !isset($_SESSION['pwd']))
				{ ?>
				<th>
	                <li><a href ="<?php echo site_url ('utilisateur/contenu/connecter'); ?>">Se connecter</a></li>
	            </th>
				
				<th>
					<li><a href ="<?php echo site_url ('utilisateur/contenu/admin'); ?>">S'incrire</a></li>
				</th>
				<?php }
				else
				{ ?>
					<th>
						<li><a href ="<?php echo site_url ('utilisateur/contenu/deconnecter'); ?>">Se Deconnecter</a></li>
					</th>
				<?php } ?>
				
				<!---->
			</tr>
		</table>
	</ul>
</header>