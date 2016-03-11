<?php
include('src/Mustache/Autoloader.php');
Mustache_Autoloader::register();
include('includes/header.php');
?>

				<form action="generate-entries.php" method="post" autocomplete="off">
					<div class="title">Post an entry here.</div>
					<p>Title:</p><p><input type="text" name="title" class="field"></p>
					<input type="email" name="email" class="none">
					<p>Entry:</p><p><textarea cols="40" rows="20" name="body" class="field"></textarea></p>
					<p><input type="submit" value="Submit" name="submit" class="button"></p>
				</form>
<?php
class entry {
	public $title = "";
	public $body  = "";
	public $url = "";
}
$doc = $_SERVER['DOCUMENT_ROOT']."/demos/mustache2/data/entry.json";
if(isset($_POST['submit']) && $_POST['email'] == "") {
	$entry = new entry();
	$entry->title = stripslashes($_POST['title']);
	$entry->body  = stripslashes($_POST['body']);
	$entry->date = date('l, F jS, Y');
	$entry->url = 'post.php?id=' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 7);
	$outputstring = json_encode($entry);
	//first, obtain the data initially present in the text file
	$ini_handle = fopen($doc, "r");
	$ini_contents = str_replace('{"entry" : [', '', fread($ini_handle, filesize($doc)));
	fclose($ini_handle);
	//done obtaining initially present data

	//write new data to the file, along with the old data
	$handle = fopen($doc, "w+");
		$writestring = "{\"entry\" : [\n\t" . strip_tags(stripslashes($outputstring)) . "," . $ini_contents;
		if (fwrite($handle, $writestring) === false) {
			echo "Cannot write to text file. <br />";
		}
		else { echo "<div class=\"entries\">Success!</div>"; }
	fclose($handle);
	unset($_POST['submit']);
}
include('includes/footer.php');
?>