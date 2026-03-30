<?php include 'admin-header.php'; ?>
    <div class="main-content">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Manage 'Why Choose Us' (Nano Version)</h1>
            
            <?php 
            $edit_page_id = isset($_GET['page_id']) ? $_GET['page_id'] : 1;
            $edit_position = isset($_GET['pos']) ? $_GET['pos'] : 1;
            $msg = "";
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['update_section'])) {
                    $sub_title = mysqli_real_escape_string($conn, $_POST['sub_title']);
                    $title = mysqli_real_escape_string($conn, $_POST['title']);
                    $description = mysqli_real_escape_string($conn, $_POST['description']);
                    $main_image = mysqli_real_escape_string($conn, $_POST['main_image']);
                    $thumb_1 = mysqli_real_escape_string($conn, $_POST['thumb_1']);
                    $thumb_2 = mysqli_real_escape_string($conn, $_POST['thumb_2']);
                    $counter_value = mysqli_real_escape_string($conn, $_POST['counter_value']);
                    $counter_text = mysqli_real_escape_string($conn, $_POST['counter_text']);
                    
                    $check = $conn->query("SELECT id FROM why_choose_us WHERE page_id = $edit_page_id AND position = $edit_position");
                    if ($check->num_rows > 0) {
                        $sql = "UPDATE why_choose_us SET 
                                sub_title = '$sub_title',
                                title = '$title',
                                description = '$description',
                                main_image = '$main_image',
                                thumb_1 = '$thumb_1',
                                thumb_2 = '$thumb_2',
                                counter_value = '$counter_value',
                                counter_text = '$counter_text'
                                WHERE page_id = $edit_page_id AND position = $edit_position";
                    } else {
                        $sql = "INSERT INTO why_choose_us (page_id, position, sub_title, title, description, main_image, thumb_1, thumb_2, counter_value, counter_text) 
                                VALUES ($edit_page_id, $edit_position, '$sub_title', '$title', '$description', '$main_image', '$thumb_1', '$thumb_2', '$counter_value', '$counter_text')";
                    }
                    
                    if ($conn->query($sql) === TRUE) {
                        $msg = '<div class="alert alert-success mt-3 shadow-sm border-left-success">Main Section Updated!</div>';
                    }
                }

                if (isset($_POST['update_features'])) {
                    foreach($_POST['feature'] as $fid => $f) {
                        $f_title = mysqli_real_escape_string($conn, $f['title']);
                        $f_desc = mysqli_real_escape_string($conn, $f['description']);
                        $f_icon = mysqli_real_escape_string($conn, $f['icon']);
                        $f_delay = mysqli_real_escape_string($conn, $f['delay']);
                        $f_style = mysqli_real_escape_string($conn, $f['style_class']);
                        
                        $check_f = $conn->query("SELECT id FROM why_choose_us_features WHERE id = $fid OR id = '".mysqli_real_escape_string($conn, $fid)."'");
                        if ($check_f->num_rows > 0) {
                            $conn->query("UPDATE why_choose_us_features SET title='$f_title', description='$f_desc', icon='$f_icon', delay='$f_delay', style_class='$f_style' WHERE id=$fid");
                        } else {
                             $conn->query("INSERT INTO why_choose_us_features (page_id, position, title, description, icon, delay, style_class) VALUES ($edit_page_id, $edit_position, '$f_title', '$f_desc', '$f_icon', '$f_delay', '$f_style')");
                        }
                    }
                    $msg = '<div class="alert alert-success mt-3 shadow-sm border-left-success">Feature Items Updated!</div>';
                }
            }

            $pages_res = $conn->query("SELECT id, title, filename, widgets_json FROM pages");
            $pages_arr = [];
            while($p = $pages_res->fetch_assoc()) $pages_arr[] = $p;

            $sql = "SELECT * FROM why_choose_us WHERE page_id = $edit_page_id AND position = $edit_position LIMIT 1";
            $res = $conn->query($sql);
            $data = $res->fetch_assoc();
            if (!$data) $data = ['sub_title'=>'','title'=>'','description'=>'','main_image'=>'','thumb_1'=>'','thumb_2'=>'','counter_value'=>'','counter_text'=>''];

            $features_res = $conn->query("SELECT * FROM why_choose_us_features WHERE page_id = $edit_page_id AND position = $edit_position ORDER BY id ASC");
            $features = [];
            while($f = $features_res->fetch_assoc()) $features[] = $f;
            // Ensure at least 4 placeholders if empty
            if (count($features) < 4) {
                for($i = count($features); $i < 4; $i++) {
                    $features[] = ['id' => 'new'.($i+1), 'title' => '', 'description' => '', 'icon' => '', 'delay' => '0.'.($i+2).'s', 'style_class' => ''];
                }
            }
            ?>

            <div class="card shadow mb-4 border-left-primary">
                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white border-bottom">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Section Details</h6>
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
                                foreach($layout as $i => $w) if($w == 'why-choose-us-nano.php' || $w == 'why-choose-us.php' || $w == 'why-choose-us-2.php') echo '<option value="'.($i+1).'" '.($edit_position == ($i+1) ? 'selected' : '').'>Position #'.($i+1).'</option>';
                            } else { echo '<option value="1">Position #1</option>'; }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="card-body bg-light-p-4">
                    <?php echo $msg; ?>
                    <form method="POST">
                        <div class="row">
                             <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Sub Title</label>
                                <input type="text" name="sub_title" class="form-control" value="<?php echo htmlspecialchars($data['sub_title']); ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Main Heading</label>
                                <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($data['title']); ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Description Text</label>
                            <textarea name="description" class="form-control shadow-inner border-0 rounded" rows="3"><?php echo htmlspecialchars($data['description']); ?></textarea>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold">Primary Image</label>
                                <div class="input-group">
                                    <input type="text" id="main_image" name="main_image" class="form-control" value="<?php echo htmlspecialchars($data['main_image']); ?>">
                                    <button type="button" class="btn btn-outline-primary" onclick="openMediaSelector('main_image')"><i class="fas fa-images"></i></button>
                                </div>
                                <div class="mt-2 border rounded p-1 bg-white shadow-sm d-inline-block">
                                    <img id="main_image_preview" src="../<?php echo !empty($data['main_image']) ? $data['main_image'] : 'assets/img/placeholder.png'; ?>" height="60" class="rounded">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold">Thumb 1</label>
                                <div class="input-group">
                                    <input type="text" id="thumb_1" name="thumb_1" class="form-control" value="<?php echo htmlspecialchars($data['thumb_1']); ?>">
                                    <button type="button" class="btn btn-outline-primary" onclick="openMediaSelector('thumb_1')"><i class="fas fa-images"></i></button>
                                </div>
                                <div class="mt-2 border rounded p-1 bg-white shadow-sm d-inline-block">
                                    <img id="thumb_1_preview" src="../<?php echo !empty($data['thumb_1']) ? $data['thumb_1'] : 'assets/img/placeholder.png'; ?>" height="60" class="rounded">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold">Thumb 2</label>
                                <div class="input-group">
                                    <input type="text" id="thumb_2" name="thumb_2" class="form-control" value="<?php echo htmlspecialchars($data['thumb_2']); ?>">
                                    <button type="button" class="btn btn-outline-primary" onclick="openMediaSelector('thumb_2')"><i class="fas fa-images"></i></button>
                                </div>
                                <div class="mt-2 border rounded p-1 bg-white shadow-sm d-inline-block">
                                    <img id="thumb_2_preview" src="../<?php echo !empty($data['thumb_2']) ? $data['thumb_2'] : 'assets/img/placeholder.png'; ?>" height="60" class="rounded">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                             <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Counter Value (e.g. 92)</label>
                                <input type="text" name="counter_value" class="form-control" value="<?php echo htmlspecialchars($data['counter_value']); ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Counter Text</label>
                                <input type="text" name="counter_text" class="form-control" value="<?php echo htmlspecialchars($data['counter_text']); ?>">
                            </div>
                        </div>

                        <button type="submit" name="update_section" class="btn btn-primary px-5 py-2 shadow-lg w-100 font-weight-bold"><i class="fas fa-save me-2"></i> Save Section Main Content</button>
                    </form>
                </div>
            </div>

            <!-- Features Management -->
            <div class="card shadow mb-4 border-left-success">
                <div class="card-header py-3 bg-white border-bottom">
                    <h6 class="m-0 font-weight-bold text-success">Manage 4 Feature Icons (2x2 Layout)</h6>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="row">
                            <?php foreach($features as $i => $f): ?>
                            <div class="col-md-6 mb-4">
                                <div class="p-3 border rounded bg-white shadow-sm">
                                    <h6 class="font-weight-bold text-dark border-bottom pb-2">Feature Item #<?php echo ($i+1); ?></h6>
                                    <div class="mb-2">
                                        <label class="form-label small font-weight-bold">Title</label>
                                        <input type="text" name="feature[<?php echo $f['id']; ?>][title]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($f['title']); ?>">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label small font-weight-bold">Description</label>
                                        <textarea name="feature[<?php echo $f['id']; ?>][description]" class="form-control form-control-sm" rows="2"><?php echo htmlspecialchars($f['description']); ?></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label class="form-label small font-weight-bold">Icon (SVG/PNG)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="icon_<?php echo $i; ?>" name="feature[<?php echo $f['id']; ?>][icon]" class="form-control" value="<?php echo htmlspecialchars($f['icon']); ?>">
                                                <button type="button" class="btn btn-outline-primary" onclick="openMediaSelector('icon_<?php echo $i; ?>')"><i class="fas fa-images"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small font-weight-bold">Preview</label>
                                            <div class="text-center p-1 border rounded bg-light">
                                                <img id="icon_<?php echo $i; ?>_preview" src="../<?php echo !empty($f['icon']) ? $f['icon'] : 'assets/img/placeholder.png'; ?>" height="40">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label class="form-label small font-weight-bold">Delay (s)</label>
                                            <input type="text" name="feature[<?php echo $f['id']; ?>][delay]" class="form-control form-control-sm" placeholder="0.6s" value="<?php echo htmlspecialchars($f['delay']); ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small font-weight-bold">Style Class (optional)</label>
                                            <input type="text" name="feature[<?php echo $f['id']; ?>][style_class]" class="form-control form-control-sm" placeholder="style-2" value="<?php echo htmlspecialchars($f['style_class']); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="submit" name="update_features" class="btn btn-success px-5 py-2 shadow-lg w-100 font-weight-bold mt-2"><i class="fas fa-check-circle me-2"></i> Update Feature Icons</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
