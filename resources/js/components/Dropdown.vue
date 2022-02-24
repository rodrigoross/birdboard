<template>
    <div class="dropdown relative">
        <div
            class="dropdown-toggle"
            aria-haspopup="true"
            :aria-expanded="isOpen"
            @click.prevent="isOpen = !isOpen"
        >
            <slot name="trigger"></slot>
        </div>

        <div
            v-show="isOpen"
            class="dropdown-menu absolute bg-white py-2 rounded shadow mt-2"
            :class="align === 'left' ? 'left-0' : 'right-0'"
            :style="{ width }"
        >
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        align: {
            type: String,
            default: "left",
        },
        width: {
            type: String,
            default: "auto",
        },
    },

    data() {
        return {
            isOpen: false,
        };
    },

    watch: {
        isOpen(isOpen) {
            if (isOpen) {
                document.addEventListener("click", this.closedIfClickedOutside);
            }
        },
    },

    methods: {
        closedIfClickedOutside(event) {
            if (!event.target.closest(".dropdown")) {
                document.removeEventListener(
                    "click",
                    this.closedIfClickedOutside
                );
                this.isOpen = false;
            }
        },
    },
};
</script>

<style>
</style>
