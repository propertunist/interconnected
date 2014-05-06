.elgg-sharing-wrapper-simple
{
    margin-top:10px;
    margin-left:20px;
    clear:both;
    text-align:left;  
}

.elgg-sharing-wrapper-simple, .elgg-sharing-wrapper-simple > label
{
    font-size: 0.9em;
    vertical-align: top;
    padding-right:6px;
}

 .elgg-sharing-wrapper-simple > label {
     position:relative;
     top:6px;
 }

.elgg-sharing-wrapper
{
    display:inline-block;    
    margin:0 !important;
    list-style:none!important;
    padding:0px!important;
}
.elgg-sharing-wrapper li
{
    float:left;
    margin-right: 8px;
    margin-top: 5px;
}
.elgg-button-share-small,.elgg-button-share-large{
    background-size: contain!important;
    color: #000;
    font-size: 15px!important;
    transition: 0.25s ease-in-out;
    line-height:22px;
}

.elgg-button-share-small:hover,.elgg-button-share-large:hover {
    transition: 0s ease-in-out;
}

.elgg-sharing-logo-small,.elgg-sharing-logo-large{
    width:22px;
    height:22px;
    display:inline-block;
    background-size:cover!important;
    background: url('<?php echo elgg_get_site_url() . 'mod/interconnected/graphics/social-sprites-2.png';?>')no-repeat;
}

.elgg-my-profiles{
    float: left;
    width: 200px;
    clear: left;
    margin: 10px 0 20px 25px;
}

.profile-details .elgg-sharing-wrapper 
{
    margin: 10px 0 0 0!important;
}

.elgg-share-count{
    background:white;
    border:1px solid black;
    border-radius:4px;
    color:black;
    padding: 0 3px;
    font-size: 0.9em;  
    display:inline-block;
    float:right;  
    margin-left: -4px;    
}

.elgg-share-count-arrow{
    color:white;
    font-size: 0.8em;
    margin-left: -3px;
    float:right;
    display:inline-block;
}

.elgg-social-shortcut{
    margin:3px;
    display: inline-block;
}

.elgg-button-share-large.elgg-button-twitter, .elgg-button-share-large.elgg-button-email,.elgg-button-share-large.elgg-button-pinterest,
.elgg-button-share-large.elgg-button-stumbleupon,.elgg-button-share-large.elgg-button-googleplus,.elgg-button-share-large.elgg-button-facebook {
    padding: 0 4px 0px 0px!important;
}

 .elgg-button-share-large.elgg-button-linkedin{
     padding: 0 0px 0px 4px!important;
 }

.elgg-button-share-small{
    padding:0px!important;
}

.elgg-button-twitter, .elgg-button-linkedin, .elgg-button-email,.elgg-button-pinterest,
.elgg-button-stumbleupon{
    background: rgb(255,255,255); /* Old browsers */
    background: -moz-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(221,221,221,1) 4%, rgba(150,150,150,1) 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(4%,rgba(221,221,221,1)), color-stop(100%,rgba(150,150,150,1))); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(221,221,221,1) 4%,rgba(150,150,150,1) 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(221,221,221,1) 4%,rgba(150,150,150,1) 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(221,221,221,1) 4%,rgba(150,150,150,1) 100%); /* IE10+ */
    background: linear-gradient(to bottom, rgba(255,255,255,1) 0%,rgba(221,221,221,1) 4%,rgba(150,150,150,1) 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#969696',GradientType=0 ); /* IE6-9 */
    border: 1px solid rgb(123, 123, 123);
}

.elgg-button-twitter:hover, .elgg-button-linkedin:hover,.elgg-button-email:hover,.elgg-button-pinterest:hover,.elgg-button-stumbleupon:hover{
    border: 1px solid rgb(201,201,201);
    background: rgb(255,255,255); /* Old browsers */
    background: -moz-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(248,248,248,1) 4%, rgba(192,192,192,1) 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(4%,rgba(248,248,248,1)), color-stop(100%,rgba(192,192,192,1))); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(248,248,248,1) 4%,rgba(192,192,192,1) 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(248,248,248,1) 4%,rgba(192,192,192,1) 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(248,248,248,1) 4%,rgba(192,192,192,1) 100%); /* IE10+ */
    background: linear-gradient(to bottom, rgba(255,255,255,1) 0%,rgba(248,248,248,1) 4%,rgba(192,192,192,1) 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#c0c0c0',GradientType=0 ); /* IE6-9 */
}

.elgg-button-twitter .elgg-sharing-logo-large, .elgg-button-facebook .elgg-sharing-logo-large, .elgg-button-email .elgg-sharing-logo-large, .elgg-button-googleplus .elgg-sharing-logo-large,.elgg-button-stumbleupon .elgg-sharing-logo-large,.elgg-button-pinterest .elgg-sharing-logo-large {
    margin-right:3px;  
}

.elgg-button-twitter .elgg-sharing-logo-large, .elgg-button-facebook .elgg-sharing-logo-large, .elgg-button-email .elgg-sharing-logo-large, .elgg-button-googleplus .elgg-sharing-logo-large,.elgg-button-stumbleupon .elgg-sharing-logo-large,.elgg-button-pinterest .elgg-sharing-logo-large,.elgg-button-twitter .elgg-sharing-logo-small, .elgg-button-facebook .elgg-sharing-logo-small, .elgg-button-email .elgg-sharing-logo-small, .elgg-button-googleplus .elgg-sharing-logo-small,.elgg-button-stumbleupon .elgg-sharing-logo-small,.elgg-button-pinterest .elgg-sharing-logo-small
{
    float:left;
}

.elgg-button-email .elgg-sharing-logo-small,.elgg-button-email .elgg-sharing-logo-large{
    background-position: -2px!important;
}

.elgg-button-linkedin .elgg-sharing-logo-large{
    margin-left:3px;
}

.elgg-button-linkedin .elgg-sharing-logo-large,.elgg-button-linkedin .elgg-sharing-logo-small
{
   float:right;
   background-position: -154px!important;
}

.elgg-button-twitter .elgg-sharing-logo-small,.elgg-button-twitter .elgg-sharing-logo-large{
    background-position: -78px!important;
}

.elgg-button-googleplus .elgg-sharing-logo-small,.elgg-button-googleplus .elgg-sharing-logo-large{
    background-position: -52px!important;
}

.elgg-button-pinterest .elgg-sharing-logo-small,.elgg-button-pinterest .elgg-sharing-logo-large{
    background-position: -104px!important;
}

.elgg-button-stumbleupon .elgg-sharing-logo-small,.elgg-button-stumbleupon .elgg-sharing-logo-large{
    background-position: -127px!important;
}

.elgg-button-facebook{
    color: rgb(238, 238, 238);
    background: rgb(119,122,163); /* Old browsers */
    background: -moz-linear-gradient(top, rgba(119,122,163,1) 0%, rgba(42,96,198,1) 4%, rgba(48,80,141,1) 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(119,122,163,1)), color-stop(4%,rgba(42,96,198,1)), color-stop(100%,rgba(48,80,141,1))); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, rgba(119,122,163,1) 0%,rgba(42,96,198,1) 4%,rgba(48,80,141,1) 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top, rgba(119,122,163,1) 0%,rgba(42,96,198,1) 4%,rgba(48,80,141,1) 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top, rgba(119,122,163,1) 0%,rgba(42,96,198,1) 4%,rgba(48,80,141,1) 100%); /* IE10+ */
    background: linear-gradient(to bottom, rgba(119,122,163,1) 0%,rgba(42,96,198,1) 4%,rgba(48,80,141,1) 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#777aa3', endColorstr='#30508d',GradientType=0 ); /* IE6-9 */
    border: 1px solid rgb(61, 94, 158);
}

.elgg-button-facebook .elgg-sharing-logo-small,.elgg-button-facebook .elgg-sharing-logo-large {
    background-position: -26px!important;
}
.elgg-button-facebook:hover{
    border: 1px solid rgb(78, 117, 192);
    background: rgb(145,149,196); /* Old browsers */
    background: -moz-linear-gradient(top, rgba(145,149,196,1) 0%, rgba(65,121,225,1) 4%, rgba(54,98,181,1) 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(145,149,196,1)), color-stop(4%,rgba(65,121,225,1)), color-stop(100%,rgba(54,98,181,1))); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, rgba(145,149,196,1) 0%,rgba(65,121,225,1) 4%,rgba(54,98,181,1) 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top, rgba(145,149,196,1) 0%,rgba(65,121,225,1) 4%,rgba(54,98,181,1) 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top, rgba(145,149,196,1) 0%,rgba(65,121,225,1) 4%,rgba(54,98,181,1) 100%); /* IE10+ */
    background: linear-gradient(to bottom, rgba(145,149,196,1) 0%,rgba(65,121,225,1) 4%,rgba(54,98,181,1) 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#9195c4', endColorstr='#3662b5',GradientType=0 ); /* IE6-9 */
}

.elgg-button-googleplus{
    background: rgb(165,120,120); /* Old browsers */
    background: -moz-linear-gradient(top, rgba(165,120,120,1) 0%, rgba(193,47,47,1) 4%, rgba(137,52,52,1) 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(165,120,120,1)), color-stop(4%,rgba(193,47,47,1)), color-stop(100%,rgba(137,52,52,1))); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, rgba(165,120,120,1) 0%,rgba(193,47,47,1) 4%,rgba(137,52,52,1) 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top, rgba(165,120,120,1) 0%,rgba(193,47,47,1) 4%,rgba(137,52,52,1) 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top, rgba(165,120,120,1) 0%,rgba(193,47,47,1) 4%,rgba(137,52,52,1) 100%); /* IE10+ */
    background: linear-gradient(to bottom, rgba(165,120,120,1) 0%,rgba(193,47,47,1) 4%,rgba(137,52,52,1) 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a57878', endColorstr='#893434',GradientType=0 ); /* IE6-9 */
    border: 1px solid rgb(131, 53, 53);
    color: rgb(238, 238, 238);
}

.elgg-button-googleplus:hover{
    background: rgb(198,145,145); /* Old browsers */
    background: -moz-linear-gradient(top, rgba(198,145,145,1) 0%, rgba(255,65,65,1) 4%, rgba(204,30,30,1) 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(198,145,145,1)), color-stop(4%,rgba(255,65,65,1)), color-stop(100%,rgba(204,30,30,1))); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, rgba(198,145,145,1) 0%,rgba(255,65,65,1) 4%,rgba(204,30,30,1) 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top, rgba(198,145,145,1) 0%,rgba(255,65,65,1) 4%,rgba(204,30,30,1) 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top, rgba(198,145,145,1) 0%,rgba(255,65,65,1) 4%,rgba(204,30,30,1) 100%); /* IE10+ */
    background: linear-gradient(to bottom, rgba(198,145,145,1) 0%,rgba(255,65,65,1) 4%,rgba(204,30,30,1) 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c69191', endColorstr='#cc1e1e',GradientType=0 ); /* IE6-9 */
    border: 1px solid rgb(194, 76, 76);
}