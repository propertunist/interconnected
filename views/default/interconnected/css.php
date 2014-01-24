.elgg-sharing-wrapper-simple
{
    margin-bottom:20px;
    margin-left:20px;  
}

.elgg-sharing-wrapper-simple, .elgg-sharing-wrapper-simple > label
{
    padding-right:5px;
}

.elgg-sharing-wrapper
{
    display:inline-block;    
    margin:0 !important;
    list-style:none!important;
}
.elgg-sharing-wrapper li
{
    float:left;
    margin-right: 8px;
    margin-top: 11px;
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
    background: linear-gradient(to bottom, rgb(255, 255, 255) 0%,rgb(231, 221, 221) 4%,rgb(150, 150, 150) 100%);
    border: 1px solid rgb(123, 123, 123);
}

.elgg-button-twitter:hover, .elgg-button-linkedin:hover,.elgg-button-email:hover,.elgg-button-pinterest:hover,.elgg-button-stumbleupon:hover{
    border: 1px solid rgb(201,201,201);
    background:linear-gradient(to bottom, rgb(255, 255, 255) 0%,rgb(248, 248, 248) 4%,rgb(192, 191, 191) 100%);
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
    background: linear-gradient(to bottom, rgb(47, 48, 65) 0%,rgb(42, 96, 198) 4%,rgb(48, 80, 141) 100%);
    border: 1px solid rgb(61, 94, 158);
    padding: 0 4px 0px 0px!important;
}

.elgg-button-facebook .elgg-sharing-logo{
    background-position: -22px!important;
}
.elgg-button-facebook:hover{
    border: 1px solid rgb(78, 117, 192);
    background: linear-gradient(to bottom, rgb(151, 152, 165) 0%,rgb(65, 121, 225) 4%,rgb(54, 98, 181) 100%);
}

.elgg-button-googleplus{
    background: linear-gradient(to bottom, rgb(101, 73, 73) 0%,rgb(193, 47, 47) 4%,rgb(137, 52, 52) 100%);
    border: 1px solid rgb(131, 53, 53);
    color: rgb(238, 238, 238);
}

.elgg-button-googleplus:hover{
    background: linear-gradient(to bottom, rgb(135, 100, 100) 0%,rgb(225, 65, 65) 4%,rgb(204, 30, 30) 100%);
    border: 1px solid rgb(194, 76, 76);
}