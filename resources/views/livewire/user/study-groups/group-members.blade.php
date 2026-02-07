<div class="p-6 space-y-4">
    <h2 class="text-lg font-bold text-slate-800">Group Members</h2>

    <div class="bg-white rounded-xl border divide-y">
        @foreach ($group->members as $member)
            <div wire:key="member-{{ $member->id }}" class="flex items-center justify-between p-4">

                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold">
                        {{ strtoupper(substr($member->user->fname, 0, 1)) }}
                    </div>

                    <div>
                        <p class="font-semibold text-slate-700">{{ $member->user->fname }}</p>
                        <p class="text-xs text-slate-400">{{ $member->user->email }}</p>
                    </div>

                    <span class="ml-2 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase
                        {{ $member->role === 'admin' ? 'bg-indigo-100 text-indigo-600' : 'bg-slate-100 text-slate-500' }}">
                        {{ $member->role }}
                    </span>
                </div>

                <div class="flex gap-2 text-xs font-semibold">

                    @can('makeAdmin', [$group, $member->user])
                        @if ($member->role !== 'admin')
                            <button type="button"
                                wire:click="makeAdmin({{ $member->user_id }})"
                                class="text-indigo-600 hover:underline">
                                Make Admin
                            </button>
                        @endif
                    @endcan

                    @can('removeAdmin', [$group, $member->user])
                        @if ($member->role === 'admin')
                            <button type="button"
                                wire:click="removeAdmin({{ $member->user_id }})"
                                class="text-amber-600 hover:underline">
                                Remove Admin
                            </button>
                        @endif
                    @endcan

                    @can('manageMembers', [$group, $member->user])
                        <button type="button"
                            wire:click="removeMember({{ $member->user_id }})"
                            class="text-red-600 hover:underline">
                            Remove Member
                        </button>
                    @endcan

                </div>
            </div>
        @endforeach
    </div>
</div>
