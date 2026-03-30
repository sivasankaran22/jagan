<?php include 'admin-header.php'; ?>
    <div class="main-content">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Manage Testimonials (Version 2)</h1>

            <?php 
            $edit_page_id = isset($_GET['page_id']) ? intval($_GET['page_id']) : 1;
            $edit_position = isset($_GET['pos']) ? intval($_GET['pos']) : 5; // Defaulting to 5 as per user's request
            $msg = "";
            
            // Handle Section Heading Update
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_section'])) {
                $sub_title = mysqli_real_escape_string($conn, $_POST['sub_title']);
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                
                $check = $conn->query("SELECT id FROM testimonial_2_section WHERE page_id = $edit_page_id AND position = $edit_position");
                if ($check->num_rows > 0) {
                    $sql = "UPDATE testimonial_2_section SET sub_title = '$sub_title', title = '$title' WHERE page_id = $edit_page_id AND position = $edit_position";
                } else {
                    $sql = "INSERT INTO testimonial_2_section (page_id, position, sub_title, title) VALUES ($edit_page_id, $edit_position, '$sub_title', '$title')";
                }
                
                if ($conn->query($sql) === TRUE) {
                    $msg = '<div class="alert alert-success">Section Heading Updated!</div>';
                }
            }

            // Handle Row/Item Delete
            if (isset($_GET['delete'])) {
                $del_id = intval($_GET['delete']);
                $conn->query("DELETE FROM testimonials WHERE id = $del_id");
                $msg = '<div class="alert alert-info">Testimonial Deleted.</div>';
            }

            // Handle Add Item
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_testimonial'])) {
                $name = mysqli_real_escape_string($conn, $_POST['name']);
                $role = mysqli_real_escape_string($conn, $_POST['role']);
                $content = mysqli_real_escape_string($conn, $_POST['content']);
                $image = mysqli_real_escape_string($conn, $_POST['image']);
                $rating = intval($_POST['rating']);
                
                $sql = "INSERT INTO testimonials (page_id, position, name, role, content, image, rating) VALUES ($edit_page_id, $edit_position, '$name', '$role', '$content', '$image', '$rating')";
                if ($conn->query($sql) === TRUE) {
                    $msg = '<div class="alert alert-success">New Testimonial Added!</div>';
                }
            }

            // Fetch Current Content
            $section_res = $conn->query("SELECT * FROM testimonial_2_section WHERE page_id = $edit_page_id AND position = $edit_position LIMIT 1");
            $section = $section_res->fetch_assoc();
            if (!$section) $section = ['sub_title' => 'Tesimonials', 'title' => 'What Our Clients are Saying <br> About Us'];

            $pages_res = $conn->query("SELECT id, title FROM pages");
            ?>

            <div class="row">
                <div class="col-lg-4">
                    <!-- Section Details Card -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Branding & Titles</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Sub Title</label>
                                    <input type="text" name="sub_title" class="form-control" value="<?php echo htmlspecialchars($section['sub_title']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Main Heading</label>
                                    <textarea name="title" class="form-control" rows="2"><?php echo htmlspecialchars($section['title']); ?></textarea>
                                </div>
                                <button type="submit" name="update_section" class="btn btn-primary w-100">Update Section Headings</button>
                            </form>
                        </div>
                    </div>

                    <!-- Page Context Card -->
                    <div class="card shadow mb-4 border-left-info">
                         <div class="card-body">
                             <label class="small text-muted font-weight-bold">Currently Editing Page:</label>
                             <select class="form-select mb-3" onchange="location.href='?pos=<?php echo $edit_position; ?>&page_id='+this.value">
                                <?php while($p = $pages_res->fetch_assoc()): ?>
                                    <option value="<?php echo $p['id']; ?>" <?php echo ($edit_page_id == $p['id']) ? 'selected' : ''; ?>>
                                        <?php echo $p['title']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                             <label class="small text-muted font-weight-bold">Widget Position Index:</label>
                             <input type="number" class="form-control" value="<?php echo $edit_position; ?>" onchange="location.href='?page_id=<?php echo $edit_page_id; ?>&pos='+this.value">
                         </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <!-- Testimonials Manager Card -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Manage Items (Slides)</h6>
                        </div>
                        <div class="card-body">
                            <?php echo $msg; ?>
                            <form method="POST" class="mb-5 p-3 border rounded bg-light shadow-sm">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Client Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="e.g. John Smith" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Client Role</label>
                                        <input type="text" name="role" class="form-control" placeholder="e.g. Product Manager" required>
                                    </div>
                                    <div class="col-md-10 mb-3">
                                        <label class="form-label">Client Photo Resource</label>
                                        <div class="input-group">
                                            <input type="text" id="image" name="image" class="form-control" placeholder="assets/img/home-2/testimonial/client-01.png" required>
                                            <button type="button" class="btn btn-outline-primary" onclick="openMediaSelector('image')"><i class="fas fa-images"></i></button>
                                        </div>
                                    </div>
                                     <div class="col-md-2 mb-3">
                                        <label class="form-label">Rating</label>
                                        <select name="rating" class="form-select">
                                            <option value="5">5 Start</option>
                                            <option value="4">4 Start</option>
                                            <option value="3">3 Start</option>
                                            <option value="2">2 Start</option>
                                            <option value="1">1 Start</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Testimonial Quote</label>
                                        <textarea name="content" class="form-control" rows="3" required></textarea>
                                    </div>
                                </div>
                                <button type="submit" name="add_testimonial" class="btn btn-success shadow-sm px-4">
                                    <i class="fas fa-plus me-1"></i> Add Into Slider
                                </button>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Client</th>
                                            <th>Quote Preview</th>
                                            <th>Rating</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $sql = "SELECT * FROM testimonials WHERE page_id = $edit_page_id AND position = $edit_position ORDER BY id DESC";
                                        $res = $conn->query($sql);
                                        if($res && $res->num_rows > 0):
                                            while($t = $res->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <img src="../<?php echo !empty($t['image']) ? $t['image'] : 'assets/img/placeholder.png'; ?>" height="40" width="40" class="rounded-circle me-3 object-fit-cover shadow-sm">
                                                    <div>
                                                        <div class="font-weight-bold text-dark"><?php echo $t['name']; ?></div>
                                                        <small class="text-muted"><?php echo $t['role']; ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-muted small">
                                                "<?php echo substr(htmlspecialchars($t['content']), 0, 80); ?>..."
                                            </td>
                                            <td class="align-middle">
                                                <div class="text-warning">
                                                    <?php for($i=1; $i<=5; $i++) echo $i<=$t['rating'] ? '<i class="fas fa-star fa-xs"></i>' : '<i class="far fa-star fa-xs"></i>'; ?>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <a href="?page_id=<?php echo $edit_page_id; ?>&pos=<?php echo $edit_position; ?>&delete=<?php echo $t['id']; ?>" 
                                                   class="btn btn-sm btn-outline-danger" 
                                                   onclick="return confirm('Remove testimonial?')">
                                                   <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php 
                                            endwhile; 
                                        else:
                                            echo '<tr><td colspan="4" class="text-center py-5 text-muted italic">No testimonials added yet for this position on this page.</td></tr>';
                                        endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
