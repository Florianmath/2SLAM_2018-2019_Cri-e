<div id="bandeau">
<!-- Image-->
<img src="<?php echo base_url('Images/criee.gif');?>" alt="Lafleur" title="Lafleur"/>
</div>

<ul id="menu">
	<table id="lespuces">
		<tr>
			<th>
				<li><a href ="<?php echo site_url (); ?>"> Accueil </a></li>
			</th>
			<!---->
			<th>
				<li><a href ="<?php echo site_url ('utilisateur/contenu/catalogue'); ?>">poiscaille</a></li>
			</th>
			<!---->
			<th>
				<li><a href ="<?php echo site_url ('utilisateur/contenu/panier'); ?>">Voir mon panier</a></li>
			</th>
			<!---->
			<th>
                <li><a href ="<?php echo site_url ('utilisateur/contenu/connecter'); ?>">Se connecter</a></li>
            </th>
			<th>
				<li><a href ="<?php echo site_url ('utilisateur/contenu/admin'); ?>">S'incrire</a></li>
			</th>
			<!---->
		</tr>
	</table>
</ul>
