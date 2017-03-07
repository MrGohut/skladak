<div id="pa-menu" class="col-lg-2 col-md-auto">
    <nav class="nav flex-column nav-pills nav-fill">
        <a class="nav-link <?php if(getOptionPA() == null) echo 'active'; ?>" href="/account/admin">Główna</a>
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#togglePAUsers">Użytkownicy<i class="fa fa-chevron-down float-right" aria-hidden="true"></i></a>
        <div class="collapse <?php if(collapseShowPA() == 'showU') echo 'show'; ?>" id="togglePAUsers">
            <a class="nav-link second <?php if(getOptionPA() == 'ul') echo 'active'; ?>" href="?option=ul"><i class="fa fa-caret-right" aria-hidden="true"></i> Lista</a>
            <a class="nav-link second <?php if(getOptionPA() == 'ue') echo 'active'; ?>" href="?option=ue"><i class="fa fa-caret-right" aria-hidden="true"></i> Edytuj</a>
        </div>
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#togglePAParts">Podzespoły<i class="fa fa-chevron-down float-right" aria-hidden="true"></i></a>
        <div class="collapse" id="togglePAParts">
            <a class="nav-link second" href="?option=ul"><i class="fa fa-caret-right" aria-hidden="true"></i> Lista</a>
            <a class="nav-link second" href="?option=ue"><i class="fa fa-caret-right" aria-hidden="true"></i> Edytuj</a>
        </div>
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#togglePABuilds">Zestawy<i class="fa fa-chevron-down float-right" aria-hidden="true"></i></a>
        <div class="collapse" id="togglePABuilds">
            <a class="nav-link second" href="?option=ul"><i class="fa fa-caret-right" aria-hidden="true"></i> Lista</a>
            <a class="nav-link second" href="?option=ue"><i class="fa fa-caret-right" aria-hidden="true"></i> Edytuj</a>
        </div>
    </nav>
</div>