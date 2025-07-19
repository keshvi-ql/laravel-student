<div class="flex flex-col p-4 md:p-5 bg-white/70 backdrop-blur-md border border-blue-100 shadow-lg rounded-2xl transition-transform duration-200 hover:scale-105 hover:shadow-2xl">
    <div class="flex items-center gap-x-2">
      <p class="text-xs uppercase tracking-wide text-blue-700 font-semibold">
        {{ $title }}
      </p>
      @if($tooltip)
        <div class="relative group">
          <svg class="shrink-0 size-4 text-blue-400 cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
            <path d="M12 17h.01"/>
          </svg>
          <span class="absolute left-1/2 -translate-x-1/2 mt-1 opacity-0 group-hover:opacity-100 transition-opacity bg-blue-700 text-white text-xs font-medium py-1 px-2 rounded-md shadow-2xs">
            {{ $tooltip }}
          </span>
        </div>
      @endif
    </div>
  
    <div class="mt-2 flex items-end gap-x-2">
      <h3 class="text-3xl font-extrabold text-blue-900 drop-shadow-sm">
        {{ $value }}
      </h3>
      @if($percentage)
        <span class="flex items-center gap-x-1 {{ $percentage > 0 ? 'text-green-600' : 'text-red-600' }} font-semibold">
          <svg class="inline-block size-4 self-center" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/>
            <polyline points="16 7 22 7 22 13"/>
          </svg>
          <span class="inline-block text-base">
            {{ $percentage }}%
          </span>
        </span>
      @endif
    </div>
</div>
  