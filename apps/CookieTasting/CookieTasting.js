function acceptCookies() {
    $('.CookieMSGOverlay').hide();
    $('#loadC').load('apps/CookieTasting/CookieTasting.php?setcookie');
}

function showCookieInfos() {
    $('#sCLink').hide();
    $('#CookieInfos').show();
    $('.CookieMSG').css('height', '500px');
    $('.CookieMSG').css('overflow-x', 'hidden');
    $('.CookieMSG').css('overflow-y', 'scroll');
}