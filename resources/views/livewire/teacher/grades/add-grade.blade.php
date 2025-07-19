<div class="min-h-screen bg-gradient-to-br from-gray-100 via-gray-50 to-gray-200 py-10">
    <!-- Add Grade Form Section -->
    <div class="max-w-2xl px-4 py-6 sm:px-6 lg:px-8 mx-auto">
        <!-- Card -->
        <div class="mt-5 p-4 relative z-10 bg-white border border-gray-200 rounded-3xl shadow-2xl sm:mt-10 md:p-10 transition-transform duration-300 hover:scale-[1.01]">
            <!-- Header -->
            <div class="px-6 py-4 flex items-center gap-3 border-b border-gray-200 relative">
                <div class="w-2 h-10 bg-gradient-to-b from-blue-400 to-purple-400 rounded-full mr-3"></div>
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight flex items-center gap-2">
                        <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        Add Grade
                    </h2>
                    <p class="text-sm text-gray-500">Add grade information here</p>
                </div>
                <div class="ml-auto">
                    <a class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 shadow transition" href="/grade/list" wire:navigate>
                        View all
                    </a>
                </div>
            </div>
            <!-- End Header -->
            <form wire:submit="save" class="mt-6">
                <div class="mb-8">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Grade name</label>
                    <input type="text" wire:model="name" class="py-3 px-4 block w-full border-gray-300 bg-gray-50 rounded-lg text-base focus:border-blue-500 focus:ring-blue-500" placeholder="Grade name">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-6 grid">
                    <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-base font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 shadow transition">
                        <div wire:loading class="animate-spin inline-block w-6 h-6 border-3 border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading">
                            <span class="sr-only">Loading...</span>
                        </div>
                        Save
                    </button>
                </div>
            </form>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Add Grade Form Section -->
</div>