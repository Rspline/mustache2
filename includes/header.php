<?php
$page = basename($_SERVER['PHP_SELF']);
$title_data = file_get_contents('./data/title.json');
$titles = json_decode($title_data, true);
$headTitle = "";
$bodyTitle = "";
foreach($titles as $key => $val) {
  if($page == $val['pageURL']) {
    $headTitle = $val['headTitle'];
    $bodyTitle = $val['bodyTitle'];
  }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $headTitle; ?></title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="wrapper">
      <nav>
          <div class="inner">
              <h1><a href="index.php">David's Site</a></h1>
              <ul>
                  <li><a href="about.php">About</a></li>
                  <li><a href="archive.php">Archive</a></li>
              </ul>
          </div>
      </nav>
      <div class="inner">
          <h1><?php echo $bodyTitle; ?></h1>