<div class="relative">
    <div class="absolute inset-0 h-1/2"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <dl class="rounded-lg bg-white sm:grid sm:grid-cols-3">
                <div class="flex flex-col border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                    <dt class="order-2 mt-2 text-base leading-6 font-medium text-gray-500">Median</dt>
                    <dd class="order-1 text-xl font-bold text-green-600">{{ $user->daily_score_median }}</dd>
                </div>
                <div
                    class="flex flex-col border-t border-b border-gray-100 p-6 text-center sm:border-0 sm:border-l sm:border-r"
                >
                    <dt class="order-2 mt-2 text-base leading-6 font-medium text-gray-500">Mean</dt>
                    <dd class="order-1 text-xl font-bold text-green-600">{{ $user->daily_score_mean }}</dd>
                </div>
                <div class="flex flex-col border-t border-gray-100 p-6 text-center sm:border-0 sm:border-l">
                    <dt class="order-2 mt-2 text-base leading-6 font-medium text-gray-500">Mode</dt>
                    <dd class="order-1 text-xl font-bold text-green-600">{{ $user->daily_score_mode }}</dd>
                </div>
            </dl>
        </div>
    </div>
    <div class="mt-6">
        <div class="text-gray-500 text-sm text-center">Based on <span class="font-semibold">{{ $user->daily_scores_recorded }}</span> scores.</div>
    </div>
</div>
