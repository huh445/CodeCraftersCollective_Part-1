<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Company home page">
    <meta name="keywords" content="IT, Home, Company, Software, Cybersecurity">
    <meta name="author" content="Code Crafters Collective">
    <link rel="icon" type="image/png" href="images/favicon-32x32.png">
    <link rel="stylesheet" href="styles/styles.css">
    <title><?php echo $pageTitle; ?></title>
</head>
<body>
  <header class="navbar">
    <div class="brand">
      <a href="index.php">
        <img src="images/logosmall.jpg" alt="IT Solutions Logo" class="logo">
      </a>
      <h1>IT Solutions</h1>
    </div>
    <?php include 'nav.inc'; ?>
  </header>
  <div class="page-wrapper">