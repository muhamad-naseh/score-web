<div>
    <div class="grid grid-cols-5 gap-4">
        <x-filament::section class="col-span-3">
            <div class="flex items-end">
                <p>{{$this->batch}}</p>
                <x-filament::badge :color="$this->fightStatus->label()">
                    {{\Str::upper($this->fightStatus->value)}}
                </x-filament::badge>
{{--                <x-filament::badge wire:poll="checkStatus" :color="$this->connectionStatus ? 'success':'danger'">--}}
{{--                    {{$this->connectionStatus ? 'ONLINE':'OFFLINE'}}--}}
{{--                </x-filament::badge>--}}
            </div>
            <div class="flex w-full gap-4 py-4">
                <div class=" flex flex-1 items-center text-2xl">
                    <p class=" font-semibold text-slate-900 dark:text-white">Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="flex items-center">
                    <p>VS</p>
                </div>
                <div class=" flex flex-1 items-center text-2xl">
                    <p class="text-end font-semibold text-slate-900 dark:text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo, sapiente.</p>
                </div>
            </div>

            <table class="fi-ta-table w-full table-fixed border border-gray-200 dark:border-white/5 divide-y divide-gray-200 text-start dark:divide-white/5">
                <thead class="divide-y divide-gray-200 dark:divide-white/5">
                    <tr class="bg-gray-50 dark:bg-white/5">
                        <th class="text-start  px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 ">Point</th>
                        <th class="text-center  px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 ">Score Type</th>
                        <th class="text-end  px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 ">Point</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
                    <tr class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-category.name">
                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p class="text-start text-md leading-6 text-gray-950 dark:text-white tabular-nums">1</p></td>
                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p class="text-center text-md leading-6 text-gray-950 dark:text-white tabular-nums">TOP</p></td>
                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p class="text-end text-md leading-6 text-gray-950 dark:text-white tabular-nums">1</p></td>
                    </tr><tr class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-category.name">
                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p class="text-start text-md leading-6 text-gray-950 dark:text-white tabular-nums">1</p></td>
                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p class="text-center text-md leading-6 text-gray-950 dark:text-white tabular-nums">TOP</p></td>
                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p class="text-end text-md leading-6 text-gray-950 dark:text-white tabular-nums">1</p></td>
                    </tr>
                    <tr class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-category.name">
                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p
                                class="text-start text-md leading-6 text-gray-950 dark:text-white tabular-nums">1</p>
                        </td>
                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p
                                class="text-center text-md leading-6 text-gray-950 dark:text-white tabular-nums">TOP</p>
                        </td>
                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p
                                class="text-end text-md leading-6 text-gray-950 dark:text-white tabular-nums">1</p></td>
                    </tr>
                </tbody>
            </table>
        </x-filament::section>
{{--        <x-filament::section class="col-span-2">--}}
{{--            <x-slot name="heading">--}}
{{--                Score Data Log--}}
{{--            </x-slot>--}}
{{--            <table class="fi-ta-table w-full table-auto border border-gray-200 dark:border-white/5 divide-y divide-gray-200 text-start dark:divide-white/5">--}}
{{--                <thead class="divide-y divide-gray-200 dark:divide-white/5">--}}
{{--                <tr class="bg-gray-50 dark:bg-white/5">--}}
{{--                    <th class="text-start  px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 ">Name</th>--}}
{{--                    <th class="text-center  px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 ">Score Type</th>--}}
{{--                    <th class="text-end  px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 ">Point</th>--}}
{{--                    <th class="text-end  px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 ">Timestamp</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">--}}
{{--                    <tr class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-category.name">--}}
{{--                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p class="text-start text-md leading-6 text-gray-950 dark:text-white tabular-nums">Lorem ipsum dolor sit amet.</p></td>--}}
{{--                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p class="text-center text-md leading-6 text-gray-950 dark:text-white tabular-nums">TOP</p></td>--}}
{{--                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p class="text-end text-md leading-6 text-gray-950 dark:text-white tabular-nums">1</p></td>--}}
{{--                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p class="text-end text-md leading-6 text-gray-950 dark:text-white tabular-nums">2 minutes ago</p></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-category.name">--}}
{{--                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p class="text-start text-md leading-6 text-gray-950 dark:text-white tabular-nums">Lorem ipsum dolor sit amet.</p></td>--}}
{{--                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p class="text-center text-md leading-6 text-gray-950 dark:text-white tabular-nums">TOP</p></td>--}}
{{--                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p class="text-end text-md leading-6 text-gray-950 dark:text-white tabular-nums">1</p></td>--}}
{{--                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p class="text-end text-md leading-6 text-gray-950 dark:text-white tabular-nums">2 minutes ago</p></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-category.name">--}}
{{--                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p class="text-start text-md leading-6 text-gray-950 dark:text-white tabular-nums">Lorem ipsum dolor sit amet.</p></td>--}}
{{--                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p class="text-center text-md leading-6 text-gray-950 dark:text-white tabular-nums">TOP</p></td>--}}
{{--                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p class="text-end text-md leading-6 text-gray-950 dark:text-white tabular-nums">1</p></td>--}}
{{--                        <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 "><p class="text-end text-md leading-6 text-gray-950 dark:text-white tabular-nums">2 minutes ago</p></td>--}}
{{--                    </tr>--}}

{{--                </tbody>--}}
{{--            </table>--}}

{{--        </x-filament::section>--}}

        <div class="col-span-2 divide-y divide-gray-200 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:divide-white/10 dark:bg-gray-900 dark:ring-white/10">
            <div class="divide-y divide-gray-200 dark:divide-white/10">
                <div class="fi-ta-header-toolbar flex items-center justify-end gap-x-4 px-4 py-6 sm:px-6">
                    <x-filament::button wire:click="playPause" :icon="$this->fightStatus->icon()" :disabled="$this->fightStatus == \App\FightStatus::COMPLETED"  :color="$this->fightStatus->buttonColor()"/>
                    <x-filament::button wire:click="completed" :disabled="$this->fightStatus == \App\FightStatus::COMPLETED">Finish</x-filament::button>
                </div>
            </div>
            <div class="fi-ta-content relative divide-y divide-gray-200 overflow-auto max-h-96 dark:divide-white/10 dark:border-t-white/10">
                <livewire:fight-score-history :fight="$this->fight"/>
            </div>
        </div>
    </div>
</div>
