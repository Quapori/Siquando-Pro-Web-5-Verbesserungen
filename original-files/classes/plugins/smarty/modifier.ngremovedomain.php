<?php

/**
 *
 * Removes teh protocol
 * @param string $string in
 */
function smarty_modifier_ngremovedomain($string) {
    return preg_replace('/^.*?\/\/.*?\//', '/', $string);

}