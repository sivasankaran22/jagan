<?php include 'admin-header.php'; ?>
    <div class="main-content">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Manage About Us Section</h1>
            
            <?php 
            $edit_page_id = isset($_GET['page_id']) ? $_GET['page_id'] : 1;
            $edit_position = isset($_GET['pos']) ? $_GET['pos'] : 1;
            $msg = "";
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $sub_title = mysqli_real_escape_string($conn, $_POST['sub_title']);
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                $description = mysqli_real_escape_string($conn, $_POST['description']);
                $image_main = mysqli_real_escape_string($conn, $_POST['image_main']);
                $image_thumb = mysqli_real_escape_string($conn, $_POST['image_thumb']);
                $image_3 = mysqli_real_escape_string($conn, $_POST['image_3']);
                $btn_text = mysqli_real_escape_string($conn, $_POST['btn_text']);
                $btn_link = mysqli_real_escape_string($conn, $_POST['btn_link']);
                
                $counter1_val = mysqli_real_escape_string($conn, $_POST['counter1_val']);
                $counter1_text = mysqli_real_escape_string($conn, $_POST['counter1_text']);
                $counter2_val = mysqli_real_escape_string($conn, $_POST['counter2_val']);
                $counter2_text = mysqli_real_escape_string($conn, $_POST['counter2_text']);
                $counter3_val = mysqli_real_escape_string($conn, $_POST['counter3_val']);
                $counter3_text = mysqli_real_escape_string($conn, $_POST['counter3_text']);
                
                $author_image = mysqli_real_escape_string($conn, $_POST['author_image']);
                $author_name = mysqli_real_escape_string($conn, $_POST['author_name']);
                $author_designation = mysqli_real_escape_string($conn, $_POST['author_designation']);
                
                $check = $conn->query("SELECT id FROM about WHERE page_id = $edit_page_id AND position = $edit_position");
                if ($check->num_rows > 0) {
                    $sql = "UPDATE about SET 
                            sub_title = '$sub_title',
                            title = '$title',
                            description = '$description',
                            image_main = '$image_main',
                            image_thumb = '$image_thumb',
                            image_3 = '$image_3',
                            btn_text = '$btn_text',
                            btn_link = '$btn_link',
                            counter1_val = '$counter1_val',
                            counter1_text = '$counter1_text',
                            counter2_val = '$counter2_val',
                            counter2_text = '$counter2_text',
                            counter3_val = '$counter3_val',
                            counter3_text = '$counter3_text',
                            author_image = '$author_image',
                            author_name = '$author_name',
                            author_designation = '$author_designation'
                            WHERE page_id = $edit_page_id AND position = $edit_position";
                } else {
                    $sql = "INSERT INTO about (page_id, position, sub_title, title, description, image_main, image_thumb, image_3, btn_text, btn_link, counter1_val, counter1_text, counter2_val, counter2_text, counter3_val, counter3_text, author_image, author_name, author_designation) 
                            VALUES ($edit_page_id, $edit_position, '$sub_title', '$title', '$description', '$image_main', '$image_thumb', '$image_3', '$btn_text', '$btn_link', '$counter1_val', '$counter1_text', '$counter2_val', '$counter2_text', '$counter3_val', '$counter3_text', '$author_image', '$author_name', '$author_designation')";
                }
                
                if ($conn->query($sql) === TRUE) {
                    $msg = '<div class="alert alert-success mt-3 shadow-sm border-left-success">About Section Updated for Position #'.$edit_position.'!</div>';
                } else {
                    $msg = '<div class="alert alert-danger mt-3 shadow-sm">Error: ' . $conn->error . '</div>';
                }
            }

            $pages_res = $conn->query("SELECT id, title, filename, widgets_json FROM pages");
            $pages_arr = [];
            while($p = $pages_res->fetch_assoc()) $pages_arr[] = $p;

            $about_sql = "SELECT * FROM about WHERE page_id = $edit_page_id AND position = $edit_position LIMIT 1";
            $about_result = $conn->query($about_sql);
            $about = $about_result->fetch_assoc();
            if (!$about) $about = [
                'sub_title'=>'','title'=>'','description'=>'','image_main'=>'','image_thumb'=>'','image_3'=>'','btn_text'=>'','btn_link'=>'',
                'counter1_val' => '', 'counter1_text' => '', 'counter2_val' => '', 'counter2_text' => '', 'counter3_val' => '', 'counter3_text' => '',
                'author_image' => '', 'author_name' => '', 'author_designation' => ''
            ];
            ?>

            <div class="card shadow mb-4 border-left-primary">
                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white border-bottom">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Content (Instance #<?php echo $edit_position; ?>)</h6>
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
                                foreach($layout as $i => $w) if($w == 'about.php') echo '<option value="'.($i+1).'" '.($edit_position == ($i+1) ? 'selected' : '').'>Pos #'.($i+1).'</option>';
                            } else { echo '<option value="1">Pos #1</option>'; }
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
                                <input type="text" name="sub_title" class="form-control" value="<?php echo htmlspecialchars($about['sub_title']); ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Main Heading</label>
                                <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($about['title']); ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Description Text</label>
                            <textarea name="description" class="form-control shadow-inner border-0 rounded" rows="3"><?php echo htmlspecialchars($about['description']); ?></textarea>
                        </div>
                        
                        <!-- Media Library Integration (3 Images) -->
                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold">Primary Image (Large)</label>
                                <div class="input-group">
                                    <input type="text" id="image_main" name="image_main" class="form-control" value="<?php echo htmlspecialchars($about['image_main']); ?>">
                                    <button type="button" class="btn btn-outline-primary" onclick="openMediaSelector('image_main')"><i class="fas fa-images"></i></button>
                                </div>
                                <div class="mt-2 border rounded p-1 bg-white shadow-sm d-inline-block">
                                    <img id="image_main_preview" src="../<?php echo !empty($about['image_main']) ? $about['image_main'] : 'assets/img/placeholder.png'; ?>" height="70" class="rounded">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold">Floating Image 1 (Left)</label>
                                <div class="input-group">
                                    <input type="text" id="image_thumb" name="image_thumb" class="form-control" value="<?php echo htmlspecialchars($about['image_thumb']); ?>">
                                    <button type="button" class="btn btn-outline-primary" onclick="openMediaSelector('image_thumb')"><i class="fas fa-images"></i></button>
                                </div>
                                <div class="mt-2 border rounded p-1 bg-white shadow-sm d-inline-block">
                                    <img id="image_thumb_preview" src="../<?php echo !empty($about['image_thumb']) ? $about['image_thumb'] : 'assets/img/placeholder.png'; ?>" height="70" class="rounded">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold">Floating Image 2 (Right)</label>
                                <div class="input-group">
                                    <input type="text" id="image_3" name="image_3" class="form-control" value="<?php echo htmlspecialchars($about['image_3']); ?>">
                                    <button type="button" class="btn btn-outline-primary" onclick="openMediaSelector('image_3')"><i class="fas fa-images"></i></button>
                                </div>
                                <div class="mt-2 border rounded p-1 bg-white shadow-sm d-inline-block">
                                    <img id="image_3_preview" src="../<?php echo !empty($about['image_3']) ? $about['image_3'] : 'assets/img/placeholder.png'; ?>" height="70" class="rounded">
                                </div>
                            </div>
                        </div>

                        <!-- Counters Setup -->
                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold">Counter 1 (Val | Title)</label>
                                <div class="input-group">
                                    <input type="text" name="counter1_val" class="form-control w-25" placeholder="25" value="<?php echo htmlspecialchars($about['counter1_val']); ?>">
                                    <input type="text" name="counter1_text" class="form-control w-75" placeholder="Year of Experience" value="<?php echo htmlspecialchars($about['counter1_text']); ?>">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold">Counter 2 (Val | Title)</label>
                                <div class="input-group">
                                    <input type="text" name="counter2_val" class="form-control w-25" placeholder="500" value="<?php echo htmlspecialchars($about['counter2_val']); ?>">
                                    <input type="text" name="counter2_text" class="form-control w-75" placeholder="Class Completed" value="<?php echo htmlspecialchars($about['counter2_text']); ?>">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold">Counter 3 (Val | Title)</label>
                                <div class="input-group">
                                    <input type="text" name="counter3_val" class="form-control w-25" placeholder="100" value="<?php echo htmlspecialchars($about['counter3_val']); ?>">
                                    <input type="text" name="counter3_text" class="form-control w-75" placeholder="Experts Instructors" value="<?php echo htmlspecialchars($about['counter3_text']); ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Author Section -->
                        <div class="row mb-4 bg-white p-3 rounded shadow-sm border mx-1">
                             <div class="col-md-3 mb-3">
                                <label class="form-label font-weight-bold">Author Image</label>
                                <div class="input-group">
                                    <input type="text" id="author_image" name="author_image" class="form-control" value="<?php echo htmlspecialchars($about['author_image']); ?>">
                                    <button type="button" class="btn btn-outline-primary" onclick="openMediaSelector('author_image')"><i class="fas fa-images"></i></button>
                                </div>
                                <div class="mt-2 text-center">
                                    <img id="author_image_preview" src="../<?php echo !empty($about['author_image']) ? $about['author_image'] : 'assets/img/placeholder.png'; ?>" height="60" class="rounded-circle border">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold">Author Name</label>
                                <input type="text" name="author_name" class="form-control" value="<?php echo htmlspecialchars($about['author_name']); ?>">
                            </div>
                            <div class="col-md-5 mb-3">
                                <label class="form-label font-weight-bold">Author Designation</label>
                                <input type="text" name="author_designation" class="form-control" value="<?php echo htmlspecialchars($about['author_designation']); ?>">
                            </div>
                        </div>

                        <!-- Link Selection Integration -->
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label class="form-label font-weight-bold">Button CTA Text</label>
                                <input type="text" name="btn_text" class="form-control" value="<?php echo htmlspecialchars($about['btn_text']); ?>">
                            </div>
                            <div class="col-md-7 mb-3">
                                <label class="form-label font-weight-bold">Target Link</label>
                                <div class="input-group">
                                    <input type="text" id="btn_link" name="btn_link" class="form-control" placeholder="about.php or https://..." value="<?php echo htmlspecialchars($about['btn_link']); ?>">
                                    <button type="button" class="btn btn-outline-primary shadow-sm" onclick="openLinkSelector('btn_link')">
                                        <i class="fas fa-link me-2"></i> Select From Site
                                    </button>
                                </div>
                                <small class="text-muted italic">Manual typing allowed for external URLs.</small>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary px-5 py-2 shadow-lg w-100 font-weight-bold mt-3"><i class="fas fa-save me-2"></i> Save Section Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
