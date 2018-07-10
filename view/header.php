<header>
    <a href="javascript:void(0)" id="menu-toggle-wrapper">
			<div id="menu-toggle"></div>	
		</a>
    <span class="heavy" style="padding-left:50px;">noteq</span>
    <span class="right">Zalogowany jako 
        <a id="navUserDropdown" class="dropdown"><?php echo $session->email ?></a>
            <div class="dropdown-menu right" aria-labelledby="navUserDropdown">
                <a class="dropdown-item last" id="logout">Wyloguj</a>
            </div>
        
    </span>
    <?php
    if ($session->privileges) echo '<span class="right admin">
        <a class="admin" href="admin" target="_blank">Admin panel</a>
    </span>';
    ?>
</header>