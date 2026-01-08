<div class="space-y-4">

    @foreach($requests as $req)
    <div class="p-4 bg-white border rounded">
        <p>{{ $req->user->name }} wants to join</p>

        <div class="flex gap-2 mt-2">
            <button wire:click="approve({{ $req->id }})"
                class="px-3 py-1 bg-green-600 text-white rounded">Approve</button>

            <button wire:click="reject({{ $req->id }})"
                class="px-3 py-1 bg-red-600 text-white rounded">Reject</button>
        </div>
    </div>
    @endforeach

</div>
