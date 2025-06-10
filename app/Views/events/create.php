<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= isset($event) ? 'Edit Dance Night' : 'Add Dance Night' ?></h1>

    <form action="<?= isset($event) ? '/events/update/' . $event['id'] : '/events/store' ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="event_name">Dance Night Name</label>
            <input type="text" name="event_name" id="event_name" class="form-control" required value="<?= isset($event) ? esc($event['event_name']) : '' ?>">
        </div>

        <div class="form-group">
            <label for="event_date">Date</label>
            <input type="date" name="event_date" id="event_date" class="form-control" required value="<?= isset($event) ? esc($event['event_date']) : '' ?>">
        </div>

        <div class="form-group">
            <label for="location">Location (optional)</label>
            <input type="text" name="location" id="location" class="form-control" value="<?= isset($event) ? esc($event['location']) : '' ?>">
        </div>

        <div class="form-group">
            <label for="notes">Notes (optional)</label>
            <textarea name="notes" id="notes" class="form-control"><?= isset($event) ? esc($event['notes']) : '' ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary"><?= isset($event) ? 'Update' : 'Add' ?> Dance Night</button>
        <a href="/events" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?= $this->endSection() ?>
