<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div x-data="{ showModal: false }" @close-modal.window="showModal = false"> <!-- Alpine.js controller -->
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center justify-between">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Devices</h1>
                        <p class="mt-2 text-sm text-gray-700">A list of all the devices</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <button @click="showModal = true" type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Add device
                        </button>
                    </div>
                </div>
                <!-- Modal for Create Device -->
                <div x-show="showModal"
                     class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full"
                     @click.away="showModal = false">

                    <!-- Modal Content -->
                    <div class="min-h-screen px-4 text-center">
                        <span class="inline-block h-screen align-middle" aria-hidden="true">&#8203;</span>
                        <div class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Add New Device</h3>
                                <button @click="showModal = false" class="text-gray-500 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" title="Close modal">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>
                            </div>

                            <!-- Form -->
                            @livewire('devices.create-device')
                        </div>
                    </div>
                </div>

                {{-- @livewire("devices.devices-index") --}}
                <livewire:devices.devices-index />

            </div>

        </div>
    </div>
</x-app-layout>
