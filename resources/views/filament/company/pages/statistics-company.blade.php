<x-filament-panels::page>
    <div class="grid grid-cols-3 gap-4">
        <x-filament::card>
            <h2 class="text-lg font-bold">أرباح الشركة من الزبائن</h2>
            <p class="text-2xl">{{ number_format($this->getCompanyEarnings(), 2) }} ل.س</p>
        </x-filament::card>

        <x-filament::card>
            <h2 class="text-lg font-bold">المبالغ المستردة</h2>
            <p class="text-2xl">{{ number_format($this->getCompanyRefunds(), 2) }} ل.س</p>
        </x-filament::card>

        <x-filament::card>
            <h2 class="text-lg font-bold">الأرباح الصافية</h2>
            <p class="text-2xl">{{ number_format($this->getNetProfit(), 2) }} ل.س</p>
        </x-filament::card>
    </div>
</x-filament-panels::page>
