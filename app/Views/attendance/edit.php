<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Attendance</h1>

    <form action="/attendance/update/<?= $attendance['id'] ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label class="form-label">Event</label>
            <input type="text" class="form-control" value="<?= esc($attendance['event_name']) ?> (<?= esc($attendance['event_date']) ?>)" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Member</label>
            <input type="text" class="form-control" value="<?= esc($attendance['first_name']) ?> <?= esc($attendance['surname']) ?>" readonly>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" name="attended" id="attended" <?= $attendance['attended'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="attended">Attended</label>
        </div>

        <div class="mb-3">
            <label class="form-label">Notes</label>
            <textarea class="form-control" name="notes"><?= esc($attendance['notes']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="/attendance/report" class="btn btn-secondary">Back to Report</a>
    </form>
</div>

<?= $this->endSection() ?>
