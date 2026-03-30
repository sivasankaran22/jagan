<?php include 'admin-header.php'; ?>
    <div class="main-content">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Dashboard Overview</h1>
            <div class="row">
                <!-- Count Stats (Optional cards) -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Courses</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php 
                                        $res = $conn->query("SELECT COUNT(*) as total FROM courses");
                                        $row = $res->fetch_assoc();
                                        echo $row['total'];
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Instructors</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php 
                                        $res = $conn->query("SELECT COUNT(*) as total FROM team");
                                        $row = $res->fetch_assoc();
                                        echo $row['total'];
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    Manage Sections
                </div>
                <div class="card-body">
                    <p>Welcome to the Eduex management dashboard. Use the sidebar to navigate to specific sections of your website and update their content directly.</p>
                    <div class="list-group">
                        <a href="hero.php" class="list-group-item list-group-item-action">Edit Hero Section (Home Page Banner)</a>
                        <a href="about.php" class="list-group-item list-group-item-action">Edit About Us Section</a>
                        <a href="courses.php" class="list-group-item list-group-item-action">Manage Courses</a>
                        <a href="team.php" class="list-group-item list-group-item-action">Manage Instructors</a>
                        <a href="pricing.php" class="list-group-item list-group-item-action">Manage Pricing Plans</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
