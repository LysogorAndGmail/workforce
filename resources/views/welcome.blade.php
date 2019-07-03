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
                                <a href="#header">Home</a>
                            </li>
                            <li>
                                <a href="#price">Pricing</a>
                            </li>
                            <li>
                                <a href="#contact">Contact</a>
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

    <div class="builder-element element-hero" id="home">
        <div class="element-inner">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <div class="element-header">
                                    <h1>Unique robot who forces you to work better & smarter</h1>
                                </div>
                                <div class="element-body">
                                    <p>unlimited work hours, documents and users</p>
                                </div>
                                <div class="element-footer text-center">
                                    <a href="/login-register" class="btn btn-primary">Free trial</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <div class="d-flex align-items-end justify-content-end hero-images clearfix">
                            <img src="assets/img/desktop-view.png" alt="" class="desktop-view"/>
                            <img src="assets/img/mobile-view.png" alt="" class="mobile-view"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="builder-element element-bg-white" id="price">
        <div class="element-inner">
            <div class="container">
                <div class="element-header text-center">
                    <h2>Pricing</h2>
                    <p>Nulla sit amet lectus nec elit suscipit gravida. Vestibulum ultricies dignissim velit nec
                        sollicitudin. Donec at nibh vel augue mattis venenatis et non leo.</p>
                </div>
                <div class="element-body">
                    <div class="row pricing-grid">
                        <div class="col-12 col-md-4 col-lg-4 text-center">
                            <div class="pricing-item">
                                <h3>
                                    Simple start
                                    <small>Package I</small>
                                </h3>
                                <p>Quisque non sapien blandit, suscipit sapien a, dictum neque. Sed vel nunc sit amet
                                    lacus consequat feugiat eget.</p>
                                <p class="pricetag">4,80 €</p>
                                <div class="pricing-btn text-center">
                                    <a href="#" class="btn btn-outline-primary">Choose</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-4 text-center">
                            <div class="pricing-item">
                                <h3>
                                    Medium company
                                    <small>Package II</small>
                                </h3>
                                <p>Quisque non sapien blandit, suscipit sapien a, dictum neque. Sed vel nunc sit amet
                                    lacus consequat feugiat eget.</p>
                                <p class="pricetag">4,80 €</p>
                                <div class="pricing-btn text-center">
                                    <a href="#" class="btn btn-outline-primary">Choose</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-4 text-center">
                            <div class="pricing-item">
                                <h3>
                                    Unlimited
                                    <small>Package III</small>
                                </h3>
                                <p>Quisque non sapien blandit, suscipit sapien a, dictum neque. Sed vel nunc sit amet
                                    lacus consequat feugiat eget.</p>
                                <p class="pricetag">4,80 €</p>
                                <div class="pricing-btn text-center">
                                    <a href="#" class="btn btn-outline-primary">Choose</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="element-footer text-center">
                    <p class="font24">Need extra features for your business? <a href="#contact"><b>Contact us</b></a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="builder-element element-bg-img element-bg-left"
         style="background-image: url(assets/img/bg-image-1.jpg)">
        <div class="element-inner">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="element-header">
                            <h3>Fusce fringilla mi eu nisl blandit</h3>
                        </div>
                        <div class="element-body">
                            <div class="editor-content">
                                <h5>Pellentesque maximus, dui dignissim rhoncus rutrum, purus felis vestibulum turpis,
                                    quis suscipit augue quam in odio. Vivamus convallis est enim, vitae hendrerit diam
                                    interdum ut.</h5>
                                <p>Donec vel velit ut felis consequat tempus. Integer tempor nibh quam, sed sollicitudin
                                    massa iaculis ut. Sed suscipit augue nisl, sit amet vehicula ex finibus quis. Nulla
                                    quam mauris, interdum non ullamcorper in, tincidunt at ex. Morbi sagittis vehicula
                                    justo, vitae consequat ante sagittis nec.</p>
                                <p>Cras sit amet erat non lacus viverra ultrices. Donec finibus purus tortor, in cursus
                                    erat aliquet nec. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
                                    posuere cubilia Curae.</p>
                            </div>
                        </div>
                        <div class="element-footer text-center">
                            <a href="#" class="btn btn-primary">More info</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="builder-element element-bg-img element-bg-right"
         style="background-image: url(assets/img/bg-image-2.jpg)">
        <div class="element-inner">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="element-header">
                            <h3>Curabitur laoreet sodales cursus</h3>
                        </div>
                        <div class="element-body">
                            <div class="editor-content">
                                <h5>Proin egestas quam sed dolor consequat, sit amet cursus ipsum gravida. Pellentesque
                                    bibendum elit dui, non auctor quam convallis nec.</h5>
                                <ul>
                                    <li>Vestibulum posuere, quam id ornare vestibulum</li>
                                    <li>Diam enim suscipit odio, et convallis lorem risus vitae lectus</li>
                                    <li>Sed convallis tempus sollicitudin pellentesque elit ante</li>
                                    <li>Sed convallis tempus sollicitudin pellentesque elit ante</li>
                                    <li>Sed quis porttitor nisi sed a volutpat massa</li>
                                    <li>Fusce vitae sem sit amet magna congue feugiat</li>
                                </ul>
                            </div>
                        </div>
                        <div class="element-footer text-center">
                            <a href="#" class="btn btn-primary">More info</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="builder-element element-bg-white" id="contact">
        <div class="element-inner">
            <div class="container">
                <div class="element-header text-center">
                    <h3>Contact us</h3>
                </div>
                <div class="element-body">
                    <div class="row">
                        <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                            <form>
                                <div class="row">
                                    <div class="col-md-6 col-12 form-group">
                                        <label class="form">Name</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-12 form-group">
                                        <label>E-mail</label>
                                        <input type="email" class="form-control">
                                    </div>
                                    <div class="col-12 form-group">
                                        <label>Message</label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                    <div class="col-12 form-group text-center">
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                            </form>
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
                            <a href="#header">Home</a>
                        </li>
                        <li>
                            <a href="#price">Pricing</a>
                        </li>
                        <li>
                            <a href="#contact">Contact</a>
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