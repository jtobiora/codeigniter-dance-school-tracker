<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Member</h1>

    <!-- Flash message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/members/update/<?= $member['id'] ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="membership_number">Membership Number</label>
                    <input type="text" name="membership_number" id="membership_number" class="form-control" value="<?= esc($member['membership_number']) ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" value="<?= esc($member['first_name']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" name="surname" id="surname" class="form-control" value="<?= esc($member['surname']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?= esc($member['email']) ?>">
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="<?= esc($member['phone']) ?>">
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="">Select Role</option>
                        <option value="Leader" <?= $member['role'] === 'Leader' ? 'selected' : '' ?>>Leader</option>
                        <option value="Follower" <?= $member['role'] === 'Follower' ? 'selected' : '' ?>>Follower</option>
                        <option value="Both" <?= $member['role'] === 'Both' ? 'selected' : '' ?>>Both</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="class_attended">Class Attended</label>
                    <input type="text" name="class_attended" id="class_attended" class="form-control" value="<?= esc($member['class_attended']) ?>">
                </div>

                <button type="submit" class="btn btn-primary">Update Member</button>
                <a href="/members" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
