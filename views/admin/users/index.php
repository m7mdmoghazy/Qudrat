<div class="main-header">
    <div>
        <h1>Users</h1>
        <p style="color: var(--text-muted);">Manage students and teachers</p>
    </div>
    <a href="<?= APP_URL ?>/admin/users/create" class="btn btn-primary"><i class="fas fa-plus"></i> Create User</a>
</div>

<div class="card">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 2px solid var(--border-color); text-align: left;">
                <th style="padding: 15px;">Name</th>
                <th style="padding: 15px;">Email</th>
                <th style="padding: 15px;">Role</th>
                <th style="padding: 15px;">Joined</th>
                <th style="padding: 15px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 15px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 30px; height: 30px; background: #eee; border-radius: 50%; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                            <?php if($user['avatar'] && $user['avatar'] != 'default-avatar.png'): ?>
                                <img src="<?= APP_URL . '/' . $user['avatar'] ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <?= strtoupper(substr($user['name'], 0, 1)) ?>
                            <?php endif; ?>
                        </div>
                        <?= $user['name'] ?>
                    </div>
                </td>
                <td style="padding: 15px; color: var(--text-muted);"><?= $user['email'] ?></td>
                <td style="padding: 15px;">
                    <span style="padding: 4px 10px; border-radius: 50px; font-size: 0.85rem; background: <?= $user['role'] == 'admin' ? 'var(--primary-light)' : ($user['role'] == 'teacher' ? 'hsl(180, 50%, 90%)' : 'hsl(330, 50%, 90%)') ?>; color: <?= $user['role'] == 'admin' ? 'var(--primary)' : ($user['role'] == 'teacher' ? 'hsl(180, 80%, 30%)' : 'hsl(330, 80%, 30%)') ?>;">
                        <?= ucfirst($user['role']) ?>
                    </span>
                </td>
                <td style="padding: 15px; color: var(--text-muted);"><?= date('M d, Y', strtotime($user['created_at'])) ?></td>
                <td style="padding: 15px;">
                    <a href="<?= APP_URL ?>/admin/users/edit/<?= $user['id'] ?>" class="btn btn-outline" style="padding: 5px 10px; font-size: 0.8rem;"><i class="fas fa-edit"></i></a>
                    <a href="<?= APP_URL ?>/admin/users/delete/<?= $user['id'] ?>" class="btn btn-outline" style="padding: 5px 10px; font-size: 0.8rem; color: #dc3545; border-color: #dc3545;" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php view('layouts/footer'); ?>
