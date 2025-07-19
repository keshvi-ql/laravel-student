<div class="min-h-screen bg-gradient-to-br from-gray-100 via-gray-50 to-gray-200 py-10">
    <!-- Table Section -->
    <div class="max-w-6xl px-4 py-6 sm:px-6 lg:px-8 mx-auto">
        <!-- Card -->
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="bg-white border border-gray-200 rounded-3xl shadow-2xl overflow-hidden transition-transform duration-300 hover:scale-[1.01]">
                        <!-- Header -->
                        <div class="px-6 py-4 flex flex-col md:flex-row md:justify-between md:items-center border-b border-gray-200 relative">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-10 bg-gradient-to-b from-blue-400 to-purple-400 rounded-full mr-3"></div>
                                <div>
                                    <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight flex items-center gap-2">
                                        <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                        Students
                                    </h2>
                                    <p class="text-sm text-gray-500">Students overview.</p>
                                </div>
                            </div>
                            <div class="mt-4 md:mt-0">
                                <a class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 shadow transition" href="/create/student" wire:navigate>
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14" /><path d="M12 5v14" /></svg>
                                    Create
                                </a>
                            </div>
                        </div>
                        <!-- End Header -->

                        <!-- Table -->
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start border-s border-gray-200">
                                        <span class="text-xs font-semibold uppercase text-gray-700">Student</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-700">Grade</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-700">Age</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start" colspan="2">
                                        <span class="text-xs font-semibold uppercase text-gray-700">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                <tr class="transition hover:bg-blue-50 even:bg-gray-50 group">
                                    <td class="h-px w-auto whitespace-nowrap">
                                        <div class="flex items-center gap-3 px-6 py-3">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-400 to-purple-400 flex items-center justify-center text-white font-bold text-lg shadow group-hover:scale-110 transition-transform">
                                                {{ strtoupper(substr($student->first_name,0,1)) }}{{ strtoupper(substr($student->last_name,0,1)) }}
                                            </div>
                                            <span class="font-semibold text-gray-800 text-base">{{ $student->first_name }} {{ $student->last_name}}</span>
                                        </div>
                                    </td>
                                    <td class="h-px w-auto whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-base text-gray-700">{{ $student->grade->name}}</span>
                                        </div>
                                    </td>
                                    <td class="h-px w-auto whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-base text-gray-700">{{$student->age}} years</span>
                                        </div>
                                    </td>
                                    <td class="h-px w-auto whitespace-nowrap">
                                        <a href="/edit/student/{{$student->id}}" class="flex justify-center items-center gap-2 w-10 h-10 text-sm font-medium rounded-lg border border-transparent bg-gray-200 text-blue-700 hover:bg-blue-100 hover:text-blue-900 shadow transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </a>
                                    </td>
                                    <td>
                                        <button type="button" wire:click="delete({{ $student->id }})" class="flex justify-center items-center gap-2 w-10 h-10 text-sm font-medium rounded-lg border border-transparent bg-red-100 text-red-600 hover:bg-red-200 hover:text-red-800 shadow transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table -->

                        <!-- Footer -->
                        <div class="px-6 py-4 flex flex-col md:flex-row md:justify-between md:items-center border-t border-gray-200 bg-gray-50 rounded-b-3xl">
                            <div>
                                <p class="text-sm text-gray-600">
                                    <span class="font-semibold text-gray-800">{{ count($students) }}</span> results
                                </p>
                            </div>
                            <div class="flex flex-col items-center justify-between mt-4 gap-2">
                                <div>
                                    Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }} results
                                </div>
                                <div class="inline-flex gap-x-2">
                                    @if ($students->onFirstPage())
                                        <button disabled class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-gray-100 text-gray-400 shadow cursor-not-allowed">
                                            <svg class="shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 6v12a3 3 0 1 0 3-3H6a3 3 0 1 0-3 3V6a3 3 0 1 0 3-3h12a3 3 0 1 0-3 3" /></svg>
                                            Prev
                                        </button>
                                    @else
                                        <button wire:click="previousPage" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow hover:bg-blue-50">
                                            <svg class="shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 6v12a3 3 0 1 0 3-3H6a3 3 0 1 0-3 3V6a3 3 0 1 0 3-3h12a3 3 0 1 0-3 3" /></svg>
                                            Prev
                                        </button>
                                    @endif

                                    @foreach ($students->getUrlRange(1, $students->lastPage()) as $page => $url)
                                        @if ($page == $students->currentPage())
                                            <button class="py-2 px-3 text-sm font-medium rounded-lg border border-blue-600 bg-blue-600 text-white shadow">{{ $page }}</button>
                                        @else
                                            <button wire:click="gotoPage({{ $page }})" class="py-2 px-3 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow hover:bg-blue-50">{{ $page }}</button>
                                        @endif
                                    @endforeach

                                    @if ($students->hasMorePages())
                                        <button wire:click="nextPage" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow hover:bg-blue-50">
                                            Next
                                            <svg class="shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18 15 12 9 6" /></svg>
                                        </button>
                                    @else
                                        <button disabled class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-gray-100 text-gray-400 shadow cursor-not-allowed">
                                            Next
                                            <svg class="shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18 15 12 9 6" /></svg>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- End Footer -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Table Section -->
</div>