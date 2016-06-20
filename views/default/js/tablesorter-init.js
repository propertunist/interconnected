/* 
 * initialise tablesorter jquery plugin for interconnected plugin admin area
 * @package: interconnected
 * author: ura soul
 */

define(function(require) 
{
    var $ = require('jquery');  
    var tablesorter = require('tablesorter');  
    $(document).ready(function()
    {
            $("#social_counts_table").tablesorter({sortList: [[12,1]]}); 
    });
});