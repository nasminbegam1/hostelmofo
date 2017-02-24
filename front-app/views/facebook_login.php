<!DOCTYPE html>

<html>
<head>
      <link rel="shortcut icon" href="<?php echo FRONTEND_URL; ?>images/favicon.ico" type="image/x-icon">
      <link rel="icon" href="<?php echo FRONTEND_URL; ?>images/favicon.ico" type="image/x-icon">
    <title>Facebook Login</title>
    <script src="<?php echo FRONT_JS_PATH; ?>jquery-1.11.2.min.js"></script>
<script>
    $(function(){
        $("#facebook").click(function(){
            window.open("<?php echo FRONTEND_URL;?>auth_oa2/session/facebook/", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=494, height=340");
        });
        
        $("#google").click(function(){
            window.open("<?php echo FRONTEND_URL;?>auth_oa2/session/google/", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=494, height=340");
        });
    });
</script>

</head>

<body>

<button id="facebook">Facebook Login</button>

<button id="google">Google Login</button>

</body>
</html>
