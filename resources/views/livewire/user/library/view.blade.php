<div 
    x-data="{ open: @entangle('open') }" 
    x-show="open"
    x-cloak
    class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50"
>

    <!-- Modal Container -->
    <div class="bg-white w-[90%] lg:w-[70%] max-h-[90vh] rounded-xl shadow-xl overflow-hidden flex flex-col">

        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b bg-slate-100">
            <h2 class="text-xl font-semibold">{{ $document->title ?? 'Loading...' }}</h2>

            <button 
                @click="open = false"
                class="text-gray-500 hover:text-black"
            >
                ✖
            </button>
        </div>

        <!-- Content -->
        <div class="flex-1 overflow-y-auto">

            @if(!$document)
                <!-- Skeleton Loader -->
                <div class="p-6 animate-pulse">
                    <div class="h-6 bg-slate-200 rounded w-1/3 mb-4"></div>
                    <div class="h-4 bg-slate-200 rounded w-full mb-2"></div>
                    <div class="h-4 bg-slate-200 rounded w-5/6 mb-4"></div>
                    <div class="h-72 bg-slate-200 rounded mt-4"></div>
                </div>
            @else

                <!-- Metadata -->
                <div class="p-4 bg-white">

                    <p class="text-sm text-gray-600 mb-1">
                        {{ $document->branch }} • 
                        {{ $document->semester }} • 
                        {{ ucfirst($document->type) }}
                    </p>

                    @if($document->description)
                        <p class="mt-2 text-gray-700">{{ $document->description }}</p>
                    @endif

                    <div class="flex items-center gap-4 mt-3 text-gray-600 text-sm">
                        <span>⭐ {{ number_format($document->rating ?? 0, 1) }} rating</span>
                        <span>{{ $document->views }} views</span>
                        <span>{{ $document->downloads }} downloads</span>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-4 flex gap-3">

                        <a 
                            href="{{ route('documents.download', $document->id) }}" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                        >
                            Download
                        </a>

                        <button 
                            class="px-4 py-2 border rounded-lg hover:bg-slate-100 transition"
                            x-on:click="navigator.clipboard.writeText('{{ url('/document/'.$document->id) }}')"
                        >
                            Share
                        </button>

                    </div>
                </div>

                <!-- PDF Viewer -->
                <div class="p-4">

                    @if($document->file)
                        <iframe 
                            src="{{ asset('storage/'.$document->file) }}" 
                            class="w-full h-[70vh] rounded-lg border"
                        ></iframe>
                    @else
                        <div class="p-6 bg-slate-100 text-center text-gray-500 rounded-lg">
                            No preview available.
                        </div>
                    @endif

                </div>

            @endif

        </div>

    </div>

</div>





























{{-- dfghjkl --}}