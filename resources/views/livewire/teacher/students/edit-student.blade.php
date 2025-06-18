

<!-- Comment Form -->
<div class="max-w-[85rem] px-4 pb-10 sm:px-6 lg:px-8 lg:pb-14 mx-auto">
    <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-900 dark:border-neutral-700">
        <div
            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                    Update data student
                </h2>
                <p class="text-sm text-gray-600 dark:text-neutral-400">
                    Student overview by school.
                </p>
            </div>
        </div>

        <!-- Card -->
        <div
            class=" p-4 relative z-10 bg-white rounded-xl  md:p-10 dark:bg-neutral-900">
            <form wire:submit="update">
                <div class="flex w-full gap-3">
                <div class="mb-4 sm:mb-8 w-full">
                    <label for="hs-feedback-post-comment-name-1"
                        class="block mb-2 text-sm font-medium dark:text-white">First name</label>
                    <input type="text" wire:model="first_name"
                        class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                        placeholder="First name">
                    @error('first_name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4 sm:mb-8 w-full">
                    <label for="hs-feedback-post-comment-name-1"
                        class="block mb-2 text-sm font-medium dark:text-white">Last name</label>
                    <input type="text" wire:model="last_name"
                        class="py-2.5 sm:py-3 px-4 block w-full  border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                        placeholder="last name">
                    @error('last_name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                                </div>

                <div class="mb-4 sm:mb-8">
                    <label for="hs-feedback-post-comment-email-1"
                        class="block mb-2 text-sm font-medium dark:text-white">Age</label>
                    <input type="number" wire:model="age" id="hs-feedback-post-comment-email-1"
                        class="py-2.5 sm:py-3 px-4 block w-full  border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                        placeholder="Age...">

                    @error('age')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="hs-feedback-post-comment-textarea-1"
                        class="block mb-2 text-sm font-medium dark:text-white">Grade</label>
                    <div class="mt-1">
                        <select wire:model="grade"
                            class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <option selected="">Open this select menu</option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}" wire:key="{{ $grade->id }}">{{ $grade->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('grade')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <flux:button variant="primary" type="submit" class="w-full mt-5 cursor-pointer">{{ __('Update') }}</flux:button>

                {{-- <div class="mt-6 grid">
                    <div wire:loading
                        class="bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-neutral-800 dark:border-neutral-700 w-full py-3 px-4 inline-flex justify-center items-center "
                        role="alert" tabindex="-1" aria-labelledby="hs-toast-message-with-loading-indicator-label">
                        <div class="flex items-center">
                            <div class="animate-spin inline-block size-4 border-3 border-current border-t-transparent text-white rounded-full"
                                role="status" aria-label="loading">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <button wire:loading.remove type="submit"
                        class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Submit</button>
                </div> --}}
            </form>
        </div>
        <!-- End Card -->
    </div>
</div>
<!-- End Comment Form -->
