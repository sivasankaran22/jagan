<?php include 'admin-header.php'; ?>
    <div class="main-content">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Manage Blog/News</h1>

            <?php 
            $edit_page_id = isset($_GET['page_id']) ? $_GET['page_id'] : 1;
            $msg = "";
            
            if (isset($_GET['delete'])) {
                $del_id = $_GET['delete'];
                $conn->query("DELETE FROM news WHERE id = $del_id");
                $msg = '<div class="alert alert-info">News Post Removed.</div>';
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_news'])) {
                $title = $_POST['title'];
                $category = $_POST['category'];
                $image = $_POST['image'];
                $date_post = $_POST['date_post'];
                $comments = $_POST['comments'];
                $link = $_POST['link'];
                
                $sql = "INSERT INTO news (page_id, title, category, image, date_post, comments, link) VALUES ($edit_page_id, '$title', '$category', '$image', '$date_post', '$comments', '$link')";
                if ($conn->query($sql) === TRUE) {
                    $msg = '<div class="alert alert-success">Blog Post Added!</div>';
                }
            }

            $pages_res = $conn->query("SELECT id, title FROM pages");
            ?>

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">News Posts for Selected Page</h6>
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
                            <div class="col-md-12">
                                <label class="form-label">Article Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Repurpose mission critical action..." required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Category</label>
                                <input type="text" name="category" class="form-control" value="Education" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Image (URL)</label>
                                <input type="text" name="image" class="form-control" value="assets/img/home-1/news/news-01.jpg" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Post Date</label>
                                <input type="text" name="date_post" class="form-control" value="<?php echo date('d M, Y'); ?>" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Comments Count</label>
                                <input type="number" name="comments" class="form-control" value="0">
                            </div>
                        </div>
                        <div class="mb-3">
                             <label class="form-label">Read More Link</label>
                             <input type="text" name="link" class="form-control" value="news-details.html">
                        </div>
                        <button type="submit" name="add_news" class="btn btn-primary px-4">Publish Article</button>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sql = "SELECT * FROM news WHERE page_id = $edit_page_id ORDER BY id DESC";
                                $res = $conn->query($sql);
                                while($n = $res->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><img src="../<?php echo $n['image']; ?>" height="40" class="rounded"></td>
                                    <td><strong><?php echo $n['title']; ?></strong></td>
                                    <td><?php echo $n['category']; ?></td>
                                    <td><?php echo $n['date_post']; ?></td>
                                    <td>
                                        <a href="?page_id=<?php echo $edit_page_id; ?>&delete=<?php echo $n['id']; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</a>
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
