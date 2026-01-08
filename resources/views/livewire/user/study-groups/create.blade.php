<div class="max-w-xl mx-auto bg-white shadow p-6 rounded-lg">

    <h1 class="text-2xl font-bold mb-4">Create Study Group</h1>

    <form wire:submit.prevent="save">

        <!-- Group Name -->
        <div class="mb-3">
            <label class="font-semibold">Group Name</label>
            <input type="text" wire:model="name" class="w-full border p-2 rounded">
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label class="font-semibold">Description</label>
            <textarea wire:model="description" class="w-full border p-2 rounded"></textarea>
        </div>

        <!-- Subject -->
        <div class="mb-3">
            <label class="font-semibold">Subject</label>
            <input type="text" wire:model="subject" class="w-full border p-2 rounded">
        </div>

        <!-- Visibility -->
        <div class="mb-3">
            <label class="font-semibold">Visibility</label>
            <select wire:model="visibility" class="w-full border p-2 rounded">
                <option value="public">Public</option>
                <option value="private">Private</option>
            </select>
        </div>

        <!-- Cover Image -->
        <div class="mb-3">
            <label class="font-semibold">Cover Image</label>
            <input type="file" wire:model="cover_image" class="w-full border p-2 rounded">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Create Group</button>
    </form>
</div>
