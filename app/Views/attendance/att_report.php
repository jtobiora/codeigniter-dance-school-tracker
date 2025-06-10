<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Attendance Report</h1>

    <form method="get" action="<?= base_url('attendance-report') ?>" class="mb-4">
        <div class="row">
            <div class="col-md-2">
                <label>Minimum Attendances:</label>
                <input type="number" name="min_attendance" class="form-control" value="<?= esc($filters['min_attendance'] ?? '') ?>">
            </div>
            <div class="col-md-2">
                <label>Start Date:</label>
                <input type="date" name="start_date" class="form-control" value="<?= esc($filters['start_date'] ?? '') ?>">
            </div>
            <div class="col-md-2">
                <label>End Date:</label>
                <input type="date" name="end_date" class="form-control" value="<?= esc($filters['end_date'] ?? '') ?>">
            </div>
            <div class="col-md-2">
                <label>Class Attended:</label>
                <select name="class_attended" class="form-control">
                    <option value="">-- Any --</option>
                    <?php foreach ($classOptions as $class): ?>
                        <option value="<?= esc($class) ?>" <?= (isset($filters['class_attended']) && $filters['class_attended'] == $class) ? 'selected' : '' ?>><?= esc($class) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label>Leader/Follower:</label>
                <select name="leader_follower" class="form-control">
                    <option value="">-- Any --</option>
                    <?php foreach ($leaderFollowerOptions as $role): ?>
                        <option value="<?= esc($role) ?>" <?= (isset($filters['leader_follower']) && $filters['leader_follower'] == $role) ? 'selected' : '' ?>><?= esc($role) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label>Lapsed Since:</label>
                <input type="date" name="lapsed_since" class="form-control" value="<?= esc($filters['lapsed_since'] ?? '') ?>">
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="<?= base_url('attendance-report/exportCsv?' . http_build_query($filters)) ?>" class="btn btn-success">Export CSV</a>
        </div>
    </form>

    <form method="post" action="<?= base_url('attendance-report/sendEmails') ?>">
        <?= csrf_field() ?>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Select</th>
                <th>Name</th>
                <th>Email</th>
                <th>Leader/Follower</th>
                <th>Class</th>
                <th>Attendance Count</th>
                <th>Last Attended</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($reportData)): ?>
                <?php foreach ($reportData as $row): ?>
                    <tr>
                        <td><input type="checkbox" name="member_emails[]" value="<?= esc($row['email']) ?>"></td>
                        <td><?= esc($row['first_name'] . ' ' . $row['surname']) ?></td>
                        <td><?= esc($row['email']) ?></td>
                        <td><?= esc($row['leader_follower']) ?></td>
                        <td><?= esc($row['class_attended']) ?></td>
                        <td><?= esc($row['attendance_count']) ?></td>
                        <td><?= esc($row['last_attended']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7">No records found</td></tr>
            <?php endif; ?>
            </tbody>
        </table>

        <h4>Email Selected Members</h4>
        <div class="form-group">
            <label>Subject:</label>
            <input type="text" name="subject" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Message:</label>
            <textarea name="message" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Send Emails</button>
    </form>

</div>

<?= $this->endSection() ?>
