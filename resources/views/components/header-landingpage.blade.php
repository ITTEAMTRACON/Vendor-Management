    @if (Auth::check())
        <div class="headbar row" style="position: relative; opacity: 1; background: #FFF7E6;">

            <div class="title col-md-6">
                <img src="images/VENOM-SSO-new.png" width="20px" />  
                {{-- Vendor Management --}}
            </div>
            <div class="auth col-md-6">
                <a href="{{ route('login') }}" style="margin-right: 47px">Welcome,
                    {{ Auth::user()->vendor->VM_NAME }}</a>

                <a href="{{ route('password.view') }}" style="margin-right: 47px">Change Password</a>

                <form method="POST" action="{{ route('logout') }}" style="display: contents">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>

            </div>
        </div>
    @else
        <div class="headbar row" style="background: #FFF7E6;">

            <div class="title col-md-11">
                <img src="images/VENOM-SSO-new.png"   width="20px" />  
            </div>
            <div class="auth col-md-1">
                <a href="{{ route('login') }}">Sign In</a>
            </div>
        </div>
    @endif
