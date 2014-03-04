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
.elgg-button-share{
    background-size: contain!important;
    color: #000;
    font-size: 15px!important;
    transition: 0.25s ease-in-out;
    line-height:22px;
}

.elgg-button-share:hover {
    transition: 0s ease-in-out;
}

.elgg-sharing-logo{
    width:22px;
    height:22px;
    display:inline-block;
    background-size:cover!important;
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

.elgg-social-shortcut{
    margin:3px;
    display: inline-block;
}

.elgg-sharing-logo{
    background: url('<?php echo elgg_get_site_url() . 'mod/interconnected/graphics/social-sprites.png';?>')no-repeat;
}

.elgg-button-twitter, .elgg-button-email,.elgg-button-pinterest,
.elgg-button-stumbleupon,.elgg-button-googleplus {
    padding: 0 4px 0px 0px!important;
}

 .elgg-button-linkedin{
     padding: 0 0px 0px 4px!important;
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

.elgg-button-twitter .elgg-sharing-logo, .elgg-button-facebook .elgg-sharing-logo, .elgg-button-email .elgg-sharing-logo, .elgg-button-googleplus .elgg-sharing-logo,.elgg-button-stumbleupon .elgg-sharing-logo,.elgg-button-pinterest .elgg-sharing-logo {
    float:left;
    margin-right:3px;  
}

.elgg-button-linkedin .elgg-sharing-logo{
    float:right;
    margin-left:3px;
    background-position: -132px!important;
}

.elgg-button-twitter .elgg-sharing-logo{
    background-position: -66px!important;
}

.elgg-button-googleplus .elgg-sharing-logo{
    background-position: -44px!important;
}

.elgg-button-pinterest .elgg-sharing-logo{
    background-position: -87px!important;
}

.elgg-button-stumbleupon .elgg-sharing-logo{
    background-position: -109px!important;
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
    padding: 0 4px 0px 0px!important;
}

.elgg-button-facebook .elgg-sharing-logo{
    background-position: -22px!important;
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