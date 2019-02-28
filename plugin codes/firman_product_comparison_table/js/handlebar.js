$(function () {

//$(document).ready(function(){

  var theTemplateScript = $("#product125").html();
  var theTemplate = Handlebars.compile(theTemplateScript);

  var context={
    "city": " Cagayan ",
    "street": " Rizal street ",
    "number": " 12588 "
  };

  var theCompiledHtml = theTemplate(context);

  $('.content-placeholder').html(theCompiledHtml);

 //} 

});
