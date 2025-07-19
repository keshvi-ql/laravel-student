<div class="bg-white rounded-xl shadow p-6 mb-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Export Attendance Report</h2>
    <form wire:submit.prevent="export" class="flex flex-col md:flex-row items-center gap-4">
        <div class="flex flex-col">
            <label for="start_date" class="text-gray-700 font-medium mb-1">Start Date</label>
            <input type="date" id="start_date" wire:model="start_date" class="rounded-lg border-gray-300 focus:border-blue-400 focus:ring-blue-400 text-gray-800" required>
            @error('start_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div class="flex flex-col">
            <label for="end_date" class="text-gray-700 font-medium mb-1">End Date</label>
            <input type="date" id="end_date" wire:model="end_date" class="rounded-lg border-gray-300 focus:border-blue-400 focus:ring-blue-400 text-gray-800" required>
            @error('end_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div class="flex items-end h-full pt-6 md:pt-0">
            <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gray-300 hover:bg-gray-400 text-gray-900 font-semibold rounded-lg shadow transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Export Excel
            </button>
        </div>
    </form>
</div> 