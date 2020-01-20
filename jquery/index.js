
function isEmail(inputEmail) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(inputEmail);
}
function validatePassword(inputPassword) {
	return inputPassword.length > 4;
}

$(document).ready(function(){
    $('#email').change(function(){
        var email = $(this).val().trim();
        // alert(`email = ${JSON.stringify(email)}`)
        if(!isEmail(email)) {
            //Error ?
            $(".emailError").html("Email không hợp lệ");
        } else {
            $(".emailError").html("");
        }
    });
    $('#password').change(function(){
        var password = $(this).val();	
        if(!validatePassword(password)) {
			$(".passwordError").html("Nhập Pass Hơn 5 kí tự");
		} else {
			$(".passwordError").html("");
		}
    });
});
///
$(document).ready(function() {
    $('.navbar a.dropdown-toggle').on('click', function(e) {
       var $el = $(this);
       var $parent = $(this).offsetParent(".dropdown-menu");
       $(this).parent("li").toggleClass('open');
       if(!$parent.parent().hasClass('nav')) {
            $el.next().css({"top": $el[0].offsetTop, "left": $parent.outerWidth() - 4});
       }
       $('.nav li.open').not($(this).parents("li")).removeClass("open");
       return false;
      });
  });

