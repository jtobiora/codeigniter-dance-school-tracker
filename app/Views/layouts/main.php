<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include('layouts/header') ?>
</head>
<body id="page-top">
<div id="wrapper">
    <?= $this->include('layouts/sidebar') ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?= $this->renderSection('content') ?>
        </div>
        <?= $this->include('layouts/footer') ?>
    </div>
</div>
</body>
</html>
