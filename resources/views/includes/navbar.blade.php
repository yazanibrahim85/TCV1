


<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="{{url('/')}}">TCS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <a class="nav-item nav-link active" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                @auth
                @if(Auth::user()->role_id==1 Or Auth::user()->role_id==2)
                <a class="nav-item nav-link" href="{{url('/trainer')}}">Trainers</a>
                @endif
                <a class="nav-item nav-link" href="{{url('/trainee')}}">Trainees</a>
                @if(Auth::user()->role_id==1 Or Auth::user()->role_id==2)
                <a class="nav-item nav-link" href="{{url('/courses')}}">Courses</a>
                @endif
                @if(Auth::user()->role_id==1 Or Auth::user()->role_id==2)
                <a class="nav-item nav-link" href="{{url('/trainings')}}">Trainings</a>

                <a class=" btn btn-primary" href="{{url('/trainings/create')}}">Create a new Training</a>
                
                @endif
                @endauth
          {{--       @auth
                    <a class="nav-item nav-link" href="{{url('/posts')}}">Posts</a>
                    <a class=" btn btn-primary" href="{{url('/posts/create')}}">Create a new Course</a>
                @endauth --}}

               
                
            </ul>
    
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
             
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>

                 {{--    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                     @endif --}}
                    
                @else


                    <li class="nav-item dropdown">
                        
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        
                        <?php
                        //dd(Auth::user()->role_id);
                        ?>
                        
                        
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        
                        @if(Auth::user()->role_id==1 Or Auth::user()->role_id==2)
                            <a href="/home" class="dropdown-item">Dashboard</a>
                            <a href="/reports" class="dropdown-item">Reports</a>
                            @if(Auth::user()->role_id==1)
                            <a href="/appregisterusers" class="dropdown-item" >Register</a>
                            @endif
                            @endif
                      

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
    
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <form id="logout-form1" action="{{  route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>

                     
                        
                    </li>
                @endguest
            </ul>
        </div>
      </nav>

