<div>
    <!-- Tabs -->
    <div
        x-data="{
        selectedId: null,
        init() {
            // Set the first available tab on the page on page load.
            this.$nextTick(() => this.select(this.$id('tab', 2)))
        },
        select(id) {
            this.selectedId = id
        },
        isSelected(id) {
            return this.selectedId === id
        },
        whichChild(el, parent) {
            return Array.from(parent.children).indexOf(el) + 1
        }
    }"
        x-id="['tab']"
        class="max-w-3xl mx-auto"

    >
        <!-- Tab List -->
        <ul
            x-ref="tablist"
            @keydown.right.prevent.stop="$focus.wrap().next()"
            @keydown.home.prevent.stop="$focus.first()"
            @keydown.page-up.prevent.stop="$focus.first()"
            @keydown.left.prevent.stop="$focus.wrap().prev()"
            @keydown.end.prevent.stop="$focus.last()"
            @keydown.page-down.prevent.stop="$focus.last()"
            role="tablist"
            class="-mb-px flex items-stretch justify-center"
            x-cloak
        >
            <!-- Tab -->
            <li>
                <button
                    :id="$id('tab', whichChild($el.parentElement, $refs.tablist))"
                    @click="select($el.id)"
                    @mousedown.prevent
                    @focus="select($el.id)"
                    type="button"
                    :tabindex="isSelected($el.id) ? 0 : -1"
                    :aria-selected="isSelected($el.id)"
                    :class="isSelected($el.id) ? 'border-gray-200 font-bold bg-white' : 'border-transparent'"
                    class="inline-flex px-5 border-t border-l border-r py-2.5 rounded-t-md text-sm md:text-base"
                    role="tab"
                >All Time</button>
            </li>

            <li>
                <button
                    :id="$id('tab', whichChild($el.parentElement, $refs.tablist))"
                    @click="select($el.id)"
                    @mousedown.prevent
                    @focus="select($el.id)"
                    type="button"
                    :tabindex="isSelected($el.id) ? 0 : -1"
                    :aria-selected="isSelected($el.id)"
                    :class="isSelected($el.id) ? 'border-gray-200 font-bold bg-white' : 'border-transparent'"
                    class="inline-flex px-5 py-2.5 border-t border-l border-r rounded-t-md text-sm md:text-base"
                    role="tab"
                >This Month</button>
            </li>


            <li>
                <button
                    :id="$id('tab', whichChild($el.parentElement, $refs.tablist))"
                    @click="select($el.id)"
                    @mousedown.prevent
                    @focus="select($el.id)"
                    type="button"
                    :tabindex="isSelected($el.id) ? 0 : -1"
                    :aria-selected="isSelected($el.id)"
                    :class="isSelected($el.id) ? 'border-gray-200 font-bold bg-white' : 'border-transparent'"
                    class="inline-flex px-5 py-2.5 border-t border-l border-r rounded-t-md text-sm md:text-base"
                    role="tab"
                >This Week</button>
            </li>
        </ul>

        <!-- Panels -->
        <div role="tabpanels" class="bg-white border border-gray-200 rounded-b-md">
            <!-- Panel -->
            <section
                x-show="isSelected($id('tab', whichChild($el, $el.parentElement)))"
                :aria-labelledby="$id('tab', whichChild($el, $el.parentElement))"
                role="tabpanel"
                class="p-5"
                x-cloak
            >
                @if($leaderboards->firstWhere('for', 'forever'))
                    <x-group.leaderboard
                        :group="$group"
                        :anonymize-private-users="$group->public && !$memberOfGroup"
                        :leaderboard="$leaderboards->firstWhere('for', 'forever')"
                    />
                @else
                    <span class="text-sm md:text-base">
                        No one in this group has recorded any scores.
                    </span>
                @endif
            </section>

            <section
                x-show="isSelected($id('tab', whichChild($el, $el.parentElement)))"
                :aria-labelledby="$id('tab', whichChild($el, $el.parentElement))"
                role="tabpanel"
                class="p-5"
            >
                @if($leaderboards->firstWhere('for', 'month'))
                    <x-group.leaderboard
                        :group="$group"
                        :anonymize-private-users="$group->public && !$memberOfGroup"
                        :leaderboard="$leaderboards->firstWhere('for', 'month')"
                    />

                @else
                    No one in this group has recorded any scores this month.
                @endif
            </section>

            <section
                x-show="isSelected($id('tab', whichChild($el, $el.parentElement)))"
                :aria-labelledby="$id('tab', whichChild($el, $el.parentElement))"
                role="tabpanel"
                class="p-5"
                x-cloak
            >
                @if($leaderboards->firstWhere('for', 'week'))
                    <x-group.leaderboard
                        :group="$group"
                        :anonymize-private-users="$group->public && !$memberOfGroup"
                        :leaderboard="$leaderboards->firstWhere('for', 'week')"
                    />

                @else
                    No one in this group has recorded any scores this week.
                @endif
            </section>
        </div>
    </div>
</div>
