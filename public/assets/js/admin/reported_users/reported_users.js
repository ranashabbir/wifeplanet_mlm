!function(e){var t={};function r(n){if(t[n])return t[n].exports;var o=t[n]={i:n,l:!1,exports:{}};return e[n].call(o.exports,o,o.exports,r),o.l=!0,o.exports}r.m=e,r.c=t,r.d=function(e,t,n){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(r.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)r.d(n,o,function(t){return e[t]}.bind(null,o));return n},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="/",r(r.s=14)}({14:function(e,t,r){e.exports=r("BQjx")},BQjx:function(e,t,r){"use strict";$(document).ready((function(){var e=$("#reportedUsersTable").DataTable({processing:!0,serverSide:!0,bStateSave:!0,order:[[2,"desc"]],ajax:{url:reportedUsersUrl},columnDefs:[{targets:[3,4],orderable:!1,className:"text-center",width:"7%"},{targets:[2],width:"10%"}],columns:[{data:function(e){return htmlSpecialCharsDecode(e.reported_by.name)},name:"reported_by.name"},{data:function(e){return htmlSpecialCharsDecode(e.reported_to.name)},name:"reported_to.name"},{data:function(e){return e},render:function(e){return'<span data-toggle="tooltip" title="'+format(e.created_at,"hh:mm:ss a")+'">'+format(e.created_at)+"</span>"},name:"created_at"},{data:function(e){return e.reported_to.id==loggedInUserId?e.reported_to.is_active?"Active":"Deactive":(e.checked=0===e.reported_to.is_active?"":"checked",$.templates("#isActiveSwitch").render(e))},name:"id"},{data:function(e){return $.templates("#viewDelIcons").render(e)},name:"id"}],drawCallback:function(){this.api().state.clear(),$('[data-toggle="tooltip"]').tooltip()}});window.format=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"DD-MMM-YYYY";return moment(e).format(t)};var t=Swal.mixin({customClass:{confirmButton:"btn btn-danger mr-2 btn-lg",cancelButton:"btn btn-secondary btn-lg"},buttonsStyling:!1});$(document).on("click",".delete-btn",(function(){var e=$(this).data("id");!function(e,r,n){arguments.length>3&&void 0!==arguments[3]&&arguments[3];t.fire({title:"Are you sure?",html:"you want to delete this record ?",icon:"warning",showCancelButton:!0,confirmButtonText:"Delete"}).then((function(t){t.value&&deleteItemAjax(e,r,n,null)}))}(reportedUsersUrl+"/"+e,"#reportedUsersTable","Reported User")})),$(document).on("click",".view-btn",(function(){var e=$(this).data("id"),t=reportedUsersUrl+"/"+e;$.ajax({type:"GET",url:t,success:function(e){$(".reported-user-notes").html(e.notes),$(".reported-by").text(e.reported_by.name),$(".reported-to").text(e.reported_to.name),$("#viewReportNoteModal").modal("show")}})})),$(document).on("change",".is-active",(function(e){var t=$(e.currentTarget).data("id");activeDeActiveUser(t)})),window.activeDeActiveUser=function(t){$.ajax({url:usersUrl+"/"+t+"/active-de-active",method:"post",cache:!1,success:function(t){t.success&&e.ajax.reload(null,!1)},error:function(e){displayToastr("Error","error",e.responseJSON.message)}})}}))}});