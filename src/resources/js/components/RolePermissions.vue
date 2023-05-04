<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center ml-10 text-2xl font-semibold whitespace-nowrap">
            Role Permissions
        </span>
        <button
            @click="$router.push({path: '/settings'})"
            type="submit"
            class="text-white bg-slate-500 hover:bg-slate-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
        >
            Cancel
        </button>
    </div>
    <div v-if="this.permissions !== null" class="relative mt-5 m-2 p-2">
        <form>
            <div class="flex">
                <div class="mr-24">
                    <div>
                        <div class="flex mb-8">
                            <span class="self-center ml-10 text-xl font-semibold whitespace-nowrap">
                                Manager Access
                            </span>
                        </div>
                    </div>
                    <div>
                        <div class="flex mb-12">
                            <label
                                for="name"
                                class="block ml-10 w-32 text-sm font-medium text-gray-900"
                            >
                                Stock
                            </label>
                            <label class="switch">
                            <input type="checkbox" v-model="managerPermissions.find((permission) => permission.module == 'stock').access">
                            <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <div class="flex mb-12">
                            <label
                                for="name"
                                class="block ml-10 w-32 text-sm font-medium text-gray-900"
                            >
                                Orders
                            </label>
                            <label class="switch">
                            <input type="checkbox" v-model="managerPermissions.find((permission) => permission.module == 'orders').access">
                            <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <div class="flex mb-12">
                            <label
                                for="name"
                                class="block ml-10 w-32 text-sm font-medium text-gray-900"
                            >
                                Sales
                            </label>
                            <label class="switch">
                            <input type="checkbox" v-model="managerPermissions.find((permission) => permission.module == 'sales').access">
                            <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <div class="flex mb-12">
                            <label
                                for="name"
                                class="block ml-10 w-32 text-sm font-medium text-gray-900"
                            >
                                Deliveries
                            </label>
                            <label class="switch">
                            <input type="checkbox" v-model="managerPermissions.find((permission) => permission.module == 'deliveries').access">
                            <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <div class="flex mb-12">
                            <label
                                for="name"
                                class="block ml-10 w-32 text-sm font-medium text-gray-900"
                            >
                                Suppliers
                            </label>
                            <label class="switch">
                            <input type="checkbox" v-model="managerPermissions.find((permission) => permission.module == 'suppliers').access">
                            <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <div class="flex mb-12">
                            <label
                                for="name"
                                class="block ml-10 w-32 text-sm font-medium text-gray-900"
                            >
                                Settings
                            </label>
                            <label class="switch">
                            <input type="checkbox" v-model="managerPermissions.find((permission) => permission.module == 'settings').access">
                            <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div>
                    <div>
                        <div class="flex mb-8">
                            <span class="self-center ml-10 text-xl font-semibold whitespace-nowrap">
                                Floor Staff Access
                            </span>
                        </div>
                    </div>
                    <div>
                        <div class="flex mb-12">
                            <label
                                for="name"
                                class="block ml-10 w-32 text-sm font-medium text-gray-900"
                            >
                                Stock
                            </label>
                            <label class="switch">
                            <input type="checkbox" v-model="floorStaffPermissions.find((permission) => permission.module == 'stock').access">
                            <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <div class="flex mb-12">
                            <label
                                for="name"
                                class="block ml-10 w-32 text-sm font-medium text-gray-900"
                            >
                                Orders
                            </label>
                            <label class="switch">
                            <input type="checkbox" v-model="floorStaffPermissions.find((permission) => permission.module == 'orders').access">
                            <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <div class="flex mb-12">
                            <label
                                for="name"
                                class="block ml-10 w-32 text-sm font-medium text-gray-900"
                            >
                                Sales
                            </label>
                            <label class="switch">
                            <input type="checkbox" v-model="floorStaffPermissions.find((permission) => permission.module == 'sales').access">
                            <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <div class="flex mb-12">
                            <label
                                for="name"
                                class="block ml-10 w-32 text-sm font-medium text-gray-900"
                            >
                                Deliveries
                            </label>
                            <label class="switch">
                            <input type="checkbox" v-model="floorStaffPermissions.find((permission) => permission.module == 'deliveries').access">
                            <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <div class="flex mb-12">
                            <label
                                for="name"
                                class="block ml-10 w-32 text-sm font-medium text-gray-900"
                            >
                                Suppliers
                            </label>
                            <label class="switch">
                            <input type="checkbox" v-model="floorStaffPermissions.find((permission) => permission.module == 'suppliers').access">
                            <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <div class="flex mb-12">
                            <label
                                for="name"
                                class="block ml-10 w-32 text-sm font-medium text-gray-900"
                            >
                                Settings
                            </label>
                            <label class="switch">
                            <input type="checkbox" v-model="floorStaffPermissions.find((permission) => permission.module == 'settings').access">
                            <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end pr-4">
                <button
                    @click="savePermissions"
                    type="button"
                    class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
                >
                    Save
                </button>
            </div>
        </form>
    </div>
    <div v-else class="grid min-h-screen place-content-center">
        <div class="flex items-center gap-2 text-gray-500">
        <span class="h-6 w-6 block rounded-full border-4 border-t-blue-300 animate-spin"></span>
        loading...
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            manager: {
                stock: false,
                orders: false,
                sales: false,
                deliveries: false,
                suppliers: false,
                settings: false
            },
            floorStaff: {
                stock: false,
                orders: false,
                sales: false,
                deliveries: false,
                suppliers: false,
                settings: false
            },
            permissions: null
        }
    },
    mounted() {
        this.getPermissions();
    },
    computed: {
        managerPermissions() {
            if (this.permissions) {
                return this.permissions.filter((permission) => permission.role == "manager");
            }
            return null;
        },
        floorStaffPermissions() {
            if (this.permissions) {
                return this.permissions.filter((permission) => permission.role == "floor staff");
            }
            return null;
        },
    },
    methods: {
        getPermissions() {
            axios.get("http://127.0.0.1:8080/api/permissions/")
                .then((response) => {
                    this.permissions = response.data;
            });
        },
        async savePermissions() {
            try {
                const permissions = this.managerPermissions.concat(this.floorStaffPermissions);
                await axios.post("http://127.0.0.1:8080/api/permissions", permissions)
                await this.$router.push({path: '/settings'})
                window.location.reload();
            } catch (error) {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            }
        },
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