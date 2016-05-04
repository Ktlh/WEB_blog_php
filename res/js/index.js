
function redirect(idish) {
    $.ajax({
        type: 'POST',
        url: '../res/ajax_my.php',
        data: {'q':idish},

success: function (data) {
//    alert('record deleted');
    var url = "http://localhost/web/view/adminPage.php";
    $(location).attr('href',url);
    },
    error:function(a,b,c){
        alert(a+b+c);
    }
});
}
$('#exit').click(function(){
    $.ajax({
        type: 'POST',
        url: '../res/ajax_my.php',
        data: {'exit':1},

        success: function () {
            var url = "http://localhost/web/view/main.php";
            $(location).attr('href',url);
    }
//        error:function(a,b,c){
//            alert(a+b+c);
//        }
    });
});
