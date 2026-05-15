<div class="main-header">
    <div>
        <h1>Create Course</h1>
        <p style="color: var(--text-muted);">Start a new class</p>
    </div>
    <a href="<?= APP_URL ?>/teacher/courses" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div class="card" style="max-width: 800px;">
    <form action="<?= APP_URL ?>/teacher/courses/store" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        
        <div class="form-group">
            <label class="form-label">Course Title</label>
            <input type="text" name="title" class="form-control" required placeholder="e.g., Introduction to Physics">
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label class="form-label">Course Code</label>
                <input type="text" name="code" class="form-control" required placeholder="e.g., PHY101">
            </div>
            
            <div class="form-group">
                <label class="form-label">Cover Image</label>
                <input type="file" name="image" class="form-control">
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="5" required placeholder="What will students learn?"></textarea>
        </div>
        
        <!-- Dates (Optional) -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label class="form-label">Start Date</label>
                <input type="date" name="start_date" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">End Date</label>
                <input type="date" name="end_date" class="form-control">
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Create Course</button>
    </form>
</div>

<?php view('layouts/footer'); ?>
