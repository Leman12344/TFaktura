<?php
$left_menu = [
	0 => [
		'link' => 'dashboard.php',
		'text' => 'Strona główna',
		'dropdown' => false
	],
	1 => [
		'link' => '#',
		'text' => 'Proforma',
		'dropdown' => [
			[
				'link' => 'new_proforma.php',
				'text' => 'Nowa proforma',
				'dropdown' => false
			],
			[
				'link' => 'proforma_list.php',
				'text' => 'Lista wszystkich proform',
				'dropdown' => false
			],
			[
				'link' => 'edit_proforma.php',
				'text' => 'Edytuj proforme',
				'dropdown' => false
			]
		]
	],
	2 => [
		'link' => '#',
		'text' => 'Firmy',
		'dropdown' => [
			[
				'link' => 'add_company.php',
				'text' => 'Dodaj firme',
				'dropdown' => false
			],
			[
				'link' => 'companies_list.php',
				'text' => 'Lista wszystkich firm',
				'dropdown' => false
			],
			[
				'link' => 'edit_company.php',
				'text' => 'Edytuj firme',
				'dropdown' => false
			]
		]
	]
];
$right_menu = [
	0 => [
		'link' => 'report_bug.php',
		'text' => 'Zgłoś błąd',
		'dropdown' => false
	],
	1 => [
		'link' => '#',
		'text' => 'Profil',
		'dropdown' => [
			[
				'link' => 'settings.php',
				'text' => 'Ustawienia',
				'dropdown' => false
			],
			[
				'link' => 'license.php',
				'text' => 'Licencja',
				'dropdown' => false
			],
			[
				'link' => 'info.php',
				'text' => 'Informacje',
				'dropdown' => false
			],
			[
				'link' => 'logout.php',
				'text' => 'Wyloguj się',
				'dropdown' => false
			]
		]
	]
];
?>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu" aria-expanded="false">
			<span class="sr-only">Menu</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="https://flovmedia.pl">LOGO</a>
		</div>
		<div class="collapse navbar-collapse" id="main-menu">
			<ul class="nav navbar-nav">
			<?php
			for($i = 0; $i < count($left_menu); $i++){
				if(!$left_menu[$i]['dropdown']){
				?>
				<li<?php echo (!strcasecmp($left_menu[$i]['link'], basename($_SERVER['PHP_SELF']))) ? ' class="active"' : null; ?>><a href="<?php echo $left_menu[$i]['link']; ?>"><?php echo $left_menu[$i]['text']; ?></a> <?php echo ($left_menu[$i]['link'] == basename($_SERVER['PHP_SELF'])) ? '<span class="sr-only">(current)</span>' : null; ?>
				<?php
				}else{
				?>
				<li<?php echo (array_search(basename($_SERVER['PHP_SELF']), array_column($left_menu[$i]['dropdown'], 'link')) !== false) ? ' class="dropdown active"' : ' class="dropdown"'; ?>>
					<a href="<?php echo $left_menu[$i]['link']; ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $left_menu[$i]['text']; ?> <span class="caret"></span></a> <?php echo ($left_menu[$i]['link'] == basename($_SERVER['PHP_SELF'])) ? '<span class="sr-only">(current)</span>' : null; ?>
					
				<ul class="dropdown-menu">
				<?php
				for($j = 0; $j < count($left_menu[$i]['dropdown']); $j++){
				?>
					<li<?php echo (!strcasecmp($left_menu[$i]['dropdown'][$j]['link'], basename($_SERVER['PHP_SELF']))) ? ' class="active"' : null; ?>><a href="<?php echo $left_menu[$i]['dropdown'][$j]['link']; ?>"><?php echo $left_menu[$i]['dropdown'][$j]['text']; ?></a></li>
				<?php
				}
				?>
				</ul>
				<?php
				}
			}
			?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<?php
			for($i = 0; $i < count($right_menu); $i++){
				if(!$right_menu[$i]['dropdown']){
				?>
				<li<?php echo (!strcasecmp($right_menu[$i]['link'], basename($_SERVER['PHP_SELF']))) ? ' class="active"' : null; ?>><a href="<?php echo $right_menu[$i]['link']; ?>"><?php echo $right_menu[$i]['text']; ?></a> <?php echo ($right_menu[$i]['link'] == basename($_SERVER['PHP_SELF'])) ? '<span class="sr-only">(current)</span>' : null; ?>
				<?php
				}else{
				?>
				<li<?php echo (array_search(basename($_SERVER['PHP_SELF']), array_column($right_menu[$i]['dropdown'], 'link')) !== false) ? ' class="dropdown active"' : ' class="dropdown"'; ?>>
					<a href="<?php echo $right_menu[$i]['link']; ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $right_menu[$i]['text']; ?> <span class="caret"></span></a> <?php echo ($right_menu[$i]['link'] == basename($_SERVER['PHP_SELF'])) ? '<span class="sr-only">(current)</span>' : null; ?>
					
				<ul class="dropdown-menu">
				<?php
				for($j = 0; $j < count($right_menu[$i]['dropdown']); $j++){
				?>
					<li<?php echo (!strcasecmp($right_menu[$i]['dropdown'][$j]['link'], basename($_SERVER['PHP_SELF']))) ? ' class="active"' : null; ?>><a href="<?php echo $right_menu[$i]['dropdown'][$j]['link']; ?>"><?php echo $right_menu[$i]['dropdown'][$j]['text']; ?></a></li>
				<?php
					if($j == count($right_menu[$i]['dropdown']) - 2){
				?>
					<li role="separator" class="divider"></li>
				<?php
					}
				}
				?>
				</ul>
				<?php
				}
			}
			?>
			</ul>
		</div>
	</div>
</nav>