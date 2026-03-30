<?php include 'admin-header.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    
    <div class="main-content">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Visual Menu Builder (Advanced)</h1>

            <?php 
            $msg = "";
            
            if (isset($_GET['delete'])) {
                $del_id = $_GET['delete'];
                $conn->query("DELETE FROM menus WHERE id = $del_id OR parent_id = $del_id");
                $msg = '<div class="alert alert-info">Menu item and its children removed!</div>';
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_menu'])) {
                $title = $_POST['title'];
                $link = $_POST['link'];
                $parent_id = $_POST['parent_id'];
                
                $sql = "INSERT INTO menus (parent_id, title, link, sort_order) VALUES ($parent_id, '$title', '$link', 99)";
                if ($conn->query($sql) === TRUE) {
                    $msg = '<div class="alert alert-success mt-3 shadow-sm rounded">Item added successfully!</div>';
                }
            }

            // AJAX: Advanced Update Order AND Parent Change
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_menu_structure'])) {
                $layout = json_decode($_POST['layout_data'], true);
                
                foreach($layout as $index => $item) {
                    $pid = $item['id'];
                    $sort = $index + 1;
                    // Update Top Level
                    $conn->query("UPDATE menus SET parent_id = 0, sort_order = $sort WHERE id = $pid");
                    
                    // Update Children if any
                    if(isset($item['children']) && !empty($item['children'])) {
                        foreach($item['children'] as $c_index => $child_id) {
                            $c_sort = $c_index + 1;
                            $conn->query("UPDATE menus SET parent_id = $pid, sort_order = $c_sort WHERE id = $child_id");
                        }
                    }
                }
                echo json_encode(['status' => 'success']);
                exit;
            }

            $top_res = $conn->query("SELECT id, title FROM menus WHERE parent_id = 0 ORDER BY sort_order ASC");
            ?>

            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow mb-4 sticky-top" style="top: 100px;">
                        <div class="card-header py-3 bg-primary text-white">
                            <h6 class="m-0 font-weight-bold font-size-14">Add New Dynamic Link</h6>
                        </div>
                        <div class="card-body">
                            <?php echo $msg; ?>
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Menu Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Our Services" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Link (.php or URL)</label>
                                    <input type="text" name="link" class="form-control" placeholder="services.php" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Initial Parent</label>
                                    <select name="parent_id" class="form-select">
                                        <option value="0">None (Top Level)</option>
                                        <?php 
                                        $top_res->data_seek(0);
                                        while($t = $top_res->fetch_assoc()): ?>
                                            <option value="<?php echo $t['id']; ?>"><?php echo $t['title']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <button type="submit" name="add_menu" class="btn btn-primary w-100"><i class="fas fa-plus me-2"></i> Add to Menu</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Dynamic Menu Layout</h6>
                            <span class="badge bg-success" id="save-indicator" style="display:none;">Saved!</span>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small mb-4">Move sub-items <strong>between</strong> different parents by dragging them into another dotted area. Re-order items instantly!</p>
                            
                            <div id="sortable-parent" class="list-group">
                                <?php 
                                $top_res->data_seek(0);
                                while($parent = $top_res->fetch_assoc()):
                                ?>
                                <div class="menu-group-wrapper bg-white shadow-sm border mb-3 rounded p-2 overflow-hidden" data-id="<?php echo $parent['id']; ?>">
                                    <div class="d-flex justify-content-between align-items-center p-2 mb-2 bg-light border-bottom rounded">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-bars me-3 text-muted drag-handle-parent cursor-move"></i>
                                            <strong class="text-primary"><?php echo $parent['title']; ?></strong>
                                        </div>
                                        <a href="?delete=<?php echo $parent['id']; ?>" class="text-danger me-2 small"><i class="fas fa-trash-alt"></i></a>
                                    </div>

                                    <div class="sub-menu-list ms-5 border-left border-dashed p-2" data-parent="<?php echo $parent['id']; ?>" style="min-height: 20px;">
                                        <?php 
                                        $sub_res = $conn->query("SELECT * FROM menus WHERE parent_id = ".$parent['id']." ORDER BY sort_order ASC");
                                        while($sub = $sub_res->fetch_assoc()):
                                        ?>
                                        <div class="sub-item bg-white p-2 mb-2 mr-2 rounded d-flex justify-content-between align-items-center border shadow-sm" data-id="<?php echo $sub['id']; ?>">
                                             <div class="d-flex align-items-center">
                                                <i class="fas fa-bars me-3 text-muted drag-handle-sub cursor-move"></i>
                                                <span class="small font-weight-bold">↳ <?php echo $sub['title']; ?></span>
                                            </div>
                                            <a href="?delete=<?php echo $sub['id']; ?>" class="text-danger me-2 small"><i class="fas fa-times"></i></a>
                                        </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .cursor-move { cursor: grab; }
        .drag-handle-parent { font-size: 14px; }
        .border-dashed { border-left: 2px dashed #4e73df88 !important; }
        .sortable-ghost { opacity: 0.3; background: #c8ebfb; }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Main list re-ordering
            Sortable.create(document.getElementById('sortable-parent'), {
                animation: 200,
                handle: '.drag-handle-parent',
                ghostClass: 'sortable-ghost',
                onEnd: function() { saveAdvancedOrder(); }
            });

            // Crossed-list sorting for sub-menus
            document.querySelectorAll('.sub-menu-list').forEach(function(subArea) {
                Sortable.create(subArea, {
                    group: 'shared-submenus', // Allow cross-list movement
                    animation: 200,
                    handle: '.drag-handle-sub',
                    ghostClass: 'sortable-ghost',
                    onEnd: function() { saveAdvancedOrder(); }
                });
            });

            function saveAdvancedOrder() {
                var structure = [];
                document.querySelectorAll('.menu-group-wrapper').forEach(function(parentEl) {
                    var parentId = parentEl.getAttribute('data-id');
                    var children = [];
                    parentEl.querySelectorAll('.sub-item').forEach(function(childEl) {
                        children.push(childEl.getAttribute('data-id'));
                    });
                    structure.push({ id: parentId, children: children });
                });

                var formData = new FormData();
                formData.append('update_menu_structure', '1');
                formData.append('layout_data', JSON.stringify(structure));

                fetch('menus.php', { method: 'POST', body: formData })
                .then(r => r.json())
                .then(d => {
                    if (d.status === 'success') {
                        document.getElementById('save-indicator').style.display = 'inline-block';
                        setTimeout(() => document.getElementById('save-indicator').style.display = 'none', 1000);
                    }
                });
            }
        });
    </script>
</body>
</html>
