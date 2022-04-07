<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
         
        </ul>
        <form class="d-flex navbar">        
            <ul class="nav justify-content-end">
              <li class="nav-item">
                <a class="nav-link home" aria-current="page" href="{{ url('/') }}">Home</a>
              </li>

              <li class="nav-item">
                <a class="nav-link"  href="{{ url('/dashboard') }}">Dashboard</a>
              </li>
             
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
            </ul>
        </form>
      </div>
    </div>
  </nav>




















