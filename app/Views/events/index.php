<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dance Nights</h1>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <a href="/events/create" class="btn btn-primary mb-3">Add New Dance Night</a>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Location</th>
            <th>Notes</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($events as $event): ?>
            <tr>
                <td><?= esc($event['event_name']) ?></td>
                <td><?= esc($event['event_date']) ?></td>
                <td><?= esc($event['location']) ?></td>
                <td><?= esc($event['notes']) ?></td>
                <td>
                    <a href="/events/edit/<?= $event['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="/events/delete/<?= $event['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>