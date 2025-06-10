<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Add New Member</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/members/store" method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label>Membership Number</label>
                    <input type="text" name="membership_number" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Surname</label>
                    <input type="text" name="surname" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" class="form-control">
                </div>

                <div class="form-group">
                    <label>IDTA Pin</label>
                    <input type="text" name="idta_pin" class="form-control">
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control" required>
                        <option value="">Select</option>
                        <option value="Leader">Leader</option>
                        <option value="Follower">Follower</option>
                        <option value="Both">Both</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Class Attended</label>
                    <select name="class_attended" class="form-control" required>
                        <option value="">Select Class</option>
                        <option value="Diamond dance class">Diamond dance class</option>
                        <option value="Silver dance class">Silver dance class</option>
                        <option value="Gold dance class">Gold dance class</option>
                        <option value="Bronze dance class">Bronze dance class</option>
                        <option value="Platinum dance class">Platinum dance class</option>
                        <option value="Copper dance class">Copper dance class</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Notes</label>
                    <textarea name="notes" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save Member</button>
                <a href="/members" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
