!function(e){var t={};function r(a){if(t[a])return t[a].exports;var n=t[a]={i:a,l:!1,exports:{}};return e[a].call(n.exports,n,n.exports,r),n.l=!0,n.exports}r.m=e,r.c=t,r.d=function(e,t,a){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:a})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var a=Object.create(null);if(r.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)r.d(a,n,function(t){return e[t]}.bind(null,n));return a},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="/",r(r.s=8)}({8:function(e,t,r){e.exports=r("uToX")},uToX:function(e,t,r){"use strict";$(document).ready((function(){$("#filter_user").select2({minimumResultsForSearch:-1,placeholder:"Select Status (ALL)"});var e=$("#users_table").DataTable({processing:!0,serverSide:!0,bStateSave:!0,order:[[1,"asc"]],ajax:{url:usersUrl,data:function(e){e.filter_user=$("#filter_user").find("option:selected").val()}},columnDefs:[{targets:[0,5,6,7],orderable:!1,className:"text-center",width:"7%"},{targets:[4],className:"text-center",width:"5%"},{targets:[3],className:"text-center",width:"10%"}],columns:[{data:function(e){return' <img src="'+e.photo_url+'" class="user-avatar-img" alt="User Image">'},name:"id",searchable:!1},{data:function(e){return htmlSpecialCharsDecode(e.name)},name:"name"},{data:"email",name:"email"},{data:"phone",name:"phone"},{data:function(e){var t=getRoleName(e.roles);return htmlSpecialCharsDecode(t)},name:"role_name",searchable:!1},{data:function(e){return e.privacy?"Public":"Private"},name:"privacy",searchable:!1},{data:function(e){var t=0===e.is_active?"":"checked";return' <label class="switch switch-label switch-outline-primary-alt"><input name="is_active" data-id="'+e.id+'" class="switch-input is-active" type="checkbox" value="1" '+t+'><span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span></label>'},name:"id"},{data:function(e){var t={isArchive:isArchive};return $.templates("#tmplAddChatUsersList").render(e,t)},name:"id"}],drawCallback:function(){this.api().state.clear()},fnInitComplete:function(){$("#filter_user").change((function(){e.ajax.reload()}))}});window.isArchive=function(e){return null!=e?1:0},window.getRoleName=function(e){var t="";return $.each(e,(function(e,r){return t=r.name,!1})),t},$("#createUserForm").on("submit",(function(e){e.preventDefault();var t=jQuery(this).find("#createBtnSave");t.button("loading"),$.ajax({url:createUserUrl,type:"post",data:new FormData($(this)[0]),processData:!1,contentType:!1,success:function(e){e.success&&(displayToastr("Success","success",e.message),$("#create_user_modal").modal("hide"),$("#users_table").DataTable().ajax.reload(null,!1))},error:function(e){displayToastr("Error","error",e.responseJSON.message)},complete:function(){t.button("reset")}})})),$("#editUserForm").on("submit",(function(e){e.preventDefault();var t=jQuery(this).find("#editBtnSave");t.button("loading");var r=$("#edit_user_id").val();$.ajax({url:usersUrl+r+"/update",type:"post",data:new FormData($(this)[0]),processData:!1,contentType:!1,success:function(e){e.success&&(displayToastr("Success","success",e.message),$("#edit_user_modal").modal("hide"),$("#users_table").DataTable().ajax.reload(null,!1))},error:function(e){displayToastr("Error","error",e.responseJSON.message)},complete:function(){t.button("reset")}})})),$(document).on("click",".edit-btn",(function(){var e=$(this).data("id");renderData(usersUrl+e+"/edit")})),window.renderData=function(e){$.ajax({url:e,type:"GET",success:function(e){if(e.success){var t=e.data.user;$("#edit_user_id").val(t.id),$("#edit_name").val(htmlSpecialCharsDecode(t.name)),$("#edit_email").val(t.email),$("#edit_phone").val(t.phone),$("#edit_is_active").val(t.is_active),$("#edit_role_id").val(t.role_id),$("#edit_upload-photo-img").attr("src",t.photo_url),$("#edit_about").val(htmlSpecialCharsDecode(t.about)),$("#edit_user_modal").modal("show"),1==t.gender&&$("#edit_male").prop("checked",!0),2==t.gender&&$("#edit_female").prop("checked",!0),1==t.privacy?$("#editPrivacyPublic").prop("checked",!0):$("#editPrivacyPrivate").prop("checked",!0)}},error:function(e){displayToastr("Error","error",e.responseJSON.message)}})};var t=Swal.mixin({customClass:{confirmButton:"btn btn-danger mr-2 btn-lg",cancelButton:"btn btn-secondary btn-lg"},buttonsStyling:!1});function r(e,t){$(e)[0].reset(),$(t).hide()}$(document).on("click",".delete-btn",(function(e){var r=$(this).data("id");!function(e,r,a){arguments.length>3&&void 0!==arguments[3]&&arguments[3];t.fire({title:"Are you sure?",html:'Are you sure you want to delete this "'+a+'" ?',icon:"warning",showCancelButton:!0,confirmButtonText:"Delete",input:"text",inputPlaceholder:'Write "delete" to delete this user',inputValidator:function(e){if("delete"!==e)return'You need to write "delete"'}}).then((function(t){t.value&&deleteItemAjax(e,r,a,null)}))}(usersUrl+r,"#users_table","User")})),$(document).on("click",".archive-btn",(function(){var e=$(this).data("id");!function(e,r,a){arguments.length>3&&void 0!==arguments[3]&&arguments[3];t.fire({title:"Are you sure?",input:"text",inputPlaceholder:'Write "archive" to archive this user',html:'want to archive this "'+a+'" ? After archive all its conversations will be archive.',icon:"warning",showCancelButton:!0,confirmButtonText:"Archive",inputValidator:function(e){if("archive"!==e)return'You need to write "archive"'}}).then((function(t){t.value&&archiveItemAjax(e,r,a,null)}))}(usersUrl+e+"/archive","#users_table","User")})),window.archiveItemAjax=function(e,t,r){arguments.length>3&&void 0!==arguments[3]&&arguments[3];$.ajax({url:e,type:"DELETE",dataType:"json",success:function(e){e.success&&$(t).DataTable().ajax.reload(null,!1),displayToastr("Success","success",e.message)},error:function(e){displayToastr("Error","error",e.responseJSON.message)}})},$(document).on("click",".restore-btn",(function(e){var t=$(this).data("id");!function(e,t,r,a){swal.fire({title:"Are you sure?",html:'want to restore this "'+r+'" ?',icon:"warning",showCancelButton:!0,confirmButtonText:"Restore"}).then((function(n){n.value&&restoreItemAjax(e,t,r,a)}))}(usersUrl+"restore","#users_table","User",t)})),window.restoreItemAjax=function(e,t,r,a){$.ajax({url:e,type:"POST",data:{id:a},dataType:"json",success:function(e){e.success&&$(t).DataTable().ajax.reload(null,!1),displayToastr("Success","success",r+" has been restored.")},error:function(e){displayToastr("Error","error",e.responseJSON.message)}})},$("#create_user_modal").on("hidden.bs.modal",(function(){r("#createUserForm","#validationErrorsBox"),$("#upload-photo-img").attr("src",defaultImageAvatar)})),$("#edit_user_modal").on("hidden.bs.modal",(function(){r("#editUserForm","#editValidationErrorsBox")})),$(document).on("change",".is-active",(function(e){var t=$(e.currentTarget).data("id");activeDeActiveUser(t)})),window.activeDeActiveUser=function(e){$.ajax({url:usersUrl+e+"/active-de-active",method:"post",cache:!1,success:function(e){e.success&&$("#users_table").DataTable().ajax.reload(null,!1)}})},window.validatePasswordConfirmation=function(){return""!==$("#confirm_password").val()||(displayToastr("Error","error","The password confirmation field is required."),!1)},window.validateMatchPasswords=function(){return $("#confirm_password").val()===$("#password").val()||(displayToastr("Error","error","The password and password confirmation did not match."),!1)},window.validatePassword=function(){return""!==$("#password").val()||(displayToastr("Error","error","The password field is required."),!1)}}))}});