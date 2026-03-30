<?php include 'admin-header.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    
    <div class="main-content">
        <div class="container-fluid">
            <?php 
            $edit_id = isset($_GET['edit']) ? $_GET['edit'] : null;
            $edit_data = null;
            if ($edit_id) {
                $res = $conn->query("SELECT * FROM pages WHERE id = $edit_id");
                $edit_data = $res->fetch_assoc();
            }
            ?>
            
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800"><?php echo $edit_id ? 'Advanced Page Builder: ' . $edit_data['title'] : 'Advanced Page Builder'; ?></h1>
                <?php if($edit_id): ?>
                    <a href="../<?php echo $edit_data['filename']; ?>" target="_blank" class="btn btn-sm btn-success shadow-sm px-4"><i class="fas fa-eye me-2"></i> View Live Page</a>
                <?php endif; ?>
            </div>
            
            <?php 
            $msg = "";
            $widgets_dir = "../widgets/";
            $widgets = is_dir($widgets_dir) ? array_diff(scandir($widgets_dir), array('.', '..', 'breadcrumb.php', 'index.php')) : []; 
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_page'])) {
                $page_name = trim($_POST['page_name']);
                $page_title = $_POST['page_title'];
                $selected_widgets = $_POST['widget_sequence'];
                $widgets_json = json_encode($selected_widgets);
                
                // SEO & Social Fields
                $meta_desc = $_POST['meta_description'];
                $og_title = $_POST['og_title'];
                $og_desc = $_POST['og_description'];
                $og_image = $_POST['og_image'];
                $tw_card = $_POST['twitter_card'];
                
                $filename = strtolower(str_replace([' ', '.php'], ['-', ''], $page_name)) . '.php';
                $file_path = "../" . $filename;
                
                if ($edit_id) {
                    $sql = "UPDATE pages SET 
                            title = '$page_title', 
                            widgets_json = '$widgets_json',
                            meta_description = '$meta_desc',
                            og_title = '$og_title',
                            og_description = '$og_desc',
                            og_image = '$og_image',
                            twitter_card = '$tw_card'
                            WHERE id = $edit_id";
                    $conn->query($sql);
                    $page_id = $edit_id;
                } else {
                    $sql = "INSERT INTO pages (filename, title, widgets_json, meta_description, og_title, og_description, og_image, twitter_card) 
                            VALUES ('$filename', '$page_title', '$widgets_json', '$meta_desc', '$og_title', '$og_desc', '$og_image', '$tw_card')";
                    $conn->query($sql);
                    $page_id = $conn->insert_id;
                }
                
                $content = "<?php \n \$page_id = $page_id; \n \$breadcrumb_title = '" . addslashes($page_title) . "'; \n include_once 'inc/db.php'; \n include 'inc/header.php'; \n";
                if (!empty($selected_widgets)) {
                    $pos = 1;
                    foreach($selected_widgets as $widget) {
                        $content .= " \$position = $pos; \n include 'widgets/$widget'; \n";
                        $pos++;
                    }
                }
                $content .= " include 'inc/footer.php'; \n ?>";
                
                if (file_put_contents($file_path, $content)) {
                    $msg = '<div class="alert alert-success mt-3 shadow-sm border-left-success rounded">Page configuration and SEO settings updated successfully!</div>';
                    if (!$edit_id) { header("Location: create-page.php?edit=".$page_id); exit; }
                }
            }
            ?>
            
            <?php echo $msg; ?>

            <form method="POST" id="builderForm">
                <div class="row">
                    <div class="col-md-9">
                        <!-- Navigation Tabs -->
                        <ul class="nav nav-pills mb-3 bg-white p-2 rounded shadow-sm border" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active" id="pills-layout-tab" data-bs-toggle="pill" data-bs-target="#pills-layout" type="button" role="tab"><i class="fas fa-th-large me-2"></i> Design Layout</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="pills-seo-tab" data-bs-toggle="pill" data-bs-target="#pills-seo" type="button" role="tab"><i class="fas fa-bullhorn me-2"></i> SEO & Social Share</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <!-- Tab 1: Layout -->
                            <div class="tab-pane fade show active" id="pills-layout" role="tabpanel">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 bg-white">
                                        <h6 class="m-0 font-weight-bold text-primary">Visual Layout Structure</h6>
                                    </div>
                                    <div class="card-body bg-light">
                                        <div id="pageLayoutArea" class="list-group p-4 rounded border-dashed" style="min-height: 500px;">
                                            <?php 
                                            if ($edit_data && !empty($edit_data['widgets_json'])) {
                                                $curr_widgets = json_decode($edit_data['widgets_json'], true);
                                                if (is_array($curr_widgets)) {
                                                    $p = 1;
                                                    foreach($curr_widgets as $w) {
                                                        $name = ucfirst(str_replace(['-', '.php'], [' ', ''], $w));
                                                        echo '<div class="list-group-item widget-item-added d-flex justify-content-between align-items-center border-left-primary mb-3 shadow-sm" data-id="'.$w.'">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="badge bg-primary me-3 pos-badge">#'.$p.'</span>
                                                                    <i class="fas fa-bars me-3 text-muted drag-handle"></i>
                                                                    <strong class="text-dark">'.$name.'</strong>
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <a href="'.str_replace('.php', '', $w).'.php?page_id='.$edit_id.'&pos='.$p.'" class="btn btn-sm btn-outline-info me-2"><i class="fas fa-edit me-1"></i> Edit Content</a>
                                                                    <i class="fas fa-trash-alt text-danger remove-widget cursor-pointer"></i>
                                                                </div>
                                                              </div>';
                                                        $p++;
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tab 2: SEO -->
                            <div class="tab-pane fade" id="pills-seo" role="tabpanel">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 bg-white">
                                        <h6 class="m-0 font-weight-bold text-primary">Search Engine & Social Settings</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Meta Description (Standard SEO)</label>
                                            <textarea name="meta_description" class="form-control" rows="2"><?php echo $edit_data ? $edit_data['meta_description'] : ''; ?></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">OG Title (Social Share Title)</label>
                                                <input type="text" name="og_title" class="form-control" value="<?php echo $edit_data ? $edit_data['og_title'] : ''; ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Twitter Card Type</label>
                                                <select name="twitter_card" class="form-select">
                                                    <option value="summary_large_image" <?php echo ($edit_data && $edit_data['twitter_card'] == 'summary_large_image') ? 'selected' : ''; ?>>Large Image Card</option>
                                                    <option value="summary" <?php echo ($edit_data && $edit_data['twitter_card'] == 'summary') ? 'selected' : ''; ?>>Summary Card</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Social Share Image URL</label>
                                            <input type="text" name="og_image" class="form-control" value="<?php echo $edit_data ? $edit_data['og_image'] : 'assets/img/logo/og-image.jpg'; ?>">
                                            <small class="text-muted">Recommended: 1200x630px JPG/PNG</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Social Share Description</label>
                                            <textarea name="og_description" class="form-control" rows="2"><?php echo $edit_data ? $edit_data['og_description'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Settings -->
                    <div class="col-md-3">
                         <div class="card shadow mb-4 sticky-top" style="top: 100px;">
                            <div class="card-header py-3 bg-white border-bottom">
                                <h6 class="m-0 font-weight-bold text-primary text-center">Control Panel</h6>
                            </div>
                            <div class="card-body">
                                <button type="submit" name="submit_page" class="btn btn-primary w-100 btn-lg mb-4 shadow"><i class="fas fa-save me-2"></i> Save Page</button>
                                
                                <div class="mb-3">
                                    <label class="form-label font-weight-bold">Page Title</label>
                                    <input type="text" name="page_title" class="form-control mb-3" value="<?php echo $edit_data ? $edit_data['title'] : ''; ?>" required>
                                    <label class="form-label font-weight-bold">File Name</label>
                                    <input type="text" name="page_name" class="form-control" value="<?php echo $edit_data ? str_replace('.php', '', $edit_data['filename']) : ''; ?>" required <?php echo $edit_id ? 'readonly' : ''; ?>>
                                </div>

                                <hr>
                                <h6 class="font-weight-bold mb-3">Add Elements</h6>
                                <div id="widgetInventory" class="list-group">
                                    <?php foreach($widgets as $widget): ?>
                                        <div class="list-group-item list-group-item-action cursor-pointer mb-2 rounded border bg-light small py-2" data-id="<?php echo $widget; ?>">
                                            <i class="fas fa-plus-circle text-success me-2"></i>
                                            <?php echo ucfirst(str_replace(['-', '.php'], [' ', ''], $widget)); ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
                <div id="sequenceInputs"></div>
            </form>
        </div>
    </div>

    <!-- Hidden template -->
    <template id="widgetItemTemplate">
        <div class="list-group-item widget-item-added d-flex justify-content-between align-items-center border-left-primary mb-3 shadow-sm">
            <div class="d-flex align-items-center">
                <span class="badge bg-primary me-3 pos-badge"></span>
                <i class="fas fa-bars me-3 text-muted drag-handle"></i>
                <strong class="widget-name text-dark"></strong>
            </div>
            <div class="d-flex align-items-center">
                <span class="text-muted small me-3 italic">Save to enable editing</span>
                <i class="fas fa-trash-alt text-danger remove-widget cursor-pointer"></i>
            </div>
        </div>
    </template>

    <style>
        .cursor-pointer { cursor: pointer; }
        .drag-handle { cursor: grab; }
        .drag-handle:active { cursor: grabbing; }
        .border-dashed { border: 2px dashed #4e73df88 !important; }
        .border-left-primary { border-left: 5px solid #4e73df !important; }
        .nav-pills .nav-link.active { background-color: #4e73df; }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var inventory = document.getElementById('widgetInventory');
            var layout = document.getElementById('pageLayoutArea');
            var form = document.getElementById('builderForm');
            var sequenceInputs = document.getElementById('sequenceInputs');
            var template = document.getElementById('widgetItemTemplate');

            inventory.addEventListener('click', function(e) {
                var item = e.target.closest('.list-group-item');
                if (item) {
                    var widgetId = item.getAttribute('data-id');
                    var name = item.innerText.trim();
                    addWidgetToLayout(widgetId, name);
                    updatePositions();
                }
            });

            function addWidgetToLayout(id, name) {
                var clone = template.content.cloneNode(true);
                var row = clone.querySelector('.list-group-item');
                row.setAttribute('data-id', id);
                row.querySelector('.widget-name').innerText = name;
                attachRemoveEvent(row);
                layout.appendChild(clone);
            }

            function updatePositions() {
                var badges = layout.querySelectorAll('.pos-badge');
                badges.forEach(function(badge, index) {
                    badge.innerText = '#' + (index + 1);
                });
            }

            function attachRemoveEvent(row) {
                row.querySelector('.remove-widget').onclick = function() {
                    row.remove();
                    updatePositions();
                };
            }

            layout.querySelectorAll('.widget-item-added').forEach(attachRemoveEvent);

            Sortable.create(layout, { 
                animation: 150, 
                handle: '.drag-handle',
                onEnd: updatePositions
            });

            form.onsubmit = function() {
                var items = layout.querySelectorAll('.list-group-item');
                sequenceInputs.innerHTML = '';
                items.forEach(function(item) {
                    var id = item.getAttribute('data-id');
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'widget_sequence[]';
                    input.value = id;
                    sequenceInputs.appendChild(input);
                });
                return true;
            };
        });
    </script>
</body>
</html>
