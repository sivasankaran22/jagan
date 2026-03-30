<?php include 'admin-header.php'; ?>
    <div class="main-content">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Manage Testimonials</h1>

            <?php 
            $edit_page_id = isset($_GET['page_id']) ? $_GET['page_id'] : 1;
            $msg = "";
            
            if (isset($_GET['delete'])) {
                $del_id = $_GET['delete'];
                $conn->query("DELETE FROM testimonials WHERE id = $del_id");
                $msg = '<div class="alert alert-info">Testimonial Deleted.</div>';
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_testimonial'])) {
                $name = $_POST['name'];
                $role = $_POST['role'];
                $content = $_POST['content'];
                $image = $_POST['image'];
                $rating = $_POST['rating'];
                
                $sql = "INSERT INTO testimonials (page_id, name, role, content, image, rating) VALUES ($edit_page_id, '$name', '$role', '$content', '$image', '$rating')";
                if ($conn->query($sql) === TRUE) {
                    $msg = '<div class="alert alert-success">New Testimonial Added!</div>';
                }
            }

            $pages_res = $conn->query("SELECT id, title FROM pages");
            ?>

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Testimonials for Selected Page</h6>
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
                    <form method="POST" class="border-bottom pb-4 mb-4 g-3">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Client Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Marvin McKinney" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Client Role</label>
                                <input type="text" name="role" class="form-control" placeholder="Product Manager" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Photo (URL)</label>
                                <input type="text" name="image" class="form-control" value="assets/img/home-1/testimonial/client-01.png" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Content</label>
                            <textarea name="content" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                             <label class="form-label">Rating (1-5)</label>
                             <input type="number" name="rating" class="form-control" value="5" max="5" min="1">
                        </div>
                        <button type="submit" name="add_testimonial" class="btn btn-primary px-4">Add Testimonial</button>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Content Snippet</th>
                                    <th>Rating</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sql = "SELECT * FROM testimonials WHERE page_id = $edit_page_id ORDER BY id DESC";
                                $res = $conn->query($sql);
                                while($t = $res->fetch_assoc()):
                                ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="../<?php echo $t['image']; ?>" height="30" class="rounded me-2">
                                            <div>
                                                <strong><?php echo $t['name']; ?></strong><br>
                                                <small class="text-muted"><?php echo $t['role']; ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo substr($t['content'], 0, 50); ?>...</td>
                                    <td><?php echo $t['rating']; ?>/5</td>
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
