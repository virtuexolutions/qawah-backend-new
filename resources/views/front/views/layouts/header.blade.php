<header>
  <nav class="navbar navbar-dark navbar-expand-lg">
      <div class="container-fluid d-block">
          <div class="row align-items-center">
              <div class="col-md-2 col-8" id="ali-left">
                @if($logo)
                  <a class="navbar-brand" href="/"><img src="{{$logo->logo}}" alt="logo"
                          class="logo"></a>
                @endif
              </div>
              <div class="col-md-7 col-4">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                      aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                          <li class="nav-item">
                              <div class="dropdown dropdown-menu-dark">
                                  <a href="#" class="btn dropdown-toggle" type="button"
                                      id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
                                      Products</a>
                                  <ul class="dropdown-menu dropdown-menu-dark"
                                      aria-labelledby="dropdownMenuButton">
                                       <li><a class="dropdown-item" href="{{ url('premium-features') }}">Premium Features</a></li>
                                      <li><a class="dropdown-item" href="{{ url('qavah-gold') }} ">Qavah Gold</a></li>
                                      <li><a class="dropdown-item" href="{{ url('qavah-platinum') }}">Qavah Platinum</a>
                                      </li>
                                  </ul>
                              </div>
                          </li>
                          <li class="nav-item">
                              <div class="dropdown dropdown-menu-dark">
                                  <a href="#" class="btn dropdown-toggle" type="button"
                                      id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
                                      Learn</a>
                                  <ul class="dropdown-menu dropdown-menu-dark"
                                      aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="{{ url('qavah-live') }}">Qavah Live</a></li>
                                      <li><a class="dropdown-item" href="{{ url('qavah-court') }}">Qavah Court</a></li>
                                      </li>
                                  </ul>
                              </div>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="{{ url('about') }}">About</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="{{ url('support') }}">Support</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="#">Merchandise</a>
                          </li>
                          <li class="nav-link db">
                              <a href="https://dashboard.qavah.us/">
                                  <h4 class="Login-text">Login</h4>
                              </a>
                          </li>
                          <li class="nav-link db">
                              <button type="button" onclick="window.location.href= 'https://dashboard.qavah.us/user/register'" class="btn1">User Registration</button>
                          </li>
                      </ul>
                  </div>
              </div>
              <div class="col-md-3" id="dp">
                  <div class="login-div">
                      <a href="https://dashboard.qavah.us/">
                          <h4 class="Login-text">Login</h4>
                      </a>
                      <button type="button"  onclick="window.location.href= 'https://dashboard.qavah.us/user/register'" class="btn1">User Registration</button>
                  </div>
              </div>
          </div>
      </div>
  </nav>
</header>
