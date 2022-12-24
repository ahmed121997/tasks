if($('.message')[0]){
    setTimeout(function () {
        $('.message').fadeOut();
    },7000);
}
function myFunction(){
    $( "td:contains('Not Done')" ).css({
        "background": "#c33d4a",
        "color" : "#FFF"

});}
setTimeout(myFunction, 700);
