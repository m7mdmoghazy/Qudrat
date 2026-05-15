<div class="main-header">
    <div>
        <h1>Edit Course</h1>
        <p style="color: var(--text-muted);">Update course details</p>
    </div>
    <a href="<?= APP_URL ?>/teacher/courses" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to Courses</a>
</div>

<div class="card" style="max-width: 700px;">
    <?= \Session::getFlash('error') ? '<div class="alert alert-danger" style="background: #fee2e2; color: #dc2626; padding: 15px; border-radius: 8px; margin-bottom: 20px;">'.\Session::getFlash('error').'</div>' : '' ?>

    <form action="<?= APP_URL ?>/teacher/courses/update/<?= $course['id'] ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        
        <div class="form-group" style="margin-bottom: 20px;">
            <label class="form-label" style="display: block; margin-bottom: 8px; font-weight: 500;">Course Title</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($course['title']) ?>" required 
                   style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px;">
        </div>
        
        <div class="form-group" style="margin-bottom: 20px;">
            <label class="form-label" style="display: block; margin-bottom: 8px; font-weight: 500;">Course Code</label>
            <input type="text" name="code" class="form-control" value="<?= htmlspecialchars($course['code']) ?>" required 
                   style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px;">
        </div>
        
        <div class="form-group" style="margin-bottom: 20px;">
            <label class="form-label" style="display: block; margin-bottom: 8px; font-weight: 500;">Description</label>
            <textarea name="description" class="form-control" rows="5" 
                      style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; resize: vertical;"><?= htmlspecialchars($course['description']) ?></textarea>
        </div>
        
        <div class="form-group" style="margin-bottom: 20px;">
            <label class="form-label" style="display: block; margin-bottom: 8px; font-weight: 500;">Course Image (Optional)</label>
            <?php if(!empty($course['image'])): ?>
                <div style="margin-bottom: 10px;">
                    <img src="<?= APP_URL . '/' . $course['image'] ?>" style="max-width: 200px; border-radius: 8px;">
                </div>
            <?php endif; ?>
            <input type="file" name="image" accept="image/*" class="form-control" 
                   style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px;">
        </div>
        
        <div style="display: flex; gap: 15px; margin-top: 30px;">
            <button type="submit" class="btn btn-primary" style="flex: 1;"><i class="fas fa-save"></i> Update Course</button>
            <a href="<?= APP_URL ?>/teacher/courses/delete/<?= $course['id'] ?>" class="btn" 
               style="background: #fee2e2; color: #dc2626;" onclick="return confirm('Are you sure you want to delete this course?')">
                <i class="fas fa-trash"></i> Delete
            </a>
        </div>
    </form>
</div>

<?php view('layouts/footer'); ?>
