<?php include 'admin-header.php'; ?>
    <div class="main-content">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Manage Hero Section</h1>
            
            <?php 
            $edit_page_id = isset($_GET['page_id']) ? $_GET['page_id'] : 1;
            $edit_position = isset($_GET['pos']) ? $_GET['pos'] : 1;
            $msg = "";
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $sub_title = $conn->real_escape_string($_POST['sub_title']);
                $title = $conn->real_escape_string($_POST['title']);
                $description = $conn->real_escape_string($_POST['description']);
                $btn_text = $conn->real_escape_string($_POST['btn_text']);
                $btn_link = $conn->real_escape_string($_POST['btn_link']);
                $bg_image = $conn->real_escape_string($_POST['bg_image']);
                $student_count = $conn->real_escape_string($_POST['student_count']);
                $course_count = $conn->real_escape_string($_POST['course_count']);
                $hero_img_1 = $conn->real_escape_string($_POST['hero_img_1']);
                $hero_img_2 = $conn->real_escape_string($_POST['hero_img_2']);
                $student_img = $conn->real_escape_string($_POST['student_img']);
                $shape_1 = $conn->real_escape_string($_POST['shape_1']);
                $shape_2 = $conn->real_escape_string($_POST['shape_2']);
                $shape_3 = $conn->real_escape_string($_POST['shape_3']);
                $shape_4 = $conn->real_escape_string($_POST['shape_4']);
                $shape_5 = $conn->real_escape_string($_POST['shape_5']);
                
                // Check if record exists for this specific page_id AND position
                $check = $conn->query("SELECT id FROM hero WHERE page_id = $edit_page_id AND position = $edit_position");
                if ($check->num_rows > 0) {
                    $sql = "UPDATE hero SET 
                            sub_title = '$sub_title',
                            title = '$title',
                            description = '$description',
                            btn_text = '$btn_text',
                            btn_link = '$btn_link',
                            bg_image = '$bg_image',
                            student_count = '$student_count',
                            course_count = '$course_count',
                            hero_img_1 = '$hero_img_1',
                            hero_img_2 = '$hero_img_2',
                            student_img = '$student_img',
                            shape_1 = '$shape_1',
                            shape_2 = '$shape_2',
                            shape_3 = '$shape_3',
                            shape_4 = '$shape_4',
                            shape_5 = '$shape_5'
                            WHERE page_id = $edit_page_id AND position = $edit_position";
                } else {
                    $sql = "INSERT INTO hero (page_id, position, sub_title, title, description, btn_text, btn_link, bg_image, student_count, course_count, hero_img_1, hero_img_2, student_img, shape_1, shape_2, shape_3, shape_4, shape_5) 
                            VALUES ($edit_page_id, $edit_position, '$sub_title', '$title', '$description', '$btn_text', '$btn_link', '$bg_image', '$student_count', '$course_count', '$hero_img_1', '$hero_img_2', '$student_img', '$shape_1', '$shape_2', '$shape_3', '$shape_4', '$shape_5')";
                }
                        
                if ($conn->query($sql) === TRUE) {
                    $msg = '<div class="alert alert-success mt-3 shadow-sm border-left-success">Content Updated for Position '.$edit_position.'!</div>';
                }
            }

            // Fetch all pages for dropdown
            $pages_res = $conn->query("SELECT id, title, filename, widgets_json FROM pages");
            $pages_arr = [];
            while($p = $pages_res->fetch_assoc()) $pages_arr[] = $p;
            
            // Get current content for selected page and position
            $hero_sql = "SELECT * FROM hero WHERE page_id = $edit_page_id AND position = $edit_position LIMIT 1";
            $hero_result = $conn->query($hero_sql);
            $hero = $hero_result->fetch_assoc();
            
            if (!$hero) {
                $hero = [
                    'sub_title' => '', 'title' => '', 'description' => '', 'btn_text' => '', 'btn_link' => '',
                    'bg_image' => 'assets/img/home-1/hero/hero-bg.jpg',
                    'student_count' => '5436', 'course_count' => '5436',
                    'hero_img_1' => 'assets/img/home-1/hero/hero-01.png',
                    'hero_img_2' => 'assets/img/home-1/hero/hero-02.png',
                    'student_img' => 'assets/img/home-1/hero/client-img.png',
                    'shape_1' => 'assets/img/home-1/hero/shape-01.png',
                    'shape_2' => 'assets/img/home-1/hero/shape-02.png',
                    'shape_3' => 'assets/img/home-1/hero/shape-03.png',
                    'shape_4' => 'assets/img/home-1/hero/shape-04.png',
                    'shape_5' => 'assets/img/home-1/hero/shape-05.png'
                ];
            }
            ?>

            <div class="card shadow mb-4 border-left-primary">
                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Hero Section</h6>
                    <div class="d-flex g-2 align-items-center">
                        <!-- 1. Select Page -->
                        <div class="me-2">
                            <select class="form-select form-select-sm" onchange="location.href='?page_id='+this.value">
                                <?php foreach($pages_arr as $p): ?>
                                    <option value="<?php echo $p['id']; ?>" <?php echo ($edit_page_id == $p['id']) ? 'selected' : ''; ?>>
                                        Page: <?php echo $p['title']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- 2. Select Position (Only if page is registered) -->
                        <div>
                            <select class="form-select form-select-sm text-primary" onchange="location.href='?page_id=<?php echo $edit_page_id; ?>&pos='+this.value">
                                <?php 
                                // Parse page layout to find all Hero positions
                                $current_page_data = null;
                                foreach($pages_arr as $p) if($p['id'] == $edit_page_id) $current_page_data = $p;
                                
                                if($current_page_data && !empty($current_page_data['widgets_json'])) {
                                    $layout = json_decode($current_page_data['widgets_json'], true);
                                    $found_pos = false;
                                    foreach($layout as $index => $widget_file) {
                                        if($widget_file == 'hero.php') {
                                            $pos_num = $index + 1;
                                            $found_pos = true;
                                            echo '<option value="'.$pos_num.'" '.($edit_position == $pos_num ? 'selected' : '').'>
                                                    At Position #'.$pos_num.'
                                                  </option>';
                                        }
                                    }
                                    if(!$found_pos) echo '<option value="1">At Position #1</option>';
                                } else {
                                    echo '<option value="1">At Position #1</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php echo $msg; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Sub Title</label>
                            <input type="text" name="sub_title" class="form-control" value="<?php echo htmlspecialchars($hero['sub_title']); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Main Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($hero['title']); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"><?php echo htmlspecialchars($hero['description']); ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label class="form-label font-weight-bold">Button CTA Text</label>
                                <input type="text" name="btn_text" class="form-control" value="<?php echo htmlspecialchars($hero['btn_text'] ?? ''); ?>">
                            </div>
                            <div class="col-md-7 mb-3">
                                <label class="form-label font-weight-bold">Target Link</label>
                                <div class="input-group">
                                    <input type="text" id="btn_link" name="btn_link" class="form-control" placeholder="contact.html or https://..." value="<?php echo htmlspecialchars($hero['btn_link'] ?? ''); ?>">
                                    <button type="button" class="btn btn-outline-primary shadow-sm" onclick="openLinkSelector('btn_link')">
                                        <i class="fas fa-link me-2"></i> Select From Site
                                    </button>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">
                        <h5 class="mb-4 text-primary font-weight-bold"><i class="fas fa-images me-2"></i> Hero Media & Shapes</h5>
                        
                        <div class="row mb-4">
                            <div class="col-md-12 mb-4">
                                <label class="form-label font-weight-bold">Background Hero Image</label>
                                <div class="input-group">
                                    <input type="text" id="bg_image" name="bg_image" class="form-control" value="<?php echo htmlspecialchars($hero['bg_image'] ?? ''); ?>">
                                    <button type="button" class="btn btn-outline-primary" onclick="openMediaSelector('bg_image')"><i class="fas fa-images"></i></button>
                                </div>
                                <div class="mt-2 text-center p-2 border rounded bg-white shadow-sm">
                                    <img id="bg_image_preview" src="../<?php echo !empty($hero['bg_image']) ? $hero['bg_image'] : 'assets/img/placeholder.png'; ?>" style="max-height: 151px; width: 100%; object-fit: cover;" class="rounded">
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label font-weight-bold">Main Image 01</label>
                                <div class="input-group">
                                    <input type="text" id="hero_img_1" name="hero_img_1" class="form-control" value="<?php echo htmlspecialchars($hero['hero_img_1'] ?? ''); ?>">
                                    <button type="button" class="btn btn-outline-primary" onclick="openMediaSelector('hero_img_1')"><i class="fas fa-images"></i></button>
                                </div>
                                <div class="mt-2 text-center p-2 border rounded bg-white shadow-sm">
                                    <img id="hero_img_1_preview" src="../<?php echo !empty($hero['hero_img_1']) ? $hero['hero_img_1'] : 'assets/img/placeholder.png'; ?>" height="100" class="rounded">
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label font-weight-bold">Secondary Image 02</label>
                                <div class="input-group">
                                    <input type="text" id="hero_img_2" name="hero_img_2" class="form-control" value="<?php echo htmlspecialchars($hero['hero_img_2'] ?? ''); ?>">
                                    <button type="button" class="btn btn-outline-primary" onclick="openMediaSelector('hero_img_2')"><i class="fas fa-images"></i></button>
                                </div>
                                <div class="mt-2 text-center p-2 border rounded bg-white shadow-sm">
                                    <img id="hero_img_2_preview" src="../<?php echo !empty($hero['hero_img_2']) ? $hero['hero_img_2'] : 'assets/img/placeholder.png'; ?>" height="100" class="rounded">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5 bg-white p-3 rounded shadow-sm border mx-0">
                            <div class="col-12 mb-3 border-bottom pb-2">
                                <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-shapes me-2"></i> Floating Decorative Shapes</h6>
                            </div>
                            <?php for($i=1; $i<=5; $i++): $shape_key = "shape_$i"; ?>
                            <div class="col-md-2 col-sm-4 mb-3">
                                <label class="form-label small font-weight-bold">Shape <?php echo $i; ?></label>
                                <div class="position-relative">
                                    <img id="<?php echo $shape_key; ?>_preview" src="../<?php echo !empty($hero[$shape_key]) ? $hero[$shape_key] : 'assets/img/placeholder.png'; ?>" class="img-fluid rounded border p-1 bg-light cursor-pointer mb-2" onclick="openMediaSelector('<?php echo $shape_key; ?>')" title="Click to change shape">
                                    <input type="hidden" id="<?php echo $shape_key; ?>" name="<?php echo $shape_key; ?>" value="<?php echo htmlspecialchars($hero[$shape_key] ?? ''); ?>">
                                    <button type="button" class="btn btn-xs btn-primary w-100 py-1" onclick="openMediaSelector('<?php echo $shape_key; ?>')" style="font-size: 10px;">Change</button>
                                </div>
                            </div>
                            <?php endfor; ?>
                        </div>

                        <hr class="my-4">
                        <h5 class="mb-4 text-primary font-weight-bold"><i class="fas fa-users me-2"></i> Student & Course Counters</h5>
                        
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <label class="form-label font-weight-bold">Student Count</label>
                                <input type="text" name="student_count" class="form-control font-weight-bold text-primary" value="<?php echo htmlspecialchars($hero['student_count'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 mb-4">
                                <label class="form-label font-weight-bold">Course Count</label>
                                <input type="text" name="course_count" class="form-control font-weight-bold text-success" value="<?php echo htmlspecialchars($hero['course_count'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label font-weight-bold">Student Avatar Group Image</label>
                                <div class="input-group">
                                    <input type="text" id="student_img" name="student_img" class="form-control" value="<?php echo htmlspecialchars($hero['student_img'] ?? ''); ?>">
                                    <button type="button" class="btn btn-outline-primary" onclick="openMediaSelector('student_img')"><i class="fas fa-images"></i></button>
                                </div>
                                <div class="mt-2">
                                    <img id="student_img_preview" src="../<?php echo !empty($hero['student_img']) ? $hero['student_img'] : 'assets/img/placeholder.png'; ?>" height="40" class="rounded border p-1">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary px-5 btn-lg w-100 shadow-lg"><i class="fas fa-save me-2"></i> Update Hero Instance</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="alert alert-info border-0 shadow-sm mt-4">
                <i class="fas fa-magic me-2"></i> You are currently editing the <strong>Hero Section</strong> located at <strong>Position #<?php echo $edit_position; ?></strong> on the <strong><?php echo $current_page_data['title']; ?></strong> page. Use the dropdowns above to switch instances.
            </div>
        </div>
    </div>
</body>
</html>
