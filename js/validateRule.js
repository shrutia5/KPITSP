$(document).ready(function(){
$.validator.addMethod("pwcheck", function(value) {
    //return /^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).*$/.test(value)
    return /^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?\W).*$/.test(value);
});
$.validator.addMethod("alpha", function(value) {
    return /^[a-zA-Z]+$/.test(value);
});
$.validator.addMethod("fullEmail", function(value) {
    return /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i.test(value)
});
$.validator.addMethod("mobileNo", function(value) {
    return /^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[6789]\d{9}$/i.test(value)
});
$.validator.addMethod( "extension", function( value, element, param ) {
    param = typeof param === "string" ? param.replace( /,/g, "|" ) : "png|jpe?g|pdf";
    return this.optional( element ) || value.match( new RegExp( "\\.(" + param + ")$", "i" ) );
}, $.validator.format( "Please enter a value with a valid extension." ) );

$.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-z]+$/i.test(value);
  }, "Letters only please"); 

  alertify.set('notifier','position', 'top-right');
      $.validator.addMethod("fullEmail", function(value) {
        return /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i.test(value)
    });
    $.validator.addMethod("pwcheck", function(value) {
      //return /^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).*$/.test(value)
      return /^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?\W).*$/.test(value);
  });
    $.validator.addMethod("alpha", function(value) {
      return /^[a-zA-Z]+$/.test(value);
  });
  
});
