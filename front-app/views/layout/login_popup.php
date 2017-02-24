<?php

if($this->nsession->userdata('USER_ID')!=''){ ?>
    <script>
        window.onload = function(){
         window.close();
        }
        
        window.onunload = function() {
            window.opener.location.reload();
        }

    </script>
<?php }
?>