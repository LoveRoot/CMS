<?php    
    switch ($_GET["component"]) 
    {
        case journal:
            require_once(admin."module/journal.php");
         break;

        case options:
            require_once(admin."module/options.php");
        break;

        case blacklist:
            require_once(admin."module/blacklist.php");
        break;

        case pages:
            require_once(admin."module/category/showcategory.php");
            require_once(admin."module/category/editcategory.php");
            require_once(admin."module/category/createcategory.php");
        break;
        
        case mailing:
            require_once(admin."module/mailing/mailing.php");
        break;
    
        case article:
            require_once(admin."module/pages/article/addarticle.php");
            require_once(admin."module/pages/article/editarticle.php");
        break;

        case faq:
            require_once(admin."module/pages/faq/addfaq.php");
            require_once(admin."module/pages/faq/editfaq.php");
        break;

        case groups:
            require_once(admin."module/groups/groups.php");
        break;

        case slider:
            require_once(admin."module/slider/addcol.php");
            require_once(admin."module/slider/editcol.php");
            require_once(admin."module/slider/slider.php");
        break;

        case users:
            require_once(admin."module/users/users.php");
        break;

        case events:
            require_once(admin."module/events.php");
        break;

        case gallery:
            require_once(admin."module/gallery.php");
        break;

        case referer:
            require_once(admin."module/referer.php");
        break;

        case application:
            require_once(admin."module/applications.php");
        break;

        default:
            require_once(admin."module/journal.php");
    }
?>