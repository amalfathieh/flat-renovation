<x-filament::page>
    <div class="space-y-6">
        <div class="p-4 bg-white shadow rounded">
            <h2 class="text-lg font-bold">إجمالي أرباح الإدمن من الاشتراكات</h2>
            <p class="text-2xl font-semibold text-green-600">
                {{ number_format($adminSubscriptionsProfit, 2) }} $
            </p>
        </div>

        <div class="p-4 bg-white shadow rounded">
            <h2 class="text-lg font-bold mb-4">ملخص الشركات</h2>
            <table class="min-w-full border border-gray-200">
                <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">اسم الشركة</th>
                    <th class="border px-4 py-2">إجمالي ما دفعه الزبائن</th>
                    <th class="border px-4 py-2">تم تحويله للشركة</th>
                    <th class="border px-4 py-2">المتبقي للتحويل</th>
                </tr>
                </thead>
                <tbody>
                @foreach($companiesSummary as $company)
                    <tr>
                        <td class="border px-4 py-2">{{ $company['name'] }}</td>
                        <td class="border px-4 py-2">{{ number_format($company['total_from_customers'], 2) }} ل.س</td>
                        <td class="border px-4 py-2">{{ number_format($company['total_transferred'], 2) }} ل.س</td>
                        <td class="border px-4 py-2">{{ number_format($company['remaining'], 2) }} ل.س</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-filament::page>
{{--<x-filament::page>--}}
{{--    <div class="grid grid-cols-3 gap-4">--}}
{{--        <x-filament::card>--}}
{{--            <h2 class="text-lg font-bold">إجمالي أرباح الاشتراكات</h2>--}}
{{--            <p class="text-2xl">{{ number_format($this->getAdminEarnings(), 2) }} ل.س</p>--}}
{{--        </x-filament::card>--}}

{{--        @foreach ($this->getCompaniesData() as $company)--}}
{{--            <x-filament::card>--}}
{{--                <h2 class="font-bold">{{ $company->name }}</h2>--}}
{{--                <p>مبلغ التحويل الخارجي المطلوب: {{ number_format($company->pending_withdrawal, 2) }} ل.س</p>--}}
{{--            </x-filament::card>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--</x-filament::page>--}}
