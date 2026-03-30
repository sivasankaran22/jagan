<?php include 'admin-header.php'; ?>
    
    <div class="main-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">Media Library</h1>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                    <i class="fas fa-upload me-2"></i> Upload New Media
                </button>
            </div>

            <?php 
            $msg = "";
            $target_dir = "../assets/uploads/";
            if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fileToUpload'])) {
                $file = $_FILES['fileToUpload'];
                $filename = basename($file["name"]);
                $timestamp = time();
                $new_filename = $timestamp . "_" . preg_replace('/[^a-z0-9.]/i', '_', $filename);
                $target_file = $target_dir . $new_filename;
                $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $db_path = "assets/uploads/" . $new_filename;

                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    $sql = "INSERT INTO uploads (filename, file_path, file_type, file_size) VALUES ('$filename', '$db_path', '$file_type', ".$file['size'].")";
                    if ($conn->query($sql) === TRUE) {
                        $msg = '<div class="alert alert-success mt-3">File uploaded successfully!</div>';
                    }
                } else {
                    $msg = '<div class="alert alert-danger mt-3">Error uploading file.</div>';
                }
            }
            ?>

            <?php echo $msg; ?>

            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
                        <?php 
                        $res = $conn->query("SELECT * FROM uploads ORDER BY id DESC");
                        if ($res->num_rows > 0) {
                            while($m = $res->fetch_assoc()):
                        ?>
                            <div class="col">
                                <div class="card h-100 border-0 shadow-sm overflow-hidden media-card">
                                    <div class="ratio ratio-1x1 bg-light d-flex align-items-center justify-content-center">
                                        <img src="../<?php echo $m['file_path']; ?>" class="img-fluid object-fit-cover" alt="<?php echo $m['filename']; ?>">
                                    </div>
                                    <div class="p-2 small text-truncate bg-white border-top">
                                        <?php echo htmlspecialchars($m['filename']); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; } else { echo "<div class='col-12'><p class='text-center py-5'>Your media library is empty. Upload your first asset!</p></div>"; } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-content shadow-lg border-0">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title font-weight-bold">Select File</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Maximum limit: 5MB</label>
                            <input class="form-control" type="file" name="fileToUpload" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">Upload Now</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .media-card:hover { transform: translateY(-5px); transition: 0.3s; cursor: pointer; }
        .object-fit-cover { width: 100%; height: 100%; object-fit: cover; }
    </style>
</body>
</html>
