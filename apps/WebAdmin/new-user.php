<?php
require("../../extensions/password.php");
echo password_hash('admin', PASSWORD_DEFAULT)."\n";
