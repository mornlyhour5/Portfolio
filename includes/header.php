<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="description" content="Portfolio of <?= e($profile['name']) ?> (<?= e($profile['nickname']) ?>), application developer working with .NET, Laravel and Power BI.">
<title><?= e($profile['nickname']) ?> Developer Portfolio</title>
<link rel="icon" type="image/svg+xml" href="<?= e(asset('assets/img/favicon.svg')) ?>">
<link rel="apple-touch-icon" href="<?= e(asset('assets/img/apple-touch-icon.png')) ?>">
<script>
  // Pick the starting language before the page paints: the saved choice, else Khmer for Khmer browsers, else English
  (function () {
    var lang = 'en';
    try {
      var saved = localStorage.getItem('portfolio-lang');
      if (saved === 'en' || saved === 'km') lang = saved;
      else if ((navigator.language || '').toLowerCase().indexOf('km') === 0) lang = 'km';
    } catch (err) { /* storage blocked: stay in English */ }
    document.documentElement.lang = lang;
    // Colour: a light or dark choice saved in the settings is applied now, otherwise the device decides
    try {
      var colour = localStorage.getItem('portfolio-theme');
      if (colour === 'light' || colour === 'dark') document.documentElement.setAttribute('data-theme', colour);
    } catch (err) { /* storage blocked: follow the device */ }
  })();
</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;700&display=swap">
<link rel="stylesheet" href="<?= e(asset('assets/css/style.css')) ?>">
<link rel="stylesheet" href="<?= e(asset('assets/css/galaxy.css')) ?>">
<link rel="stylesheet" href="<?= e(asset('assets/css/responsive.css')) ?>">
</head>
<body>
<canvas class="sky" id="sky" aria-hidden="true"></canvas>

<div class="page">
<?php require __DIR__ . '/navigation.php'; ?>
