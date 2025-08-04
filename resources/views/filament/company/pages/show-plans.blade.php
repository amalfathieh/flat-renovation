
<style>
    .scrolling-wrapper {
        display: flex;
        overflow-x: auto;
        gap: 1rem;
        padding-bottom: 1rem;
        scrollbar-width: thin;
    }

    .scrolling-wrapper::-webkit-scrollbar {
        height: 6px;
    }

    .scrolling-wrapper::-webkit-scrollbar-thumb {
        background-color: rgba(234, 88, 12, 0.6);
        /* برتقالي */
        border-radius: 6px;
    }

    .pricing-card {
        min-width: 240px;
        max-width: 260px;
        flex: 0 0 auto;
        background-color: #f8f5f2;
        border-radius: 0.75rem;
        padding: 1.5rem;
        color: #7c2d12;
        text-align: center;
        transition: transform 0.3s, box-shadow 0.3s;
        border: 2px solid #fdba74;
    }

    .pricing-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .price {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
        color: #ea580c;
    }

    .subscribe-btn {
        background-color: #ea580c;
        padding: 0.40rem 1rem;
        border-radius: 0.5rem;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        border: none;
        cursor: pointer;
    }

    .subscribe-btn:hover {
        background-color: #c2410c;
    }


    .features {
        color: #444;
        font-size: 0.875rem;
        line-height: 1.6;
        margin-bottom: 1rem;
        text-align: start;
    }

    .dark .pricing-card {
        background-color: #1f2937;
        color: #f9fafb;
        border-color: #fb923c;
    }

    .dark .features {
        color: #d1d5db;
    }
</style>





<x-filament-panels::page>

    <h2 class="text-xl font-bold mb-4 text-center text-gray-800 dark:text-white">باقات الاشتراك</h2>

    <div class="scrolling-wrapper">
        @foreach ($this->getPlans()["plans"] as $plan)
            <div class="pricing-card dark:text-white">
                <h3 class="text-lg font-semibold mb-2">{{ $plan->name }}</h3>

                <div class="price">

                    <span class="text-sm text-gray-600 font-normal">  {{ $plan->duration_in_days }} يوم/</span>
                    {{ $plan->price == 0 ? '$0' : '$' . number_format($plan->price, 2) }}
                </div>



                <div class="features">
                    <p><strong>{{ $plan->project_limit }}</strong> مشروع</p>
                    <p><strong>{{ $plan->duration_in_days }}</strong> يوم</p>

                    {!! \Illuminate\Support\Str::markdown($plan->description) !!}
                </div>

                @if($this->getPlans()["comSub"])
                    @if ($plan->id == $this->getPlans()["comSub"]['id'] )
                        <button class="subscribe-btn bg-gray-400 cursor-not-allowed" disabled>
                            أنت مشترك بالفعل
                        </button>
                    @else
                        <a href="{{ route('payment.create', $plan->id) }}" class="subscribe-btn">
                            اشترك الآن
                        </a>
                    @endif

                @else
                    <a href="{{ route('payment.create', $plan->id) }}" class="subscribe-btn">
                        اشترك الآن
                    </a>
                @endif

            </div>
        @endforeach
    </div>
</x-filament-panels::page>
