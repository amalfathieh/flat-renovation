<style>
    /* ===== أسلوب عام ===== */
    * {
        box-sizing: border-box;
    }

    body {
        font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Noto Sans Arabic", Arial, sans-serif;
    }

    /* ===== عنوان رئيسي ===== */
    h2 {
        margin-bottom: 1rem;
    }

    /* ===== كروت الباقات ===== */
    .scrolling-wrapper {
        display: flex;
        gap: 16px;
        overflow-x: auto;
        padding: 10px 0;
    }

    .pricing-card {
        flex: 0 0 250px;
        background: #fdfcfa;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 16px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .dark .pricing-card {
        background: #1f2937;
        border-color: #374151;
    }

    .price {
        /*font-weight: bold;
        font-size: 1.2rem;
        margin-bottom: 6px;
        text-align: center;
        color: #ea580c;*/
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
        color: #ea580c;
        text-align: center;

    }

    .features {
        font-size: 0.9rem;
        color: #494949;
    }

    .dark .features {
        color: #ccc;
    }

    /* ===== زر الاشتراك ===== */
    .subscribe-btn {
        background: #f97316;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .subscribe-btn:hover {
        background: #ea580c;
    }

    .subscribe-btn[disabled] {
        background: #9ca3af;
        cursor: not-allowed;
    }

    /* ===== المودال ===== */
    .fixed.inset-0 {
        background: rgba(0, 0, 0, 0.5);
    }

    .bg-white.dark\:bg-gray-800 {
        background: #fff;
    }

    .dark .bg-white.dark\:bg-gray-800 {
        background: #1f2937;
    }

    .rounded-lg {
        border-radius: 12px;
    }

    .shadow-lg {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .p-6 {
        padding: 24px;
    }

    /* ===== أزرار المودال ===== */
    .bg-gray-300 {
        background: #d1d5db;
        border: none;
        border-radius: 6px;
        padding: 8px 14px;
        cursor: pointer;
    }

    .bg-gray-300:hover {
        background: #9ca3af;
    }

    .bg-orange-600 {
        background: #f97316;
        border: none;
        border-radius: 6px;
        padding: 8px 14px;
        cursor: pointer;
    }

    .bg-orange-600:hover {
        background: #ea580c;
    }

    /* ===== Toast الرسائل ===== */
    .fixed.top-5.right-5 {
        position: fixed;
        top: 20px;
        right: 20px;
        min-width: 220px;
        padding: 10px 14px;
        border-radius: 8px;
        font-size: 0.9rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        z-index: 9999;
    }

    .bg-green-500 {
        background: #16a34a;
        color: #fff;
    }

    .bg-red-500 {
        background: #dc2626;
        color: #fff;
    }
</style>



<x-filament-widgets::widget>
    <x-filament::section>
        <h2 class="text-xl font-bold mb-4 text-center text-gray-800 dark:text-white">باقات الاشتراك</h2>

        <div
            x-data="subscriptionModal()"
            x-cloak
            class="relative">

            {{-- Toast Notification --}}
            <div
                x-show="showToast"
                x-transition
                x-init="
                    $watch('toastMessage', value => {
                        if (value) {
                            showToast = true;
                            setTimeout(() => { showToast = false; toastMessage = ''; }, 3000);
                        }
                    })
                "
                class="fixed top-5 right-5 px-4 py-3 rounded shadow-lg text-black z-50"
                :class="toastType === 'success' ? 'bg-green-500' : 'bg-red-500'"
                x-text="toastMessage">
            </div>

            {{-- قائمة الباقات --}}
            <div class="scrolling-wrapper">
                @foreach ($this->getPlans()["plans"] as $plan)
                <div class="pricing-card dark:text-white">
                    <h3 class="text-lg font-semibold mb-2 text-center">{{ $plan->name }}</h3>

                    <div class="price">
                        <span class="text-sm text-gray-600 font-normal">{{ $plan->duration_in_days }} يوم/</span>
                        {{ $plan->price == 0 ? '$0' : '$' . number_format($plan->price, 2) }}
                    </div>

                    <div class="features">
                        <p><strong>{{ $plan->project_limit }}</strong> مشروع</p>
                        <p><strong>{{ $plan->duration_in_days }}</strong> يوم</p>
                        {!! \Illuminate\Support\Str::markdown($plan->description) !!}
                    </div>

                    @if($this->getPlans()["comSub"])
                    @if ($plan->id == $this->getPlans()["comSub"]['subscription_plan_id'] )
                    <button class="subscribe-btn bg-gray-400 cursor-not-allowed" disabled>
                        أنت مشترك بالفعل
                    </button>

                    @else
                    <button
                        class="subscribe-btn"
                        @click="openModal('{{ $plan->id }}', '{{ $plan->name }}', '{{ $plan->price }}', '{{ $plan->duration_in_days }}')">
                        اشترك الآن
                    </button>
                    @endif
                    @else
                    <button
                        class="subscribe-btn"
                        @click="openModal('{{ $plan->id }}', '{{ $plan->name }}', '{{ $plan->price }}', '{{ $plan->duration_in_days }}')">
                        اشترك الآن
                    </button>
                    @endif
                </div>
                @endforeach
            </div>

            {{-- نافذة التأكيد --}}
            <div
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50"
                x-show="show"
                x-transition>
                <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-md shadow-lg">
                    <h2 class="text-lg font-bold mb-4 text-gray-800 dark:text-white">
                        تأكيد الاشتراك
                    </h2>

                    <p class="mb-4 text-gray-600 dark:text-gray-300">
                        سيتم خصم <b class="text-orange-600" x-text="'$' + price"></b> من محفظتك للاشتراك في
                        <b x-text="planName"></b> لمدة <b x-text="duration"></b> يوم.
                    </p>

                    <div class="flex justify-end gap-2">
                        <button
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"
                            @click="show = false">
                            إلغاء
                        </button>
                        <button
                            @click="confirmSubscription"
                            class="px-4 py-2 bg-orange-600 text-white rounded hover:bg-orange-700">
                            تأكيد
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function subscriptionModal() {
                return {
                    show: false,
                    planId: null,
                    planName: '',
                    price: '',
                    duration: '',
                    password: '',
                    message: '',
                    messageType: '',
                    showToast: false,
                    toastMessage: '',
                    toastType: '',

                    openModal(id, name, price, duration) {
                        this.planId = id;
                        this.planName = name;
                        this.price = parseFloat(price).toFixed(2);
                        this.duration = duration;
                        this.password = '';
                        this.message = '';
                        this.show = true;
                    },

                    async confirmSubscription() {
                        try {
                            const res = await fetch(`/subscription/confirm/${this.planId}`, {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                }
                            });

                            const data = await res.json();

                            if (data.success) {
                                this.toastMessage = data.message || 'تم الاشتراك بنجاح!';
                                this.toastType = 'success';
                                this.show = false;
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1500);
                            } else {
                                this.toastMessage = data.error || 'حدث خطأ أثناء الاشتراك';
                                this.toastType = 'error';
                            }
                            this.showToast = true;
                        } catch (err) {
                            this.toastMessage = 'تعذر الاتصال بالسيرفر';
                            this.toastType = 'error';
                            this.showToast = true;
                        }
                    }


                }
            }
        </script>
    </x-filament::section>
</x-filament-widgets::widget>
