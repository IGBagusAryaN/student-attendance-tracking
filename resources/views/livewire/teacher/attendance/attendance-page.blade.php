<div>
    <div class="max-w-[85rem] px-4 pb-10 sm:px-6 lg:px-8 lg:pb-14 mx-auto">

        <div class="w-full mb-3">
            <div class="w-[55%] inline-flex gap-x-2">
                <select wire:model="year"
                    class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-xl cursor-pointer text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                    <option selected="">Year</option>
                    @foreach (range(now()->year - 10, now()->year) as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
                <select wire:model="month"
                    class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-xl cursor-pointer text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                    <option selected="">Month</option>
                    @foreach (range(1, 12) as $m)
                        <option value="{{ $m }}">
                            {{ Carbon\Carbon::create()->month($m)->format('F') }}</option>
                    @endforeach
                </select>
                <select wire:model="grade"
                    class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-xl cursor-pointer text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                    <option selected="">Grade</option>
                    @foreach ($grades as $grade)
                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                    @endforeach
                </select>
                <select wire:model="selectedDay"
                    class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-xl cursor-pointer text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                    <option value="">Day</option>
                    @foreach (range(1, $daysInMonth) as $day)
                        <option value="{{ $day }}">{{ $day }}</option>
                    @endforeach
                </select>
                <button type="button" wire:click="fetchStudents()"
                    class="py-2 px-3 cursor-pointer flex justify-center items-center size-11 text-sm font-medium rounded-lg border border-transparent bg-gray-600 text-white hover:bg-gray-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                            d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
        <!-- Card -->
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div
                        class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-900 dark:border-neutral-700">
                        <!-- Header -->
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                                    Attendance
                                </h2>
                                <p class="text-sm text-gray-600 dark:text-neutral-400">
                                    Attendance overview.
                                </p>
                            </div>
                            @if ($year && $month && $grade)
                                <div class="flex items-center gap-2">
                                    <div>Export to excel</div>
                                    <button type="button" wire:click="exportToExcel()"
                                        class="cursor-pointer py-2 px-3 flex justify-center items-center size-11 text-sm font-medium rounded-lg border border-transparent bg-gray-600 text-white hover:bg-gray-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <!-- End Header -->

                        <!-- Table -->
                        @if ($year && $month && $grade)
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead
                                    class="bg-gray-50 divide-y divide-gray-200 dark:bg-neutral-800 dark:divide-neutral-700">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-start border-s border-gray-200 dark:border-neutral-700">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                Student name
                                            </span>
                                        </th>
                                        @if ($selectedDay)
                                            <th
                                                class="border border-gray-200 dark:border-neutral-700 px-4 py-2 text-center">
                                                {{ $daysLabel[$selectedDay] }}</th>
                                        @else
                                            @foreach (range(1, $daysInMonth) as $day)
                                                <th
                                                    class="border border-gray-200 dark:border-neutral-700 px-4 py-2 text-center">
                                                    {{ $day }} {{ $daysLabel[$day] }}<< /th>
                                            @endforeach
                                        @endif

                                        {{-- @foreach (range(1, $daysInMonth) as $day)
                                            <th scope="col"
                                                class="px-6 py-3 text-start border border-gray-200 dark:border-neutral-700-s border border-gray-200 dark:border-neutral-700-gray-200 dark:border border-gray-200 dark:border-neutral-700-neutral-700">
                                                <span
                                                    class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                    {{ $day }}
                                                    <select
                                                        wire:change="markAll({{ $day }}, $event.target.value)"
                                                        class="">
                                                        <option selected value="">All</option>
                                                        <option value="present">Present</option>
                                                        <option value="absent">Absent</option>
                                                        <option value="sick">Sick</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </span>
                                            </th>
                                        @endforeach --}}
                                    </tr>
                                </thead>
                                <tbody class=" divide-y divide-gray-200 dark:divide-neutral-700">
                                    @foreach ($students as $student)
                                        <tr>
                                            <td class="border border-gray-200 dark:border-neutral-700 px-6 py-2">
                                                {{ $student->first_name }}{{ $student->last_name }}</td>

                                            @if ($selectedDay)
                                                <td
                                                    class="border border-gray-200 dark:border-neutral-700 px-4 py-2 text-center">
                                                    <select
                                                        wire:change="updateAttendance({{ $student->id }},{{ $selectedDay }}, $event.target.value)"
                                                        class="outline-none cursor-pointer bg-white dark:bg-[#171717] text-[#1d1d1d] dark:text-white ">
                                                        {{-- <option selected value="">All</option> --}}
                                                        
                                                        <option value="check"
                                                            {{ $attendance[$student->id][$selectedDay] == 'check' ? 'selected' : '' }}>
                                                            Check Attendance</option>
                                                        <option value="present"
                                                            {{ $attendance[$student->id][$selectedDay] == 'present' ? 'selected' : '' }}>
                                                            Present</option>
                                                        <option value="absent"
                                                            {{ $attendance[$student->id][$selectedDay] == 'absent' ? 'selected' : '' }}>
                                                            Absent</option>
                                                        <option value="sick"
                                                            {{ $attendance[$student->id][$selectedDay] == 'sick' ? 'selected' : '' }}>
                                                            Sick</option>
                                                        <option
                                                            value="other"{{ $attendance[$student->id][$selectedDay] == 'other' ? 'selected' : '' }}>
                                                            Other</option>
                                                    </select>
                                                </td>
                                            @else
                                                @foreach (range(1, $daysInMonth) as $day)
                                                    <td
                                                        class="border border-gray-200 dark:border-neutral-700 px-4 py-2 text-center">
                                                        <select
                                                            wire:change="updateAttendance({{ $student->id }}, {{ $selectedDay }}, $event.target.value)"
                                                            class="">
                                                            {{-- <option selected value="">All</option> --}}
                                                            <option value="check"
                                                            {{ $attendance[$student->id][$selectedDay] == 'check' ? 'selected' : '' }}>
                                                            Check Attendance</option>
                                                            <option value="present"
                                                                {{ $attendance[$student->id][$selectedDay] == 'present' ? 'selected' : '' }}>
                                                                Present</option>
                                                            <option value="absent"
                                                                {{ $attendance[$student->id][$selectedDay] == 'absent' ? 'selected' : '' }}>
                                                                Absent</option>
                                                            <option value="sick"
                                                                {{ $attendance[$student->id][$selectedDay] == 'sick' ? 'selected' : '' }}>
                                                                Sick</option>
                                                            <option
                                                                value="other"{{ $attendance[$student->id][$selectedDay] == 'other' ? 'selected' : '' }}>
                                                                Other</option>
                                                        </select>
                                                    </td>
                                                @endforeach
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table -->

                            <!-- Footer -->
                            <div
                                class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                                        <span
                                            class="font-semibold text-gray-800 dark:text-neutral-200">{{ $grades->count() }}</span>
                                        results
                                    </p>
                                </div>

                                <div>
                                    {{-- <div class="inline-flex gap-x-2">
                                        <button type="button"
                                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="m15 18-6-6 6-6" />
                                            </svg>
                                            Prev
                                        </button>

                                        <button type="button"
                                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                            Next
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="m9 18 6-6-6-6" />
                                            </svg>
                                        </button>
                                    </div> --}}
                                </div>
                            </div>

                        @endif
                        <!-- End Footer -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
</div>
