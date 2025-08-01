
{{--@dd($this->getPlans()["plans"])--}}
{{--@dd($this->getPlans()["comSub"]->subscription_plan_id)--}}
{{--@dd( Filament::getTenant())--}}

<x-filament-widgets::widget>
    <x-filament::section>
        باقات الاشتراك
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($this->getPlans()["plans"] as $plan)
                <div class=" rounded-xl shadow p-6 border">
                    <h3 class="text-lg font-bold text-orange-600" style="color: darkorange">{{ $plan->name }}</h3>
                    <p class="text-gray-400">{{ $plan->description }}</p>
                    <div class="mt-4 text-sm text-gray-500">
                        <p><strong>السعر:</strong> {{ $plan->price }} $</p>
                        <p><strong>عدد المشاريع:</strong> {{ $plan->project_limit }}</p>
                        <p><strong>المدة:</strong> {{ $plan->duration_in_days }} يوم</p>
                    </div>
                    <button
                        class="mt-4 bg-orange-500 text-white px-4 py-1 my-2 rounded hover:bg-orange-600 transition" style="background-color: orangered">

                                اشترك الآن
                    </button>
                </div>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>









{{--<x-filament-widgets::widget>--}}
{{--    <x-filament::section>--}}

{{--        <div class="bg-red-500 text-white p-4 rounded">--}}
{{--            Tailwind شغال داخل Filament ✅--}}
{{--        </div>--}}

{{--    </x-filament::section>--}}
{{--</x-filament-widgets::widget>--}}
<!-- component -->
{{--<section class="bg-gray-900 py-12">--}}
{{--    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">--}}
{{--        <div class="text-center mb-12">--}}
{{--            <h2 class="text-4xl font-extrabold text-white sm:text-5xl">--}}
{{--                Pricing Plans--}}
{{--            </h2>--}}
{{--            <p class="mt-4 text-xl text-gray-400">--}}
{{--                Simple, transparent pricing for your business needs.--}}
{{--            </p>--}}
{{--        </div>--}}

{{--        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">--}}
{{--            <!-- Free Plan -->--}}
{{--            <div class="bg-gray-800 rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">--}}
{{--                <div class="mb-8">--}}
{{--                    <h3 class="text-2xl font-semibold text-white">Free</h3>--}}
{{--                    <p class="mt-4 text-gray-400">Get started with our basic features.</p>--}}
{{--                </div>--}}
{{--                <div class="mb-8">--}}
{{--                    <span class="text-5xl font-extrabold text-white">$0</span>--}}
{{--                    <span class="text-xl font-medium text-gray-400">/mo</span>--}}
{{--                </div>--}}
{{--                <ul class="mb-8 space-y-4 text-gray-400">--}}
{{--                    <li class="flex items-center">--}}
{{--                        <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />--}}
{{--                        </svg>--}}
{{--                        <span>1 user account</span>--}}
{{--                    </li>--}}
{{--                    <li class="flex items-center">--}}
{{--                        <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />--}}
{{--                        </svg>--}}
{{--                        <span>10 transactions per month</span>--}}
{{--                    </li>--}}
{{--                    <li class="flex items-center">--}}
{{--                        <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />--}}
{{--                        </svg>--}}
{{--                        <span>Basic support</span>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--                <a href="#" class="block w-full py-3 px-6 text-center rounded-md text-white font-medium bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600">--}}
{{--                    Sign Up--}}
{{--                </a>--}}
{{--            </div>--}}

{{--            <!-- Starter Plan -->--}}
{{--            <div class="bg-gray-800 rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">--}}
{{--                <div class="mb-8">--}}
{{--                    <h3 class="text-2xl font-semibold text-white">Starter</h3>--}}
{{--                    <p class="mt-4 text-gray-400">Perfect for small businesses and startups.</p>--}}
{{--                </div>--}}
{{--                <div class="mb-8">--}}
{{--                    <span class="text-5xl font-extrabold text-white">$49</span>--}}
{{--                    <span class="text-xl font-medium text-gray-400">/mo</span>--}}
{{--                </div>--}}
{{--                <ul class="mb-8 space-y-4 text-gray-400">--}}
{{--                    <li class="flex items-center">--}}
{{--                        <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />--}}
{{--                        </svg>--}}
{{--                        <span>5 user accounts</span>--}}
{{--                    </li>--}}
{{--                    <li class="flex items-center">--}}
{{--                        <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />--}}
{{--                        </svg>--}}
{{--                        <span>100 transactions per month</span>--}}
{{--                    </li>--}}
{{--                    <li class="flex items-center">--}}
{{--                        <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />--}}
{{--                        </svg>--}}
{{--                        <span>Standard support</span>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--                <a href="#" class="block w-full py-3 px-6 text-center rounded-md text-white font-medium bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600">--}}
{{--                    Get Started--}}
{{--                </a>--}}
{{--            </div>--}}

{{--            <!-- Pro Plan -->--}}
{{--            <div class="bg-gray-800 rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">--}}
{{--                <div class="mb-8">--}}
{{--                    <h3 class="text-2xl font-semibold text-white">Pro</h3>--}}
{{--                    <p class="mt-4 text-gray-400">Ideal for growing businesses and enterprises.</p>--}}
{{--                </div>--}}
{{--                <div class="mb-8">--}}
{{--                    <span class="text-5xl font-extrabold text-white">$99</span>--}}
{{--                    <span class="text-xl font-medium text-gray-400">/mo</span>--}}
{{--                </div>--}}
{{--                <ul class="mb-8 space-y-4 text-gray-400">--}}
{{--                    <li class="flex items-center">--}}
{{--                        <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />--}}
{{--                        </svg>--}}
{{--                        <span>Unlimited user accounts</span>--}}
{{--                    </li>--}}
{{--                    <li class="flex items-center">--}}
{{--                        <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />--}}
{{--                        </svg>--}}
{{--                        <span>Unlimited transactions</span>--}}
{{--                    </li>--}}
{{--                    <li class="flex items-center">--}}
{{--                        <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />--}}
{{--                        </svg>--}}
{{--                        <span>Priority support</span>--}}
{{--                    </li>--}}
{{--                    <li class="flex items-center">--}}
{{--                        <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />--}}
{{--                        </svg>--}}
{{--                        <span>Advanced analytics</span>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--                <a href="#" class="block w-full py-3 px-6 text-center rounded-md text-white font-medium bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600">--}}
{{--                    Get Started--}}
{{--                </a>--}}
{{--            </div>--}}

{{--            <!-- Enterprise Plan -->--}}
{{--            <div class="bg-gray-800 rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">--}}
{{--                <div class="mb-8">--}}
{{--                    <h3 class="text-2xl font-semibold text-white">Enterprise</h3>--}}
{{--                    <p class="mt-4 text-gray-400">Tailored for large-scale deployments and custom needs.</p>--}}
{{--                </div>--}}
{{--                <div class="mb-8">--}}
{{--                    <span class="text-5xl font-extrabold text-white">Custom</span>--}}
{{--                </div>--}}
{{--                <ul class="mb-8 space-y-4 text-gray-400">--}}
{{--                    <li class="flex items-center">--}}
{{--                        <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />--}}
{{--                        </svg>--}}
{{--                        <span>Dedicated infrastructure</span>--}}
{{--                    </li>--}}
{{--                    <li class="flex items-center">--}}
{{--                        <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />--}}
{{--                        </svg>--}}
{{--                        <span>Custom integrations</span>--}}
{{--                    </li>--}}
{{--                    <li class="flex items-center">--}}
{{--                        <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />--}}
{{--                        </svg>--}}
{{--                        <span>Dedicated support team</span>--}}
{{--                    </li>--}}
{{--                    <li class="flex items-center">--}}
{{--                        <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />--}}
{{--                        </svg>--}}
{{--                        <span>Premium SLAs</span>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--                <a href="#" class="block w-full py-3 px-6 text-center rounded-md text-white font-medium bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600">--}}
{{--                    Contact Sales--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}



