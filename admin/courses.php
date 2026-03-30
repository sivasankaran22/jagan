<?php include 'admin-header.php'; ?>
    <div class="main-content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Manage Courses</h1>
                <a href="#" class="btn btn-sm btn-primary shadow-sm disabled"><i class="fas fa-plus fa-sm text-white-50"></i> Add Course</a>
            </div>

            <?php 
            if (isset($_GET['delete'])) {
                $del_id = $_GET['delete'];
                $conn->query("DELETE FROM courses WHERE id = $del_id");
                echo '<div class="alert alert-info">Course Deleted Successfully!</div>';
            }
            ?>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">All Courses List</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Rating</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $courses_sql = "SELECT * FROM courses ORDER BY id DESC";
                                $courses_result = $conn->query($courses_sql);
                                while($row = $courses_result->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['category']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><?php echo $row['rating']; ?> / 5</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info disabled"><i class="fas fa-edit"></i> Edit</a>
                                        <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
