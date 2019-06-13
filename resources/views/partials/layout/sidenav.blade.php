<ul id="nav-mobile" class="sidenav sidenav-fixed">
    <li class="logo">
        <i class="material-icons" style="font-size: 1.2em">fitness_center</i>
        {{ config('app.name', 'Laravel') }}
    </li>
    <li><a href="#!">First Sidebar Link</a></li>
    <li><a href="#!">Second Sidebar Link</a></li>
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            <li class="active">
                <a class="collapsible-header">Dropdown<i class="material-icons">
                        chevron_right
                    </i> </a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="#!">First</a></li>
                        <li><a href="#!" class="active">Second</a></li>
                        <li><a href="#!">Third</a></li>
                        <li><a href="#!">Fourth</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <a class="collapsible-header">Options<i class="material-icons">
                        chevron_right
                    </i> </a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="#!">First</a></li>
                        <li><a href="#!">Second</a></li>
                        <li><a href="#!">Third</a></li>
                        <li><a href="#!">Fourth</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
</ul>