<div
    x-data="{
        notifications: [],
        add(e) {
            this.notifications.push({
                id: e.timeStamp,
                type: e.detail.type,
                content: e.detail.content,
            })
        },
        remove(notification) {
            this.notifications = this.notifications.filter(i => i.id !== notification.id)
        },
    }"
    @notify.window="add($event)"
    class="fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start"
    role="status"
    aria-live="polite"
>
    <div class="w-full flex flex-col items-center sm:items-end">

        <!-- Notification -->
        <template x-for="notification in notifications" :key="notification.id">
            <div
                x-data="{
                show: false,
                init() {
                    this.$nextTick(() => this.show = true)

                    setTimeout(() => this.transitionOut(), 300000)
                },
                transitionOut() {
                    this.show = false

                    setTimeout(() => this.remove(this.notification), 500)
                },
            }"
                x-show="show"
                x-transition.duration.500ms
                class="relative max-w-sm w-full bg-white mb-4 last:mb-0 pl-6 pr-4 py-4 border border-gray-200 rounded-md shadow-lg pointer-events-auto"
            >
                <div class="flex items-center">
                    <!-- Icons -->
                    <div x-show="notification.type === 'info'" class="flex-shrink-0">
                        <x-icon-solid.circle-info class="h-4 w-4 text-blue-500"/>
                        <span class="sr-only">Information:</span>
                    </div>

                    <div x-show="notification.type === 'success'" class="flex-shrink-0">
                        <x-icon-solid.circle-check class="h-4 w-4 text-green-700"/>
                        <span class="sr-only">Success:</span>
                    </div>

                    <div x-show="notification.type === 'error'" class="flex-shrink-0">
                        <x-icon-solid.circle-exclamation class="h-4 w-4 text-red-700"/>
                        <span class="sr-only">Error:</span>
                    </div>

                    <!-- Text -->
                    <div class="ml-3 w-0 flex-1">
                        <p x-text="notification.content" class="text-sm leading-5 font-medium text-gray-900"></p>
                    </div>

                    <!-- Remove button -->
                    <div class="ml-4 flex-shrink-0 flex">
                        <button @click="transitionOut()" type="button" class="inline-flex text-gray-400">
                            <x-icon-regular.xmark class="h-4 w-4 text-gray-400"/>

                            <span class="sr-only">Close notification</span>
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
