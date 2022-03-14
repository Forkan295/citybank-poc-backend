<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-1/2">
                        <div class="p-6">
                            <div class="bg-white shadow-sm sm:rounded-lg">
                                <h1>Activiry Log Details</h1>
                                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                                    @foreach ($activityLog->properties as $key => $item)
                                        <tr>
                                            <th style="text-align: left;">{{ $key }}</th>
                                            <th>&nbsp;&nbsp;:&nbsp;&nbsp;</th>
                                            <td>{{ ($key == 'status' && $item == 1) ? 'success' : $item }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
