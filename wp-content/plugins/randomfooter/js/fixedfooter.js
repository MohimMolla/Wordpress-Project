jQuery(document).ready(function(){

    var changeads = function(){
    $i = jQuery("#randomfoot");
    $totalimage = $i.data('totalimg');
$randimg = Math.ceil(Math.random()*10);
$randimg = $randimg%$totalimage?$randimg%$totalimage:1;
// console.log($randimg);

    $currentimage = $i.attr("src");
    $slashpos = $currentimage.lastIndexOf("/");
    $headlink = $currentimage.substring(0,$slashpos+1);
    $totallink = $headlink + "f" + $randimg+".png";
    // console.log($totallink);
    $i.attr("src",$totallink);
    }
    setInterval(changeads,5000);

});