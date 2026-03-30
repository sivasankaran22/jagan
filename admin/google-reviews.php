<?php include 'admin-header.php'; ?>
    <div class="main-content">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Manage Google Reviews Slider</h1>

            <?php 
            $edit_page_id = isset($_GET['page_id']) ? intval($_GET['page_id']) : 1;
            $edit_position = isset($_GET['pos']) ? intval($_GET['pos']) : 1; 
            $msg = "";
            
            // Handle Section Heading & Branding Update
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_section'])) {
                $sub_title = mysqli_real_escape_string($conn, $_POST['sub_title']);
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                $google_score = mysqli_real_escape_string($conn, $_POST['google_score']);
                $google_icon = mysqli_real_escape_string($conn, $_POST['google_icon']);
                $btn_text = mysqli_real_escape_string($conn, $_POST['btn_text']);
                $btn_link = mysqli_real_escape_string($conn, $_POST['btn_link']);
                
                $check = $conn->query("SELECT id FROM google_reviews_section WHERE page_id = $edit_page_id AND position = $edit_position");
                if ($check->num_rows > 0) {
                    $sql = "UPDATE google_reviews_section SET 
                            sub_title = '$sub_title', 
                            title = '$title',
                            google_score = '$google_score',
                            google_icon = '$google_icon',
                            btn_text = '$btn_text',
                            btn_link = '$btn_link'
                            WHERE page_id = $edit_page_id AND position = $edit_position";
                } else {
                    $sql = "INSERT INTO google_reviews_section (page_id, position, sub_title, title, google_score, google_icon, btn_text, btn_link) 
                            VALUES ($edit_page_id, $edit_position, '$sub_title', '$title', '$google_score', '$google_icon', '$btn_text', '$btn_link')";
                }
                
                if ($conn->query($sql) === TRUE) {
                    $msg = '<div class="alert alert-success">Section Branding Updated!</div>';
                }
            }

            // Handle Item Delete
            if (isset($_GET['delete'])) {
                $del_id = intval($_GET['delete']);
                $conn->query("DELETE FROM testimonials WHERE id = $del_id");
                $msg = '<div class="alert alert-info">Review Deleted.</div>';
            }

            // Handle Add Item
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_review'])) {
                $name = mysqli_real_escape_string($conn, $_POST['name']);
                $role = mysqli_real_escape_string($conn, $_POST['role']);
                $content = mysqli_real_escape_string($conn, $_POST['content']);
                $image = mysqli_real_escape_string($conn, $_POST['image']);
                
                $sql = "INSERT INTO testimonials (page_id, position, name, role, content, image) VALUES ($edit_page_id, $edit_position, '$name', '$role', '$content', '$image')";
                if ($conn->query($sql) === TRUE) {
                    $msg = '<div class="alert alert-success">New Review Added!</div>';
                }
            }

            // Fetch Current Section Branding
            $section_res = $conn->query("SELECT * FROM google_reviews_section WHERE page_id = $edit_page_id AND position = $edit_position LIMIT 1");
            $section = $section_res->fetch_assoc();
            if (!$section) $section = [
                'sub_title' => 'Students Reviews', 
                'title' => 'What Students Say About <br> Our Platform.',
                'google_score' => '5.0',
                'google_icon' => 'assets/img/home-1/testimonial/icon-01.png',
                'btn_text' => 'All Testimonials',
                'btn_link' => 'testimonial.html'
            ];

            $pages_res = $conn->query("SELECT id, title FROM pages");
            ?>

            <div class="row">
                <div class="col-lg-4">
                    <!-- Branding Settings -->
                    <div class="card shadow mb-4 border-left-primary">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Branding & Layout</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Sub Title</label>
                                    <input type="text" name="sub_title" class="form-control" value="<?php echo htmlspecialchars($section['sub_title']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Title (HTML supported)</label>
                                    <textarea name="title" class="form-control" rows="2"><?php echo htmlspecialchars($section['title']); ?></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Google Rating</label>
                                        <input type="text" name="google_score" class="form-control" value="<?php echo htmlspecialchars($section['google_score']); ?>">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Branding Icon</label>
                                        <div class="input-group">
                                            <input type="text" id="google_icon" name="google_icon" class="form-control" value="<?php echo htmlspecialchars($section['google_icon']); ?>">
                                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="openMediaSelector('google_icon')"><i class="fas fa-images"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Button Text</label>
                                        <input type="text" name="btn_text" class="form-control" value="<?php echo htmlspecialchars($section['btn_text']); ?>">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Button Link</label>
                                        <input type="text" name="btn_link" class="form-control" value="<?php echo htmlspecialchars($section['btn_link']); ?>">
                                    </div>
                                </div>
                                <button type="submit" name="update_section" class="btn btn-primary w-100 mt-2"> <i class="fas fa-check-circle me-1"></i> Update Section Global Settings</button>
                            </form>
                        </div>
                    </div>

                    <!-- Page Context Card -->
                    <div class="card shadow mb-4 bg-light">
                         <div class="card-body">
                             <label class="small text-muted font-weight-bold">Page:</label>
                             <select class="form-select mb-2" onchange="location.href='?pos=<?php echo $edit_position; ?>&page_id='+this.value">
                                <?php while($p = $pages_res->fetch_assoc()): ?>
                                    <option value="<?php echo $p['id']; ?>" <?php echo ($edit_page_id == $p['id']) ? 'selected' : ''; ?>>
                                        <?php echo $p['title']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                             <label class="small text-muted font-weight-bold">Position Index:</label>
                             <input type="number" class="form-control" value="<?php echo $edit_position; ?>" onchange="location.href='?page_id=<?php echo $edit_page_id; ?>&pos='+this.value">
                         </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <!-- Items Section -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Google Review Items</h6>
                        </div>
                        <div class="card-body">
                            <?php echo $msg; ?>
                            <form method="POST" class="mb-4 p-4 border rounded bg-light border-left-success">
                                <h6 class="font-weight-bold mb-3">Add New Review</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Student Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Marvin McKinney" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Role/Label</label>
                                        <input type="text" name="role" class="form-control" placeholder="Product Manager" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Review Content</label>
                                        <textarea name="content" class="form-control" rows="2" required></textarea>
                                    </div>
                                    <div class="col-md-10 mb-3">
                                        <label class="form-label">Avatar Resource</label>
                                        <div class="input-group">
                                            <input type="text" id="image" name="image" class="form-control" value="assets/img/home-1/testimonial/client-01.png" required>
                                            <button type="button" class="btn btn-outline-primary" onclick="openMediaSelector('image')"><i class="fas fa-images"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="add_review" class="btn btn-success shadow-sm"> <i class="fas fa-plus"></i> Add Review </button>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Reviewer</th>
                                            <th width="50%">Review</th>
                                            <th>Actions</th>
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
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="../<?php echo !empty($t['image']) ? $t['image'] : 'assets/img/placeholder.png'; ?>" height="40" width="40" class="rounded me-3 shadow-sm">
                                                    <div>
                                                        <div class="font-weight-bold"><?php echo $t['name']; ?></div>
                                                        <small class="text-muted"><?php echo $t['role']; ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="small text-muted italic">
                                                "<?php echo htmlspecialchars($t['content']); ?>"
                                            </td>
                                            <td>
                                                <a href="?page_id=<?php echo $edit_page_id; ?>&pos=<?php echo $edit_position; ?>&delete=<?php echo $t['id']; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php 
                                            endwhile; 
                                        else:
                                            echo '<tr><td colspan="3" class="text-center py-4 text-muted">No reviews yet for this position.</td></tr>';
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
