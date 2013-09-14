<?php

/*
 * Template to display product search form
 * 
 */
?>

<form id="searchform" action="http://localhost/wordpress/" method="get" role="search">
    <div>
        <input id="s" type="text" placeholder="Search for products" name="s" value="">
        <input id="searchsubmit" type="submit" value="Search">
        <input type="hidden" value="product" name="post_type">
    </div>
</form>
