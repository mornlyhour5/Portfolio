<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="description" content="Portfolio of <?= e($profile['name']) ?> (<?= e($profile['nickname']) ?>), application developer working with .NET, Laravel and Power BI.">
<title><?= e($profile['nickname']) ?> Developer Portfolio</title>
<link rel="stylesheet" href="<?= e(asset('assets/css/style.css')) ?>">
<link rel="stylesheet" href="<?= e(asset('assets/css/galaxy.css')) ?>">
<link rel="stylesheet" href="<?= e(asset('assets/css/responsive.css')) ?>">
</head>
<body>
<canvas class="sky" id="sky" aria-hidden="true"></canvas>

<div class="page">
<?php require __DIR__ . '/navigation.php'; ?>
