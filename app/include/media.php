<?php

/*
 * Image sizes
 */

function _addImageSizes() {
    add_image_size('heading-image', 1920, 9999999);
}

add_action('init', '_addImageSizes');