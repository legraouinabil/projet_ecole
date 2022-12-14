

 <div class="bg-top navbar-light">
    <div class="container">
        <div class="row no-gutters d-flex align-items-center align-items-stretch">
            <div class="col-md-4 d-flex align-items-center py-4">
                <a class="navbar-brand" href="{{route('front.home')}}">Fox. <span>University</span></a>
            </div>
            <div class="col-lg-8 d-block">
                <div class="row d-flex">
                    <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
                        <div class="icon d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                        <div class="text">
                            <span>Email</span>
                            <span>youremail@email.com</span>
                        </div>
                    </div>
                    <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
                        <div class="icon d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                        <div class="text">
                            <span>Call</span>
                            <span>Call Us: + 1235 2355 98</span>
                        </div>
                    </div>
                    <div class="col-md topper d-flex align-items-center justify-content-end">
                        <p class="mb-0">
                          @if (Auth::guard('stagaire')->check() || Auth::guard('formateur')->check() )
                          
                          <form action=" {{route('logout')}}  " method="POST">
                            @csrf
                    <button class="btn py-2 px-3 btn-primary d-flex align-items-center justify-content-center" type="submit">
                        <i class="fas fa-unlock"></i>
                        <span>log out</span>
                      </button>
                    
                    </form>
                            @else
                            <a href="/stagaire/login" class="btn py-2 px-3 btn-primary d-flex align-items-center justify-content-center">
                              <span>Apply Now</span>
                          </a>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
      </div>
</div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container d-flex align-items-center px-4">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>
      <form action="#" class="searchform order-lg-last">
      <div class="form-group d-flex">
        <input type="text" class="form-control pl-3" placeholder="Search">
        <button type="submit" placeholder="" class="form-control search"><span class="ion-ios-search"></span></button>
      </div>
    </form>
      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active"><a href="{{route('front.home')}}   " class="nav-link pl-0">Home</a></li>
          
             
           <li class="dropdown open nav-item">
            <a class="nav-link" dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Formation
                </button>
            <div class="dropdown-menu" aria-labelledby="triggerId">
              @foreach ($formations as $f)
                  
              <a class="dropdown-item" href=" {{route('front.filier' , $f->id)}} ">{{$f->name}}
              <i class="fa fa-address-book" aria-hidden="true"></i>
              </a>
             
              @endforeach
             
             
            </div>
          </li>
            
            </li>
          
            <li class="nav-item"><a href=" {{route('front.blog')}}" class="nav-link">Blog</a></li>
          <li class="nav-item"><a href="  {{route('front.cantact')}} " class="nav-link">Contact</a></li>
          @if (Auth::guard('stagaire')->check())
          <li class="nav-item"><a href="   " class="nav-link">Courses</a></li>
         @endif
         @if (Auth::guard('formateur')->check())
         <li class="nav-item"><a href="   "class="nav-link">Dashbord</a></li>
        @endif

        </ul>
      </div>
    </div>
  </nav>
<!-- END nav -->