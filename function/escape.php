<?php

function h($text) {
    echo htmlspecialchars($text, ENT_QUOTES, "UTF-8");
}