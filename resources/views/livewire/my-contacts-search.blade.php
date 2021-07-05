<div>
<form class="mb-2">
    <input type="search" class="form-control search-input" id="searchMyContactForChat"
           placeholder="{{ __('messages.search') }}..." wire:model="searchTerm">
</form>
<div class="form-group">
    <div class="col-sm-12 d-flex justify-content-around">
        <div class="custom-control custom-checkbox">
            <input name="my_contacts_filter" value="1" type="checkbox" class="custom-control-input group-type"
                   id="male" wire:model="male">
            <label class="custom-control-label" for="male">{{ __('messages.male') }}</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input name="my_contacts_filter" value="2" type="checkbox" class="custom-control-input group-type"
                   id="female" wire:model="female">
            <label class="custom-control-label" for="female">{{ __('messages.female') }}</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input name="my_contacts_filter" value="3" type="checkbox" class="custom-control-input group-type"
                   id="online" wire:model="online">
            <label class="custom-control-label" for="online">{{ __('messages.online') }}</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input name="my_contacts_filter" value="4" type="checkbox" class="custom-control-input group-type"
                   id="offline" wire:model="offline">
            <label class="custom-control-label" for="offline">{{ __('messages.offline') }}</label>
        </div>
    </div>
</div>
<div id="myContactListForAddPeople">
    <ul class="list-group user-list-chat-select list-with-filter" id="myContactListForChat">
        @foreach($users as $key => $user)
            <li class="list-group-item user-list-chat-select__list-item align-items-center chat-user-{{ $user->id }} {{ getGender($user->gender) }} {{ getOnOffClass($user->is_online) }}">
                <input type="hidden" class="add-chat-user-id" value="{{ $user->id }}">
                <div class="new-conversation-img-status position-relative mr-2 user-{{ $user->id }}"
                     data-status="{{$user->is_online}}">
                    <div class="chat__person-box-status @if ($user->is_online) chat__person-box-status--online @else chat__person-box-status--offline @endif"></div>
                    <div class="new-conversation-img-status__inner">
                        <img src="{{$user->photo_url}}" alt="user-avatar-img" class="user-avatar-img add-user-img">
                    </div>
                </div>
                <div>
                    <span class="add-user-contact-name">{{ $user->name }}
                        <span class="my-contact-user-status" data-status="{{ checkUserStatusForGroupMember($user->userStatus) }}">
                        @if (checkUserStatusForGroupMember($user->userStatus))
                            <i class="nav-icon user-status-icon" data-toggle="tooltip" data-placement="top"
                               title="{{$user->userStatus->status}}" data-original-title="{{$user->userStatus->status}}">
                                {!! $user->userStatus->emoji  !!}
                            </i>
                        @endif
                        </span>
                    </span>
                    <div class="align-self-center">{{ $user->email }}</div>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="text-center no-my-contact new-conversation__no-my-contact @if(count($users) > 0) d-none @endif">
        <div class="chat__not-selected">
            <div class="text-center"><i class="fa fa-2x fa-user" aria-hidden="true"></i>
            </div>
            {{ ($myContactsCount > 0) ? __('messages.no_user_found') : __('messages.no_conversation_added_yet') }}
        </div>
    </div>
</div>
</div>
