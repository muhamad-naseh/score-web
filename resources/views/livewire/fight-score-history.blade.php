<table class="fi-ta-table w-full table-auto border border-gray-200 dark:border-white/5 divide-y divide-gray-200 text-start dark:divide-white/5">
    <thead class="divide-y divide-gray-200 dark:divide-white/5 ">
    <tr class="bg-gray-50 dark:bg-white/5">
        <th class="text-start  px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 ">Name</th>
        <th class="text-center  px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 ">Score Type</th>
        <th class="text-end  px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 ">Point</th>
        <th class="text-end  px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 ">Timestamp</th>
    </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5" wire:poll="fetchData">
    @forelse($this->scores as $score)
        <tr wire:key="{{$score['id']}}" wire:click="fetchData"
            class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
            <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6"><p class="text-start text-md leading-6 text-gray-950 dark:text-white tabular-nums">{{$score['name']}}</p></td>
            <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p
                    class="text-center text-md leading-6 text-gray-950 dark:text-white tabular-nums">{{Str::upper($score['type']->name)}}</p>
            </td>
            <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p class="text-end text-md leading-6 text-gray-950 dark:text-white tabular-nums">{{$score['value']}}</p></td>
            <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p class="text-end text-md leading-6 text-gray-950 dark:text-white tabular-nums">{{$score['timestamp']}}</p></td>
        </tr>
    @empty
        <tr class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
            <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 " colspan="4"><p
                    class="text-center text-md leading-6 text-gray-950 dark:text-white">Data Not Found</p></td>
        </tr>
    @endforelse
    </tbody>
</table>
