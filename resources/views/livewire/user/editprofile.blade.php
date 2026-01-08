<form wire:submit.prevent="save" class="space-y-4">
    <input type="text" wire:model="subject"
        placeholder="Subject"
        class="w-full border rounded-xl p-3">

    <input type="text" wire:model="graduation_year"
        placeholder="Graduation Year"
        class="w-full border rounded-xl p-3">

    <input type="text" wire:model="location"
        placeholder="Location"
        class="w-full border rounded-xl p-3">

    <textarea wire:model="bio"
        placeholder="Write about yourself..."
        class="w-full border rounded-xl p-3"></textarea>

    <button type="submit"
        class="bg-indigo-600 text-white px-6 py-2 rounded-xl">
        Save
    </button>
</form>
