<?php

function show($stuff)
{
    echo "<pre></pre>";
    print_r($stuff);
    echo "</pre>";
}

function esc($str)
{
    return htmlspecialchars($str);
}

function redirectToHome($path)
{
    header("Location: " . ROOT. '/' .$path);
    die;
}
