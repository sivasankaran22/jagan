<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
include_once '../inc/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eduex Admin Dashboard</title>
    <!-- Use local CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <style>
        :root { --admin-primary: #4e73df; --admin-dark: #222e3c; }
        body { font-family: 'Inter', sans-serif; background: #f8f9fc; font-size: 14px; }
        .sidebar { height: 100vh; background: var(--admin-dark); color: #fff; width: 250px; position: fixed; overflow-y: auto; z-index: 1050;}
        .sidebar a { color: rgba(255,255,255,0.7); padding: 12px 25px; display: block; text-decoration: none; border-left: 3px solid transparent; }
        .sidebar a:hover, .sidebar a.active { color: #fff; background: rgba(255,255,255,0.05); border-left: 3px solid var(--admin-primary); }
        .sidebar .logo-area { padding: 30px 25px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar .logo-area h4 { font-weight: 700; color: #fff; margin-bottom: 0; }
        .sidebar .menu-label { padding: 15px 25px 5px; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.4); }
        .sidebar .submenu { background: rgba(0,0,0,0.2); display: block; }
        .sidebar .submenu a { padding-left: 45px; font-size: 13px; }
        .main-content { margin-left: 250px; padding: 40px; }
        .card { border: none; box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15); border-radius: 12px; }
        .card-header { background: #fff; border-bottom: 1px solid #e3e6f0; font-weight: 700; padding: 1.25rem; }
        .top-navbar { height: 70px; background: #fff; display: flex; align-items: center; justify-content: flex-end; padding: 0 40px; border-bottom: 1px solid #e3e6f0; margin-left: 250px;}
        .top-navbar a { color: var(--admin-dark); text-decoration: none; font-weight: 600; }
        .cursor-pointer { cursor: pointer; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo-area">
            <h4>Eduex Admin</h4>
        </div>
        
        <div class="menu-label">Main Navigation</div>
        <a href="index.php"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
        <a href="pages.php"><i class="fas fa-file-alt me-2"></i> Pages List</a>
        <a href="create-page.php"><i class="fas fa-magic me-2"></i> Page Builder</a>
        <a href="menus.php"><i class="fas fa-bars me-2"></i> Menu Editor</a>
        <a href="media.php"><i class="fas fa-images me-2"></i> Media Library</a>
        
        <div class="menu-label">Manage Content</div>
        <a href="#collapseWidgets" data-bs-toggle="collapse" class="dropdown-toggle" aria-expanded="true"><i class="fas fa-th-large me-2"></i> Widgets Area</a>
        <div class="collapse show" id="collapseWidgets">
            <div class="submenu">
                <a href="hero.php">Hero Section</a>
                <a href="about.php">About Us</a>
                <a href="category.php">Categories</a>
                <a href="courses.php">Courses</a>
                <a href="team.php">Team/Teachers</a>
                <a href="testimonials.php">Testimonials</a>
                <a href="testimonial-2.php">Testimonials v2</a>
                <a href="google-reviews.php">Google Review Slider</a>
                <a href="news.php">News/Blogs</a>
                <a href="discount.php">Discount Banner</a>
                <a href="why-choose-us.php">Why Choose Us</a>
            </div>
        </div>

        <div class="menu-label">Settings</div>
        <a href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout System</a>
    </div>

    <!-- Bootstrap JS (needed for collapse) -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <div class="top-navbar">
        <div class="user-info">
            Welcome, <strong>Admin</strong>
        </div>
    </div>
    
    <!-- Shared Media Selector Modal -->
    <div class="modal fade" id="mediaSelectorModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content shadow-lg border-0 rounded-lg">
                <div class="modal-header bg-dark text-white p-4">
                    <h5 class="modal-title font-size-16"><i class="fas fa-images me-2 text-primary"></i> Media Assets Library</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <div id="media-grid" class="row row-cols-3 row-cols-md-4 row-cols-lg-6 g-3">
                        <!-- Loaded dynamically via JS -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Shared Link Selector Modal -->
    <div class="modal fade" id="linkSelectorModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content shadow-lg border-0 rounded-lg">
                <div class="modal-header bg-primary text-white p-4">
                    <h5 class="modal-title"><i class="fas fa-link me-2"></i> Select Internal Page</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-3 bg-light">
                    <div class="list-group list-group-flush shadow-sm rounded overflow-hidden" id="links-list">
                        <!-- Loaded dynamically via JS -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentTargetInputId = null;

        /** Media Selector Functions **/
        function openMediaSelector(inputId) {
            currentTargetInputId = inputId;
            const modal = new bootstrap.Modal(document.getElementById('mediaSelectorModal'));
            loadMediaLibrary();
            modal.show();
        }

        async function loadMediaLibrary() {
            const grid = document.getElementById('media-grid');
            grid.innerHTML = '<div class="col-12 text-center py-5"><i class="fas fa-spinner fa-spin fa-2x"></i></div>';
            try {
                const response = await fetch('media-api.php');
                const images = await response.json();
                grid.innerHTML = '';
                if (images.length === 0) {
                    grid.innerHTML = '<div class="col-12 text-center py-5">No images found. <a href="media.php">Upload some first!</a></div>';
                    return;
                }
                images.forEach(img => {
                    const div = document.createElement('div');
                    div.className = 'col';
                    div.innerHTML = `
                        <div class="card h-100 border-0 shadow-sm overflow-hidden cursor-pointer selection-card" onclick="selectMedia('${img.file_path}')">
                            <div class="ratio ratio-1x1 bg-white"><img src="../${img.file_path}" class="object-fit-cover w-100 h-100" alt="img"></div>
                            <div class="p-1 px-2 small text-truncate border-top bg-white border-0">${img.filename}</div>
                        </div>
                    `;
                    grid.appendChild(div);
                });
            } catch (e) { grid.innerHTML = 'Error loading media.'; }
        }

        function selectMedia(path) {
            if (currentTargetInputId) {
                document.getElementById(currentTargetInputId).value = path;
                const preview = document.getElementById(currentTargetInputId + '_preview');
                if (preview) preview.src = '../' + path;
            }
            bootstrap.Modal.getInstance(document.getElementById('mediaSelectorModal')).hide();
        }

        /** Link Selector Functions **/
        function openLinkSelector(inputId) {
            currentTargetInputId = inputId;
            const modal = new bootstrap.Modal(document.getElementById('linkSelectorModal'));
            loadInternalLinks();
            modal.show();
        }

        async function loadInternalLinks() {
            const list = document.getElementById('links-list');
            list.innerHTML = '<div class="p-4 text-center"><i class="fas fa-spinner fa-spin me-2"></i> Loading pages...</div>';
            try {
                const response = await fetch('links-api.php');
                const pages = await response.json();
                list.innerHTML = '';
                pages.forEach(pg => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'list-group-item list-group-item-action p-3';
                    btn.innerHTML = `<strong>${pg.title}</strong><br><small class="text-muted text-monospace">${pg.filename}</small>`;
                    btn.onclick = () => selectLink(pg.filename);
                    list.appendChild(btn);
                });
            } catch (e) { list.innerHTML = '<div class="p-3 text-danger">Error loading page links.</div>'; }
        }

        function selectLink(filename) {
            if (currentTargetInputId) {
                document.getElementById(currentTargetInputId).value = filename;
            }
            bootstrap.Modal.getInstance(document.getElementById('linkSelectorModal')).hide();
        }
    </script>
    <style>
        .selection-card:hover { outline: 3px solid var(--admin-primary); transition: 0.1s; }
        .object-fit-cover { object-fit: cover !important; }
        .italic { font-style: italic; }
        .text-monospace { font-family: monospace; }
    </style>
</body>
</html>
