<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Attendance Report</h1>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Event</th>
            <th>Date</th>
            <th>Member</th>
            <th>Attended</th>
            <th>Notes</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($attendances as $att): ?>
            <tr>
                <td><?= esc($att['event_name']) ?></td>
                <td><?= esc($att['event_date']) ?></td>
                <td><?= esc($att['first_name']) ?> <?= esc($att['surname']) ?></td>
                <td><?= $att['attended'] ? 'Yes' : 'No' ?></td>
                <td><?= esc($att['notes']) ?></td>
                <td>
                    <a href="/attendance/edit/<?= $att['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="/attendance/delete/<?= $att['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>

    <a href="/attendance" class="btn btn-secondary">Back to Event List</a>
</div>

<?= $this->endSection() ?>
