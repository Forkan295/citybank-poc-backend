<x-app-layout>
    <div class="py-4">
        <div class="max-w-7 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-1/2">
                        <div class="p-6">
                            <div class="bg-white shadow-sm sm:rounded-lg">
                            	<h2>Change Password</h2>
                                <x-auth-validation-errors />

                            	@if(session()->has('error'))
								    <div class="font-medium text-red-600">
								        {{ session()->get('error') }}
								    </div>
								@elseif(session()->has('success'))
								    <div class="font-medium text-green-600">
								        {{ session()->get('success') }}
								    </div>
								@endif

                                <form method="POST" action="{{ route('profile.update') }}">
                                    @csrf

                                    <div class="py-4">
                                        <x-label for="password" :value="__('Password')"/>
                                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required/>
                                    </div>

                                    <div class="py-4">
                                        <x-label for="cpassword" :value="__('Confirm Password')"/>
                                        <x-input id="cpassword" class="block mt-1 w-full" type="password" name="password_confirmation" required/>
                                    </div>

                                    <div class="flex  justify-start">
                                        <x-button>
                                            {{ __('Change Password') }}
                                        </x-button>
                                    </div>
                                </form>
                            </div>

                            <div class="bg-white shadow-sm sm:rounded-lg py-12">
                            	<h1>Account List</h1>
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
                                            Account Number
                                        </th>
                                        <th scope="col"
                                            class="py-4 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Account Balance
                                        </th>
                                        <th scope="col"
                                            class="py-4 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Status
                                        </th>
                                        <th scope="col"
                                            class="py-4 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Created At
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                    @foreach ($user->accounts as $item)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-900">
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->index + 1 }}</td>
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->account_no }}</td>
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->balance }} tk.</td>
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->status == 1 ? 'Active' : 'Inactive' }}</td>
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
