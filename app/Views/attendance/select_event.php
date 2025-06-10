<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Select an Event to Take Attendance</h1>
    <a href="/attendance/report" class="btn btn-success mb-3">View Attendance Report</a>
    <ul class="list-group">
        <?php foreach ($events as $event): ?>
            <li class="list-group-item">
                <a href="/attendance/<?= $event['id'] ?>">
                    <?= esc($event['event_name']) ?> — <?= esc($event['event_date']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?= $this->endSection() ?>
