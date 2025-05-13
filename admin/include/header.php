<div class="container-fluid my-custom-bg text-light p-3 d-flex align-items-center justify-content-between sticky-top">
    <div class="logo-container">
        <a class="navbar-brand me-5" href="index.php">
            <img src="/Horizon Blu Hotel Web app/images/Horizon Blu logo Vf.png" alt="Horizon Blu Hotel Logo">
        </a>
    </div>
    <div class="flex-grow-1 text-center ms-0">
        <!-- <h3 class="mb-0">Admin Panel</h3> -->
    </div>
    <a href="logout.php" class="btn text-white button-bg shadow-none btn-sm">LOG OUT</a>    
</div>

<div class="col-lg-2 border-top border-3 border-secondary" id="dashboard-menu">
    <nav class="navbar navbar-expand-lg navbar-dark text-white">
        <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="mt-2">ADMIN PANEL</h4>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminDropdown" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="adminDropdown">
                <ul class="nav nav-pills flex-column">
                    
                    <li class="nav-item">
                        <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="rooms.php">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="features_facilities.php">Features & Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="settings.php">Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>