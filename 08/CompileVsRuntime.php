<?php

// TypeHinting
function typeHintedFunc(User $user) {
    // Do things with user
}


// Run-time class checking
function classCheckFunc($user) {
    if (get_class($user) === 'User') {
        // Do things with user
    } else {
        throw new Exception('First argument for classCheckFunc must be of type User');
    }
}
