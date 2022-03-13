<div class="relative">
    <div class="absolute inset-0 h-1/2"></div>
    <div class="relative max-w-7xl mx-auto px-4 px-6">
        <div class="max-w-4xl mx-auto">
            <dl class="rounded-lg bg-white grid grid-cols-3">
                <div class="flex flex-col border-gray-100 px-6 py-4 text-center border-0 border-r">
                    <dt class="order-2 mt-2 text-base leading-6 font-medium text-gray-500">Median</dt>
                    <dd class="order-1 text-xl font-bold text-green-700">{{ $user->daily_score_median }}</dd>
                </div>
                <div
                    class="flex flex-col border-gray-100 px-6 py-4 text-center border-0 border-l border-r"
                >
                    <dt class="order-2 mt-2 text-base leading-6 font-medium text-gray-500">Mean</dt>
                    <dd class="order-1 text-xl font-bold text-green-700">{{ $user->daily_score_mean }}</dd>
                </div>
                <div class="flex flex-col border-gray-100 px-6 py-4 text-center border-0 border-l">
                    <dt class="order-2 mt-2 text-base leading-6 font-medium text-gray-500">Mode</dt>
                    <dd class="order-1 text-xl font-bold text-green-700">{{ $user->daily_score_mode }}</dd>
                </div>
            </dl>
        </div>
    </div>
    <div class="mt-6">
        <div class="text-gray-500 text-sm text-center"><span class="font-semibold">{{ $user->daily_scores_recorded }}</span>
            recorded
            {{ Str::plural('score', $user->daily_scores_recorded ) }}.</div>
    </div>
    <div class="mt-8">
        <x-score.bar-chart :scores="$user->dailyScores" />
    </div>

</div>
