<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Members</h1>

    <!-- Alert Flashdata -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Member List</h6>
            <a href="/members/create" class="btn btn-primary btn-sm float-right">Add New</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Class</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($members as $member): ?>
                        <tr>
                            <td><?= esc($member['membership_number']) ?></td>
                            <td><?= esc($member['first_name'] . ' ' . $member['surname']) ?></td>
                            <td><?= esc($member['email']) ?></td>
                            <td><?= esc($member['phone']) ?></td>
                            <td><?= esc($member['role']) ?></td>
                            <td><?= esc($member['class_attended']) ?></td>
                            <td>
                                <a href="/members/edit/<?= $member['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <!-- Delete button -->
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $member['id'] ?>">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal<?= $member['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $member['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel<?= $member['id'] ?>">Confirm Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete <strong><?= esc($member['first_name']) ?> <?= esc($member['surname']) ?></strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <a href="/members/delete/<?= $member['id'] ?>" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    </tbody>
                </table>
                <div class="mt-3">
                    <?= $pager->links('default', 'bootstrap_full') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
