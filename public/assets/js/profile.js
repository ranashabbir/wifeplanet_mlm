!function(e){var t={};function r(n){if(t[n])return t[n].exports;var o=t[n]={i:n,l:!1,exports:{}};return e[n].call(o.exports,o,o.exports,r),o.l=!0,o.exports}r.m=e,r.c=t,r.d=function(e,t,n){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(r.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)r.d(n,o,function(t){return e[t]}.bind(null,o));return n},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="/",r(r.s=4)}({"2wtg":function(e,t,r){"use strict";$("#editProfileForm").on("submit",(function(e){if(!validateName()||!validateEmail()||!validatePhone())return!1;e.preventDefault();var t=jQuery(this).find("#btnEditSave");t.button("loading"),$.ajax({url:profileURL,type:"post",data:new FormData($(this)[0]),processData:!1,contentType:!1,success:function(e){e.success&&(displayToastr("Success","success",e.message),setTimeout((function(){location.reload()}),2e3))},error:function(e){displayToastr("Error","error",e.responseJSON.message)},complete:function(){t.button("reset")}})})),$(":checkbox:not('.not_checkbox')").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square",increaseArea:"20%"}),$("#upload-photo").on("change",(function(){!function(e){if(e.files&&e.files[0]){var t=new FileReader;t.onload=function(e){$("#upload-photo-img").attr("src",e.target.result)},t.readAsDataURL(e.files[0])}}(this)}));$("#btnCancelEdit").on("click",(function(){$("#editProfileForm").trigger("reset")}));window.printErrorMessage=function(e,t){$(e).show().html(""),$(e).text(t.responseJSON.message)};var n=/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;window.validateName=function(){return""!==$("#user-name").val()||(displayToastr("Error","error","The name field is required."),!1)},window.validateEmail=function(){var e=$("#email").val();return""===e?(displayToastr("Error","error","The email field is required."),!1):!!validateEmailFormat(e)||(displayToastr("Error","error","Please enter valid email."),!1)},window.validateEmailFormat=function(e){return n.test(e)},window.validatePhone=function(){var e=$("#phone").val();return""===e||10===e.length||(displayToastr("Error","error","The phone number must be 10 digits long."),!1)},$("#phone").on("keypress keyup blur",(function(e){if($(this).val($(this).val().replace(/[^\d].+/,"")),8!==e.which&&0!==e.which&&(e.which<48||e.which>57))return e.preventDefault(),!1}));var o=Swal.mixin({customClass:{confirmButton:"btn btn-danger mr-2 btn-lg",cancelButton:"btn btn-secondary btn-lg"},buttonsStyling:!1});$(".remove-profile-img").on("click",(function(e){e.preventDefault(),o.fire({title:"Are you sure?",html:"Your profile image removed by clicking on YES.",icon:"warning",showCancelButton:!0,confirmButtonText:"Yes, remove it!"}).then((function(e){e.value&&$.ajax({type:"DELETE",url:removeProfileImage,success:function(e){displayToastr("Success","success",e.message),setTimeout((function(){location.reload()}),2e3)},error:function(e){displayToastr("Error","error",e.message)}})}))})),$(document).on("click",".changeLanguage",(function(){var e=$(this).data("prefix-value");$.ajax({type:"POST",url:updateLanguageURL,data:{languageName:e},success:function(){location.reload()}})}))},4:function(e,t,r){e.exports=r("2wtg")}});