<?php include 'admin-header.php'; ?>
    <div class="main-content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Website Pages</h1>
                <a href="create-page.php" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Create New Page</a>
            </div>

            <?php 
            if (isset($_GET['delete'])) {
                $del_id = $_GET['delete'];
                $res = $conn->query("SELECT filename FROM pages WHERE id = $del_id");
                $data = $res->fetch_assoc();
                if ($data) {
                    $file = "../" . $data['filename'];
                    if (file_exists($file) && $data['filename'] != 'index.php') {
                        unlink($file);
                    }
                    $conn->query("DELETE FROM pages WHERE id = $del_id");
                    echo '<div class="alert alert-info">Page and record deleted.</div>';
                }
            }
            ?>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">All Pages</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Page Title</th>
                                    <th>File Name</th>
                                    <th>Date Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $pages_sql = "SELECT * FROM pages ORDER BY id DESC";
                                $pages_result = $conn->query($pages_sql);
                                while($row = $pages_result->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><strong><?php echo $row['title']; ?></strong></td>
                                    <td><code><?php echo $row['filename']; ?></code></td>
                                    <td><?php echo $row['created_at']; ?></td>
                                    <td>
                                        <a href="../<?php echo $row['filename']; ?>" target="_blank" class="btn btn-sm btn-success"><i class="fas fa-eye"></i> View</a>
                                        <a href="create-page.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit Layout</a>
                                        <?php if($row['filename'] != 'index.php'): ?>
                                        <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete file and record?')"><i class="fas fa-trash"></i> Delete</a>
                                        <?php endif; ?>
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
