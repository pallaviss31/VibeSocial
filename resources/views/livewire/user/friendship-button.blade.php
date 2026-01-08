<div>
    @if($friendshipStatus === 'not_friends')
        <button wire:click="sendFriendRequest" class="w-full bg-indigo-50 hover:bg-indigo-100 text-indigo-600 font-bold px-4 py-2 rounded-xl text-sm transition flex items-center justify-center gap-2 whitespace-nowrap">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
            Connect
        </button>
    @elseif($friendshipStatus === 'request_sent')
        <button wire:click="cancelFriendRequest" class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-4 py-2 rounded-xl text-sm transition whitespace-nowrap">
            Cancel Request
        </button>
    @elseif($friendshipStatus === 'request_received')
        <div class="flex flex-col gap-2 w-full">
            <button wire:click="acceptFriendRequest" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-4 py-2 rounded-xl text-sm transition whitespace-nowrap shadow-md shadow-indigo-200">
                Accept
            </button>
            <button wire:click="rejectFriendRequest" class="w-full bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold px-4 py-2 rounded-xl text-sm transition whitespace-nowrap">
                Ignore
            </button>   
        </div>
    @elseif($friendshipStatus === 'friends')
        <button  class="w-full bg-green-50 hover:bg-green-100 text-green-600 font-bold px-4 py-2 rounded-xl text-sm transition flex items-center justify-center gap-2 whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            Classmates
        </button>
        <span wire:click="unfriend" class="text-xs text-slate-500 underline cursor-pointer mt-1 px-3 py-2 text-center">Remove Classmate</span>
    @endif
</div>