<?php include 'admin-header.php'; ?>
    <div class="main-content">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Manage Discount Banner</h1>
            
            <?php 
            $edit_page_id = isset($_GET['page_id']) ? $_GET['page_id'] : 1;
            $edit_position = isset($_GET['pos']) ? $_GET['pos'] : 1;
            $msg = "";
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $title = $_POST['title'];
                $description = $_POST['description'];
                $bg_image = $_POST['bg_image'];
                $btn_1_text = $_POST['btn_1_text'];
                $btn_1_link = $_POST['btn_1_link'];
                $btn_2_text = $_POST['btn_2_text'];
                $btn_2_link = $_POST['btn_2_link'];
                
                $check = $conn->query("SELECT id FROM discount WHERE page_id = $edit_page_id AND position = $edit_position");
                if ($check->num_rows > 0) {
                    $sql = "UPDATE discount SET 
                            title = '$title',
                            description = '$description',
                            bg_image = '$bg_image',
                            btn_1_text = '$btn_1_text',
                            btn_1_link = '$btn_1_link',
                            btn_2_text = '$btn_2_text',
                            btn_2_link = '$btn_2_link'
                            WHERE page_id = $edit_page_id AND position = $edit_position";
                } else {
                    $sql = "INSERT INTO discount (page_id, position, title, description, bg_image, btn_1_text, btn_1_link, btn_2_text, btn_2_link) 
                            VALUES ($edit_page_id, $edit_position, '$title', '$description', '$bg_image', '$btn_1_text', '$btn_1_link', '$btn_2_text', '$btn_2_link')";
                }
                
                if ($conn->query($sql) === TRUE) {
                    $msg = '<div class="alert alert-success mt-3 shadow-sm border-left-success">Banner Content Updated!</div>';
                }
            }

            $pages_res = $conn->query("SELECT id, title, filename, widgets_json FROM pages");
            $pages_arr = [];
            while($p = $pages_res->fetch_assoc()) $pages_arr[] = $p;

            $sql = "SELECT * FROM discount WHERE page_id = $edit_page_id AND position = $edit_position LIMIT 1";
            $res = $conn->query($sql);
            $data = $res->fetch_assoc();
            
            if (!$data) {
                $data = ['title'=>'','description'=>'','bg_image'=>'','btn_1_text'=>'','btn_1_link'=>'','btn_2_text'=>'','btn_2_link'=>''];
            }
            ?>

            <div class="card shadow mb-4 border-left-primary">
                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Discount Banner</h6>
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
                                foreach($layout as $i => $w) if($w == 'discount.php') echo '<option value="'.($i+1).'" '.($edit_position == ($i+1) ? 'selected' : '').'>Position #'.($i+1).'</option>';
                            } else { echo '<option value="1">Position #1</option>'; }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <?php echo $msg; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Main Headline</label>
                            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($data['title']); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"><?php echo htmlspecialchars($data['description']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Background Image (URL)</label>
                            <input type="text" name="bg_image" class="form-control" value="<?php echo htmlspecialchars($data['bg_image']); ?>">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Btn 1 Text</label>
                                <input type="text" name="btn_1_text" class="form-control" value="<?php echo htmlspecialchars($data['btn_1_text']); ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Btn 1 Link</label>
                                <input type="text" name="btn_1_link" class="form-control" value="<?php echo htmlspecialchars($data['btn_1_link']); ?>">
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Btn 2 Text</label>
                                <input type="text" name="btn_2_text" class="form-control" value="<?php echo htmlspecialchars($data['btn_2_text']); ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Btn 2 Link</label>
                                <input type="text" name="btn_2_link" class="form-control" value="<?php echo htmlspecialchars($data['btn_2_link']); ?>">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-5">Save Banner</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
