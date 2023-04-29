<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center ml-10 text-2xl font-semibold whitespace-nowrap">
            Automated Reordering
        </span>
        <button
            @click="$router.push({path: '/settings'})"
            type="submit"
            class="text-white bg-slate-500 hover:bg-slate-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
        >
            Cancel
        </button>
    </div>
    <div class="relative mt-5 m-2 p-2">
        <form>
            <div class="grid grid-cols-2">
                <div>
                    <div class="flex mb-12">
                        <label
                            for="name"
                            class="block ml-10 w-32 text-sm font-medium text-gray-900"
                        >
                            Enabled
                        </label>
                        <label class="switch">
                        <input type="checkbox" v-model="enabled">
                        <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="flex mb-12">
                        <div class="grid">
                            <label for="name"
                                class="block ml-10 w-32 text-sm font-medium text-gray-900"
                            >
                                Reorder Level
                            </label>
                            <label for="name"
                                class="block ml-10 w-64 text-sm text-gray-900"
                            >
                                The reorder level specifies the stock level an item must reach to be automatically reordered
                            </label>
                        </div>
                        <input
                            v-model="reorderLevel"
                            type="number"
                            :disabled="!enabled"
                            min="1"
                            step="any"
                            id="name"
                            class="level-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/4 p-2.5 ml-5"
                        required>
                    </div>
                    <div class="flex mb-12">
                        <div class="grid">
                            <label for="name"
                                class="block ml-10 w-32 text-sm font-medium text-gray-900"
                            >
                                Reorder Amount
                            </label>
                            <label for="name"
                                class="block ml-10 w-64 text-sm text-gray-900"
                            >
                                The reorder amount specifies the quantity that will be ordered when an item is automatically reordered
                            </label>
                        </div>
                        <input
                            v-model="reorderAmount"
                            type="number"
                            :disabled="!enabled"
                            min="1"
                            step="any"
                            id="name"
                            class="level-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/4 p-2.5 ml-5"
                        required>
                    </div>
                </div>
            </div>
            <div class="flex justify-end pr-4">
                <button
                    @click="saveSettings"
                    type="button"
                    class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
                >
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            enabled: false,
            reorderLevel: 0,
            reorderAmount: 0
        }
    },
    watch: {
        enabled() {
            this.reorderLevel = 0;
            this.reorderAmount = 0;
        }
    },
    methods: {
        saveSettings() {
            return;
        }
    }
}
</script>

<style>
 /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.level-input {
  position: relative;
  display: inline-block;
  width: 100px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
} 
</style>