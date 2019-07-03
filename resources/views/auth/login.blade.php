@include('layout.head')

<header id="header">
    <div class="container">
        <div class="row align-items-center">
            <div id="header-logo" class="col">
                <a href="/">WorkForce</a>
            </div>
            <div id="header-btn" class="col text-right">
                <a href="/login-register" class="btn btn-primary">
                    <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                         fill-rule="evenodd" clip-rule="evenodd">
                        <path fill="#fff"
                              d="M24 11.5c0 3.613-2.951 6.5-6.475 6.5-2.154 0-4.101-1.214-5.338-3h-2.882l-1.046-1.013-1.302 1.019-1.362-1.075-1.407 1.081-4.188-3.448 3.346-3.564h8.841c1.145-1.683 3.104-3 5.339-3 3.497 0 6.474 2.866 6.474 6.5zm-10.691 1.5c.98 1.671 2.277 3 4.217 3 2.412 0 4.474-1.986 4.474-4.5 0-2.498-2.044-4.5-4.479-4.5-2.055 0-3.292 1.433-4.212 3h-9.097l-1.293 1.376 1.312 1.081 1.38-1.061 1.351 1.066 1.437-1.123 1.715 1.661h3.195zm5.691-3.125c.828 0 1.5.672 1.5 1.5s-.672 1.5-1.5 1.5-1.5-.672-1.5-1.5.672-1.5 1.5-1.5z"/>
                    </svg>
                    Log in
                </a>
                <button id="mobile-toggle" type="button">
                    <span class="menui top-menu"></span>
                    <span class="menui mid-menu"></span>
                    <span class="menui bot-menu"></span>
                </button>
            </div>
            <div id="header-navigation" class="col-md-auto text-center">
                <div id="header-items">
                    <nav class="navigation-menu">
                        <ul class="clearfix">
                            <li>
                                <a href="/#header">Home</a>
                            </li>
                            <li>
                                <a href="/#price">Pricing</a>
                            </li>
                            <li>
                                <a href="/#contact">Contact</a>
                            </li>
                            <li>
                                <a href="/login-register">Register</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>

<section id="main" class="builder-elements">
    <div class="builder-element element-bg-white">
        <div class="element-inner">
            <div class="container">
                <div class="element-header text-center">
                    <h2>Log in / Register</h2>
                </div>
                <div class="element-body">
                    <div class="editor-content">
                        <div class="row login-register">
                            <div class="col-12 col-lg-5">
                                <h4>Log in</h4>
                                @guest
                                    <div class="form-group text-center">
                                        <a href="{{ env('ACCOUNT_URL') }}/module-login/workforce?redirect_url={{ env('APP_URL') }}&module=workforce"
                                           class="btn btn-success btn-block mt-2">
                                            Log in via ACCOUNT
                                        </a>
                                    </div>
                                @else
                                    <a href="/auth#/" class="btn btn-success btn-block">Dashboard</a>
                                @endguest
                            </div>
                            <div class="col-12 col-lg-2 col-seperator">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col">
                                        <span>OR</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-5">
                                @guest
                                    <h4>Register</h4>
                                    <div class="form-group text-center">
                                        <a href="javascript:void(0)" class="btn btn-success btn-block mt-2">
                                            Register via ACCOUNT
                                        </a>
                                    </div>
                                @else
                                    <h4>You are logged in {{ auth()->user()->fname }}!</h4>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer id="footer">
    <div class="container">
        <div class="row align-items-center">
            <div id="footer-logo" class="col">
                WorkForce
            </div>
            <div id="footer-navigation" class="col-md-auto text-center">
                <nav class="navigation-menu">
                    <ul class="clearfix">
                        <li>
                            <a href="/#header">Home</a>
                        </li>
                        <li>
                            <a href="/#price">Pricing</a>
                        </li>
                        <li>
                            <a href="/#contact">Contact</a>
                        </li>
                        <li>
                            <a href="/login-register">Register</a>
                        </li>
                        <li>
                            <a href="/login-register">Log in</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div id="copyright" class="col text-right">
                <a href="/">Copyright &copy; {{ date('Y') }} Tinksmat Systems OÜ</a>
            </div>
        </div>
    </div>
</footer>
@include('layout.foot')