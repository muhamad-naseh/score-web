<x-filament-panels::page>
    <livewire:realtime-fight-recorder :fight="$this->record"/>
    <div class="mx-auto my-2 max-w-md rounded overflow-hidden shadow-md text-xs">

        <div class="flex bg-gray-200 px-2 py-2">
            <div class="w-5/12 text-gray-700 text-left text-red-700">4:32 - 4th</div>
            <div class="w-5/12 flex justify-end items-center">
                <p class="w-8 px-2 text-center">1</p>
                <p class="w-8 px-2 text-center">2</p>
                <p class="w-8 px-2 text-center">3</p>
                <p class="w-8 px-2 text-center">4</p>
            </div>
            <div class="w-1/6 text-gray-700 text-right">ABC</div>
        </div>

        <div class="flex px-2 py-2 items-center">
            <div class="w-5/12 flex">
                <img class="w-6 sm:w-10 mr-2 self-center" alt="away-logo" src="https://a1.espncdn.com/combiner/i?img=/i/teamlogos/nba/500/scoreboard/tor.png&h=70&w=70">
                <div class="flex flex-col">
                    <p class="text-sm font-bold">Raptors</p>
                    <p class="hidden sm:block text-gray-600">(58-24, 26-15 Away)</p>
                </div>
            </div>
            <div class="w-5/12 flex justify-end items-center">
                <p class="w-8 px-1 text-center">36</p>
                <p class="w-8 px-1 text-center">24</p>
                <p class="w-8 px-1 text-center">36</p>
                <p class="w-8 px-1 text-center">27</p>
            </div>
            <p class="w-1/6 text-lg sm:text-xl font-bold text-right">123</p>
        </div>

        <div class="flex px-2 py-2 items-center">
            <div class="w-5/12 flex">
                <img class="w-6 sm:w-10 mr-2 self-center" alt="home-logo" src="https://a1.espncdn.com/combiner/i?img=/i/teamlogos/nba/500/scoreboard/gs.png&h=70&w=70">
                <div class="flex flex-col">
                    <p class="text-sm font-bold">Warriors</p>
                    <p class="hidden sm:block text-gray-600">(57-25, 30-11 Home)</p>
                </div>
            </div>
            <div class="w-5/12 flex justify-end items-center">
                <p class="w-8 px-1 text-center">29</p>
                <p class="w-8 px-1 text-center">23</p>
                <p class="w-8 px-1 text-center">31</p>
                <p class="w-8 px-1 text-center">26</p>
            </div>
            <p class="w-1/6 text-lg sm:text-xl font-bold text-right">109</p>
        </div>

        <div class="hidden sm:block border-t border-gray-300">
            <p class="text-center text-gray-500 m-1 uppercase">Top Performers</p>
            <div class="flex">
                <div class="w-1/2 px-2 py-2">
                    <div class="flex">
                        <img class="w-10 mr-2 self-center" src="https://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/6450.png?w=90&h=60&scale=crop&transparent=true">
                        <div class="flex flex-col">
                            <p class="font-semibold">Kawhi Leonard</p>
                            <p class="text-gray-600">TOR - SF</p>
                            <p class="text-gray-600">30 PTS, 7 REB, 6 AST</p>
                        </div>
                    </div>
                </div>
                <div class="w-1/2 px-2 py-2">
                    <div class="flex">
                        <img class="w-10 mr-2 self-center" src="https://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/3975.png?w=90&h=60&scale=crop&transparent=true">
                        <div class="flex flex-col">
                            <p class="font-semibold">Stephen Curry</p>
                            <p class="text-gray-600">GS - SG</p>
                            <p class="text-gray-600">47 PTS, 8 REB, 7 AST</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t bg-gray-200 text-center px-1 py-1">
            <p class="text-gray-600">NBA Finals - Game 3, TOR leads 2-1</p>
        </div>

        <div class="flex border-t bg-gray-200">
            <div class="w-1/2 px-2 py-2 text-center">
                <p class="font-semibold text-gray-700">ORACLE Arena</p>
                <p class="font-light text-gray-600">Oakland, CA</p>
            </div>
            <div class="w-1/2 px-2 py-2 text-center">
                <p class="text-gray-600"><span class="font-semibold">Line</span>: GS -4.5</p>
                <p class="text-gray-600"><span class="font-semibold">O/U</span>: 213.5</p>
            </div>
        </div>

    </div>

</x-filament-panels::page>
