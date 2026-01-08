<div class="bg-white p-6 rounded-xl shadow-md">

    <h2 class="text-xl font-semibold mb-4">Upload New Document</h2>

    @if (session()->has('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    




    <div class="bg-white p-6 rounded-xl shadow-md">

    <h2 class="text-xl font-semibold mb-4">Upload New Document</h2>

    @if (session()->has('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="uploadLibrary" enctype="multipart/form-data">

        <div class="mb-3">
            <label>Title</label>
            <input type="text" wire:model="title" class="w-full border rounded p-2">
            @error('title')
                <span class="text-rose-500 text-xs font-bold">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea wire:model="description" class="w-full border rounded p-2"></textarea>
        </div>

        <div class="grid grid-cols-3 gap-3 mb-3">
            <div>
                <label>Branch</label>
                <input type="text" wire:model="branch" class="w-full border rounded p-2">
                @error('branch')
                    <span class="text-rose-500 text-xs font-bold">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label>Semester</label>
                <input type="text" wire:model="semester" class="w-full border rounded p-2">
                @error('semester')
                    <span class="text-rose-500 text-xs font-bold">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label>Type</label>
                <select wire:model="type" class="w-full border rounded p-2">
                    <option value="notes">Notes</option>
                    <option value="assignment">Assignment</option>
                    <option value="pyq">PYQ</option>
                </select>
                @error('type')
                    <span class="text-rose-500 text-xs font-bold">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label>File</label>
            <input type="file" name="file" wire:model="file" class="w-full">
            @error('file')
                <span class="text-rose-500 text-xs font-bold">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
            Upload
        </button>

    </form>
</div>

</div>
