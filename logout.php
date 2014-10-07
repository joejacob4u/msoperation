<?PHP

session_start();
session_destroy();
echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('You have been logged out!')
        window.location.href='index.html'
        </SCRIPT>");?>