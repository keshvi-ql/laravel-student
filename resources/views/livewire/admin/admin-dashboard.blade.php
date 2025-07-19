<div class="min-h-screen bg-gray-50 py-8 px-4 md:px-10">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800 mb-1">Admin Dashboard</h1>
            <p class="text-gray-500 text-lg">Welcome back, <span class="font-semibold text-gray-700">{{ auth()->user()->name }}</span>! Here’s an overview of your platform.</p>
        </div>
        <!-- Profile/Avatar -->
        <div class="flex items-center gap-3 bg-white rounded-xl shadow p-3">
            <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-blue-400 to-purple-400 flex items-center justify-center text-white text-2xl font-bold">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="flex flex-col">
                <span class="font-semibold text-gray-800">{{ auth()->user()->name }}</span>
                <span class="text-xs text-gray-500">{{ auth()->user()->email }}</span>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="flex flex-wrap gap-3 mb-8">
        <a href="{{ route('student.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-900 font-semibold rounded-lg shadow transition border border-gray-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add Student
        </a>
        <a href="{{ route('grade.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-400 hover:bg-gray-500 text-gray-900 font-semibold rounded-lg shadow transition border border-gray-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add Grade
        </a>
        <a href="#export-report-section" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg shadow transition border border-gray-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 17v2a2 2 0 002 2h14a2 2 0 002-2v-2M16 11V7a4 4 0 00-8 0v4M5 11h14"/></svg>
            Export Report
        </a>
    </div>

    <!-- Export Report Section -->
    <div id="export-report-section">
        <livewire:admin.export-report />
    </div>

    <!-- Stats and Widgets -->
    <div class="flex flex-col gap-8">
        <div class="bg-white rounded-2xl shadow p-6">
            <livewire:dashborad-widget-overview />
        </div>
    </div>
</div>