<?php

namespace Gehog\StaticPages;

/**
 * Add single callback to multiple filters
 *
 * @param array $filters
 * @param callable $callback
 * @param int $priority
 * @param int $args
 * @return void
 */
function add_filters($filters, $callback, $priority = 10, $args = 2) {
    $count = count($filters);
    array_map(
        '\add_filter',
        $filters,
        array_fill(0, $count, $callback),
        array_fill(0, $count, $priority),
        array_fill(0, $count, $args)
    );
}

/**
 * Remove single callback from multiple filters
 *
 * @param array $filters
 * @param callable $callback
 * @param int $priority
 * @return void
 */
function remove_filters($filters, $callback, $priority = 10) {
    $count = count($filters);
    array_map('\remove_filter', $filters, array_fill(0, $count, $callback), array_fill(0, $count, $priority));
}

/**
 * Alias of add_filters
 *
 * @see add_filters
 * @param  array $actions
 * @param  callable $callback
 * @param  integer  $priority
 * @param  integer  $args
 * @return void
 */
function add_actions($actions, $callback, $priority = 10, $args = 2) {
    add_filters($actions, $callback, $priority, $args);
}

/**
 * Alias of remove_filters
 *
 * @see remove_filters
 * @param  array $actions
 * @param  callable $callback
 * @param  integer  $priority
 * @return void
 */
function remove_actions($actions, $callback, $priority = 10) {
    remove_filters($actions, $callback, $priority);
}
