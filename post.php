<?php
$entry_data = file_get_contents('./data/entry.json');
$entries = json_decode($entry_data, true);
$title = "";
$date = "";
$body = "";
if(isset($_GET['id'])) {
    $query = 'post.php?id='.$_GET['id'];
    foreach($entries['entry'] as $key => $val) {
        if($val['url'] == $query) {
            $title = $val['title'];
            $date = $val['date'];
            $body = $val['body'];
        }
    }
}
else {
    $title = "Not found";
    $date = "";
    $body = "Sorry but this entry doesn't exist";
}
?>

<?php include('includes/header.php'); ?>
<div class="entries">
    <article class="entry">
        <h1><?php echo $title; ?></h1>
        <p><?php echo $date; ?></p>
        <p><?php echo $body; ?></p>
    </article>
</div>
<?php include('includes/footer.php'); ?>