<div>
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">Menu</li>

        <li>
            <a href="{{route('adm.dashboard')}}" class="waves-effect">
                <i class="ri-dashboard-line"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="{{route('adm.clients')}}" class=" waves-effect">
                <i class="ri-account-circle-line"></i>
                <span>Clients</span>
            </a>
        </li>

        <li class="menu-title">Master Data</li>

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ri-calendar-2-line"></i>

                <span>Region</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('adm.countries')}}">Countries</a></li>
                <li><a href="auth-register.html">Provinces / States</a></li>
            </ul>
        </li>


    </ul>
</div>
