!function(e){var t={};function r(s){if(t[s])return t[s].exports;var o=t[s]={i:s,l:!1,exports:{}};return e[s].call(o.exports,o,o.exports,r),o.l=!0,o.exports}r.m=e,r.c=t,r.d=function(e,t,s){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:s})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var s=Object.create(null);if(r.r(s),Object.defineProperty(s,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)r.d(s,o,function(t){return e[t]}.bind(null,o));return s},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="/",r(r.s=3)}({3:function(e,t,r){e.exports=r("RkTt")},RkTt:function(e,t,r){"use strict";$("#userStatusEmoji").emojioneArea({standalone:!0,autocomplete:!1,saveEmojisAs:"shortname",pickerPosition:"right"}),$(document).on("click","#setUserStatus",(function(e){e.preventDefault();var t=$("#userStatusEmoji").data("emojioneArea").getText().trim(),r={emoji:emojione.shortnameToImage(t),emoji_short_name:t,status:$("#userStatus").val()};$.ajax({type:"post",url:setUserCustomStatusUrl,data:r,success:function(e){displayToastr("Success","success",e.message),$("#setCustomStatusModal").modal("hide")},error:function(e){displayToastr("Error","error",e.responseJSON.message)}})})),$(document).on("click","#clearUserStatus",(function(e){e.preventDefault(),$.ajax({type:"get",url:clearUserCustomStatusUrl,success:function(e){$("#userStatus").val(""),$("#userStatusEmoji")[0].emojioneArea.setText(""),displayToastr("Success","success",e.message),$("#setCustomStatusModal").modal("hide")},error:function(e){displayToastr("Error","error",e.responseJSON.message)}})})),""!=loggedInUserStatus&&loggedInUserStatus.hasOwnProperty("status")&&($("#userStatus").val(loggedInUserStatus.status),$("#userStatusEmoji")[0].emojioneArea.setText(loggedInUserStatus.emoji_short_name))}});