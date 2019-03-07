<div class="header container-fluid fixed-top shadow">
    <div class=row>
        <div class=" col-sm-6 fl-small">
            <button class="openbtn" onclick="openNav();">☰ </button>  
            <img src="imgs/logo-sm.png"/>
        </div>
        <div class=" col-sm-3"> </div>
        <div class=" col-sm-3">
            <div class="pt-2 fr-small">
                <div class="dropdown">
                <button class="btn btn-light dropdown-toggle btn-login" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                
                </button>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @if(auth()->guard('admin')->check())
                    {{auth()->guard('admin')->user()->usernname}}
                        <a href="{{ route('logout') }}" class="dropdown-item" 
                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        Logout
                        </a>

                        <form id="logout-form" action="{{ url('user/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                     @endif
                        {{-- <a class="dropdown-item" href="#">Logout</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>