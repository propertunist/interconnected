<?php
/*
*
* share count Table creator
*
*/

// create tables if not exist
$prefix = elgg_get_config('dbprefix');
$tables = get_db_tables();
if (! in_array("{$prefix}social_share_counts", $tables)) {
    run_sql_script(__DIR__ . '/sql/create_share_count_table.sql');
    error_log("database table created: {$prefix}social_share_counts");
}