<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Attendance for <?= esc($event['event_name']) ?> (<?= esc($event['event_date']) ?>)</h1>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <form action="/attendance/save/<?= $event['id'] ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="member-search" class="form-label">Quick Add Member:</label>
            <input type="text" id="member-search" class="form-control" placeholder="Type name or membership number">
            <button type="button" id="add-member-btn" class="btn btn-success mt-2">Add Member</button>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Member Name</th>
                <th>Attended</th>
                <th>Class Attended</th>
                <th>Amount Paid</th>
                <th>Payment Method</th>
                <th>Notes</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($members as $member):
                $attended = isset($attendanceByMember[$member['id']]) ? $attendanceByMember[$member['id']]['attended'] : false;
                $note = isset($attendanceByMember[$member['id']]) ? $attendanceByMember[$member['id']]['notes'] : '';
                $amountPaid = isset($attendanceByMember[$member['id']]) ? $attendanceByMember[$member['id']]['amount_paid'] : '';
                $paymentMethod = isset($attendanceByMember[$member['id']]) ? $attendanceByMember[$member['id']]['payment_method'] : '';
                $selectedClass = $classAttendedByMember[$member['id']] ?? '';
                ?>
                <tr>
                    <td>
                        <?= esc($member['first_name']) . ' ' . esc($member['surname']) ?>
                        <input type="hidden" name="members[]" value="<?= $member['id'] ?>">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" name="attendance[<?= $member['id'] ?>]" value="1" <?= $attended ? 'checked' : '' ?>>
                    </td>
                    <td>
                        <select name="class_attended[<?= $member['id'] ?>]" class="form-control" required>
                            <option value="">-- Select Class --</option>
                            <?php foreach ($classOptions as $option): ?>
                                <option value="<?= esc($option) ?>" <?= ($selectedClass === $option) ? 'selected' : '' ?>>
                                    <?= esc($option) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <input type="number" step="0.01" name="amount_paid[<?= $member['id'] ?>]"
                               value="<?= isset($attendanceByMember[$member['id']]) ? esc($attendanceByMember[$member['id']]['amount_paid']) : '' ?>"
                               class="form-control">
                    </td>
                    <td>
                        <select name="payment_method[<?= $member['id'] ?>]" class="form-control">
                            <option value="">-- Select --</option>
                            <option value="Cash" <?= (isset($attendanceByMember[$member['id']]) && $attendanceByMember[$member['id']]['payment_method'] == 'Cash') ? 'selected' : '' ?>>Cash</option>
                            <option value="Card" <?= (isset($attendanceByMember[$member['id']]) && $attendanceByMember[$member['id']]['payment_method'] == 'Card') ? 'selected' : '' ?>>Card</option>
                            <option value="FOC" <?= (isset($attendanceByMember[$member['id']]) && $attendanceByMember[$member['id']]['payment_method'] == 'FOC') ? 'selected' : '' ?>>FOC</option>
                            <option value="Direct Debit" <?= (isset($attendanceByMember[$member['id']]) && $attendanceByMember[$member['id']]['payment_method'] == 'Direct Debit') ? 'selected' : '' ?>>Direct Debit</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="notes[<?= $member['id'] ?>]" class="form-control" value="<?= esc($note) ?>">
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Save Attendance</button>
        <a href="/attendance" class="btn btn-secondary">Back to Events</a>
    </form>
</div>



<?= $this->endSection() ?> <!-- close content section -->

<?= $this->section('scripts') ?>
<script src="/assets/js/attendance.js"></script>
<?= $this->endSection() ?>  <!-- close scripts section -->
