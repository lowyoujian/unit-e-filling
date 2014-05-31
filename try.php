<!DOCTYPE HTML>
<html>
<?php
$inputs = array();
$errors = array();
$upload_form_fields = array(
    'unitcode' => 'Unit Code',
    'unitname' => 'Unit Name',
    'trimester' => 'Trimester/Year',
    'programme' => 'Programme',
    'moderator' => 'Moderator',
    'quizzes' => 'Number of Quizzes',
    'tests' => 'Number of Tests',
    'labs' => 'Number of Labs',
    'assignments' => 'Number of Assignments',
    );

foreach($upload_form_fields as $key => $value)
{
    $inputs[$key] = '';
    $errors[$key] = '';
}

?>
<head>
    <title>Unit e-Filling</title>   
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    
    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
</head>
<body>
<form class="form-horizontal">
    <!--<span class="offset2">Sign Into the Email</span>-->
    <div class="control-group">
        <div class="controls"><span>Welcome to My Email</span>

        </div>
    </div>
    <div class="control-group">
        <div class="input-append">
            <label for="unitcode" class="control-label"><?php echo $upload_form_fields['unitcode']; ?></label>
            <div class="controls">
                <input type="text" /> <span class="add-on">@</span>

            </div>
        </div>
    </div>
    <div class="control-group">
        <div class="input-append">
            <label for="passwd" class="control-label">Password</label>
            <div class="controls">
                <input type="password" /> <span class="add-on">***</span>

            </div>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <label class="checkbox">
                <input type="checkbox" />Remember Me</label>
            <button class="btn">Sign In</button>
        </div>
    </div>
</form>