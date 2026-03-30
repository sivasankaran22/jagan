<?php include 'admin-header.php'; ?>
    <div class="main-content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Manage Team/Instructors</h1>
            </div>

            <?php 
            $edit_page_id = isset($_GET['page_id']) ? $_GET['page_id'] : 1;
            $msg = "";
            
            // Delete logic
            if (isset($_GET['delete'])) {
                $del_id = $_GET['delete'];
                $conn->query("DELETE FROM team WHERE id = $del_id");
                $msg = '<div class="alert alert-info">Member Removed.</div>';
            }

            // Save new member logic
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_member'])) {
                $name = $_POST['name'];
                $designation = $_POST['designation'];
                $image = $_POST['image'];
                
                $sql = "INSERT INTO team (page_id, name, designation, image) VALUES ($edit_page_id, '$name', '$designation', '$image')";
                if ($conn->query($sql) === TRUE) {
                    $msg = '<div class="alert alert-success">New Instructor Added!</div>';
                }
            }

            $pages_res = $conn->query("SELECT id, title FROM pages");
            ?>

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Team Members for Selected Page</h6>
                    <div class="col-md-4">
                        <select class="form-select" onchange="location.href='?page_id='+this.value">
                            <?php while($p = $pages_res->fetch_assoc()): ?>
                                <option value="<?php echo $p['id']; ?>" <?php echo ($edit_page_id == $p['id']) ? 'selected' : ''; ?>>
                                    Showing: <?php echo $p['title']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <?php echo $msg; ?>
                    <form method="POST" class="row border-bottom pb-4 mb-4 g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Designation</label>
                            <input type="text" name="designation" class="form-control" placeholder="UI/UX Designer" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Image Path (URL)</label>
                            <input type="text" name="image" class="form-control" value="assets/img/home-1/team/team-01.jpg" required>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" name="add_member" class="btn btn-primary w-100">Add Instructor</button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $team_sql = "SELECT * FROM team WHERE page_id = $edit_page_id ORDER BY id DESC";
                                $team_result = $conn->query($team_sql);
                                while($t = $team_result->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><img src="../<?php echo $t['image']; ?>" height="40" alt="img" class="rounded"></td>
                                    <td><?php echo $t['name']; ?></td>
                                    <td><?php echo $t['designation']; ?></td>
                                    <td>
                                        <a href="?page_id=<?php echo $edit_page_id; ?>&delete=<?php echo $t['id']; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</a>
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
