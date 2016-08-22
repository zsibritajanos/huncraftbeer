<?php

include('./config.php');
include('./config_db.php');
include('./globals.php');

require('brewery_functions.php');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"
      dir="ltr">

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <title><?php echo SITE_TITLE ?></title>
</head>
<body>

<?php

if (isset($_POST['delete'])) {
    delete_brewery($_POST['brewery_id']);
}

new_form();

if (isset($_POST[FIELD_BREWERY_NAME])) {
    add_brewery($_POST);
}

list_breweries();
?>

</body>
</html>