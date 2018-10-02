<?php
extract($_POST);
if(isset($submit)){
	$errors=array();
	$file_name=$_FILES['image']['name'];
	$file_type=$_FILES['image']['type'];
	$file_size=$_FILES['image']['size'];
    $file_tmp=$_FILES['image']['tmp_name'];
	if(empty($file_name)){
		echo "please choose file";
	}
	else{
	$extensions=array('jpg','jpeg','png','gif','JPEG');
	$imageex=strtolower(end(explode(".",$file_name)));
	if((in_array($imageex,$extensions))==false){
		$errors[]="please choose extensions of jpg,png,jpeg and gif";
		
	}
	if($file_size>2048000){
		$errors[]="please choose image size less than or eqal to 2 MB";
	}
	if(empty($errors))
	{

	$res=move_uploaded_file($file_tmp,"uploads/".$file_name);
	if($res)
		echo "successfully uploaded";
	else
		echo "failed";
		mysql_connect("localhost","root","");
		mysql_select_db("9amci");
		$insert="insert into images(image_name) values($file_name)";
		mysql_query($insert);
}

else
{
	print_r($errors);
}
}
}

?>

<form method="post" action="" enctype="multipart/form-data">
<input type="file"name="image"><br><br>
<input type="submit"name="submit"value="Upload">
</form>