@php
    $roles = session('user_roles', []); // Ex: ['Agent', 'Manager', 'Administrateur']
@endphp

<div class="sidebar" id="sidebar">
    <div class="d-flex align-items-center w-100 justify-content-center logo-brand">
        <img src="images/logo.png" width="47px" alt="">
        <h5 class="fw-bold" style="font-size: 2rem">Performa</h5>
    </div>

    <div class="menu-sidebar">
        <div class="accordion" id="accordionPanelsStayOpenExample">

            <!-- Section Home (accessible à tous) -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingZero">
                    <a href="{{ route('dashboard') }}" class="accordion-button collapsed no-item active" type="button">
                        Home
                    </a>
                </h2>
            </div>

            <!-- Section Objectives -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Objectives
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne">
                    <div class="accordion-body">
                        <ul class="list-unstyled">
                            @if(array_intersect(['Agent', 'Admin'], $roles))
                                <li><a href="{{ route('user-create-objective') }}">Create Objective</a></li>
                            @endif
                            @if(array_intersect(['Admin', 'Manager'], $roles))
                                <li><a href="{{ route('collaborator-objective') }}">Collaborator Objectives</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Section Evaluations -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        Evaluations
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                    <div class="accordion-body">
                        <ul class="list-unstyled">
                            @if(array_intersect(['Agent', 'Admin'], $roles))
                                <li><a href="{{ route('dashboard-self-evaluation') }}">Self Evaluation</a></li>
                            @endif
                            @if(array_intersect(['Manager', 'Admin'], $roles))
                                <li><a href="{{ route('collaborator-evaluations') }}">Collaborator Evaluations</a></li>
                            @endif
                            @if(array_intersect(['Agent', 'Manager', 'Admin'], $roles))
                                <li><a href="{{ route('user-history') }}">Evaluation History</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Section Profil (tous les utilisateurs) -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                        User Profile
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix">
                    <div class="accordion-body">
                        <ul class="list-unstyled">
                            <li><a href="{{ route('user-manage-profile') }}">View and Manage Profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Section Organisation Management (Administrateur uniquement) -->
            @if(in_array('Admin', $roles))
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            Organisation Management
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree">
                        <div class="accordion-body">
                            <ul class="list-unstyled">
                                <li><a href="{{ route('user-create-organisation-management') }}">Manage Users</a></li>
                                <li><a href="{{ route('create-comite') }}">Manage Comite</a></li>
                                <li><a href="{{ route('create-comite') }}">Manage Committee Heads</a></li>
                                <li><a href="{{ route('create-comite') }}">Manage Committee Members</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Period Management -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                            Period Management
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour">
                        <div class="accordion-body">
                            <ul class="list-unstyled">
                                <li><a href="{{route('user-create-period-management')}}">Create period</a></li>
                                 <li><a href="{{route('user-manage-period')}}">Manage Period</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Section Reports (visible à tous par défaut) -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingZeroOne">
                    <button class="accordion-button collapsed no-item" type="button">
                        Reports
                    </button>
                </h2>
            </div>
        </div>
    </div>

    <!-- Footer avec info utilisateur -->
    <div class="footer">
        <div class="divider"></div>
        <div class="account-info mt-3 mb-3 w-100">
            <div class="img-account"></div>
            <div class="info">
                <h5 id="user-name"> {{ session('user_name') }} {{ session('user_secondname') }} </h5>
                <p id="user-email"> {{ session('user_email') }}</p>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" style="background-color:transparent; border:none;">
                    <i class="icon-signout" style="font-size: 1.5rem; color: #778093;"></i>
                </button>
            </form>

        </div>
    </div>
</div>