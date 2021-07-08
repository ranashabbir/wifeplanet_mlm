@extends('layouts.index')
@section('title')
    {{ __('messages.conversations') }}
@endsection
@section('page_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/coreui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icheck/skins/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datetime-picker.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.toast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/emojionearea.min.css') }}">


    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ekko-lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/video-js.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new-conversation.css') }}">
    {{--    <link href="https://www.jsviews.com/samples/samples.css" rel="stylesheet" />--}}
@endsection
@section('content')
    <audio id="notificationSound">
        <source src="{{ isset($notification_sound) ? $notification_sound : ''}}" type="audio/mp3">
    </audio>
    <div class="page-wrapper">
        <div class="container-fluid chat-container chat">
            <div class="chat__inner">
                <!-- left section of chat area (chat person selection area) -->
                <div class="chat__people-wrapper chat__people-wrapper--responsive">
                    <div class="chat__people-wrapper-header">
                        <span class="h3 mb-0">{{ __('messages.conversations') }}</span>
                        <div class="d-flex chat__people-wrapper-btn-group">
                            <i class="nav-icon fa fa-bars align-top chat__people-wrapper-bar"></i>
                            @if($enableGroupSetting == 1)
                                @if(Auth::user()->hasRole('admin'))
                                    <div class="chat__people-wrapper-button btn-create-group mr-2" data-toggle="modal"
                                         data-target="#createNewGroup">
                                        <i class="nav-icon group-icon color-green" data-toggle="tooltip"
                                           data-placement="bottom"
                                           title="{{ __('messages.create_new_group') }}"><img
                                                    src="{{asset('assets/icons/group30.png')}}"></i>
                                    </div>
                                @elseif($membersCanAddGroup == 1)
                                    <div class="chat__people-wrapper-button btn-create-group mr-2" data-toggle="modal"
                                         data-target="#createNewGroup">
                                        <i class="nav-icon group-icon color-green" data-toggle="tooltip"
                                           data-placement="bottom"
                                           title="{{ __('messages.create_new_group') }}"><img
                                                    src="{{asset('assets/icons/group30.png')}}"></i>
                                    </div>
                                @endif
                            @endif
                            <div class="chat__people-wrapper-button" data-toggle="modal"
                                 data-target="#addNewChat">
                                <i class="nav-icon " data-toggle="tooltip" data-placement="bottom"
                                   title="{{ __('messages.new_conversation') }}"><img
                                            src="{{asset('assets/icons/chat30.png')}}"></i>
                            </div>
                        </div>
                    </div>
                    <div class="chat__search-wrapper">
                        <div class="chat__search clearfix chat__search--responsive">
                            <i class="fa fa-search"></i>
                            <input type="search" placeholder="{{ __('messages.search') }}" class="chat__search-input"
                                   id="searchUserInput">
                            <i class="fa fa-search d-lg-none chat__search-responsive-icon"></i>
                        </div>
                    </div>
                    <ul class="nav nav-tabs chat__tab-nav" id="chatTabs">
                        <li class="nav-item">
                            <a data-toggle="tab" id="activeChatTab" class="nav-link active" href="#chatPeopleBody">{{__('messages.chats.active_chat')}}</a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="tab" id="archiveChatTab" class="nav-link" href="#archivePeopleBody">{{__('messages.chats.archive_chat')}}</a>
                        </li>
                    </ul>
                    <div class="tab-content chat__tab-content">
                        <div class="chat__people-body tab-pane fade in active show" id="chatPeopleBody">
                            <div id="infyLoader" class="infy-loader chat__people-body-loader">
                                @include('partials.infy-loader')
                            </div>
                            <div class="text-center no-conversation" style="display: none">
                                <div class="chat__no-conversation">
                                    <div class="text-center"><i class="fa fa-2x fa-commenting-o" aria-hidden="true"></i></div>
                                    {{ __('messages.no_conversation_found') }}
                                </div>
                            </div>
                            <div class="text-center no-conversation-yet" style="display: none">
                                <div class="chat__no-conversation">
                                    <div class="text-center"><i class="fa fa-2x fa-commenting-o" aria-hidden="true"></i></div>
                                    {{ __('messages.no_conversation_added_yet') }}
                                </div>
                            </div>
                            <div id="loadMoreConversationBtn" style="display: none">
                                <a href="javascript:void(0)" class="load-more-conversation">Load More</a>
                            </div>
                        </div>
                        <div class="chat__people-body tab-pane fade in active" id="archivePeopleBody">
                            <div class="text-center no-archive-conversation">
                                <div class="chat__no-archive-conversation">
                                    <div class="text-center"><i class="fa fa-2x fa-commenting-o" aria-hidden="true"></i></div>
                                    {{ __('messages.no_conversation_found') }}
                                </div>
                            </div>
                            <div class="text-center no-archive-conversation-yet">
                                <div class="chat__no-archive-conversation">
                                    <div class="text-center"><i class="fa fa-2x fa-commenting-o" aria-hidden="true"></i></div>
                                    {{ __('messages.no_conversation_added_yet') }}
                                </div>
                            </div>
                            <div id="loadMoreArchiverConversationBtn" style="display: none">
                                <a href="javascript:void(0)" class="load-more-archive-conversation">{{__('messages.chats.load_more')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ left section of chat area -->


                <!-- right section of chat area (chat conversation area)-->
                <div class="chat__area-wrapper">
                    @include('chat.no-chat')
                </div>
                <!--/ right section of chat area-->

                <!-- profile section (chat profile section)-->
            @include('chat.chat_profile')
            @include('chat.msg_info')
            <!--/ profile section -->
            </div>
        </div>
        <!-- Modal -->
        <div id="addNewChat" class="modal fade" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <!-- Modal content-->
                <div class="modal-content modal-new-conversation">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title">
                            <i class="ti-user"></i>{{__('messages.group.new_conversations')}} @if($enableGroupSetting == 1) / {{__('messages.group.groups')}} @endif</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <nav class="nav nav-tabs" id="myTab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-my-contacts-tab" data-toggle="tab"
                               href="#nav-my-contacts" role="tab" aria-controls="nav-my-contacts-tab"
                               aria-expanded="true"> <i class="ti-user"></i>{{ __('messages.my_contacts') }}
                            </a> 
                            <a
                                    class="nav-item nav-link wrap-text" id="nav-users-tab" data-toggle="tab"
                                    href="#nav-users"
                                    role="tab" aria-controls="nav-users" aria-expanded="true">
                                <i class="ti-user"></i>{{ __('messages.new_conversation') }}
                            </a>
                            @if($enableGroupSetting == 1)
                            <a
                                    class="nav-item nav-link" id="nav-groups-tab" data-toggle="tab" href="#nav-groups"
                                    role="tab" aria-controls="nav-groups">{{ __('messages.group.groups') }}</a>
                            @endif
                                <a
                                    class="nav-item nav-link" id="nav-blocked-users-tab" data-toggle="tab"
                                    href="#nav-blocked-users" role="tab"
                                    aria-controls="nav-blocked-users">{{ __('messages.blocked_users') }}</a>
                        </nav>

                        <div class="tab-content search-any-member" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-my-contacts" role="tabpanel"
                                 aria-labelledby="nav-my-contacts-tab">
                                @livewire('my-contacts-search', ['myContactIds' => $myContactIds, 'blockUserIds' => $blockUserIds])
                            </div>
                            <div class="tab-pane fade" id="nav-users" role="tabpanel" aria-labelledby="nav-users-tab">
                                @livewire('search-users', ['myContactIds' => $myContactIds, 'blockUserIds' => $blockUserIds])
                            </div>
                            @if($enableGroupSetting == 1)
                            <div class="tab-pane fade" id="nav-groups" role="tabpanel" aria-labelledby="nav-groups-tab">
                                @livewire('group-search')
                            </div>
                            @endif
                            <div class="tab-pane fade show" id="nav-blocked-users" role="tabpanel"
                                 aria-labelledby="nav-blocked-users-tab">
                                @livewire('blocked-user-search', ['blockedByMeUserIds' => $blockedByMeUserIds])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('chat.group_modals')
        @include('chat.edit_group_modals')
        @include('chat.report_user_modal')

        <footer class="footer">
            All right reserved by {{ config('app.name', 'Laravel') }} {{ date('Y') }}
        </footer>
    </div>
    @include('chat.templates.conversation-template')
    @include('chat.templates.message')
    @include('chat.templates.no-messages-yet')
    @include('chat.templates.no-conversation')
    @include('chat.templates.group_details')
    @include('chat.templates.user_details')
    @include('chat.templates.group_listing')
    @include('chat.templates.group_members')
    @include('chat.templates.single_group_member')
    @include('chat.group_members_modal')
    @include('chat.templates.blocked_users_list')
    @include('chat.templates.add_chat_users_list')
    @include('chat.templates.badge_message_template')
    @include('chat.templates.member_options')
    @include('chat.templates.single_message')
    @include('chat.templates.contact_template')
    @include('chat.templates.conversations_list')
    @include('chat.templates.common_templates')
    @include('chat.templates.my_contacts_listing')
    @include('chat.templates.conversation-request')
    @include('chat.copyImageModal')
@endsection
@section('page_js')
    <script src="{{ asset('js/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/ekko-lightbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/video.min.js') }}"></script>
@endsection
@section('scripts')
    <!--custom js-->
    <script>
        let userURL = '{{url('users')}}/';
        let userListURL = '{{url('users-list')}}';
        let conversationListURL = '{{url('conversations-list')}}';
        let archiveConversationListURL = '{{url('archive-conversations')}}';
        let chatSelected = false;
        let sendMessageURL = '{{route('conversations.store')}}';
        let fileUploadURL = '{{route('file-upload')}}';
        let imageUploadURL = '{{route('image-upload')}}';
        let csrfToken = '{{csrf_token()}}';
        let authUserName = '{{ Auth::user()->name }}';
        let readMessageURL = '{{url('read-message')}}';
        let authImgURL = '{{Auth::user()->photo_url}}';
        let deleteConversationUrl = '{{url('conversations')}}/';
        let deleteMessageUrl = '{{url('conversations/message')}}/';
        let createGroupURL = '{{url('groups')}}';
        let getUsers = '{{url('get-users')}}';
        let groupsList = '{{url('groups')}}';
        let appName = '{{ getAppName() }}';
        let conversationId = '{{ $conversationId }}';
        let sendChatReqURL = '{{route('send-chat-request')}}';
        let acceptChatReqURL = '{{route('accept-chat-request')}}';
        let declineChatReqURL = '{{route('decline-chat-request')}}';
        let enableGroupSetting = '{{ isGroupChatEnabled() }}';
        let reportUserURL = '{{route('report-user.store')}}';
        let authRole = "{{ Auth::user()->role_name }}";
        
        /** Icons URL */
        let pdfURL = '{{ asset('assets/icons/pdf.png') }}';
        let xlsURL = '{{ asset('assets/icons/xls.png') }}';
        let textURL = '{{ asset('assets/icons/text.png') }}';
        let docsURL = '{{ asset('assets/icons/docs.png') }}';
        let videoURL = '{{ asset('assets/icons/video.png') }}';
        let youtubeURL = '{{ asset('assets/icons/youtube.png') }}';
        let audioURL = '{{ asset('assets/icons/audio.png') }}';
        let zipURL = '{{ asset('assets/icons/zip.png') }}';
        let isUTCTimezone = '{{(config('app.timezone') == 'UTC') ? 1  :0 }}';
        let timeZone = '{{config('app.timezone')}}';
        let blockedUsersListObj = JSON.parse('{!! json_encode($blockUserIds) !!}');
        let myContactIdsObj = JSON.parse('{!! json_encode($myContactIds) !!}');
        let groupMembers = [];
    </script>
    <script src="{{ asset('assets/js/chat.js') }}"></script>
@endsection
