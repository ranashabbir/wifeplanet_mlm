<div class="relative">
    <div class="row new-group-members">
        <div class="col-6 new-members">
            <input
                    type="search"
                    class="form-control"
                    placeholder="Search Members..."
                    wire:ignore
                    id="searchMember"
            />
            <ul class="absolute z-10 list-group bg-white w-full group-members-list new-group-members__list">
                @foreach($contacts as $i => $contact)
                    <li class="list-group-item group-members-list-chat-select__list-item align-items-center d-flex justify-content-between">
                        <div class="d-flex">
                            <input type="hidden" class="add-group-user-id" value="{{ $contact['id'] }}">
                            <div class="new-conversation-img-status position-relative mr-2 user-{{ $contact['id'] }}"
                                 data-status="0" data-is-group="1">
                                <div class="new-conversation-img-status__inner">
                                    <img src="{{ $contact['photo_url'] }}" alt="user-avatar-img"
                                         class="user-avatar-img add-user-img">
                                </div>
                            </div>
                            <div>
                                <span class="add-user-contact-name align-self-center">{{ $contact['name'] }}</span>
                                <div class="align-self-center">{{ $contact['email'] }}</div>
                            </div>
                        </div>
                        <span class="btn btn-sm btn-success float-right add-group-member" data-id="{{ $contact['id'] }}">Add</span>
                    </li>
                @endforeach
                <div class="text-center no-member-found h-110 {{ count($contacts) > 0 ? 'd-none' : '' }}">
                    <div class="chat__not-selected">
                        <div class="text-center"><i class="fa fa-2x fa-user" aria-hidden="true"></i>
                        </div>
                        <span>{{__('messages.no_member_found')}}</span>
                    </div>
                </div>
            </ul>
        </div>
        <div class="col-6 added-members" wire:ignore>
            <ul class="absolute z-10 list-group bg-white w-full added-group-members-list new-group-members__added-member-list">
                <div class="text-center no-member-added h-130">
                    <div class="chat__not-selected">
                        <div class="text-center"><i class="fa fa-2x fa-user" aria-hidden="true"></i>
                        </div>
                        <span>{{__('messages.no_member_added_yet')}}</span>
                    </div>
                </div>
            </ul>
        </div>
    </div>
    {!! Form::hidden('users', json_encode($members), ['id' => 'selectedGroupMembers']) !!}
</div>

@push('scripts')
    <script>
        let addedMembers = [];
    </script>
@endpush
