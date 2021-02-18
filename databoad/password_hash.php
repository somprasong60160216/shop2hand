<?php



$hash = password_hash("user", PASSWORD_DEFAULT);



if (password_verify('user', $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}

?>