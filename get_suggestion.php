<?php
    require('config.php');
    if( isset( $_REQUEST['keyword'] ) )
    {
 
        $keyword        =       $_REQUEST['keyword'];
        $query          =       "SELECT quality from quality WHERE state LIKE '$keyword%'";
        $result         =       mysql_query($query);
        $html           =       "";
        while ( $row    =       mysql_fetch_array($result) )
        {
            $html   .='<li>'.$row['quality'].'</li>';
        }
 
        echo $html;
 
    }
?>