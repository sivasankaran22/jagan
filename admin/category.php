<?php include 'admin-header.php'; ?>
    <div class="main-content">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Manage Categories</h1>

            <?php 
            $edit_page_id = isset($_GET['page_id']) ? $_GET['page_id'] : 1;
            $edit_position = isset($_GET['pos']) ? $_GET['pos'] : 1;
            $msg = "";
            
            if (isset($_GET['delete'])) {
                $del_id = $_GET['delete'];
                $conn->query("DELETE FROM top_categories WHERE id = $del_id");
                $msg = '<div class="alert alert-info">Category Removed.</div>';
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
                $name = $_POST['name'];
                $icon = $_POST['icon'];
                $delay = $_POST['delay'];
                $link = $_POST['link'];
                
                $sql = "INSERT INTO top_categories (page_id, position, name, icon, delay, link) VALUES ($edit_page_id, $edit_position, '$name', '$icon', '$delay', '$link')";
                if ($conn->query($sql) === TRUE) {
                    $msg = '<div class="alert alert-success">New Category Added to Position #'.$edit_position.'!</div>';
                }
            }

            $pages_res = $conn->query("SELECT id, title, filename, widgets_json FROM pages");
            $pages_arr = [];
            while($p = $pages_res->fetch_assoc()) $pages_arr[] = $p;
            ?>

            <div class="card shadow mb-4 border-left-primary">
                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white">
                    <h6 class="m-0 font-weight-bold text-primary">Categories for Selected Layout Position</h6>
                    <div class="d-flex g-2">
                         <select class="form-select form-select-sm me-2" onchange="location.href='?page_id='+this.value">
                            <?php foreach($pages_arr as $p): ?>
                                <option value="<?php echo $p['id']; ?>" <?php echo ($edit_page_id == $p['id']) ? 'selected' : ''; ?>>Page: <?php echo $p['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select class="form-select form-select-sm" onchange="location.href='?page_id=<?php echo $edit_page_id; ?>&pos='+this.value">
                            <?php 
                            $curr_page = null;
                            foreach($pages_arr as $p) if($p['id'] == $edit_page_id) $curr_page = $p;
                            if($curr_page && !empty($curr_page['widgets_json'])) {
                                $layout = json_decode($curr_page['widgets_json'], true);
                                foreach($layout as $i => $w) if($w == 'category.php') echo '<option value="'.($i+1).'" '.($edit_position == ($i+1) ? 'selected' : '').'>Position #'.($i+1).'</option>';
                            } else { echo '<option value="1">Position #1</option>'; }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <?php echo $msg; ?>
                    <form method="POST" class="row border-bottom pb-4 mb-4 g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" name="name" class="form-control" placeholder="UI/UX Design" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Icon Image (URL)</label>
                            <input type="text" name="icon" class="form-control" value="assets/img/home-1/category/icon-01.png" required>
                        </div>
                         <div class="col-md-2">
                            <label class="form-label">CSS Delay</label>
                            <input type="text" name="delay" class="form-control" value="0.2s">
                        </div>
                        <div class="col-md-2">
                             <label class="form-label">Link</label>
                             <input type="text" name="link" class="form-control" value="courses-details.html">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" name="add_category" class="btn btn-primary w-100">Add Box</button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sql = "SELECT * FROM top_categories WHERE page_id = $edit_page_id AND position = $edit_position ORDER BY id ASC";
                                $res = $conn->query($sql);
                                while($c = $res->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><img src="../<?php echo $c['icon']; ?>" height="30" class="rounded"></td>
                                    <td><strong><?php echo $c['name']; ?></strong></td>
                                    <td>
                                        <a href="?page_id=<?php echo $edit_page_id; ?>&pos=<?php echo $edit_position; ?>&delete=<?php echo $c['id']; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</a>
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
