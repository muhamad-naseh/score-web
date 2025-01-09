<div>
    <div class="flex justify-between gap-4 py-4">
        <div class="flex-1 items-center text-2xl mr-2">
            <p class=" font-semibold text-slate-900 dark:text-white">
                {{$participant1->player->name}}
            </p>
        </div>
        <div class="flex items-center">
            <p>VS</p>
        </div>
        <div class="flex flex-1 items-end text-2xl justify-end ml-2">
            <p class=" text-right font-semibold text-slate-900 dark:text-white">
                {{$participant2->player->name}}
            </p>
        </div>
    </div>

    <table
        class="fi-ta-table w-full table-fixed border border-gray-200 dark:border-white/5 divide-y divide-gray-200 text-start dark:divide-white/5">
        <thead class="divide-y divide-gray-200 dark:divide-white/5">
        <tr class="bg-gray-50 dark:bg-white/5">
            <th class="text-start  px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 ">Point</th>
            <th class="text-center  px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 ">Score Type</th>
            <th class="text-end  px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 ">Point</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
        @foreach($scores as $score)
            <tr wire:key="{{$score['type']->value}}"
                class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-category.name">
                <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p
                        class="text-start text-md leading-6 text-gray-950 dark:text-white tabular-nums">
                        {{$score['score_1']}}</p></td>
                <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p
                        class="text-center text-md leading-6 text-gray-950 dark:text-white tabular-nums">{{Str::upper($score['type']->value)}}</p>
                </td>
                <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p
                        class="text-end text-md leading-6 text-gray-950 dark:text-white tabular-nums">{{$score['score_2']}}</p>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
