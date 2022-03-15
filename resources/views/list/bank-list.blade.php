<x-app-layout>
    <div class="py-4">
        <div class="max-w-7 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>Bank List</h1>

                    <div class="w-1/2">
                        <div class="p-6">
                            <div class="bg-white shadow-sm sm:rounded-lg">
                                <table
                                    class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                                    <thead class="bg-gray-100 dark:bg-gray-900 py-12">
                                    <tr>
                                        <th scope="col"
                                            class="py-4 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            #
                                        </th>
                                        <th scope="col"
                                            class="py-4 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Name
                                        </th>
                                        <th scope="col"
                                            class="py-4 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Short Code
                                        </th>
                                        <th scope="col"
                                            class="py-4 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Type
                                        </th>
                                        <th scope="col"
                                            class="py-4 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Founded
                                        </th>
                                        <th scope="col"
                                            class="py-4 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Founder
                                        </th>
                                        <th scope="col"
                                            class="py-4 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Headquarter
                                        </th>
                                        <th scope="col"
                                            class="py-4 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Website
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                    @foreach ($lists as $item)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-900">
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->id }}</td>
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->name }}</td>
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->short_code }}</td>
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->type }}</td>
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->founded }}</td>
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->founder }}</td>
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->headquarter }}</td>
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->website }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                @if ($lists->links())
                                    {{ $lists->links() }}
                                @endif 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
