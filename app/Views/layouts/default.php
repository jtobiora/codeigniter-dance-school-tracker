<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include('layouts/header') ?>
    <?= $this->renderSection('styles') ?>
</head>
<body id="page-top">
<div id="wrapper">
    <?= $this->include('layouts/sidebar') ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?= $this->include('layouts/topbar') ?>

            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>

        </div>
        <?= $this->include('layouts/footer') ?>
    </div>
</div>

<!-- Global JS Libraries -->
<?= $this->include('layouts/scripts') ?>

<!-- Page-specific scripts -->
<?= $this->renderSection('scripts') ?>

</body>
</html>
