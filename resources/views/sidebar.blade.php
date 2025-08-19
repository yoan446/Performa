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
            <div class="accordion-item" data-role="Agent,Admin,Manager">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Objectives
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne">
                    <div class="accordion-body">
                        <ul class="list-unstyled">
                            <li data-role="Agent,Admin,comite"><a href="{{ route('user-create-objective') }}">Create Objective</a></li>
                            <li data-role="Manager,Admin,comite"><a href="{{ route('collaborator-objective') }}">Collaborator Objectives</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Section Evaluations -->
            <div class="accordion-item" data-role="Agent,Manager,Admin">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        Evaluations
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                    <div class="accordion-body">
                        <ul class="list-unstyled">
                            <li data-role="Agent,Admin"><a href="{{ route('dashboard-self-evaluation') }}">Self Evaluation</a></li>
                            <li data-role="Manager,Admin"><a href="{{ route('collaborator-evaluations') }}">Collaborator Evaluations</a></li>
                            <li data-role="Agent,Manager,Admin"><a href="{{ route('user-history') }}">Evaluation History</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Section User Profile (tous les utilisateurs) -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingProfile">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseProfile" aria-expanded="true" aria-controls="collapseProfile">
                        User Profile
                    </button>
                </h2>
                <div id="collapseProfile" class="accordion-collapse collapse" aria-labelledby="headingProfile">
                    <div class="accordion-body">
                        <ul class="list-unstyled">
                            <li><a href="{{ route('user-manage-profile') }}">View and Manage Profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Organisation & Period Management (Admin uniquement) -->
            <div class="accordion-item" data-role="Admin">
                <h2 class="accordion-header" id="headingOrg">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOrg" aria-expanded="true" aria-controls="collapseOrg">
                        Organisation Management
                    </button>
                </h2>
                <div id="collapseOrg" class="accordion-collapse collapse" aria-labelledby="headingOrg">
                    <div class="accordion-body">
                        <ul class="list-unstyled">
                            <li><a href="{{ route('user-create-organisation-management') }}">Manage Users</a></li>
                            <li><a href="{{ route('create-comite') }}">Manage Comite</a></li>
                            <li><a href="{{ route('create-comite-responsable') }}">Manage Committee Heads</a></li>
                            <li><a href="{{ route('create-comite-member') }}">Manage Committee Members</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item" data-role="Admin">
                <h2 class="accordion-header" id="headingPeriod">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapsePeriod" aria-expanded="true" aria-controls="collapsePeriod">
                        Period Management
                    </button>
                </h2>
                <div id="collapsePeriod" class="accordion-collapse collapse" aria-labelledby="headingPeriod">
                    <div class="accordion-body">
                        <ul class="list-unstyled">
                            <li><a href="{{route('user-manage-cycle')}}">Manage Cycles</a></li>
                            <li><a href="{{route('user-create-period-management')}}">Manage period</a></li>
                            <li><a href="{{route('user-manage-action')}}">Manage Actions</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Section Reports (visible à tous) -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingReports">
                    <button class="accordion-button collapsed no-item" type="button">
                        Reports
                    </button>
                </h2>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="divider"></div>
        <div class="account-info mt-3 mb-3 w-100">
            <div class="img-account"></div>
            <div class="info">
                <h5 id="user-name">name</h5>
                <p id="user-email">email</p>
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
<script src="{{ asset('js/script-profile.js') }}"></script>
<script src="{{ asset('js/script-sidebar.js') }}"></script>